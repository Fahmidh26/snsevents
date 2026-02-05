<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventGallery;
use App\Models\ServiceArea;
use App\Models\PackageInquiry;
use App\Models\CustomPackageRequest;
use App\Models\ManagementSessionBooking;
use App\Models\FAQ;
use App\Models\EventType;
use App\Models\CounselingBooking;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Get all statistics
        $stats = [
            // Total counts
            'total_events' => EventType::count(), // Count event types, not gallery images
            'total_services' => ServiceArea::count(),
            'total_event_types' => EventType::count(),
            'total_gallery_images' => EventGallery::count(), // Count individual gallery images
            'total_faqs' => FAQ::count(),
            'total_users' => User::count(),
            
            // Inquiries
            'total_inquiries' => PackageInquiry::count(),
            'pending_inquiries' => PackageInquiry::where('status', 'pending')->count(),
            'contacted_inquiries' => PackageInquiry::where('status', 'contacted')->count(),
            'converted_inquiries' => PackageInquiry::where('status', 'converted')->count(),
            'rejected_inquiries' => PackageInquiry::where('status', 'rejected')->count(),

            'new_inquiries_today' => PackageInquiry::whereDate('created_at', Carbon::today())->count(),
            'new_inquiries_this_week' => PackageInquiry::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count(),
            'new_inquiries_this_month' => PackageInquiry::whereMonth('created_at', Carbon::now()->month)->count(),
            
            // Custom Package Requests
            'total_custom_requests' => CustomPackageRequest::count(),
            'pending_custom_requests' => CustomPackageRequest::where('status', 'pending')->count(),
            'processing_custom_requests' => CustomPackageRequest::where('status', 'processing')->count(),
            'completed_custom_requests' => CustomPackageRequest::where('status', 'completed')->count(),
            'new_custom_requests_today' => CustomPackageRequest::whereDate('created_at', Carbon::today())->count(),
            
            // Counseling Bookings
            'total_counseling_bookings' => CounselingBooking::count(),
            'pending_counseling' => CounselingBooking::where('status', 'pending')->count(),
            'confirmed_counseling' => CounselingBooking::where('status', 'confirmed')->count(),
            'completed_counseling' => CounselingBooking::where('status', 'completed')->count(),
            'cancelled_counseling' => CounselingBooking::where('status', 'cancelled')->count(),
            'upcoming_counseling' => CounselingBooking::where('status', 'confirmed')
                ->whereHas('slot', function($q) {
                    $q->where('date', '>=', Carbon::today());
                })
                ->count(),

            // Management Session Bookings
            'total_management_bookings' => ManagementSessionBooking::count(),
            'pending_management' => ManagementSessionBooking::where('status', 'pending')->count(),
            'confirmed_management' => ManagementSessionBooking::where('status', 'confirmed')->count(),
            'completed_management' => ManagementSessionBooking::where('status', 'completed')->count(),
            'upcoming_management' => ManagementSessionBooking::where('status', 'confirmed')
                ->whereHas('slot', function($q) {
                    $q->where('date', '>=', Carbon::today());
                })
                ->count(),
        ];
        
        // Recent activities
        $recent_inquiries = PackageInquiry::with('pricingTier.eventType')
            ->latest()
            ->take(5)
            ->get();
            
        $recent_custom_requests = CustomPackageRequest::latest()
            ->take(5)
            ->get();
            
        $recent_counseling = CounselingBooking::with('slot')
            ->latest()
            ->take(5)
            ->get();

        $recent_management = ManagementSessionBooking::with('slot')
            ->latest()
            ->take(5)
            ->get();
        
        // Popular event types (by inquiries)
        $popular_event_types = EventType::withCount('packageInquiries')
            ->orderBy('package_inquiries_count', 'desc')
            ->take(5)
            ->get();
        
        // Monthly inquiry trends (last 6 months)
        $monthly_trends = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthly_trends[] = [
                'month' => $date->format('M Y'),
                'inquiries' => PackageInquiry::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count(),
                'custom_requests' => CustomPackageRequest::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count(),
            ];
        }
        
        // Calculate growth percentages
        $last_month_inquiries = PackageInquiry::whereMonth('created_at', Carbon::now()->subMonth()->month)->count();
        $inquiry_growth = $last_month_inquiries > 0 
            ? round((($stats['new_inquiries_this_month'] - $last_month_inquiries) / $last_month_inquiries) * 100, 1)
            : 0;
        
        return view('dashboard', compact(
            'stats',
            'recent_inquiries',
            'recent_custom_requests',
            'recent_counseling',
            'recent_management',
            'popular_event_types',
            'monthly_trends',
            'inquiry_growth'
        ));
    }
}
