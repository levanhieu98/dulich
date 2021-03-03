<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class food extends Model
{
    use HasFactory;
    protected $table = 'foods';
    protected $fillable = [
        'banner',
        'name',
        'content',
        'address',
    ];

    protected function img()
    {
        return $this->hasMany(album_food::class);
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
