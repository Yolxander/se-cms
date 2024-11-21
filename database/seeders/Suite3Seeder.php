<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\Section;
use App\Models\Content;
use App\Models\Image;

class Suite3Seeder extends Seeder
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

        // Create the Suite 3 section
        $suite3Section = Section::create([
            'page_id' => $suitesPage->id,
            'name' => 'Suite 3',
            'order' => 3,
            'component_name' => 'Suite3Component',
        ]);

        // Add header content
        Content::create([
            'section_id' => $suite3Section->id,
            'key' => 'header',
            'value' => json_encode([
                'name' => 'Suite 3',
                'description' => 'Studio Suite with Pool, Garden & Mountain Views',
                'image' => 'https://storage.googleapis.com/sempre-studios-893c8.appspot.com/uploads/Casa%20Turul/Suite%203/672302a36c66c.jpeg?GoogleAccessId=firebase-adminsdk-gkp49%40sempre-studios-893c8.iam.gserviceaccount.com&Expires=1761883683&Signature=ORmyurkEzmzlHwrOPLlJfLkDQIKBrElRXy%2BkxoPAyWF3gyvN34Pkn%2FXEuXpTNQW%2FJrqcqQ2J4FPl5lCUcL758tSvCYjM1U%2BtffZHDPXnP5SHtFOPlXgo2Zg0cj9pcwSrPjOnJcIhYm5JwwcAZcyzopksp4yVY1XS%2BeuHNvaaJTgTCniT9wCNhK9FYs3Gm8ZlQ68qt3X8cwFdb2DC9kP%2B6GYGWAClQgbLhxYYmThH6OxyPAOnduA2SZ%2FjsX%2B1XB52zSF%2FLk5JHL6YpE1pDEBKhHlt%2F6mlN2oujZvBja2hoaMIjj2EJkLDlTGsIyxpFLrOIO2b64s%2FpxEudhaZoWOs1A%3D%3D',
            ]),
            'type' => 'json',
        ]);

        // Add facilities
        $facilities = [
            "Second level suite with private entrance and spacious balcony",
            "Queen bed with fresh linens",
            "Full kitchen with 2-burner induction stovetop, coffee machine, mini fridge, microwave, toaster & electric kettle",
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
            "Glass & screen windows and doors",
            "Patio with outdoor dining area and bamboo privacy curtain",
            "Hammock",
            "Mosquito net",
        ];

        Content::create([
            'section_id' => $suite3Section->id,
            'key' => 'facilities',
            'value' => json_encode($facilities),
            'type' => 'list',
        ]);

        // Add bathroom amenities
        $bathroomAmenities = [
            "Toilet & toilet paper",
            "Shower with complimentary shampoo, conditioner & body wash",
            "Hairdryer*",
            "Hand soap",
        ];

        Content::create([
            'section_id' => $suite3Section->id,
            'key' => 'bathroom_amenities',
            'value' => json_encode($bathroomAmenities),
            'type' => 'list',
        ]);

        // Add views
        $views = [
            "Private outdoor patio/terrace with pool, garden, and mountain views",
        ];

        Content::create([
            'section_id' => $suite3Section->id,
            'key' => 'views',
            'value' => json_encode($views),
            'type' => 'list',
        ]);


        $galleryContent = Content::create([
            'section_id' => $suite3Section->id,
            'key' => 'gallery',
            'value' => 'Suite 3 Gallery',
            'type' => 'gallery', // Custom type for a group of images
        ]);


    }
}
