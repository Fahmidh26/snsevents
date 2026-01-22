<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PackageInquiry;
use Illuminate\Http\Request;

class PackageInquiryController extends Controller
{
    public function index()
    {
        $inquiries = PackageInquiry::with('pricingTier.eventType')->latest()->get();
        return view('admin.inquiries.index', compact('inquiries'));
    }

    public function updateStatus(Request $request, PackageInquiry $inquiry)
    {
        $request->validate([
            'status' => 'required|in:pending,contacted,converted,rejected'
        ]);

        $inquiry->update(['status' => $request->status]);

        return back()->with('success', 'Inquiry status updated successfully.');
    }

    public function destroy(PackageInquiry $inquiry)
    {
        $inquiry->delete();
        return back()->with('success', 'Inquiry deleted successfully.');
    }
}
