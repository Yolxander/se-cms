<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['path', 'title', 'section_id','gallery_id','image_size'];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }

}
