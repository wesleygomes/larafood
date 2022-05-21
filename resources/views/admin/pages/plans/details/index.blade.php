@extends('adminlte::page')

@section('title', 'Planos')

@section('content_header')

    {{ Breadcrumbs::render('details.plan.index', $plan->url) }}

    <h1>Detalhes <a href="{{ route('details.plan.create', $plan->url) }}" class="btn btn-success"><i class="fas fa-plus"></i> ADD</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            @if ($details->count() > 0)

                @include('admin.includes.alerts')

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col" width="290">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($details as $detail)
                            <tr>
                                <td>{{ $detail->name }}</td>
                                <td style="width=10px;">
                                    <a href="{{ route('details.plan.edit', [$plan->url, $detail->id]) }}" class="btn btn-info"><i class="fas fa-pen"></i> Edit</a>
                                    <a href="{{ route('details.plan.show', [$plan->url, $detail->id]) }}"
                                        class="btn btn-warning"><i class="fas fa-eye"></i> VER</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div>
                    <b>Nenhum detalhe cadastrado.</b>
                </div>
            @endif
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $details->appends($filters)->links() !!}
            @else
                {!! $details->links() !!}
            @endif
        </div>
    </div>
@stop
