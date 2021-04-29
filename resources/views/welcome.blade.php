<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" value="{{ csrf_token() }}" />

    <title>Innovative Solutions - Assignment</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet" />
</head>

<body>
    <div id="app">
        <app></app>
    </div>
    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
</body>

</html>