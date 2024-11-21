<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gallery;

class GallerySeeder extends Seeder
{
    public function run()
    {
        Gallery::create(['title' => 'Suite 1']);
        Gallery::create(['title' => 'Suite 2']);
        Gallery::create(['title' => 'Suite 3']);
    }
}
