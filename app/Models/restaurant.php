<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\album_restaurant;
class restaurant extends Model
{
    use HasFactory;
    protected $table = 'restaurants';
    protected $fillable = [
        'banner',
        'name',
        'content',
        'address',
        'time',
    ];

    protected function album()
    {
        return $this->hasMany(album_restaurant::class);
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
