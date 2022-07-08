<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateRoleFormRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Throwable;

class RoleController extends Controller
{

    private $repository;

    public function __construct(Role $role)
    {
        $this->repository = $role;

        $this->middleware(['can:roles']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->repository->latest()->paginate();

        return view('admin.pages.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreUpdateRoleFormRequest  $request
     * @return App\Http\Requests\StoreUpdateRoleFormRequest
     */
    public function store(StoreUpdateRoleFormRequest $request)
    {
        try {
            $this->repository->create($request->all());
            alert()->success('Sucesso', 'Cargo cadastrado com sucesso')->toToast();
            return redirect()->route('roles.index');
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
        $role = $this->repository->find($id)->first();

        if (!$role)
            return redirect()->back();

        return view('admin.pages.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = $this->repository->find($id)->first();

        if (!$role)
            return redirect()->back();

        return view('admin.pages.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\StoreUpdateRoleFormRequest  $request
     * @return App\Http\Requests\StoreUpdateRoleFormRequest
     */
    public function update(StoreUpdateRoleFormRequest $request, $id)
    {
        $role = $this->repository->find($id)->first();

        if (!$role)
            return redirect()->back();

        try {
            $role->update($request->all());
            alert()->success('Sucesso', 'Cargo atualizado com sucesso')->toToast();
            return redirect()->route('roles.index');
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
    public function destroy($id)
    {

        $role = $this->repository->find($id)->first();

        if (!$role)
            return redirect()->back();

        try {
            $role->delete();
            alert()->success('Sucesso', 'Cargo deletado com sucesso')->toToast();
            return redirect()->route('roles.index');
        } catch (Throwable $th) {
            alert()->error('Erro', 'Algo deu errado, tente novamente')->toToast();
            return redirect()->back();
        }
    }

    public function search(Request $request)
    {
        $filters = $request->only('filter');

        $roles = $this->repository->search($request->search);

        return view('admin.pages.roles.index', compact('roles', 'filters'));
    }
}
