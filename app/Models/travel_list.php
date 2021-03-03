<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class travel_list extends Model
{
    use HasFactory;
    protected $table = 'travel_lists';
    protected $fillable = [
        'avatar', 'title', 'description', 'content', 'type_of_tour_id', 'langauge_id', 'price'
    ];
    protected $appends = [
        'img'
    ];

    protected $with = ['TypeOfTour'];

    public function tour_image() {
        return $this->hasMany(tour_image::class, 'tour_id', 'id');
    }

    public function TypeOfTour() {
        return $this->belongsTo(TypeOfTour::class);
    }


    public function getImgAttribute()
    {
        return [
            'original'  => request()->getSchemeAndHttpHost() . '/img/original/' . $this->images,
            'medium'    => request()->getSchemeAndHttpHost() . '/img/medium/' . $this->images,
        ];
    }
}
