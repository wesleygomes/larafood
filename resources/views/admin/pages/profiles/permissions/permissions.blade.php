@extends('adminlte::page')

@section('title', "Permissões do perfil {$profile->name}")

@section('content_header')
    {{-- {{ Breadcrumbs::render('profiles') }} --}}
    <h1>Permissões do perfil <strong>{{ $profile->name }}</strong></h1>
    <a href="{{ route('profiles.permissions.available', $profile->id) }}" class="btn btn-dark">ADD NOVA PERMISSÃO</a>
@stop

@section('content')
    <div class="card">
        {{-- <div class="card-header">
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
        </div> --}}
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
