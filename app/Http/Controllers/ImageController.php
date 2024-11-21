<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Image;
use App\Models\Section;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ImageController extends Controller
{
    protected $imageService;

    public function __construct(ImageUploadService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index()
    {
        $images = Image::all();
        $galleries = Gallery::all();
        $sections = Section::all();
        $mediaImages = $images;

        return view('images.index', compact('images', 'galleries', 'sections', 'mediaImages'));
    }

    public function store(Request $request)
    {

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $this->imageService->uploadImage($file, $request->section_id, $request->gallery_id);
            }
        }

        return redirect()->back()->with('success', 'Images uploaded successfully.');
    }



    public function destroy(Image $image)
    {
        $this->imageService->deleteImage($image);

        return redirect()->back()->with('success', 'Image deleted successfully.');
    }

    public function replace(Request $request, Image $image)
    {
        $request->validate(['image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048']);

        $this->imageService->replaceImage($image, $request->file('image'));

        return response()->json([
            'success' => true,
            'newPath' => $image->path, // Updated Firebase URL
            'message' => 'Image replaced successfully!',
        ]);
    }


    public function move(Request $request, Image $image)
    {
        $request->validate(['gallery_id' => 'required|exists:galleries,id']);

        $image->update(['gallery_id' => $request->gallery_id]);

        return redirect()->back()->with('success', 'Image moved successfully!');
    }



    public function changeSection(Request $request, Image $image)
    {
        try {
            // Find and update the image
            $image = Image::findOrFail($request->image_id);
            $image->update(['section_id' => $request->section_id]);

            return response()->json(['success' => true, 'message' => 'Section updated successfully!']);
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error updating section for image ID: ' . $request->image_id, [
                'exception' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Return a JSON error response
            return response()->json(['success' => false, 'message' => 'Failed to update section. Please try again later.'], 500);
        }
    }

    public function addToGallery(Request $request, Image $image)
    {
        try {

            // Find and update the image
            $image = Image::findOrFail($request->image_id);
            $image->update(['gallery_id' => $request->gallery_id]);

            return response()->json(['success' => true, 'message' => 'Gallery updated successfully!']);
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error adding image ID: ' . $request->image_id . ' to gallery', [
                'exception' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Return a JSON error response
            return response()->json(['success' => false, 'message' => 'Failed to add image to gallery. Please try again later.'], 500);
        }
    }



}
