<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    use HasFactory;
    protected $table    = 'map';
    protected $fillable = [
        'key',
        'title',
        'description'
    ];
    public function place()
    {
        return $this->hasMany(MapPlace::class);
    }

   
}
