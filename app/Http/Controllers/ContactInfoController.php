<?php

namespace App\Http\Controllers;

use App\Models\ContactInfo;
use Illuminate\Http\Request;

class ContactInfoController extends Controller
{
    public function edit()
    {
        $contactInfo = ContactInfo::first();
        if (!$contactInfo) {
            $contactInfo = new ContactInfo();
        }
        return view('admin.contact-info.edit', compact('contactInfo'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'office_hours' => 'nullable|string',
            'description' => 'nullable|string',
            'map_url' => 'nullable|string',
        ]);

        $contactInfo = ContactInfo::first();
        if (!$contactInfo) {
            $contactInfo = new ContactInfo();
        }

        // Extract URL from iframe if entire iframe code is pasted
        $mapUrl = $request->input('map_url');
        if ($mapUrl && strpos($mapUrl, '<iframe') !== false) {
            // Extract src attribute from iframe
            preg_match('/src="([^"]+)"/', $mapUrl, $matches);
            if (isset($matches[1])) {
                $mapUrl = $matches[1];
            }
        }

        $contactInfo->fill($request->except('map_url'));
        $contactInfo->map_url = $mapUrl;
        $contactInfo->save();

        return redirect()->route('contact-info.edit')->with('success', 'Contact information updated successfully!');
    }
}
