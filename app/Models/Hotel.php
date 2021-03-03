<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    protected $table = 'hotels';
    protected $fillable = [
        'banner',
        'name',
        'description',
        'address',
    ];

    protected function album()
    {
        return $this->hasMany(album_hotel::class);
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
