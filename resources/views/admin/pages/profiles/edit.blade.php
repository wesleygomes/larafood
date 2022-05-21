@extends('adminlte::page')

@section('title', "Editar Perfil {$profile->name}")

@section('content_header')

    {{ Breadcrumbs::render('profiles.edit', $profile->name) }}

    <h1>Editar Perfil: <b>{{ $profile->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            @include('admin.includes.alerts')

            <form class="form" action="{{ route('profiles.update', $profile->id) }}" method="post"
                enctype="multipart/form-data">
                @method('PUT')

                @include('admin.pages.profiles._partials.form')

            </form>
        </div>
    </div>
@stop
