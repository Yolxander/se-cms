<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{

    public function edit(Gallery $gallery)
    {
        return view('gallery.edit', compact('gallery'));
    }
    public function index()
    {
        $galleries = Gallery::withCount('images')->get();
        return view('gallery.index', compact('galleries'));
    }

    public function show(Gallery $gallery)
    {
        $gallery->load('images');
        $galleries = Gallery::all();
        return view('gallery.show', compact('gallery','galleries'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $gallery = Gallery::create([
            'title' => $request->title,
        ]);

        return redirect()->route('galleries.show', $gallery);
    }

}
