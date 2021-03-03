<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapPlace extends Model
{
    use HasFactory;
    protected $table    = 'map_place';
    protected $fillable = [
        'map_id',
        'title',
        'image',
        'url',
    ];
    protected function map()
    {
        return $this->belongTo(Map::class);
    }

    protected $appends = [
        'images'
    ];
    
    public function getimagesAttribute() {
        return [
            'original'  => request()->getSchemeAndHttpHost(). '/img/original/'. $this->image,
            'medium'    => request()->getSchemeAndHttpHost(). '/img/medium/'. $this->image,
        ];
    }
}
