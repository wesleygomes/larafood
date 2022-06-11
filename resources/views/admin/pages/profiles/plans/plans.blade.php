@extends('adminlte::page')

@section('title', "Planos do perfil {$profile->name}")

@section('content_header')
    {{ Breadcrumbs::render('profiles.plans', $profile->name) }}
    <h1>Perfis do plano <strong>{{ $profile->name }}</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @if ($plans->count() > 0)
                @include('admin.includes.alerts')
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Planos</th>
                            <th scope="col" width="50">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($plans as $plan)
                            <tr>
                                <td>{{ $plan->name }}</td>
                                <td style="width=10px;">
                                    <form class="detachProfilePlans" action="{{ route('plans.profiles.detach', [$plan->id, $profile->id]) }}"
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
                {{ $plans->appends($filters)->links() }}
            @else
                {{ $plans->links() }}
            @endif
        </div>
    </div>
@stop
@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $('.detachProfilePlans').submit(function(e) {
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
