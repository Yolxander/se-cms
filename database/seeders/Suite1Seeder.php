<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\Section;
use App\Models\Content;
use App\Models\Image;

class Suite1Seeder extends Seeder
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

        // Create the Suite 1 section
        $suite1Section = Section::create([
            'page_id' => $suitesPage->id,
            'name' => 'Suite 1',
            'order' => 1,
            'component_name' => 'Suite1Component',
        ]);

        // Add header content
        Content::create([
            'section_id' => $suite1Section->id,
            'key' => 'header',
            'value' => json_encode([
                'name' => 'Suite 1',
                'description' => 'Wheelchair Accessible Studio Suite with Garden View',
                'image' => 'https://storage.googleapis.com/sempre-studios-893c8.appspot.com/uploads/Casa%20Turul/Suite%201/6722811bbc369.jpeg?GoogleAccessId=firebase-adminsdk-gkp49%40sempre-studios-893c8.iam.gserviceaccount.com&Expires=1761850524&Signature=BySCk34Wg5xMdxbMU1r%2FUH3LhZayf%2FsF8seffcH63yoRvVrwEeoFoeEbNzFt7c%2BPYy4E%2FhyHWS6bduWyT4AagbmTBaPhXqa1YkJfYZHW%2BSPOA0cDF8OsNfIqJRlxRtE6tIFGIS0egfKa9CKrN%2BbAuH77QfVQ5o5kfuc8VggATVODybITrdnlfV7UERiWx%2Fr8JNeNpQo9Nf%2Bo36x3QcqCsqAACJpE5Uc7ZoYESMcDh9NytfKz27evYj9YKwGb%2B0t8eEr9eravw5wPf%2BcF%2BxYkh54ilo2bnLSQcpSC2yZq4QbbH%2BSgn1rlWO3AY6c3AnFzvdkxIs0eUKmyrX4rTK7GRQ%3D%3D',
            ]),
            'type' => 'json',
        ]);

        // Add facilities
        $facilities = [
            "Entire detached ground floor wheelchair accessible unit with private entrance",
            "Queen bed with fresh linens",
            "Full kitchenette with coffee machine, mini fridge, microwave, toaster & electric kettle",
            "Iron*",
            "Smart TV with Netflix subscription included",
            "Sofa Bed (sleeps 2 small children or 1 adult)",
            "Drying rack for clothing",
            "Bath towels, Pool towels, Bed linens",
            "Access to hotel pool & lounge area",
            "Tile floor",
            "Single-room air conditioning for guest accommodation & fan",
            "Washing machine ($)",
            "Clothing storage unit",
            "Private Garden & Outdoor dining area",
            "Glass & Screen windows and doors",
            "Hammock",
        ];

        Content::create([
            'section_id' => $suite1Section->id,
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
            "Grab Bar for safety",
        ];

        Content::create([
            'section_id' => $suite1Section->id,
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
            'section_id' => $suite1Section->id,
            'key' => 'views',
            'value' => json_encode($views),
            'type' => 'list',
        ]);

// Add gallery content
        $gallery = Gallery::firstOrCreate([
            'title' => 'Suite 1 Gallery', // Title of the gallery
        ]);

        $galleryContent = Content::create([
            'section_id' => $suite1Section->id,
            'key' => 'gallery',
            'value' => 'Suite 1 Gallery',
            'type' => 'gallery', // Custom type for a group of images
        ]);

// Add images to the gallery
        $imageUrls = [
            "https://storage.googleapis.com/sempre-studios-893c8.appspot.com/uploads/Casa%20Turul/Suite%201/6722811bbc369.jpeg",
            "https://storage.googleapis.com/sempre-studios-893c8.appspot.com/uploads/Casa%20Turul/Suite%201/672456f4a7513.jpeg",
            "https://storage.googleapis.com/sempre-studios-893c8.appspot.com/uploads/Casa%20Turul/Suite%201/672456f59f915.jpeg",
            "https://storage.googleapis.com/sempre-studios-893c8.appspot.com/uploads/Casa%20Turul/Suite%201/672456f65702a.jpeg",
            "https://storage.googleapis.com/sempre-studios-893c8.appspot.com/uploads/Casa%20Turul/Suite%201/672456f6a1f59.jpeg",
            "https://storage.googleapis.com/sempre-studios-893c8.appspot.com/uploads/Casa%20Turul/Suite%201/672456f702dc0.jpeg",
            "https://storage.googleapis.com/sempre-studios-893c8.appspot.com/uploads/Casa%20Turul/Suite%201/672456f74763a.jpeg",
            "https://storage.googleapis.com/sempre-studios-893c8.appspot.com/uploads/Casa%20Turul/Suite%201/672456f7890e0.jpeg",
            "https://storage.googleapis.com/sempre-studios-893c8.appspot.com/uploads/Casa%20Turul/Suite%201/672456f7cda16.jpeg",
            "https://storage.googleapis.com/sempre-studios-893c8.appspot.com/uploads/Casa%20Turul/Suite%201/672456f821193.jpeg",
            "https://storage.googleapis.com/sempre-studios-893c8.appspot.com/uploads/Casa%20Turul/Suite%201/672456f86bdd5.jpeg",
            "https://storage.googleapis.com/sempre-studios-893c8.appspot.com/uploads/Casa%20Turul/Suite%201/672456f8b13f8.jpeg",
        ];

        foreach ($imageUrls as $index => $url) {
            Image::create([
                'path' => $url,
                'title' => 'Suite 1 Image ' . ($index + 1),
                'section_id' => $suite1Section->id,
                'gallery_id' => $gallery->id, // Associate the image with the gallery
            ]);
        }

    }
}
