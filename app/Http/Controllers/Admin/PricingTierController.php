<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PricingTier;
use App\Models\EventType;
use Illuminate\Http\Request;

class PricingTierController extends Controller
{
    public function index()
    {
        $pricingTiers = PricingTier::with('eventType')->orderBy('event_type_id')->orderBy('display_order')->get();
        return view('admin.pricing_tiers.index', compact('pricingTiers'));
    }

    public function create()
    {
        $eventTypes = EventType::all();
        return view('admin.pricing_tiers.create', compact('eventTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_type_id' => 'required|exists:event_types,id',
            'tier_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'features' => 'nullable|array',
            'features.*' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = $request->except('image', 'features');
        // Filter out empty features
        $data['features'] = array_filter($request->features ?? []);
        $data['status'] = $request->has('status');

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/pricing'), $imageName);
            $data['image'] = 'uploads/pricing/' . $imageName;
        }

        PricingTier::create($data);

        return redirect()->route('admin.pricing-tiers.index')->with('success', 'Pricing tier created successfully.');
    }

    public function edit(PricingTier $pricingTier)
    {
        $eventTypes = EventType::all();
        return view('admin.pricing_tiers.edit', compact('pricingTier', 'eventTypes'));
    }

    public function update(Request $request, PricingTier $pricingTier)
    {
        $request->validate([
            'event_type_id' => 'required|exists:event_types,id',
            'tier_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'features' => 'nullable|array',
            'features.*' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = $request->except('image', 'features');
        $data['features'] = array_filter($request->features ?? []);
        $data['status'] = $request->has('status');

        if ($request->hasFile('image')) {
            if ($pricingTier->image && file_exists(public_path($pricingTier->image))) {
                unlink(public_path($pricingTier->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/pricing'), $imageName);
            $data['image'] = 'uploads/pricing/' . $imageName;
        }

        $pricingTier->update($data);

        return redirect()->route('admin.pricing-tiers.index')->with('success', 'Pricing tier updated successfully.');
    }

    public function destroy(PricingTier $pricingTier)
    {
        if ($pricingTier->image && file_exists(public_path($pricingTier->image))) {
            unlink(public_path($pricingTier->image));
        }

        $pricingTier->delete();

        return redirect()->route('admin.pricing-tiers.index')->with('success', 'Pricing tier deleted successfully.');
    }
}
