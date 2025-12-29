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
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'ceo_name' => 'nullable|string|max:255',
            'ceo_bio' => 'nullable|string',
            'ceo_background' => 'nullable|string',
            'ceo_why_business' => 'nullable|string',
            'mission' => 'nullable|string',
            'vision' => 'nullable|string',
            'team_description' => 'nullable|string',
        ]);

        $companyProfile = CompanyProfile::firstOrCreate([]);
        $data = $request->except('logo');

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('company_logos', 'public');
            $data['logo_path'] = $path;
        }

        $companyProfile->update($data);

        return redirect()->route('company-profile.edit')->with('success', 'Company profile updated successfully.');
    }
}
