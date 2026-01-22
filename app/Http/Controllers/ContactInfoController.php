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
        ]);

        $contactInfo = ContactInfo::first();
        if (!$contactInfo) {
            $contactInfo = new ContactInfo();
        }

        $contactInfo->fill($request->all());
        $contactInfo->save();

        return redirect()->route('contact-info.edit')->with('success', 'Contact information updated successfully!');
    }
}
