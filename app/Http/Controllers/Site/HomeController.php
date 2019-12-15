<?php

namespace App\Http\Controllers\Site;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
	/**
	 * @var Post
	 */
	private $post;

	public function __construct(Post $post)
	{
		$this->post = $post;
	}

	public function index()
	{
		$posts = $this->post->orderBy('id', 'DESC')->paginate(15);

		return view('site.posts.index', compact('posts'));
	}

	public function single($slug)
	{
		$post = $this->post->whereSlug($slug)->first();

		return view('site.posts.single', compact('post'));
	}
}
