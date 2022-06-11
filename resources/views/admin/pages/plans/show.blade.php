@extends('adminlte::page')

@section('title', "Plano {$plan->name}")

@section('content_header')
    {{ Breadcrumbs::render('plans.show', $plan->name) }}

    <h1>Detalhes do plano <b>{{ $plan->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $plan->name }}
                </li>
                <li>
                    <strong>URL: </strong> {{ $plan->url }}
                </li>
                <li>
                    <strong>Preço: </strong> R$ {{ number_format($plan->price, 2, ',', '.') }}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $plan->description }}
                </li>
                <li>
                    <strong>date: </strong> {{ $plan->created_at }}
                </li>
            </ul>

            @include('admin.includes.alerts')

            <form id="myForm" action="{{ route('plans.destroy', $plan->url) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i>
                    DELETAR O PLANO
                </button>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $('#myForm').submit(function(e) {
            var form = this;
            e.preventDefault();
            Swal.fire({
                    title: "Deletar",
                    text: "Tem certeza que deseja deletar este plano?",
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
