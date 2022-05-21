@extends('adminlte::page')

@section('title', 'Cadastrar nova permissão')

@section('content_header')
    {{ Breadcrumbs::render('permissions.create') }}

    <h1>Cadastrar Nova Permissão</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            @include('admin.includes.alerts')

            <form action="{{ route('permissions.store') }}" method="POST" class="form">
                @csrf

                @include('admin.pages.permissions._partials.form')

            </form>
        </div>
    </div>
@stop
