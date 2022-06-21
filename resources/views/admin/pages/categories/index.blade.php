@extends('adminlte::page')

@section('title', 'Categorias')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('categories.index') }}" class="active">Categorias</a></li>
    </ol>

    <h1>Categorias <a href="{{ route('categories.create') }}" class="btn btn-dark">ADD</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('categories.search') }}" method="POST" class="form form-inline">
                @csrf
                <div class="mb-3 mr-1">
                    <input type="text" class="form-control" id="search" value="{{ $filters['search'] ?? '' }}"
                        name="search" placeholder="Nome">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i> Pesquisar</button>
                    <a href="{{ route('categories.index') }}" class="btn btn-info">Limpar</a>
                </div>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th width="150">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description }}</td>
                            <td style="width=10px;">
                                <a href="{{ route('categories.edit', $category->url) }}" class="btn btn-info">Edit</a>
                                <a href="{{ route('categories.show', $category->url) }}" class="btn btn-warning">VER</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $categories->appends($filters)->links() !!}
            @else
                {!! $categories->links() !!}
            @endif
        </div>
    </div>
@stop
