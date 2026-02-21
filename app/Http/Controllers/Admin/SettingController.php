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
            'footer_description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png,jpg,webp|max:1024',
            'facebook_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'primary_color' => 'nullable|string',
            'secondary_color' => 'nullable|string',
            'accent_color' => 'nullable|string',
            'text_color' => 'nullable|string',
            'background_color' => 'nullable|string',
        ]);

        $settings = SiteSetting::current();
        $data = $request->except(['favicon', 'logo']);
        
        if ($request->hasFile('logo')) {
            if ($settings->logo_path) {
                Storage::delete('public/' . $settings->logo_path);
            }
            $data['logo_path'] = $request->file('logo')->store('settings', 'public');
        }

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
