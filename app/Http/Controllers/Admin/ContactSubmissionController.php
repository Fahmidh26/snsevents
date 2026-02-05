<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;
use Illuminate\Http\Request;

class ContactSubmissionController extends Controller
{
    /**
     * Display a listing of contact submissions.
     */
    public function index()
    {
        $submissions = ContactSubmission::orderBy('created_at', 'desc')->paginate(20);
        $newCount = ContactSubmission::where('status', 'new')->count();
        
        return view('admin.contact-submissions.index', compact('submissions', 'newCount'));
    }

    /**
     * Display the specified contact submission.
     */
    public function show($id)
    {
        $submission = ContactSubmission::findOrFail($id);
        
        // Mark as read when viewed
        $submission->markAsRead();
        
        return view('admin.contact-submissions.show', compact('submission'));
    }

    /**
     * Update the status of a contact submission.
     */
    public function updateStatus(Request $request, $id)
    {
        $submission = ContactSubmission::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:new,read,replied,archived',
        ]);
        
        $submission->update([
            'status' => $request->status,
        ]);
        
        return redirect()->back()->with('success', 'Status updated successfully.');
    }

    /**
     * Update admin notes for a contact submission.
     */
    public function updateNotes(Request $request, $id)
    {
        $submission = ContactSubmission::findOrFail($id);
        
        $request->validate([
            'admin_notes' => 'nullable|string|max:2000',
        ]);
        
        $submission->update([
            'admin_notes' => $request->admin_notes,
        ]);
        
        return redirect()->back()->with('success', 'Notes updated successfully.');
    }

    /**
     * Remove the specified contact submission.
     */
    public function destroy($id)
    {
        $submission = ContactSubmission::findOrFail($id);
        $submission->delete();
        
        return redirect()->route('admin.contact-submissions.index')
            ->with('success', 'Contact submission deleted successfully.');
    }

    /**
     * Export contact submissions to CSV.
     */
    public function export()
    {
        $submissions = ContactSubmission::orderBy('created_at', 'desc')->get();
        
        $filename = 'contact_submissions_' . date('Y-m-d_His') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        
        $callback = function() use ($submissions) {
            $file = fopen('php://output', 'w');
            
            // Add CSV headers
            fputcsv($file, [
                'ID',
                'Name',
                'Email',
                'Phone',
                'Event Type',
                'Preferred Date',
                'Message',
                'Status',
                'Admin Notes',
                'Submitted At',
                'Read At',
            ]);
            
            // Add data rows
            foreach ($submissions as $submission) {
                fputcsv($file, [
                    $submission->id,
                    $submission->name,
                    $submission->email,
                    $submission->phone,
                    $submission->event_type,
                    $submission->preferred_date ? $submission->preferred_date->format('Y-m-d') : '',
                    $submission->message,
                    $submission->status,
                    $submission->admin_notes,
                    $submission->created_at->format('Y-m-d H:i:s'),
                    $submission->read_at ? $submission->read_at->format('Y-m-d H:i:s') : '',
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
}
