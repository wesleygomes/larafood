<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Plan;

class SiteController extends Controller
{

    public function index()
    {
        $plans = Plan::with('details')->orderBy('price', 'ASC')->get();
        return view('site.page.home.index', compact('plans'));
    }

    public function plan($url)
    {
        if (!$plan = Plan::where('url', $url)->first()) {
            return redirect()->back();
        }

        session()->put('plan', $plan);

        return view('auth.register', compact('plan'));
    }
}
