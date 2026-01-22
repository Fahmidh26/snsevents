<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomPackageRequest;
use Illuminate\Http\Request;

class CustomPackageRequestController extends Controller
{
    public function index()
    {
        $requests = CustomPackageRequest::latest()->get();
        return view('admin.custom_requests.index', compact('requests'));
    }

    public function updateStatus(Request $request, CustomPackageRequest $customRequest)
    {
        $request->validate([
            'status' => 'required|in:pending,contacted,quoted,converted,rejected'
        ]);

        $customRequest->update(['status' => $request->status]);

        return back()->with('success', 'Request status updated successfully.');
    }

    public function destroy(CustomPackageRequest $customRequest)
    {
        $customRequest->delete();
        return back()->with('success', 'Request deleted successfully.');
    }
}
