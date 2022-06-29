<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateTableFormRequest;
use App\Models\Table;
use Illuminate\Http\Request;
use Throwable;

class TableController extends Controller
{
    private $repository;

    public function __construct(Table $table)
    {
        $this->repository = $table;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tables = $this->repository->latest()->active()->paginate();

        return view('admin.pages.tables.index', compact('tables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.tables.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreUpdateTableFormRequest  $request
     * @return App\Http\Requests\StoreUpdateTableFormRequest
     */
    public function store(StoreUpdateTableFormRequest $request)
    {
        try {
            $this->repository->create($request->all());
            alert()->success('Sucesso', 'Mesa cadastrada com sucesso')->toToast();
            return redirect()->route('tables.index');
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
        $table = $this->repository->active()->where('uuid', $uuid)->first();

        if (!$table)
            return redirect()->back();

        return view('admin.pages.tables.show', compact('table'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $table = $this->repository->active()->where('uuid', $uuid)->first();

        if (!$table)
            return redirect()->back();

        return view('admin.pages.tables.edit', compact('table'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\StoreUpdateTableFormRequest  $request
     * @return App\Http\Requests\StoreUpdateTableFormRequest
     */
    public function update(StoreUpdateTableFormRequest $request, $uuid)
    {
        $table = $this->repository->active()->where('uuid', $uuid)->first();

        if (!$table)
            return redirect()->back();

        try {
            $table->update($request->all());
            alert()->success('Sucesso', 'Mesa atualizada com sucesso')->toToast();
            return redirect()->route('tables.index');
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

        $table = $this->repository->active()->where('uuid', $uuid)->first();

        if (!$table)
            return redirect()->back();

        try {
            $table->delete();
            alert()->success('Sucesso', 'Mesa deletada com sucesso')->toToast();
            return redirect()->route('tables.index');
        } catch (Throwable $th) {
            alert()->error('Erro', 'Algo deu errado, tente novamente')->toToast();
            return redirect()->back();
        }
    }

    public function search(Request $request)
    {
        $filters = $request->only('filter');

        $tables = $this->repository->search($request->search);
        
        return view('admin.pages.tables.index', compact('tables', 'filters'));
    }
}
