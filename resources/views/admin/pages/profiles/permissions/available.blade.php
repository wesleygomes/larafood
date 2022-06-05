@extends('adminlte::page')

@section('title', 'Permissões disponíveis perfil {$profile->name}')

@section('content_header')
    {{ Breadcrumbs::render('profiles.permissions.available', $profile->name) }}
    <h1>Permissões disponíveis perfil <strong>{{ $profile->name }}</strong></h1>

@stop

@section('content')
    <div class="card">
        @if ($permissions->count() > 0)
            <div class="card-header">
                <form action="{{ route('profiles.permissions.available', $profile->id) }}" method="POST"
                    class="form form-inline">
                    @csrf
                    <div class="mb-3 mr-1">
                        <input type="text" name="filter" placeholder="Filtro" class="form-control"
                            value="{{ $filters['filter'] ?? '' }}">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-dark">Filtrar</button>
                        <a href="{{ route('profiles.permissions.available', $profile->id) }}"
                            class="btn btn-secondary ">Limpar</a>
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
                        <form action="{{ route('profiles.permissions.attach', $profile->id) }}" method="POST">
                            @csrf

                            @foreach ($permissions as $permission)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}">
                                    </td>
                                    <td>
                                        {{ $permission->name }}
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
                    {!! $permissions->appends($filters)->links() !!}
                @else
                    {!! $permissions->links() !!}
                @endif
            </div>
        @else
            <div>
                <b>Nenhuma permissão para ser vinculada.</b>
            </div>
        @endif
    </div>
@stop
