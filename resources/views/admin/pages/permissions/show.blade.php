@extends('adminlte::page')

@section('title', "Permissão {$permission->name}")

@section('content_header')
    {{ Breadcrumbs::render('permissions.show', $permission->name) }}

    <h1>Detalhes da permissão <b>{{ $permission->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $permission->name }}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $permission->description }}
                </li>
            </ul>

            @include('admin.includes.alerts')

            <form id="formDelPermission" action="{{ route('permissions.destroy', $permission->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> DELETAR A PERMISSÃO </button>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $('#formDelPermission').submit(function(e) {
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
