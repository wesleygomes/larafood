@extends('adminlte::page')

@section('title', "Perfis do plano {$plan->name}")

@section('content_header')
    {{ Breadcrumbs::render('plans.profiles', $plan->name) }}
    <h1>Perfis do plano <strong>{{ $plan->name }}</strong></h1>
    <a href="{{ route('plans.profiles.available', $plan->id) }}" class="btn btn-dark">ADD NOVO VINCULO</a>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @if ($profiles->count() > 0)
                @include('admin.includes.alerts')
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Perfil</th>
                            <th scope="col" width="50">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($profiles as $key => $profile)
                            <tr>
                                <td>{{ $profile->name }}</td>
                                <td style="width=10px;">
                                    <form class="formdetachPlanProfile" action="{{ route('plans.profiles.detach', [$plan->id, $profile->id]) }}"
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
                    <b>Nenhum perfil vinculado.</b>
                </div>
            @endif
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {{ $profiles->appends($filters)->links() }}
            @else
                {{ $profiles->links() }}
            @endif
        </div>
    </div>
@stop
@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $('.formdetachPlanProfile').submit(function(e) {
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
