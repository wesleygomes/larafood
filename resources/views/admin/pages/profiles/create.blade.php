@extends('adminlte::page')

@section('title', 'Cadastrar novo perfil')

@section('content_header')
    {{ Breadcrumbs::render('profiles.create') }}

    <h1>Cadastrar Novo Perfil</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            @include('admin.includes.alerts')

            <form action="{{ route('profiles.store') }}" method="POST" class="form">
                @csrf

                @include('admin.pages.profiles._partials.form')

            </form>
        </div>
    </div>
@stop
