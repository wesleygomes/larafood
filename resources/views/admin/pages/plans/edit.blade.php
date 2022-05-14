@extends('adminlte::page')

@section('title', 'Editar Plano')

@section('content_header')
    <h1>Editar Plano</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form class="form" action="{{ route('plans.update', $plan->url) }}" method="post"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $plan->name }}"
                        placeholder="Nome">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Preço</label>
                    <input type="text" class="form-control" id="price" name="price" placeholder="Preço"
                        value="{{ $plan->price }}">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Descrição</label>
                    <input class="form-control" id="description" name="description" placeholder="Descrição"
                        value="{{ $plan->description }}">
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
    </div>
@stop
