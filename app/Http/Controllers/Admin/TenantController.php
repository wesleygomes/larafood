<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateTenantFormRequest;
use App\Models\Plan;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Throwable;

class TenantController extends Controller
{

    private $repository, $plan;

    public function __construct(Tenant $tenant, Plan $plan)
    {
        $this->repository = $tenant;
        $this->plan = $plan;

        $this->middleware(['can:tenants']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tenants = $this->repository->latest()->paginate();

        return view('admin.pages.tenants.index', compact('tenants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $plans = $this->plan->all();
        return view('admin.pages.tenants.create', compact('plans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreUpdateTenantFormRequest  $request
     * @return App\Http\Requests\StoreUpdateTenantFormRequest
     */
    public function store(StoreUpdateTenantFormRequest $request)
    {
        try {

            $data = $request->all();

            if ($request->hasFile('logo') && $request->logo->isValid()) {
                $data['logo'] = $request->logo->store("tenants/{$data['name']}");
            }

            $this->repository->create($data);
            alert()->success('Sucesso', 'Empresa cadastrada com sucesso')->toToast();
            return redirect()->route('tenants.index');
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
        $tenant = $this->repository->with('plan')->where('uuid', $uuid)->first();

        if (!$tenant)
            return redirect()->back();

        return view('admin.pages.tenants.show', compact('tenant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $tenant = $this->repository->where('uuid', $uuid)->first();

        if (!$tenant)
            return redirect()->back();

        return view('admin.pages.tenants.edit', compact('tenant'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreUpdateTenantFormRequest  $request
     * @return App\Http\Requests\StoreUpdateTenantFormRequest
     */
    public function update(StoreUpdateTenantFormRequest $request, $uuid)
    {
        $tenant = $this->repository->where('uuid', $uuid)->first();

        if (!$tenant)
            return redirect()->back();

        try {
            $data = $request->all();

            if ($request->hasFile('logo') && $request->logo->isValid()) {

                if (Storage::exists($tenant->logo)) {
                    Storage::delete($tenant->logo);
                }

                $data['logo'] = $request->image->store("tenants/{$tenant->uuid}");
            }

            $tenant->update($data);
            alert()->success('Sucesso', 'Empresa atualizada com sucesso')->toToast();
            return redirect()->route('tenants.index');
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
        $tenant = $this->repository->where('uuid', $uuid)->first();

        if (!$tenant)
            return redirect()->back();

        try {

            if (Storage::exists($tenant->image)) {
                Storage::delete($tenant->image);
            }

            $tenant->delete();

            alert()->success('Sucesso', 'Empresa deletada com sucesso')->toToast();
            return redirect()->route('tenants.index');
        } catch (Throwable $th) {
            alert()->error('Erro', 'Algo deu errado, tente novamente')->toToast();
            return redirect()->back();
        }
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $tenants = $this->repository->search($request->search);
        return view('admin.pages.tenants.index', compact('tenants', 'filters'));
    }
}
