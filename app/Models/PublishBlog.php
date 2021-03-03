<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublishBlog extends Model
{
    use HasFactory;
    protected $table = 'publish_blog';
    protected $dates = ['published_at'];
}
