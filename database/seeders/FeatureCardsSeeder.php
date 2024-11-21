<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\Section;
use App\Models\Content;
use App\Models\Image;

class FeatureCardsSeeder extends Seeder
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

        // Create the Feature Cards section
        $featureCardsSection = Section::create([
            'page_id' => $homePage->id,
            'name' => 'Feature Cards',
            'order' => 2,
            'component_name' => 'FeatureCardsComponent',
        ]);

        // Define features data
        $features = [
            [
                'title' => 'Accommodations',
                'description' => 'Our suites are uniquely designed & sleep up to 4 guests.',
                'learnMoreLink' => '/suites',
                'imageSrc' => 'https://hebbkx1anhila5yf.public.blob.vercel-storage.com/36c31ceb-32d2-45e7-b29f-58fc567c27fb-YfVLPrRTFvmfCYgUhqdUhyxiEql4vB.jpeg',
            ],
            [
                'title' => 'Amenities',
                'description' => 'Guests can enjoy our gorgeous pool, on-site massages & more!',
                'learnMoreLink' => '/amenities',
                'imageSrc' => 'https://hebbkx1anhila5yf.public.blob.vercel-storage.com/Image-oICsIJGcXDyT254WtnJzmQPKwRFJVr.jpeg',
            ],
            [
                'title' => 'Tours & Activities',
                'description' => 'Discover what Costa Rica has to offer during your stay!',
                'learnMoreLink' => '/tours',
                'imageSrc' => 'https://hebbkx1anhila5yf.public.blob.vercel-storage.com/image-asset-s7zal6cEjEwXJm7mJeUrIGJT775KnL.jpeg',
            ],
        ];

        foreach ($features as $index => $feature) {
            // Create content for title, description, and learnMoreLink
            Content::create([
                'section_id' => $featureCardsSection->id,
                'key' => "feature_{$index}_title",
                'value' => $feature['title'],
                'type' => 'text',
            ]);

            Content::create([
                'section_id' => $featureCardsSection->id,
                'key' => "feature_{$index}_description",
                'value' => $feature['description'],
                'type' => 'textarea',
            ]);

            Content::create([
                'section_id' => $featureCardsSection->id,
                'key' => "feature_{$index}_learnMoreLink",
                'value' => $feature['learnMoreLink'],
                'type' => 'text',
            ]);

            // Create image and connect it to content
            $image = Image::create([
                'path' => $feature['imageSrc'],
                'title' => $feature['title'],
                'section_id' => $featureCardsSection->id,
            ]);

            Content::create([
                'section_id' => $featureCardsSection->id,
                'key' => "feature_{$index}_image",
                'value' =>$feature['imageSrc'], // Save the image ID as the value
                'type' => 'image',
            ]);
        }
    }
}
