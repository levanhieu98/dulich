<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeOfTour extends Model
{
    use HasFactory;
    protected $table ="type_of_tour";

   
    public function travel_list()
    {
        return $this->hasMany(travel_list::class);
    }
}
