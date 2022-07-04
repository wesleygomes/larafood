@extends('adminlte::page')

@section('title', 'Cadastrar Novo Tenant')

@section('content_header')
    {{ Breadcrumbs::render('tenants.create') }}
    <h1>Cadastrar Novo Tenant</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('tenants.store') }}" class="form" method="POST" enctype="multipart/form-data">
                @include('admin.pages.tenants._partials.form')
            </form>
        </div>
    </div>
@endsection

@section('js')

    <script src="{{ asset('js/maskedinput.js') }}" type="text/javascript"></script>

    <script>
        $(function() {
            $(".cnpj").mask("99.999.999/9999-99");
            //$("#plan_id").val( "{{$tenant->plan_id}}" ).trigger("change");
        });
    </script>
@stop
