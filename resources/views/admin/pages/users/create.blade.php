@extends('adminlte::page')

@section('title', 'Cadastrar Novo Usuário')

@section('content_header')
    {{ Breadcrumbs::render('users.create') }}

    <h1>Cadastrar Novo Usuário</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            @include('admin.includes.alerts')

            <form action="{{ route('users.store') }}" class="form" method="POST">

                @include('admin.pages.users._partials.form')
            </form>
        </div>
    </div>
@endsection

