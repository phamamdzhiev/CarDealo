<!DOCTYPE html>
<html lang="{{env('APP_LOCALE')}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="{{ csrf_token() }}" name="csrf-token">
    <title>
        {{env('APP_NAME')}}
    </title>
    {{--    BS ICONS--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    {{--    Font Awesome Kit--}}
    <script src="https://kit.fontawesome.com/f0041d2798.js" crossorigin="anonymous"></script>
    {{-- Chrisp chat --}}
{{--    <script type="text/javascript">window.$crisp = [];--}}
{{--        window.CRISP_WEBSITE_ID = "5d194d17-d057-4284-896e-3077f71b331e";--}}
{{--        (function () {--}}
{{--            d = document;--}}
{{--            s = d.createElement("script");--}}
{{--            s.src = "https://client.crisp.chat/l.js";--}}
{{--            s.async = 1;--}}
{{--            d.getElementsByTagName("head")[0].appendChild(s);--}}
{{--        })();</script>--}}
    <link href="https://unpkg.com/nprogress@0.2.0/nprogress.css" rel="stylesheet" />
    <script src="https://unpkg.com/nprogress@0.2.0/nprogress.js"></script>
</head>
<body>
<noscript>
    <strong>We're sorry but the site doesn't work properly without JavaScript enabled. Please enable it to
        continue.</strong>
</noscript>
{{--<div class="container-xxl mt-3">--}}
{{--    <div class="alert alert-warning alert-dismissible p-2 mb-0" role="alert">--}}
{{--        <h5 class="alert-heading mb-0">В момента се извършва поддръжка на сайтa. </h5>--}}
{{--    </div>--}}
{{--</div>--}}
<div id="app"></div>
@if(env('IS_SITE_ACCESSIBLE'))
    <script>
        window.APP_VERSION = '{{ env('APP_VERSION') }}';
        window.APP_NAME = '{{ env('APP_NAME') }}';
        window.APP_URL = '{{ env('APP_URL') }}';
        window.AUTH = {!! json_encode( Auth::guard('web')->user()) !!};
        window._asset = '{{ asset('') }}';
    </script>
    <script defer src="{{ asset('js/app.js') }}"></script>
    <script defer type="text/javascript"
            src="https://cdn.jsdelivr.net/npm/cookie-bar/cookiebar-latest.min.js?forceLang=bg&theme=grey&tracking=1&always=1&noGeoIp=1&hideDetailsBtn=1&remember=365"></script>
@else
    <div style="text-align: center; margin-top: 75px;">
        <h2 style="font-weight: bold;">
            Сайтът в момента е в профилактика
        </h2>
        <h3>
            Моля, оптайте по-късно
        </h3>
    </div>
@endif
</body>
</html>

