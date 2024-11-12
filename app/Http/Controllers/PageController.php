<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::all();
        return view('pages.index', compact('pages'));
    }

    public function create()
    {
        return view('pages.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:pages|max:255',
            'content' => 'required',
            'type' => 'required|in:home,rooms,amenities,activities,contact',
        ]);

        Page::create($validatedData);

        return redirect()->route('pages.index')->with('success', 'Page created successfully.');
    }

    public function show(Page $page)
    {
        return view('pages.show', compact('page'));
    }

    public function edit(Page $page)
    {
        return view('pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:pages,slug,' . $page->id . '|max:255',
            'content' => 'required',
            'type' => 'required|in:home,rooms,amenities,activities,contact',
        ]);

        $page->update($validatedData);

        return redirect()->route('pages.index')->with('success', 'Page updated successfully.');
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('pages.index')->with('success', 'Page deleted successfully.');
    }

    public function editHome()
    {
        $page = Page::where('type', 'home')->firstOrFail();
        return view('pages.edit-home', compact('page'));
    }

    public function editRooms()
    {
        $page = Page::where('type', 'rooms')->firstOrFail();
        return view('pages.edit-rooms', compact('page'));
    }

    public function editAmenities()
    {
        $page = Page::where('type', 'amenities')->firstOrFail();
        return view('pages.edit-amenities', compact('page'));
    }

    public function editActivities()
    {
        $page = Page::where('type', 'activities')->firstOrFail();
        return view('pages.edit-activities', compact('page'));
    }

    public function editContact()
    {
        $page = Page::where('type', 'contact')->firstOrFail();
        return view('pages.edit-contact', compact('page'));
    }
}
