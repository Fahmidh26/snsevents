<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscription;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    /**
     * Display a listing of newsletter subscriptions.
     */
    public function index()
    {
        $subscriptions = NewsletterSubscription::latest()->paginate(20);
        $activeCount = NewsletterSubscription::active()->count();
        $inactiveCount = NewsletterSubscription::inactive()->count();
        
        return view('admin.newsletter.index', compact('subscriptions', 'activeCount', 'inactiveCount'));
    }

    /**
     * Toggle subscription status.
     */
    public function toggleStatus($id)
    {
        $subscription = NewsletterSubscription::findOrFail($id);
        $subscription->is_active = !$subscription->is_active;
        $subscription->save();

        return redirect()->route('admin.newsletter.index')
            ->with('success', 'Subscription status updated successfully.');
    }

    /**
     * Remove the specified subscription.
     */
    public function destroy($id)
    {
        $subscription = NewsletterSubscription::findOrFail($id);
        $subscription->delete();

        return redirect()->route('admin.newsletter.index')
            ->with('success', 'Subscription deleted successfully.');
    }

    /**
     * Export subscriptions to CSV.
     */
    public function export()
    {
        $subscriptions = NewsletterSubscription::active()->get();
        
        $filename = 'newsletter_subscriptions_' . date('Y-m-d') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($subscriptions) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Email', 'Status', 'Subscribed At']);

            foreach ($subscriptions as $subscription) {
                fputcsv($file, [
                    $subscription->email,
                    $subscription->is_active ? 'Active' : 'Inactive',
                    $subscription->subscribed_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
