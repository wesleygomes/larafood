<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePermissionFormRequest;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    protected $repository;

    public function __construct(Permission $permission)
    {
        $this->repository = $permission;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = $this->repository->orderBy('id', 'DESC')->paginate();

        return view('admin.pages.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreUpdatePermissionFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdatePermissionFormRequest $request)
    {
        try {
            $this->repository->create($request->all());
            alert()->success('Sucesso', 'Permissão cadastrada com sucesso')->toToast();
            return redirect()->route('permissions.index');
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
    public function show($id)
    {
        $permission = $this->repository->find($id);

        if (!$permission) {
            return redirect()->back();
        }

        return view('admin.pages.permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = $this->repository->find($id);

        if (!$permission) {
            return redirect()->back();
        }

        return view('admin.pages.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\StoreUpdatePermissionFormRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdatePermissionFormRequest $request, $id)
    {
        $permission = $this->repository->find($id);

        if (!$permission)
            return redirect()->back();

        try {
            $permission->update($request->all());
            alert()->success('Sucesso', 'Permissão atualizada com sucesso')->toToast();
            return redirect()->route('permissions.index');
        } catch (\Throwable $th) {
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
    public function destroy($id)
    {
        $permission = $this->repository->find($id);

        if (!$permission)
            return redirect()->back();

        try {
            $permission->delete();
            alert()->success('Sucesso', 'Permissão deletada com sucesso')->toToast();
            return redirect()->route('permissions.index');
        } catch (\Throwable $th) {
            alert()->error('Erro', 'Algo deu errado, tente novamente');
            return redirect()->back();
        }
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $permissions = $this->repository->search($request->search);
        return view('admin.pages.permissions.index', compact('permissions', 'filters'));
    }
}
