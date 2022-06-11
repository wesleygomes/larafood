@extends('adminlte::page')

@section('title', "Permissões do perfil {$profile->name}")

@section('content_header')
    {{ Breadcrumbs::render('permissions.profiles', $profile->name) }}
    <h1>Permissões do perfil <strong>{{ $profile->name }}</strong></h1>
    <a href="{{ route('profiles.permissions.available', $profile->id) }}" class="btn btn-dark">ADD NOVA PERMISSÃO</a>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @if ($permissions->count() > 0)
                @include('admin.includes.alerts')
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Permissões</th>
                            <th scope="col" width="50">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                            <tr>
                                <td>{{ $permission->name }}</td>
                                <td style="width=10px;">
                                    <form
                                        class="detachProfilePermission"
                                        action="{{ route('profiles.permission.detach', [$profile->id, $permission->id]) }}"
                                        method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger">DESVINCULAR</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div>
                    <b>Nenhuma permissão vinculada.</b>
                </div>
            @endif
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {{ $permissions->appends($filters)->links() }}
            @else
                {{ $permissions->links() }}
            @endif
        </div>
    </div>
@stop
@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $('.detachProfilePermission').submit(function(e) {
            var form = this;
            e.preventDefault();
            Swal.fire({
                title: "Deletar",
                text: "Tem certeza que deseja remover este vinculo?",
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

