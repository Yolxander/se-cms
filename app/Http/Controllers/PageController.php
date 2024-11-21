<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

        $page = Page::create($validatedData);

        return redirect()->route('site-pages.show', $page->id)->with('success', 'Page created successfully.');
    }

    public function show($id)
    {

        $page = Page::find($id);
        return view('pages.show', compact('page'));
    }

    public function edit($id)
    {
        $page = Page::with(['sections' => function ($query) {
            $query->orderBy('order');
        }, 'sections.content'])->findOrFail($id);
        return view('pages.edit', compact('page'));
    }

    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required',
        ]);

        $page = Page::find($id);

        $page->update($validatedData);

        // Ensure the parameter passed is the page's ID
        return redirect()->route('site-pages.show', ['site_page' => $id])
            ->with('success', 'Page updated successfully.');
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('site-pages.index')->with('success', 'Page deleted successfully.');
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
