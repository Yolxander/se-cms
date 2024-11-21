<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleriesTable extends Migration
{
    public function up()
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamps();
        });

        // Add a foreign key to the `images` table for gallery association
        Schema::table('images', function (Blueprint $table) {
            $table->foreignId('gallery_id')->nullable()->constrained('galleries')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('images', function (Blueprint $table) {
            $table->dropForeign(['gallery_id']);
            $table->dropColumn('gallery_id');
        });

        Schema::dropIfExists('galleries');
    }
}
