<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
	/**
	 * @var Category
	 */
	private $category;

	public function __construct(Category $category)
	{
		$this->category = $category;
	}

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    $categories = $this->category->paginate(15);

	    return view('categories.index', compact('categories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	    return view('categories.create');
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param CategoryRequest $request
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function store(CategoryRequest $request)
    {
    	$data = $request->all();

        try {
			$category = $this->category->create($data);

			flash('Categoria criada com sucesso!')->success();
			return redirect()->route('categories.index');

        } catch (\Exception $e) {
        	$message = 'Erro ao criar categoria!';

			if(env('APP_DEBUG')) {
				$message = $e->getMessage();
			}

			flash($message)->warning();
			return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
	    return view('categories.edit', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return redirect()->route('categories.show', ['category' => $category->id]);
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param CategoryRequest $request
	 * @param  \App\Category $category
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function update(CategoryRequest $request, Category $category)
    {
	    $data = $request->all();

	    try {
		    $category->update($data);

		    flash('Categoria atualizada com sucesso!')->success();
		    return redirect()->route('categories.show', ['category' => $category->id]);

	    } catch (\Exception $e) {
		    $message = 'Erro ao atualizar categoria!';

		    if(env('APP_DEBUG')) {
			    $message = $e->getMessage();
		    }

		    flash($message)->warning();
		    return redirect()->back();
	    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
	    try {
		    $category->delete();

		    flash('Categoria removida com sucesso!')->success();
		    return redirect()->route('categories.index');

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
