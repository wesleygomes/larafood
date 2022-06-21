@extends('adminlte::page')

@section('title', "Editar o usuário {$user->name}")

@section('content_header')

    {{ Breadcrumbs::render('users.show', $user->name) }}
    <h1>Editar o usuário {{ $user->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('users.update', $user->id) }}" class="form" method="POST">
                @method('PUT')

                @include('admin.pages.users._partials.form')
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script type="application/javascript">
        $(function() {
            $("input[name='active']").each(function(index, element) {
                if ($(this).val() == "{{ $user->active }}") {
                    $(this).attr("checked", "checked");
                }
            });
        });
    </script>
@endsection
