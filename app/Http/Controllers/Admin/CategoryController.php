<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCategoryFormRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Throwable;

class CategoryController extends Controller
{

    private $repository;

    public function __construct(Category $category)
    {
        $this->repository = $category;

        $this->middleware(['can:categories']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->repository->latest()->active()->paginate();

        return view('admin.pages.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreUpdateCategoryFormRequest  $request
     * @return App\Http\Requests\StoreUpdateCategoryFormRequest
     */
    public function store(StoreUpdateCategoryFormRequest $request)
    {
        try {
            $this->repository->create($request->all());
            alert()->success('Sucesso', 'Categoria cadastrada com sucesso')->toToast();
            return redirect()->route('categories.index');
        } catch (\Throwable $th) {
            alert()->error('Erro', 'Algo deu errado, tente novamente');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($url)
    {
        $category = $this->repository->active()->where('url', $url)->first();

        if (!$category)
            return redirect()->back();

        return view('admin.pages.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($url)
    {
        $category = $this->repository->active()->where('url', $url)->first();

        if (!$category)
            return redirect()->back();

        return view('admin.pages.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\StoreUpdateCategoryFormRequest  $request
     * @return App\Http\Requests\StoreUpdateCategoryFormRequest
     */
    public function update(StoreUpdateCategoryFormRequest $request, $url)
    {
        $category = $this->repository->active()->where('url', $url)->first();

        if (!$category)
            return redirect()->back();

        try {
            $category->update($request->all());
            alert()->success('Sucesso', 'Categoria atualizada com sucesso')->toToast();
            return redirect()->route('categories.index');
        } catch (Throwable $e) {
            alert()->error('Erro', 'Algo deu errado, tente novamente');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($url)
    {

        $category = $this->repository->active()->where('url', $url)->first();

        if (!$category)
            return redirect()->back();

        // if ($category->details->count() > 0) {
        //     return redirect()
        //         ->back()
        //         ->with('error', 'Existem detahes vinculados a esse Categoryo, portanto não pode deletar');
        // }

        try {
            $category->delete();
            alert()->success('Sucesso', 'Categoria deletada com sucesso')->toToast();
            return redirect()->route('categories.index');
        } catch (Throwable $th) {
            alert()->error('Erro', 'Algo deu errado, tente novamente')->toToast();
            return redirect()->back();
        }
    }

    public function search(Request $request)
    {
        $filters = $request->only('filter');

        $categories = $this->repository->search($request->search);

        return view('admin.pages.categories.index', compact('categories', 'filters'));
    }
}
