@extends('adminlte::page')

@section('title', 'Perfis')

@section('content_header')
    {{ Breadcrumbs::render('profiles') }}
    <h1>Perfis <a href="{{ route('profiles.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> ADICIONAR
            NOVO PERFIL</a>
    </h1>
@stop

@section('content')
    <div class="card">
        @if ($profiles->count() > 0)
            <div class="card-header">
                <form action="{{ route('profiles.search') }}" method="POST" class="form form-inline">
                    @csrf
                    <div class="mb-3 mr-1">
                        <input type="text" class="form-control" id="search" value="{{ $filters['search'] ?? '' }}"
                            name="search" placeholder="Perfil">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i> Pesquisar</button>
                        <a href="{{ route('profiles.index') }}" class="btn btn-info">Limpar</a>
                    </div>
                </form>
            </div>
            <div class="card-body">

                @include('admin.includes.alerts')

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col" width="290">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($profiles as $profile)
                            <tr>
                                <td>{{ $profile->name }}</td>
                                <td style="width=10px;">
                                    <a href="{{ route('profiles.edit', $profile->id) }}" class="btn btn-info"><i
                                            class="fas fa-pen"></i> Edit</a>
                                    <a href="{{ route('profiles.show', $profile->id) }}" class="btn btn-warning"><i
                                            class="fas fa-eye"></i> VER</a>
                                    <a href="{{ route('profiles.permissions', $profile->id) }}" class="btn btn-warning"><i
                                            class="fas fa-lock"></i></a>
                                    <a href="{{ route('profiles.plans', $profile->id) }}" class="btn btn-warning"><i
                                            class="fas fa-list-alt"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                @if (isset($filters))
                    {{ $profiles->appends($filters)->links() }}
                @else
                    {{ $profiles->links() }}
                @endif
            </div>
        @else
            <div class="card-hearder">
                <b>Nenhum perfil cadastrado.</b>
            </div>
        @endif
    </div>
@stop
