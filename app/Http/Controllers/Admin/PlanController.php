<?php

namespace App\Http\Controllers\Admin;

use App\Models\Plan;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePlanFormRequest;
use Illuminate\Http\Request;
use Throwable;

class PlanController extends Controller
{

    private $repository;

    public function __construct(Plan $plan)
    {
        $this->repository = $plan;

        $this->middleware(['can:plans']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = $this->repository->latest()->active()->paginate();

        return view('admin.pages.plans.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.plans.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreUpdatePlanFormRequest  $request
     * @return App\Http\Requests\StoreUpdatePlanFormRequest
     */
    public function store(StoreUpdatePlanFormRequest $request)
    {
        try {
            $this->repository->create($request->all());
            alert()->success('Sucesso', 'Plano cadastrado com sucesso')->toToast();
            return redirect()->route('plans.index');
        } catch (\Throwable $th) {
            alert()->error('Erro', 'Algo deu errado na atualização');
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
        $plan = $this->repository->active()->where('url', $url)->first();

        if (!$plan)
            return redirect()->back();

        return view('admin.pages.plans.show', compact('plan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($url)
    {
        $plan = $this->repository->active()->where('url', $url)->first();

        if (!$plan)
            return redirect()->back();

        return view('admin.pages.plans.edit', compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\StoreUpdatePlanFormRequest  $request
     * @return App\Http\Requests\StoreUpdatePlanFormRequest
     */
    public function update(StoreUpdatePlanFormRequest $request, $url)
    {
        $plan = $this->repository->active()->where('url', $url)->first();

        if (!$plan)
            return redirect()->back();

        try {
            $plan->update($request->all());
            alert()->success('Sucesso', 'Plano atualizado com sucesso')->toToast();
            return redirect()->route('plans.index');
        } catch (Throwable $e) {
            alert()->error('Erro', 'Algo deu errado na atualização');
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

        $plan = $this->repository->active()->where('url', $url)->first();

        if (!$plan)
            return redirect()->back();

        if ($plan->details->count() > 0) {
            return redirect()
                ->back()
                ->with('error', 'Existem detahes vinculados a esse plano, portanto não pode deletar');
        }

        try {
            $plan->delete();
            alert()->success('Sucesso', 'Plano deletado com sucesso')->toToast();
            return redirect()->route('plans.index');
        } catch (Throwable $th) {
            alert()->error('Erro', 'Algo deu errado, tente novamente')->toToast();
            return redirect()->back();
        }
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $plans = $this->repository->search($request->search);
        return view('admin.pages.plans.index', compact('plans', 'filters'));
    }
}
