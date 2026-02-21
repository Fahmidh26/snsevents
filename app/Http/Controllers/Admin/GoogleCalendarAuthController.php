<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Google_Client;
use Google_Service_Calendar;

class GoogleCalendarAuthController extends Controller
{
    public function auth()
    {
        $client = new Google_Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        // Use the route helper to dynamically generate the callback URL based on APP_URL
        $client->setRedirectUri(route('google.callback')); 
        $client->setScopes([Google_Service_Calendar::CALENDAR_EVENTS]);
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');

        $authUrl = $client->createAuthUrl();
        return redirect()->away($authUrl);
    }

    public function callback(Request $request)
    {
        if ($request->has('code')) {
            $client = new Google_Client();
            $client->setClientId(env('GOOGLE_CLIENT_ID'));
            $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
            $client->setRedirectUri(route('google.callback'));
            
            $token = $client->fetchAccessTokenWithAuthCode($request->get('code'));
            
            if (!isset($token['error'])) {
                if (!file_exists(storage_path('app/google-calendar'))) {
                    mkdir(storage_path('app/google-calendar'), 0755, true);
                }
                
                file_put_contents(storage_path('app/google-calendar/oauth_token.json'), json_encode($token));
                return redirect()->route('admin.settings.index')->with('success', 'Google Calendar connected successfully! You can now receive automated Meet Links.');
            }
            
            return redirect()->route('admin.settings.index')->with('error', 'Error connecting Google Calendar: ' . ($token['error_description'] ?? $token['error']));
        }

        return redirect()->route('admin.settings.index')->with('error', 'Google Calendar authorization failed.');
    }
}
