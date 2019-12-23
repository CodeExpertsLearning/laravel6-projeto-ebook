<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\{SlugOptions, HasSlug};

class Category extends Model
{
	use HasSlug;

	protected $fillable = ['name', 'description', 'slug'];

	public function getSlugOptions() : SlugOptions
	{
		return SlugOptions::create()
		                  ->generateSlugsFrom('name')
		                  ->saveSlugsTo('slug');
	}

	public function posts()
	{
		return $this->belongsToMany(Post::class, 'posts_categories');
	}
}
