<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProfileFormRequest;
use App\Models\Profile;

class ProfileController extends Controller
{

    protected $repository;

    public function __construct(Profile $profile)
    {
        $this->repository = $profile;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiles = $this->repository->orderBy('id', 'DESC')->paginate();

        return view('admin.pages.profiles.index', compact('profiles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.profiles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreUpdateProfileFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateProfileFormRequest $request)
    {
        if (!$this->repository->create($request->all())) {
            return redirect()->back()->with('error', 'Não foi possivel salvar o perfil');
        }

        return redirect()->route('profiles.index')->with('success', 'Perfil criado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = $this->repository->find($id);

        if (!$profile) {
            return redirect()->back();
        }

        return view('admin.pages.profiles.show', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profile = $this->repository->find($id);

        if (!$profile) {
            return redirect()->back();
        }

        return view('admin.pages.profiles.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\StoreUpdateProfileFormRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateProfileFormRequest $request, $id)
    {
        $profile = $this->repository->find($id);

        if (!$profile)
            return redirect()->back();

        $profile->update($request->all());

        return redirect()->route('profiles.index')->with('success', 'Perfil atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profile = $this->repository->find($id);

        if (!$profile)
            return redirect()->back();

        // if ($plan->details->count() > 0) {
        //     return redirect()
        //         ->back()
        //         ->with('error', 'Existem detahes vinculados a esse plano, portanto não pode deletar');
        // }

        $profile->delete();

        return redirect()->route('profiles.index')->with('success', 'Perfil deletado com sucesso');
    }
}
