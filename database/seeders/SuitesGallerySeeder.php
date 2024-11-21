<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\Section;
use App\Models\Content;
use App\Models\Image;

class SuitesGallerySeeder extends Seeder
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

        // Create the "Suites Gallery" section
        $suitesGallerySection = Section::create([
            'page_id' => $suitesPage->id,
            'name' => 'Suites Gallery',
            'order' => 2, // Adjust as necessary
            'component_name' => 'SuitesGalleryComponent',
        ]);

        // Define the suite images
        $suites = [
            [
                'path' => 'https://storage.googleapis.com/sempre-studios-893c8.appspot.com/uploads/Casa%20Turul/Suites/67205e0a1b3d1.jpeg?GoogleAccessId=firebase-adminsdk-gkp49%40sempre-studios-893c8.iam.gserviceaccount.com&Expires=1761710474&Signature=VtsL32AoKpnuEXa5g5qwiriDefGb6AkO%2BDGA7URx2geyOgBhM4do0nGF7QvGQomSJuF4CL%2FB9Y0K93q%2FrKlIsYtefKCt6Hoj5F9Bx%2BimKN2mgQK8skaAJfH9P6JrfT3PcTgkRKqJ%2Btv97aS9FJc0c1dU%2FPpvMuD5V4QohW6mbsedefgKHAB6NWMu9lxn3S3G5tiUeX5x4neRinoShO07%2F73F2BtvTEIYJshn%2FxVcN2pk8AnM7vHiMg%2Bpe%2FelQfst6GuQHNIjuH6%2BpxUW4dAOOkXobpNXHvKfwvKGa42QTy7%2BskyJu8ZiRBCjMVaczQsUTg%2BmUeZJkIiGWqZzOIzVeA%3D%3D',
                'title' => 'Exterior view of Suite 1 with pink walls and tropical plants',
                'alt' => 'Suite 1 Exterior'
            ],
            [
                'path' => 'https://storage.googleapis.com/sempre-studios-893c8.appspot.com/uploads/Casa%20Turul/Suites/67205e096bf5b.jpg?GoogleAccessId=firebase-adminsdk-gkp49%40sempre-studios-893c8.iam.gserviceaccount.com&Expires=1761710474&Signature=GN2iMA6GNJEmeqZsD6r%2BLw8ioVamar3AK8uX04KEQNOc2g556b7vWe4E8cDWQBjAPyEwdqXKGOclePvz%2B61gmMuWQFWUYCUAS%2Bvf9%2BL3a5GOWvJZkSvRRqgBUkxz6g%2B3yjzZBLgjkz2nIlxGHuRLX54gebvhECX5bOE%2FD1s5Z8SeLZt1ZVixMCKBQhji0tn%2FqS2SpHc8XNCzJlMjr%2FRckP8%2FUl5mccvdSZk%2F%2B0x6cERee9wzxJgkyktJ2UJW7DkqXoYQMr0RoEGqguRvgU%2BGC%2FVkOOxMKj24cYkrQi%2F1wrOhUxuuSpDwsPGn4pjH4WIuhKoGFAbSDULDg7%2FcTu7UIQ%3D%3D',
                'title' => 'Interior view of Suite 2 kitchen with terrazzo countertop',
                'alt' => 'Suite 2 Kitchen'
            ],
            [
                'path' => 'https://storage.googleapis.com/sempre-studios-893c8.appspot.com/uploads/Casa%20Turul/Suites/67205e0a645a0.jpeg?GoogleAccessId=firebase-adminsdk-gkp49%40sempre-studios-893c8.iam.gserviceaccount.com&Expires=1761710474&Signature=nbdxDzNupFS4MLbl6UwqAtwozcUJJRTQ9b3BRKAUpCIRUHV6HJ20XA%2FOlbRgo1lXW2DxYXx5NvVyXcIDLBmL83bBI4L6e6FbdmRwd5Tg3mDBs9fifhsEA2N1obL2AWgz8rMmTD9IzM5NEDQL45Sh3RUXmIDogf2ZWdy18updjlrpW9vwIWE2RIkqzkJCLH5cmeyNDSItkp6puxX8xhE9GxQo7q4AR0QxcFw9dyJb6hZJpLn%2BQE%2Fd6H1zv2S8wgslTdehZQ28bK68ptqEESCDi42GFi8VxbUk73TOyqvk2WSIgH5DLx4WkhjRWlSEUjCAxXEr6LXjaN79jiyHwugLyg%3D%3D',
                'title' => 'Interior view of Suite 3 bedroom with wooden slat wall',
                'alt' => 'Suite 3 Bedroom'
            ],
        ];

        foreach ($suites as $suite) {
            // Add image to the images table
            $image = Image::create([
                'path' => $suite['path'],
                'title' => $suite['title'],
                'section_id' => $suitesGallerySection->id,
            ]);

            // Link image to the content
            Content::create([
                'section_id' => $suitesGallerySection->id,
                'key' => 'suite_image_' . $image->id,
                'value' => $image->path,
                'type' => 'image',
            ]);
        }
    }
}
