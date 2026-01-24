<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyProfileController extends Controller
{
    public function edit()
    {
        $companyProfile = CompanyProfile::firstOrCreate([]);
        return view('admin.company.edit', compact('companyProfile'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'ceo_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'ceo_name' => 'nullable|string|max:255',
            'ceo_bio' => 'nullable|string',
            'ceo_background' => 'nullable|string',
            'ceo_why_business' => 'nullable|string',
            'mission' => 'nullable|string',
            'vision' => 'nullable|string',
            'team_description' => 'nullable|string',
            'ceo_section_title' => 'nullable|string|max:255',
            'ceo_section_subtitle' => 'nullable|string|max:255',
        ]);

        $companyProfile = CompanyProfile::firstOrCreate([]);
        $data = $request->except(['ceo_image']);
        
        if ($request->hasFile('ceo_image')) {
            // Delete old logo if exists
            if ($companyProfile->ceo_image_path) {
                Storage::delete('public/' . $companyProfile->ceo_image_path);
            }
            $path = $request->file('ceo_image')->store('ceo_images', 'public');
            $data['ceo_image_path'] = $path;
        }

        $companyProfile->update($data);

        return redirect()->route('company-profile.edit')->with('success', 'Company profile updated successfully.');
    }
}
