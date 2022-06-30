<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Profile;
use Illuminate\Http\Request;

class PlanProfileController extends Controller
{

    protected $plan, $profile;

    public function __construct(Plan $plan, Profile $profile)
    {
        $this->plan = $plan;
        $this->profile = $profile;

        $this->middleware(['can:plans']);
    }

    public function profiles($idPlan)
    {
        if (!$plan = $this->plan->find($idPlan)) {
            return redirect()->back();
        }

        $profiles = $plan->profiles()->paginate();

        return view('admin.pages.plans.profiles.profiles', compact('plan', 'profiles'));
    }

    public function plans($idProfile)
    {
        if (!$profile = $this->profile->find($idProfile)) {
            return redirect()->back();
        }

        $plans = $profile->plans()->paginate();

        return view('admin.pages.profiles.plans.plans', compact('profile', 'plans'));
    }


    public function profilesAvailable(Request $request, $idPlan)
    {
        if (!$plan = $this->plan->find($idPlan)) {
            return redirect()->back();
        }


        $filters = $request->except('_token');

        $profiles = $plan->profilesAvailable($request->filter);

        return view('admin.pages.plans.profiles.available', compact('plan', 'profiles', 'filters'));
    }

    public function attachProfilesPlan(Request $request, $idPlan)
    {

        if (!$plan = $this->plan->find($idPlan)) {
            return redirect()->back();
        }

        //verifica se esta vazio
        if (!isset($request->profiles)) {
            return redirect()
                ->back()
                ->with('info', 'Precisa escolher pelo menos um perfil');
        }

        try {
            $plan->profiles()->attach($request->profiles);
            alert()->success('Sucesso', 'Vínculo adicionado com sucesso')->toToast();
            return redirect()->route('plans.profiles', $plan->id);
        } catch (\Throwable $th) {
            alert()->error('Erro', 'Algo deu errado, tente novamente');
            return redirect()->back();
        }
    }

    public function detachPlanProfile($idPlan, $idProfile)
    {
        $plan = $this->plan->find($idPlan);
        $profile = $this->profile->find($idProfile);

        if (!$plan || !$profile) {
            return redirect()->back();
        }

        try {
            $plan->profiles()->detach($profile);
            alert()->success('Sucesso', 'Vínculo removido com sucesso')->toToast();
            return redirect()->route('plans.profiles', $plan->id);
        } catch (\Throwable $th) {
            alert()->error('Erro', 'Algo deu errado, tente novamente');
            return redirect()->back();
        }
    }
}
