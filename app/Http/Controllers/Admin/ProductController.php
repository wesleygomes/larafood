<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProductFormRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Throwable;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private $repository;

    public function __construct(Product $product)
    {
        $this->repository = $product;

        $this->middleware(['can:products']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->repository->latest()->active()->paginate();

        return view('admin.pages.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreUpdateProductFormRequest  $request
     * @return App\Http\Requests\StoreUpdateProductFormRequest
     */
    public function store(StoreUpdateProductFormRequest $request)
    {
        try {

            $data = $request->all();
            $tenant = auth()->user()->tenant;

            if ($request->hasFile('image') && $request->image->isValid()) {
                $data['image'] = $request->image->store("tenants/{$tenant->uuid}/products");
            }

            $this->repository->create($data);
            alert()->success('Sucesso', 'Producto cadastrado com sucesso')->toToast();
            return redirect()->route('products.index');
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
    public function show($uuid)
    {
        $product = $this->repository->active()->where('uuid', $uuid)->first();

        if (!$product)
            return redirect()->back();

        return view('admin.pages.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $product = $this->repository->active()->where('uuid', $uuid)->first();

        if (!$product)
            return redirect()->back();

        return view('admin.pages.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\StoreUpdateProductFormRequest  $request
     * @return App\Http\Requests\StoreUpdateProductFormRequest
     */
    public function update(StoreUpdateProductFormRequest $request, $uuid)
    {
        $product = $this->repository->active()->where('uuid', $uuid)->first();

        if (!$product)
            return redirect()->back();

        try {
            $data = $request->all();

            $tenant = auth()->user()->tenant;

            if ($request->hasFile('image') && $request->image->isValid()) {

                if (Storage::exists($product->image)) {
                    Storage::delete($product->image);
                }

                $data['image'] = $request->image->store("tenants/{$tenant->uuid}/products");
            }

            $product->update($data);
            alert()->success('Sucesso', 'Produto atualizado com sucesso')->toToast();
            return redirect()->route('products.index');
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
    public function destroy($uuid)
    {

        $product = $this->repository->active()->where('uuid', $uuid)->first();

        if (!$product)
            return redirect()->back();

        try {

            if (Storage::exists($product->image)) {
                Storage::delete($product->image);
            }

            $product->delete();

            alert()->success('Sucesso', 'Produto deletado com sucesso')->toToast();
            return redirect()->route('products.index');
        } catch (Throwable $th) {
            alert()->error('Erro', 'Algo deu errado, tente novamente')->toToast();
            return redirect()->back();
        }
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $products = $this->repository->search($request->search);
        return view('admin.pages.products.index', compact('products', 'filters'));
    }
}
