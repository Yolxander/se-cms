<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\Section;
use App\Models\Content;
use App\Models\Image;

class LifeInUvitaSeeder extends Seeder
{
    public function run()
    {
        // Find or create the Home page
        $homePage = Page::firstOrCreate([
            'name' => 'Home',
            'slug' => 'home',
        ], [
            'is_published' => true,
        ]);

        // Create the Life in Uvita section
        $lifeInUvitaSection = Section::create([
            'page_id' => $homePage->id,
            'name' => 'Life in Uvita',
            'order' => 3,
            'component_name' => 'LifeInUvitaComponent',
        ]);

        // Add textual content
        Content::create([
            'section_id' => $lifeInUvitaSection->id,
            'key' => 'title',
            'value' => 'Life in Uvita',
            'type' => 'text',
        ]);

        Content::create([
            'section_id' => $lifeInUvitaSection->id,
            'key' => 'description_1',
            'value' => 'Located on the South Pacific of Costa Rica, Uvita is known for its whale watching, stunning beaches, and greener landscapes.',
            'type' => 'textarea',
        ]);

        Content::create([
            'section_id' => $lifeInUvitaSection->id,
            'key' => 'description_2',
            'value' => 'Hotel Daleese is in close proximity of Catarata Waterfall Uvita and the Whale Tail National Park.',
            'type' => 'textarea',
        ]);

        Content::create([
            'section_id' => $lifeInUvitaSection->id,
            'key' => 'learnMoreLink',
            'value' => '/life-in-costa-rica',
            'type' => 'text',
        ]);

        // Add images to the images table and link them to content
        $mainImage = Image::create([
            'path' => 'https://hebbkx1anhila5yf.public.blob.vercel-storage.com/59c5d488-9e8e-481d-97b7-a7864ca3cec1-cgHQLzcvkUlq7mTWcASJLLbvWP4JjF.jpg',
            'title' => 'Lush green forest with waterfall in Uvita, Costa Rica',
            'section_id' => $lifeInUvitaSection->id,
        ]);

        Content::create([
            'section_id' => $lifeInUvitaSection->id,
            'key' => 'main_image',
            'value' => $mainImage->id, // Link to the image ID
            'type' => 'image',
        ]);

        $secondaryImage = Image::create([
            'path' => 'https://hebbkx1anhila5yf.public.blob.vercel-storage.com/image-asset-3JLZYcfflSE6dkaP6szN8iKpvF3517.jpeg',
            'title' => 'Aerial view of beautiful coastline in Uvita, Costa Rica',
            'section_id' => $lifeInUvitaSection->id,
        ]);

        Content::create([
            'section_id' => $lifeInUvitaSection->id,
            'key' => 'secondary_image',
            'value' => $secondaryImage->path, // Link to the image ID
            'type' => 'image',
        ]);
    }
}
