<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUserFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Throwable;

class UserController extends Controller
{
    protected $repository;

    public function __construct(User $user)
    {
        $this->repository = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->repository->latest()->tenantUser()->paginate();
        return view('admin.pages.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreUpdateUserFormRequest  $request
     * @return App\Http\Requests\StoreUpdateUserFormRequest
     */
    public function store(StoreUpdateUserFormRequest $request)
    {
        try {
            $data = $request->all();
            $data['tenant_id'] = auth()->user()->tenant_id;
            $data['password'] = bcrypt($data['password']); // encrypt password

            $this->repository->create($data);
            alert()->success('Sucesso', 'Usuário cadastrado com sucesso')->toToast();
            return redirect()->route('users.index');
        } catch (\Throwable $th) {
            alert()->error('Erro', 'Algo deu errado no cadastro, tente novamente');
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
        if (!$user = $this->repository->tenantUser()->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$user = $this->repository->tenantUser()->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\StoreUpdateUserFormRequest  $request
     * @return App\Http\Requests\StoreUpdateUserFormRequest
     */
    public function update(StoreUpdateUserFormRequest $request, $id)
    {

        if (!$user = $this->repository->tenantUser()->find($id)) {
            return redirect()->back();
        }

        try {
            $data = $request->only(['name', 'email']);

            if ($request->password) {
                $data['password'] = bcrypt($request->password);
            }

            if ($request->active) {
                $data['active'] = $request->active;
            }

            $user->update($data);
            alert()->success('Sucesso', 'Usuário atualizado com sucesso')->toToast();
            return redirect()->route('users.index');
        } catch (Throwable $e) {
            alert()->error('Erro', 'Algo deu errado na atualização, tente novamente');
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

        if (!$user = $this->repository->tenantUser()->find($id)) {
            return redirect()->back();
        }

        if ($id = auth()->user()->id) {
            alert()->error('Erro', 'Você não pode excluir seu próprio usuário')->toToast();
            return redirect()->back();
        }

        try {
            $user->delete();
            alert()->success('Sucesso', 'Usuário deletado com sucesso')->toToast();
            return redirect()->route('users.index');
        } catch (Throwable $th) {
            alert()->error('Erro', 'Algo deu errado, tente novamente')->toToast();
            return redirect()->back();
        }
    }

    public function search(Request $request)
    {
        $filters = $request->only('filter');

        $users = $this->repository->search($request->search);

        return view('admin.pages.users.index', compact('users', 'filters'));
    }
}
