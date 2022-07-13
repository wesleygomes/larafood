@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
    {{ Breadcrumbs::render('users') }}

    <h1>Usuários <a href="{{ route('users.create') }}" class="btn btn-dark">ADD</a></h1>
@stop

@section('content')
    <div class="card">
        @if ($users->count() > 0)
        <div class="card-header">
            <form action="{{ route('users.search') }}" method="POST" class="form form-inline">
                @csrf
                <div class="mb-3 mr-1">
                    <input type="text" class="form-control" id="search" value="{{ $filters['search'] ?? '' }}"
                        name="search" placeholder="Nome">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i> Pesquisar</button>
                    <a href="{{ route('users.index') }}" class="btn btn-info">Limpar</a>
                </div>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th width="320">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td style="width=10px;">
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info">Edit</a>
                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-warning">VER</a>
                                {{-- {!! $user->active['span'] !!} --}}
                                <a href="{{ route('users.roles', $user->id) }}" class="btn btn-info" title="Cargos"><i class="fas fa-address-card"></i> Cargos</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $users->appends($filters)->links() !!}
            @else
                {!! $users->links() !!}
            @endif
        </div>
        @else
            <div class="card-hearder">
                <strong>Nenhum Usuário cadastrado.</strong>
            </div>
        @endif
    </div>
@stop
