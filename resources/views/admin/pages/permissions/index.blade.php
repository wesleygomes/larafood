@extends('adminlte::page')

@section('title', 'Permissões')

@section('content_header')
    {{ Breadcrumbs::render('permissions') }}
    <h1>Permissão <a href="{{ route('permissions.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> ADICIONAR NOVA PERMISSÃO</a>
    </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="#" method="POST" class="form form-inline">
                @csrf
                <div class="mb-3 mr-1">
                    <input type="text" class="form-control" id="search" value="" name="search" placeholder="Nome">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i> Pesquisar</button>
                    <a href="#" class="btn btn-info">Limpar</a>
                </div>
            </form>
        </div>
        <div class="card-body">

            @if ($permissions->count() > 0)

                @include('admin.includes.alerts')

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col" width="290">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                            <tr>
                                <td>{{ $permission->name }}</td>
                                <td style="width=10px;">
                                    <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-info"><i
                                            class="fas fa-pen"></i> Edit</a>
                                    <a href="{{ route('permissions.show', $permission->id) }}" class="btn btn-warning"><i
                                            class="fas fa-eye"></i> VER</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div>
                    <b>Nenhuma permissão cadastrada.</b>
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
