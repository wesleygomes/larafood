<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Larafood</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/site.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">

</head>

<body>
    <div class="demo">
        <div class="container">
            @yield('content')
        </div>
    </div>
</body>

</html>
