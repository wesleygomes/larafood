@extends('adminlte::page')

@section('title', "Editar Plano {$plan->name}")

@section('content_header')

    {{ Breadcrumbs::render('plans.edit', $plan->name) }}

    <h1>Editar Plano: <b>{{$plan->name}}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            @include('admin.includes.alerts')

            <form class="form" action="{{ route('plans.update', $plan->url) }}" method="post"
                enctype="multipart/form-data">
                @method('PUT')

                @include('admin.pages.plans._partials.form')

            </form>
        </div>
    </div>
@stop
