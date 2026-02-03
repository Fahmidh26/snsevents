<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NavbarItem;
use Illuminate\Http\Request;

class NavbarItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = NavbarItem::whereNull('parent_id')->orderBy('order')->with('children')->get();
        return view('admin.navbar.index', compact('items'));
    }

    public function create()
    {
        $parents = NavbarItem::whereNull('parent_id')->orderBy('order')->get();
        return view('admin.navbar.create', compact('parents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required|string|max:255',
            'type' => 'required|in:route,url',
            'route_name' => 'nullable|string',
            'url' => 'nullable|string',
            'order' => 'integer',
        ]);

        NavbarItem::create($request->all());

        return redirect()->route('admin.navbar-items.index')->with('success', 'Menu item created successfully.');
    }

    public function edit(NavbarItem $navbarItem)
    {
        $parents = NavbarItem::whereNull('parent_id')->where('id', '!=', $navbarItem->id)->orderBy('order')->get();
        return view('admin.navbar.edit', compact('navbarItem', 'parents'));
    }

    public function update(Request $request, NavbarItem $navbarItem)
    {
        $request->validate([
            'label' => 'required|string|max:255',
            'type' => 'required|in:route,url',
            'route_name' => 'nullable|string',
            'url' => 'nullable|string',
            'order' => 'integer',
        ]);

        $navbarItem->update($request->all());

        return redirect()->route('admin.navbar-items.index')->with('success', 'Menu item updated successfully.');
    }

    public function destroy(NavbarItem $navbarItem)
    {
        $navbarItem->delete();
        return redirect()->route('admin.navbar-items.index')->with('success', 'Menu item deleted successfully.');
    }
}
