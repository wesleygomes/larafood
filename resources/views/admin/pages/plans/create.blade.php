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


@section('js')
    
    <script src="{{ asset('js/maskMoney.js') }}" type="text/javascript"></script>

    <script>
        $(function() {
            $('#price').maskMoney({
                prefix: 'R$ ',
                allowNegative: true,
                thousands: '.',
                decimal: '.',
                affixesStay: false
            });
        })
    </script>
@stop
