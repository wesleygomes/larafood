@extends('adminlte::page')

@section('title', "Editar o produto {$product->title}")

@section('content_header')
    <h1>Editar o produto {{ $product->title }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('products.update', $product->uuid) }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @include('admin.pages.products._partials.form')
            </form>
        </div>
    </div>
@endsection
@section('js')
    
    <script src="{{ asset('js/maskMoney.js') }}" type="text/javascript"></script>

    <script>
        $(function() {
            $('#price').maskMoney({
                prefix: 'R$ ',
                allowNegative: true,
                thousands: '.',
                decimal: '.',
                affixesStay: false
            });
        })
    </script>
@stop