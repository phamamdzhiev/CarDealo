<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;700&display=swap"
        rel="stylesheet"
    />
    {{--    BS ICONS--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div id="app"></div>
<script>
    const APP_VERSION = window.APP_VERSION = '{{ env('APP_VERSION') }}';
    const APP_NAME = window.APP_NAME = '{{ env('APP_NAME') }}';
    const AUTH = window.AUTH = {!! json_encode(\Illuminate\Support\Facades\Auth::user()) !!}
</script>
<script defer src="{{ asset('js/app.js') }}"></script>
</body>
</html>
