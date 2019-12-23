<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\{SlugOptions, HasSlug};

class Post extends Model
{
	use HasSlug;

    protected $fillable = [
		'title',
	    'description',
	    'content',
	    'slug',
	    'is_active',
	    'user_id',
	    'thumb'
    ];

	public function getSlugOptions() : SlugOptions
	{
		return SlugOptions::create()
		                  ->generateSlugsFrom('title')
		                  ->saveSlugsTo('slug');
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function categories()
	{
		return $this->belongsToMany(Category::class, 'posts_categories');
	}

	public function comments()
	{
		return $this->hasMany(Comment::class);
	}
}
