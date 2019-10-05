<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;

class PostController extends Controller
{
	public function index()
	{
		$posts = Post::paginate(15);

		return view('posts.index', compact('posts'));
	}

	public function show($id)
	{
		$post = Post::findOrFail($id);

		return view('posts.edit', compact('post'));
	}

    public function create()
    {
		return view('posts.create');
    }

    public function store(Request $request)
    {
//		if($request->hasAny(['title', 'content', 'slug'])) {
//			var_dump($request->except(['title']));
//		}
//
//		return back()->withInput();

//	  Salvando com active record
//    $data = $request->all();
//
//	    $post = new Post();
//
//	    $post->title       = $data['title'];
//	    $post->description = $data['description'];
//	    $post->content     = $data['content'];
//	    $post->slug        = $data['slug'];
//	    $post->is_active   = true;
//	    $post->user_id     = 1;
//
//	    dd($post->save());

	    //Salvando com mass assignment
        $data = $request->all();
	    $data['is_active'] = true;

	    $user = Post::find(1);
		$user->posts()->create($data);

		return redirect()->route('posts.index');
    }

    public function update($id, Request $request)
    {
	    //Salvando com mass assignment
	    $data = $request->all();

	    $post = Post::findOrFail($id);

	    dd($post->update($data));
    }

	public function destroy($id)
	{
		$post = Post::findOrFail($id);

		dd($post->delete());
	}
}
