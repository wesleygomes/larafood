@extends('adminlte::page')

@section('title', "Editar Detelhe do plano {$plan->name}")

@section('content_header')

    {{ Breadcrumbs::render('details.plan.edit', $plan->url, $detail->name) }}

    <h1>Editar Detelhe do plano {{ $plan->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            @include('admin.includes.alerts')

            <form class="form" action="{{ route('details.plan.update', [$plan->url, $detail->id]) }}" method="post">
                @method('PUT')

                @include('admin.pages.plans.details._partials.form')

            </form>
        </div>
    </div>
@stop
