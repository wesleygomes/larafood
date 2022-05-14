@extends('adminlte::page')

@section('title', 'Planos')

@section('content_header')
    {{ Breadcrumbs::render('plans') }}

    <h1>Planos <a href="{{ route('plans.create') }}" class="btn btn-secondary">ADD</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            #filtros
        </div>
        <div class="card-body">

            @if ($plans->count() > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Preço</th>
                            <th scope="col" width="200">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($plans as $plan)
                            <tr>
                                <td>{{ $plan->name }}</td>
                                <td>{{ $plan->price }}</td>
                                <td style="width=10px;">
                                    <a href="{{ route('plans.edit', $plan->url) }}" class="btn btn-info">Edit</a>
                                    <a href="{{ route('plans.show', $plan->url) }}" class="btn btn-warning">VER</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div>
                    <b>Nenhum plano cadastrado.</b>
                </div>
            @endif
        </div>
        <div class="card-footer">
            {{ $plans->links() }}
        </div>
    </div>
@stop
