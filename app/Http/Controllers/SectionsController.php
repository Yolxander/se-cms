<?php

namespace App\Http\Controllers;

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
        return view('sections.edit', compact('section','pages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'order' => 'required|integer',
            'content' => 'required'
        ]);

        $section = Section::findOrFail($id);
        $section->update([
            'title' => $validatedData['title'],
            'order' => $validatedData['order']
        ]);

        $section->content()->update([
            'content' => $validatedData['content']
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
}
