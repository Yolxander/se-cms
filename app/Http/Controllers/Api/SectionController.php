<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\Gallery;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Fetch section details dynamically by section ID or slug
     */
    public function getSectionDetails(Request $request, $sectionIdentifier)
    {
        $section = is_numeric($sectionIdentifier)
            ? Section::with('content')->find($sectionIdentifier)
            : Section::with('content')->where('name', $sectionIdentifier)->first();

        if (!$section) {
            return response()->json(['error' => 'Section not found'], 404);
        }

        $details = $section->content->mapWithKeys(function ($content) {
            $value = $content->type === 'json' || $content->type === 'list'
                ? json_decode($content->value, true)
                : $content->value;

            return [$content->key => $value];
        });

        // Fetch gallery for the section
        $gallery = Gallery::with('images')->where('section_id', $section->id)->first();

        if ($gallery) {
            $details['gallery'] = $gallery->title;
            $details['gallery_images'] = $gallery->images->map(function ($image) {
                return [
                    'path' => $image->path,
                    'title' => $image->title,
                ];
            });
        }

        return response()->json([
            'component_name' => $section->component_name,
            'order' => $section->order,
            'details' => $details,
        ]);
    }
}
