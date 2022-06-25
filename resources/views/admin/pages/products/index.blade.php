@extends('adminlte::page')

@section('title', 'Produtos')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('products.index') }}" class="active">Produtos</a></li>
    </ol>

    <h1>Produtos <a href="{{ route('products.create') }}" class="btn btn-dark">ADD</a></h1>
@stop

@section('content')
    <div class="card">
        @if ($products->count() > 0)
            <div class="card-header">
                <form action="{{ route('products.search') }}" method="POST" class="form form-inline">
                    @csrf
                    <div class="mb-3 mr-1">
                        <input type="text" class="form-control" id="search" value="{{ $filters['search'] ?? '' }}"
                            name="search" placeholder="Nome">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i> Pesquisar</button>
                        <a href="{{ route('products.index') }}" class="btn btn-info">Limpar</a>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th width="100">Imagem</th>
                            <th>Título</th>
                            <th width="190">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>
                                    <img src="{{ url("storage/{$product->image}") }}" alt="{{ $product->title }}"
                                        style="max-width: 90px;">
                                </td>
                                <td>{{ $product->title }}</td>
                                <td style="width=10px;">
                                    {{-- <a href="{{ route('products.categories', $product->id) }}" class="btn btn-warning" title="Categorias"><i class="fas fa-layer-group"></i></a> --}}
                                    <a href="{{ route('products.edit', $product->uuid) }}" class="btn btn-info">Edit</a>
                                    <a href="{{ route('products.show', $product->uuid) }}"
                                        class="btn btn-warning">VER</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                @if (isset($filters))
                    {!! $products->appends($filters)->links() !!}
                @else
                    {!! $products->links() !!}
                @endif
            </div>
        @else
            <div class="card-header">
                <b>Nenhum produto cadastrado.</b>
            </div>
        @endif
    </div>
@stop
