<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
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
{{--<div class="container-xxl mt-3">--}}
{{--    <div class="alert alert-warning alert-dismissible p-2 mb-0" role="alert">--}}
{{--        <h5 class="alert-heading mb-0">В момента се извършва поддръжка на сайт. </h5>--}}
{{--    </div>--}}
{{--</div>--}}
<div id="app"></div>
<script>
    window.APP_VERSION = '{{ env('APP_VERSION') }}';
    window.APP_NAME = '{{ env('APP_NAME') }}';
    window.AUTH = {!! json_encode( Auth::guard('web')->user()) !!};
    window._asset = '{{ asset('') }}';
</script>
<script defer src="{{ asset('js/app.js') }}"></script>
<script defer type="text/javascript"
        src="https://cdn.jsdelivr.net/npm/cookie-bar/cookiebar-latest.min.js?forceLang=bg&theme=grey&tracking=1&always=1&noGeoIp=1&hideDetailsBtn=1&remember=365"></script>
</body>
</html>

