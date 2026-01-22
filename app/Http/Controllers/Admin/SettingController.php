<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $adminEmail = Setting::get('admin_email');
        return view('admin.settings.index', compact('adminEmail'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'admin_email' => 'required|email'
        ]);

        Setting::set('admin_email', $request->admin_email);

        return back()->with('success', 'Settings updated successfully.');
    }
}
