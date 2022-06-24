@extends('adminlte::page')

@section('title', "Detalhes do usuário {$user->name}")

@section('content_header')
    {{ Breadcrumbs::render('users.show', $user->name) }}
    <h1>Detalhes do usuário <b>{{ $user->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $user->name }}
                </li>
                <li>
                    <strong>E-mail: </strong> {{ $user->email }}
                </li>
                <li>
                    <strong>Empresa: </strong> {{ $user->tenant->name }}
                </li>
                <li>
                    <strong>Status: </strong>  {!! $user->active['span'] !!}
                </li>
            </ul>

            @include('admin.includes.alerts')

            <form id="myForm" action="{{ route('users.destroy', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> DELETAR O USUÁRIO</button>
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
