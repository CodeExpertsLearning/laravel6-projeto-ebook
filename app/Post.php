<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
		'title',
	    'description',
	    'content',
	    'slug',
	    'is_active',
	    'user_id'
    ];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
