<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\Section;
use App\Models\Content;

class HomePageSeeder extends Seeder
{
    public function run()
    {
        $homePage = Page::create([
            'name' => 'Home',
            'slug' => 'home',
            'is_published' => true,
        ]);

        $heroSection = Section::create([
            'page_id' => $homePage->id,
            'name' => 'Hero',
            'order' => 1,
            'component_name' => 'HeroWithNavbarComponent',
        ]);

        Content::create([
            'section_id' => $heroSection->id,
            'key' => 'title',
            'value' => 'Boutique Hotel in the Heart of Uvita',
            'type' => 'text',
        ]);

        Content::create([
            'section_id' => $heroSection->id,
            'key' => 'subtitle',
            'value' => 'Eccentric • Privacy • Comfort',
            'type' => 'text',
        ]);

        Content::create([
            'section_id' => $heroSection->id,
            'key' => 'description',
            'value' => 'Welcome to Hotel Daleese. Located on the Southern Pacific Coast of Costa Rica, our family-owned boutique hotel is situated in Uvita, Puntarenas. We look forward to your visit!',
            'type' => 'text',
        ]);

        Content::create([
            'section_id' => $heroSection->id,
            'key' => 'background_image',
            'value' => 'https://storage.googleapis.com/sempre-studios-893c8.appspot.com/uploads/67322841779f6.jpg?GoogleAccessId=firebase-adminsdk-gkp49%40sempre-studios-893c8.iam.gserviceaccount.com&Expires=1762876354&Signature=mhPpLz8xVY7o1kR7kjmypvLScdCF0aA2oGQY1eLGl3Qkr68arHVBtZ9qUDAXndVSaf53IHqdvnJFZ8BITkZ71giidOltyC84ojOtPge9HD7WTD8iD6RWdgLI%2BMAVqKFVIXv7T%2FlouRT8W5d%2B6bdt5YnOOpaXfjfIv5rP17YhePJ7onUEbr05IncLROPLrAxB%2FPEHXVgoI2wrXFMUQwGBDP9xIayj9w%2BGY9qAoE891EhJ69O4PkZCAXzLjo1Mf%2FOvla6Ae55JkZ3s366ChNXYqN37I6cfvldJdmxMDZ7rB8xuHeRBLRpLzD%2FKncRAPwGX4Ait4KxiqM9ZluW5opRRRw%3D%3D',
            'type' => 'image',
        ]);

    }
}
