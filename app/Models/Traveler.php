<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traveler extends Model
{
    use HasFactory;
    protected $appends = [
        'image'
    ];
    
    public function getImageAttribute() {
        return [
            'original'  => request()->getSchemeAndHttpHost(). '/img/original/'. $this->images,
            'medium'    => request()->getSchemeAndHttpHost(). '/img/medium/'. $this->images,
        ];
    }
}
