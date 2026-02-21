<?php

namespace App\Services;

use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Calendar_EventDateTime;
use Google_Service_Calendar_ConferenceData;
use Google_Service_Calendar_CreateConferenceRequest;
use Google_Service_Calendar_ConferenceSolutionKey;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class GoogleCalendarService
{
    protected $client;
    protected $service;

    public function __construct()
    {
        $this->client = new Google_Client();
        
        $this->client->setClientId(env('GOOGLE_CLIENT_ID'));
        $this->client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $this->client->setRedirectUri(route('google.callback'));

        // Look for the user OAuth token, not the service account JSON
        $tokenPath = storage_path('app/google-calendar/oauth_token.json');

        if (file_exists($tokenPath)) {
            $accessToken = json_decode(file_get_contents($tokenPath), true);
            $this->client->setAccessToken($accessToken);

            if ($this->client->isAccessTokenExpired()) {
                if ($this->client->getRefreshToken()) {
                    $this->client->fetchAccessTokenWithRefreshToken($this->client->getRefreshToken());
                    file_put_contents($tokenPath, json_encode($this->client->getAccessToken()));
                }
            }
        } else {
            Log::warning('Google Calendar oauth_token.json not found. Please authenticate via admin settings.');
        }

        $this->client->setScopes([Google_Service_Calendar::CALENDAR_EVENTS]);
        $this->client->setAccessType('offline');

        $this->service = new Google_Service_Calendar($this->client);
    }

    /**
     * Create a Google Calendar Event and generate a Meet Link
     *
     * @param string $summary Title of the event
     * @param string $description Description or notes for the event
     * @param Carbon $startDateTime Start time of the event
     * @param Carbon $endDateTime End time of the event
     * @param string $attendeeEmail Email of the person who booked
     * @param string $calendarId Defaults to 'primary'. If using a specific calendar, pass its ID here.
     * @return array Contains 'meet_link' and 'event_id'
     */
    public function createEventWithMeetLink(
        $summary, 
        $description, 
        $startDateTime, 
        $endDateTime, 
        $attendeeEmail,
        $calendarId = 'primary'
    ) {
        if (!$this->client->isAccessTokenExpired() && empty($this->client->getAccessToken())) {
            // Avoid fatal errors if file doesn't exist yet
            return [
                'meet_link' => null,
                'event_id' => null,
                'error' => 'Google Calendar not authenticated. Please run the setup flow.'
            ];
        }

        $event = new Google_Service_Calendar_Event([
            'summary' => $summary,
            'description' => $description,
            'start' => [
                'dateTime' => $startDateTime->format(\DateTime::ISO8601),
                'timeZone' => config('app.timezone'),
            ],
            'end' => [
                'dateTime' => $endDateTime->format(\DateTime::ISO8601),
                'timeZone' => config('app.timezone'),
            ],
            'attendees' => [
                ['email' => $attendeeEmail],
            ],
            // Request video conference info (Google Meet)
            'conferenceData' => [
                'createRequest' => [
                    'requestId' => 'request-' . time(),
                    'conferenceSolutionKey' => [
                        'type' => 'hangoutsMeet'
                    ]
                ]
            ],
            'reminders' => [
                'useDefault' => false,
                'overrides' => [
                    ['method' => 'email', 'minutes' => 24 * 60], // 1 day before
                    ['method' => 'popup', 'minutes' => 10], // 10 minutes before
                ],
            ],
        ]);

        try {
            // The conferenceDataVersion arg is critical for generating Meet links
            $createdEvent = $this->service->events->insert($calendarId, $event, ['conferenceDataVersion' => 1]);

            return [
                'meet_link' => $createdEvent->getHangoutLink(),
                'event_id' => $createdEvent->getId(),
            ];
        } catch (\Exception $e) {
            Log::error('Full Google Calendar Error: ' . $e->getMessage());
            return [
                'meet_link' => null,
                'event_id' => null,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Delete a Google Calendar Event by its event ID.
     *
     * @param string $eventId The Google Calendar Event ID to delete
     * @param string $calendarId Defaults to 'primary'
     * @return bool True on success, false on failure
     */
    public function deleteEvent($eventId, $calendarId = 'primary')
    {
        if (empty($eventId)) {
            return false;
        }

        try {
            $this->service->events->delete($calendarId, $eventId);
            Log::info('Google Calendar event deleted: ' . $eventId);
            return true;
        } catch (\Exception $e) {
            Log::error('Google Calendar deleteEvent error: ' . $e->getMessage());
            return false;
        }
    }
}
