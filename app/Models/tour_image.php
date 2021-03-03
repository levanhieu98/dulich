<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tour_image extends Model
{
    use HasFactory;
    protected $table    = 'tour_images';
    protected $appends = [
        'album_image'
    ];
    public function getAlbumImageAttribute()
    {
        return request()->getSchemeAndHttpHost() . '/img/album/' . $this->image;
    }
}
