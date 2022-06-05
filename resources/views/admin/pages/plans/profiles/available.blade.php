@extends('adminlte::page')

@section('title', 'Perfis disponíveis para o plano {$plan->name}')

@section('content_header')
    {{ Breadcrumbs::render('plans.profiles.available', $plan->name, 'Disponíveis') }}
    {{-- <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.profiles', $plan->id) }}">Perfis</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('plans.profiles.available', $plan->id) }}"
                class="active">Disponíveis</a></li>
    </ol> --}}
    <h1>Perfis disponíveis para o plano <strong>{{ $plan->name }}</strong></h1>

@stop

@section('content')
    <div class="card">
        @if ($profiles->count() > 0)
            <div class="card-header">
                <form action="{{ route('plans.profiles.available', $plan->id) }}" method="POST" class="form form-inline">
                    @csrf
                    <div class="mb-3 mr-1">
                        <input type="text" name="filter" placeholder="Filtro" class="form-control"
                            value="{{ $filters['filter'] ?? '' }}">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-dark">Filtrar</button>
                        <a href="{{ route('plans.profiles.available', $plan->id) }}" class="btn btn-secondary ">Limpar</a>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th width="50px">#</th>
                            <th>Nome</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="{{ route('plans.profiles.attach', $plan->id) }}" method="POST">
                            @csrf

                            @foreach ($profiles as $profile)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="profiles[]" value="{{ $profile->id }}">
                                    </td>
                                    <td>
                                        {{ $profile->name }}
                                    </td>
                                </tr>
                            @endforeach

                            <tr>
                                <td colspan="500">
                                    @include('admin.includes.alerts')

                                    <button type="submit" class="btn btn-success">Vincular</button>
                                </td>
                            </tr>
                        </form>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                @if (isset($filters))
                    {!! $profiles->appends($filters)->links() !!}
                @else
                    {!! $profiles->links() !!}
                @endif
            </div>
        @else
            <div>
                <b>Nenhum perfil para ser vinculado.</b>
            </div>
        @endif
    </div>
@stop
