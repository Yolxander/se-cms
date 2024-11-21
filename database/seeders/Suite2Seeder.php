<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\Section;
use App\Models\Content;
use App\Models\Image;

class Suite2Seeder extends Seeder
{
    public function run()
    {
        // Find or create the Suites page
        $suitesPage = Page::firstOrCreate([
            'name' => 'Suites',
            'slug' => 'suites',
        ], [
            'is_published' => true,
        ]);

        // Create the Suite 2 section
        $suite2Section = Section::create([
            'page_id' => $suitesPage->id,
            'name' => 'Suite 2',
            'order' => 2,
            'component_name' => 'Suite2Component',
        ]);

        // Add header content
        Content::create([
            'section_id' => $suite2Section->id,
            'key' => 'header',
            'value' => json_encode([
                'name' => 'Suite 2',
                'description' => 'Studio Suite with Garden View',
                'image' => 'https://storage.googleapis.com/sempre-studios-893c8.appspot.com/uploads/Casa%20Turul/Suite%202/672301ae6af1c.jpeg?GoogleAccessId=firebase-adminsdk-gkp49%40sempre-studios-893c8.iam.gserviceaccount.com&Expires=1761883438&Signature=LFOa7ciZ%2F7OmNMkmq%2FE%2FCufWn%2FyFKG%2F75BGatA1Mn1vjvTeH2PkYzktMnYlhkD56Ezyoy6x03THviphQK29LxzwkEMnad73BRP4Yjf%2BkUz%2FuLQDQtS9c3GPQjyhlLYwmkKiVvLRMwEGTkgvJyPPtIXWQnjGDdV3t4Vf5Y3c0P%2BeSySyuYZiwcl61TUVHffNfEKsz6DKjZpoGo01DEsZpnMLxj29flhdwI7SnKTeJUscoP0zdVx9Scs0OHNdtuOVaQ8DAjpMAcOoqgsjxvX2bu9DxoK7hBO2mtBQGRRCfCa4P%2BlD9oACmH%2FQ5dLf6CB1cv%2B8ZeuP55vPg896Ejswg8w%3D%3D',
            ]),
            'type' => 'json',
        ]);

        // Add facilities
        $facilities = [
            "Entire detached ground floor unit with private entrance & garden terrace",
            "Queen bed with fresh linens",
            "Full kitchenette with coffee machine, mini fridge, microwave, toaster & electric kettle",
            "Iron*",
            "Smart TV with Netflix subscription included",
            "Sofa bed (sleeps 2 small children or 1 adult)",
            "Drying rack for clothing",
            "Bath towels, pool towels, bed linens",
            "Access to hotel pool & lounge area",
            "Tile floor",
            "Single-room air conditioning for guest accommodation & fan",
            "Washing machine ($)",
            "Clothing storage unit",
            "Private garden & outdoor dining area",
            "Glass & screen windows and doors",
            "Hammock",
        ];

        Content::create([
            'section_id' => $suite2Section->id,
            'key' => 'facilities',
            'value' => json_encode($facilities),
            'type' => 'list',
        ]);

        // Add bathroom amenities
        $bathroomAmenities = [
            "Toilet & toilet paper",
            "Shower with complimentary shampoo, conditioner & body wash",
            "Hairdryer*",
        ];

        Content::create([
            'section_id' => $suite2Section->id,
            'key' => 'bathroom_amenities',
            'value' => json_encode($bathroomAmenities),
            'type' => 'list',
        ]);

        // Add views
        $views = [
            "Garden view with outdoor patio/terrace",
            "Inner courtyard view",
        ];

        Content::create([
            'section_id' => $suite2Section->id,
            'key' => 'views',
            'value' => json_encode($views),
            'type' => 'list',
        ]);

        $galleryContent = Content::create([
            'section_id' => $suite2Section->id,
            'key' => 'gallery',
            'value' => 'Suite 2 Gallery',
            'type' => 'gallery', // Custom type for a group of images
        ]);

    }
}
