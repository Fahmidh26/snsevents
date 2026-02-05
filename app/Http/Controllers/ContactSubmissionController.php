<?php

namespace App\Http\Controllers;

use App\Models\ContactSubmission;
use App\Models\ContactInfo;
use App\Mail\ContactSubmissionNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactSubmissionController extends Controller
{
    /**
     * Submit contact form.
     */
    public function submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'event_type' => 'required|string',
            'preferred_date' => 'nullable|date',
            'message' => 'required|string|max:2000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }

        // Create the submission
        $submission = ContactSubmission::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'event_type' => $request->event_type,
            'preferred_date' => $request->preferred_date,
            'message' => $request->message,
            'status' => 'new',
        ]);

        // Send email notification to admin
        try {
            $contactInfo = ContactInfo::first();
            $adminEmail = $contactInfo && $contactInfo->email 
                ? $contactInfo->email 
                : config('mail.from.address');

            Mail::to($adminEmail)->send(new ContactSubmissionNotification($submission));
        } catch (\Exception $e) {
            // Log the error but don't fail the submission
            \Log::error('Failed to send contact submission email: ' . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => 'Thank you for contacting us! We will get back to you soon.',
        ]);
    }
}
