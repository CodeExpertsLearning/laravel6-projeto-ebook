<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
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
		$posts = $this->post->paginate(15);

		return view('posts.index', compact('posts'));
	}

    public function create()
    {
    	$categories = \App\Category::all(['id', 'name']);

		return view('posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
    	$data = $request->all();
	    try{
	        $data['is_active'] = true;

		    $user = auth()->user();

		    if($request->hasFile('thumb')) {
			    $data['thumb'] = $request->file('thumb')->store('thumbs', 'public');
		    } else {
			    unset($data['thumb']);
		    }

		    $post = $user->posts()->create($data);
			$post->categories()->sync($data['categories']);


			flash('Postagem inserida com sucesso!')->success();
			return redirect()->route('posts.index');

	    } catch (\Exception $e) {
		    $message = 'Erro ao remover categoria!';

		    if(env('APP_DEBUG')) {
			    $message = $e->getMessage();
		    }

		    flash($message)->warning();
		    return redirect()->back();
	    }
    }

	public function show(Post $post)
	{
		$categories = \App\Category::all(['id', 'name']);

		return view('posts.edit', compact('post', 'categories'));
	}


	public function update(Post $post, Request $request)
	{
	    $data = $request->all();

		try{

			if($request->hasFile('thumb')) {
				//Remove a imagem atual
				Storage::disk('public')->delete($post->thumb);

				$data['thumb'] = $request->file('thumb')->store('thumbs', 'public');

			} else {
				unset($data['thumb']);
			}

			$post->update($data);
			$post->categories()->sync($data['categories']);

		    flash('Postagem atualizada com sucesso!')->success();
		    return redirect()->route('posts.show', ['post' => $post->id]);

        } catch (\Exception $e) {
		    $message = 'Erro ao remover categoria!';

		    if(env('APP_DEBUG')) {
			    $message = $e->getMessage();
		    }

		    flash($message)->warning();
		    return redirect()->back();
	    }
    }

	public function destroy(Post $post)
	{
		try {
			$post->delete($post);

			flash('Postagem removida com sucesso!')->success();
			return redirect()->route('posts.index');

		} catch (\Exception $e) {
			$message = 'Erro ao remover categoria!';

			if(env('APP_DEBUG')) {
				$message = $e->getMessage();
			}

			flash($message)->warning();
			return redirect()->back();
		}
	}
}
