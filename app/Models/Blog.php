<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $table = 'blogs';
    protected $fillable = [
        'id',
        'title',
        'slug',
        'image',
        'description',
        'content',
        'publish',
        'publish_on',
        'category_id',
        'language_id',
        'author_id',
    ];

    public function publisher()
    {
        return $this->belongsTo(User::class, 'publish_on');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'blog_tags');
    }
    public function publish_blog()
    {
        return $this->hasOne(PublishBlog::class, 'blog_id', 'id');
    }
}