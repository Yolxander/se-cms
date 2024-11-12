<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'content', 'type'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }
}
