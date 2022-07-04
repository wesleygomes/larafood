<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateTenantFormRequest;
use App\Models\Plan;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TenantController extends Controller
{
    private $repository;

    public function __construct(Tenant $tenant)
    {
        $this->repository = $tenant;

        $this->middleware(['can:tenants']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tenants = $this->repository->latest()->with('plan')->paginate();

        return view('admin.pages.tenants.index', compact('tenants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $plans = Plan::all();
        return view('admin.pages.tenants.create', compact('plans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateTenantFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateTenantFormRequest $request)
    {
        try {

            $data = $request->all();

            if ($request->hasFile('logo') && $request->logo->isValid()) {
                $data['logo'] = $request->logo->store("tenants/{$data['name']}");
            }

            $plan = Plan::find($data['plan_id']);

            $plan->tenants()->create($data);
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
    public function show($id)
    {
        if (!$tenant = $this->repository->with('plan')->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.tenants.show', compact('tenant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($url)
    {
        if (!$tenant = $this->repository->find($url)) {
            return redirect()->back();
        }

        $plans = Plan::all();
        return view('admin.pages.tenants.edit', compact('tenant', 'plans'));
    }


    /**
     * Update register by id
     *
     * @param  \App\Http\Requests\StoreUpdateTenantFormRequest  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateTenantFormRequest $request, $url)
    {
        if (!$tenant = $this->repository->find($url)) {
            return redirect()->back();
        }

        $data = $request->all();

        if ($request->hasFile('logo') && $request->logo->isValid()) {

            if (!is_null($tenant->logo)) {
                if (Storage::exists($tenant->logo)) {
                    Storage::delete($tenant->logo);
                }
            }

            $data['logo'] = $request->logo->store("tenants/{$tenant->name}");
        }

        $tenant->update($data);

        return redirect()->route('tenants.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($url)
    {
        if (!$tenant = $this->repository->find($url)) {
            return redirect()->back();
        }

        if (Storage::exists($tenant->logo)) {
            Storage::delete($tenant->logo);
        }

        $tenant->delete();

        return redirect()->route('tenants.index');
    }


    /**
     * Search results
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $filters = $request->only('filter');

        $tenants = $this->repository
            ->where(function ($query) use ($request) {
                if ($request->filter) {
                    $query->where('name', $request->filter);
                }
            })
            ->latest()
            ->paginate();

        return view('admin.pages.tenants.index', compact('tenants', 'filters'));
    }
}
