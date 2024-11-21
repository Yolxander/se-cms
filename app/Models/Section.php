<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'order'];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function content()
    {
        return $this->hasMany(Content::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

}
