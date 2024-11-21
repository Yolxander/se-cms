<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\Section;
use App\Models\Content;
use App\Models\Image;

class HotelHomeSectionSeeder extends Seeder
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

        // Create the Hotel Home Section
        $hotelHomeSection = Section::create([
            'page_id' => $homePage->id,
            'name' => 'Hotel Home Section',
            'order' => 4,
            'component_name' => 'HotelHomeSectionComponent',
        ]);

        // Add textual content
        Content::create([
            'section_id' => $hotelHomeSection->id,
            'key' => 'title',
            'value' => 'Our Hotel is Your Home',
            'type' => 'text',
        ]);

        Content::create([
            'section_id' => $hotelHomeSection->id,
            'key' => 'description',
            'value' => 'Hotel Daleese is your home away from home. We are committed to offering our guests a unique and relaxing experience. Get to know your hosts better here.',
            'type' => 'textarea',
        ]);

        Content::create([
            'section_id' => $hotelHomeSection->id,
            'key' => 'cta_link',
            'value' => '/our-story',
            'type' => 'text',
        ]);

        // Add image to the images table and link it to the content
        $image = Image::create([
            'path' => 'https://storage.googleapis.com/sempre-studios-893c8.appspot.com/uploads/67336fd10e763.jpg?GoogleAccessId=firebase-adminsdk-gkp49%40sempre-studios-893c8.iam.gserviceaccount.com&Expires=1762960210&Signature=TqR36aeJCJf9z5wXj%2BaQTRZhS4oDVzILqBuOZfOzWCS4hJSmiHox11aGHRrtB600seSp8s0LhterEEIsCYVLdV649sMWNk0SuVlFo8%2BYBFUo%2FT4vtOSImspNSuHUjmCqOi9WQoiy3%2B9%2Bc4r6fl6rJv0ab5ZGIrOCaxvpwx6%2B1WcIEERadp%2B3op71017z6K%2FcE3Y1Q4SLHSBd4heOcsWPqIlXfNgY3%2FgVZYcPZK8bEJnTyYU%2BMbMMo4%2F0UJqwtaENxR537zedKOP2GVIOMV9L7yLjwHN5KKpcmkqgeYH13E1pbYoR2HV%2FnQxrGLrd9MeLlXQm5nF87HnrRuQKDAHpTA%3D%3D',
            'title' => 'Tropical hotel pool area with lush vegetation and outdoor dining',
            'section_id' => $hotelHomeSection->id,
        ]);

        Content::create([
            'section_id' => $hotelHomeSection->id,
            'key' => 'background_image',
            'value' => $image->path, // Link to the image ID
            'type' => 'image',
        ]);
    }
}
