@extends('adminlte::page')

@section('title', "Cadastrar novo detalhe do plano {$plan->name}")

@section('content_header')
    {{ Breadcrumbs::render('details.plan.create', $plan->url) }}

    <h1>Cadastrar detalhes do plano <b>{{ $plan->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            @include('admin.includes.alerts')

            <form action="{{ route('details.plan.store', $plan->url) }}" method="POST" class="form">
                               
                @include('admin.pages.plans.details._partials.form')
            </form>
        </div>
    </div>
@stop
