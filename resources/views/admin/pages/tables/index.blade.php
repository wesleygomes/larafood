@extends('adminlte::page')

@section('title', 'Mesas')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('tables.index') }}" class="active">Mesas</a></li>
    </ol>

    <h1>Mesas <a href="{{ route('tables.create') }}" class="btn btn-dark">ADD</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('tables.search') }}" method="POST" class="form form-inline">
                @csrf
                <div class="mb-3 mr-1">
                    <input type="text" class="form-control" id="search" value="{{ $filters['search'] ?? '' }}"
                        name="search" placeholder="Nome">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i> Pesquisar</button>
                    <a href="{{ route('tables.index') }}" class="btn btn-info">Limpar</a>
                </div>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Identify</th>
                        <th>Descrição</th>
                        <th width="190">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tables as $table)
                        <tr>
                            <td>{{ $table->identify }}</td>
                            <td>{{ $table->description }}</td>
                            <td style="width=10px;">
                                {{-- <a href="{{ route('tables.qrcode', $table->identify) }}" class="btn btn-default"
                                    target="_blank">
                                    <i class="fas fa-qrcode"></i>
                                </a> --}}
                                <a href="{{ route('tables.edit', $table->uuid) }}" class="btn btn-info">Edit</a>
                                <a href="{{ route('tables.show', $table->uuid) }}" class="btn btn-warning">VER</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $tables->appends($filters)->links() !!}
            @else
                {!! $tables->links() !!}
            @endif
        </div>
    </div>
@stop
