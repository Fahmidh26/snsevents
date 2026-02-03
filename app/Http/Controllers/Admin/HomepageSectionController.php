<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageSection;
use Illuminate\Http\Request;

class HomepageSectionController extends Controller
{
    public function index()
    {
        $sections = HomepageSection::orderBy('order')->get();
        return view('admin.homepage-sections.index', compact('sections'));
    }

    public function updateOrder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
        ]);

        foreach ($request->order as $index => $id) {
            HomepageSection::where('id', $id)->update(['order' => $index + 1]);
        }

        return response()->json(['status' => 'success']);
    }

    public function toggleVisibility(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:homepage_sections,id',
            'is_visible' => 'required|boolean',
        ]);

        $section = HomepageSection::find($request->id);
        $section->is_visible = $request->is_visible;
        $section->save();

        return response()->json(['status' => 'success']);
    }
}
