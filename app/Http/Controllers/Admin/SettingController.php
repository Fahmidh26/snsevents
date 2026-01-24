<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::current();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_title' => 'required|string|max:255',
            'site_description' => 'nullable|string',
            'admin_email' => 'required|email',
            'footer_text' => 'nullable|string|max:255',
            'favicon' => 'nullable|image|mimes:ico,png,jpg|max:1024',
            'facebook_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
        ]);

        $settings = SiteSetting::current();
        $data = $request->except(['favicon']);

        if ($request->hasFile('favicon')) {
            if ($settings->favicon_path) {
                Storage::delete('public/' . $settings->favicon_path);
            }
            $data['favicon_path'] = $request->file('favicon')->store('settings', 'public');
        }

        $settings->update($data);

        return back()->with('success', 'Settings updated successfully.');
    }
}
