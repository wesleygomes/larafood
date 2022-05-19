@extends('adminlte::page')

@section('title', 'Planos')

@section('content_header')
    {{ Breadcrumbs::render('plans') }}
    <h1>Planos <a href="{{ route('plans.create') }}" class="btn btn-secondary"><i class="fas fa-plus"></i> ADD</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('plans.search') }}" method="POST" class="form form-inline">
                @csrf
                <div class="mb-3">
                    <input type="text" class="form-control" id="search" value="{{ $filters['search'] ?? '' }}"
                        name="search" placeholder="Nome">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i> Pesquisar</button>
                    <a href="{{ route('plans.index') }}" class="btn btn-info">Limpar</a>
                </div>
            </form>
        </div>
        <div class="card-body">

            @if ($plans->count() > 0)

                @include('admin.includes.alerts')

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Preço</th>
                            <th scope="col" width="290">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($plans as $plan)
                            <tr>
                                <td>{{ $plan->name }}</td>
                                <td>R$ {{ number_format($plan->price, 2, ',', '.') }}</td>
                                <td style="width=10px;">
                                    <a href="{{ route('details.plan.index', $plan->url) }}" class="btn btn-primary"><i class="fas fa-list-alt"></i> Detalhes</a>
                                    <a href="{{ route('plans.edit', $plan->url) }}" class="btn btn-info"><i
                                            class="fas fa-pen"></i> Edit</a>
                                    <a href="{{ route('plans.show', $plan->url) }}" class="btn btn-warning"><i
                                            class="fas fa-eye"></i> VER</a>
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
            @if (isset($filters))
                {{ $plans->appends($filters)->links() }}
            @else
                {{ $plans->links() }}
            @endif
        </div>
    </div>
@stop
