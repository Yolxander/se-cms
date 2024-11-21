<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = ['title','section_id'];

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

}
