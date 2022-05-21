@extends('adminlte::page')

@section('title', "Editar Permissão {$permission->name}")

@section('content_header')

    {{ Breadcrumbs::render('permissions.edit', $permission->name) }}

    <h1>Editar Permissão: <b>{{ $permission->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            @include('admin.includes.alerts')

            <form class="form" action="{{ route('permissions.update', $permission->id) }}" method="post"
                enctype="multipart/form-data">
                @method('PUT')

                @include('admin.pages.permissions._partials.form')

            </form>
        </div>
    </div>
@stop
