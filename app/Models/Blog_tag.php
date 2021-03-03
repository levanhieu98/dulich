<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog_tag extends Model
{
    use HasFactory;
    protected $table = 'blog_tags';
    protected $fillable = [
        'blog_id',
        'tag_id',
    ];
}
