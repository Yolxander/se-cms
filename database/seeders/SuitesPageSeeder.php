<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\Section;
use App\Models\Content;

class SuitesPageSeeder extends Seeder
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

        // Create the "Our Suites" section
        $ourSuitesSection = Section::create([
            'page_id' => $suitesPage->id,
            'name' => 'Our Suites',
            'order' => 1, // Adjust based on where this section should appear
            'component_name' => 'OurSuitesComponent',
        ]);

        // Add content for the section
        Content::create([
            'section_id' => $ourSuitesSection->id,
            'key' => 'title',
            'value' => 'Our Suites',
            'type' => 'text',
        ]);

        Content::create([
            'section_id' => $ourSuitesSection->id,
            'key' => 'description',
            'value' => 'There are three (3) unique studio suites located on our well-maintained manicured property. Contact us for group rates.',
            'type' => 'textarea',
        ]);
    }
}
