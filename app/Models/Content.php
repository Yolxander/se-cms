<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value', 'type'];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

}
