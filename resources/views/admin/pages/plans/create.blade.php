@extends('adminlte::page')

@section('title', 'Cadastrar novo plano')

@section('content_header')
    {{ Breadcrumbs::render('plans.create') }}

    <h1>Cadastrar Novo Plano</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            @include('admin.includes.alerts')

            <form action="{{ route('plans.store') }}" method="POST" class="form">
                @csrf
                
                @include('admin.pages.plans._partials.form')
                
            </form>
        </div>
    </div>
@stop
