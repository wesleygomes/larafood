<?php

namespace App\Http\Controllers\Admin;

use App\Models\Plan;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePlanFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PlanController extends Controller
{

    private $repository;

    public function __construct(Plan $plan)
    {
        $this->repository = $plan;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = $this->repository->orderBy('id', 'DESC')->paginate();
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
        $this->repository->create($request->all());
        return redirect()->route('plans.index')->with('success', 'Plano criado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($url)
    {
        $plan = $this->repository->where('url', $url)->first();

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
        $plan = $this->repository->where('url', $url)->first();

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
        $plan = $this->repository->where('url', $url)->first();

        if (!$plan)
            return redirect()->back();

        $plan->update($request->all());

        return redirect()->route('plans.index')->with('success', 'Plano atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($url)
    {
        $plan = $this->repository->where('url', $url)->first();

        if (!$plan)
            return redirect()->back();

        if ($plan->details->count() > 0) {
            return redirect()
                ->back()
                ->with('error', 'Existem detahes vinculados a esse plano, portanto não pode deletar');
        }

        $plan->delete();

        return redirect()->route('plans.index')->with('success', 'Plano deletado com sucesso');
        //return redirect()->route('plans.index')->with('success', 'Plano deletado com sucesso!');
        //return redirect()->route('plans.index')->alert()->success('Title','Lorem Lorem Lorem');

    }

    public function search(Request $request)
    {

        $filters = $request->except('_token');
        $plans = $this->repository->search($request->search);
        return view('admin.pages.plans.index', compact('plans', 'filters'));
    }
}
