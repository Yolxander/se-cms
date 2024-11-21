<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Image;
use App\Models\Page;
use App\Models\Section;
use App\Models\SectionContent;
use Illuminate\Http\Request;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::with('content')->orderBy('order')->get();
        return view('sections.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'order' => 'required|integer',
            'content' => 'required'
        ]);

        $section = Section::create([
            'title' => $validatedData['title'],
            'order' => $validatedData['order']
        ]);

        $section->content()->create([
            'content' => $validatedData['content']
        ]);

        return redirect()->route('sections.index')->with('success', 'Section created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $section = Section::with('content')->findOrFail($id);
        return view('sections.show', compact('section'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $section = Section::findOrFail($id);
        $pages = Page::all();
        $mediaImages = Image::all();
        $existingGalleries = Gallery::all(); // Fetch all available galleries


        return view('sections.edit', compact('section','pages','mediaImages','existingGalleries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'nullable|max:255',
            'order' => 'nullable|integer',
            'component_name' => 'nullable|max:255',
            'page_id' => 'nullable|exists:pages,id',
        ]);

        $section = Section::findOrFail($id);
        $section->update([
            'name' => $validatedData['name'],
            'order' => $validatedData['order'],
            'component_name' => $validatedData['component_name'],
            'page_id' => $validatedData['page_id'],
        ]);

        return redirect()->route('sections.index')->with('success', 'Section updated successfully.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $section = Section::findOrFail($id);
        $section->content()->delete();
        $section->delete();

        return redirect()->route('sections.index')->with('success', 'Section deleted successfully.');
    }

    public function linkGallery(Request $request, Section $section)
    {
        $request->validate([
            'gallery_id' => 'required|exists:galleries,id',
        ]);

        $gallery = Gallery::find($request->gallery_id);

        if (!$gallery) {
            return response()->json(['error' => 'Gallery not found.'], 404);
        }

        $section->update(['gallery_id' => $gallery->id]);

        return response()->json(['success' => true, 'message' => 'Gallery linked successfully.']);
    }

}
