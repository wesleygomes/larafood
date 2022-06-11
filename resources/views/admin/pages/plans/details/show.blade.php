@extends('adminlte::page')

@section('title', "Detalhes do plano {$plan->name}")

@section('content_header')

    {{ Breadcrumbs::render('details.plan.show', $plan->url, $plan->name) }}

    <h1>Detalhes do plano <b>{{ $plan->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $detail->name }}
                </li>
            </ul>
            @include('admin.includes.alerts')

            <form id="formDelDetails" action="{{ route('details.plan.destroy', [$plan->url, $detail->id]) }}"
                method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Deletar o Detalhe
                    {{ $detail->name }}, do plano {{ $plan->name }} </button>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $('#formDelDetails').submit(function(e) {
            var form = this;
            e.preventDefault();
            Swal.fire({
                title: "Deletar",
                text: "Tem certeza que deseja deletar este detalhe?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#186e1d',
                confirmButtonText: 'Confirmar',
                cancelButtonText: "Cancelar",
                closeOnConfirm: false,
                closeOnCancel: false
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        });
    </script>
@stop
