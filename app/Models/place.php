<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class place extends Model
{
    use HasFactory;
    protected $table = 'places';
    protected $fillable = [
        'banner',
        'name',
        'description',
        'address',
    ];

    protected function album()
    {
        return $this->hasMany(album_place::class);
    }

    protected $appends = [
        'banners'
    ];
    
    public function getBannersAttribute() {
        return [
            'original'  => request()->getSchemeAndHttpHost(). '/img/original/'. $this->banner,
            'medium'    => request()->getSchemeAndHttpHost(). '/img/medium/'. $this->banner,
        ];
    }
}
