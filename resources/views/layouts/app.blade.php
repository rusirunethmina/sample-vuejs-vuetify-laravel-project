<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Laravel') }}</title>

<link rel="icon" href="img/gv-logo.png" type="image">

<!-- Scripts -->
<script src="{{ mix('js/app.js') }}" defer></script>
<!-- <script src="https://js.pusher.com/5.1/pusher.min.js"></script> -->
<script>
    window.Laravel = '{!! json_encode([
    'csrfToken' => csrf_token(),
    'user' => Auth::user(),  ]) !!}';
</script>
<script>
    window.setLogout = function () {
    document.getElementById('logout-form').submit();
    };

</script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/624389a60bfe3f4a87705de2/1fvbt3ddf';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">

<!-- Styles -->
<link href="{{ mix('css/app.css') }}" rel="stylesheet">
<!--map load-->
{{--    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQb-eQu_uTMovX7lpNN8o-ity8uUc3B94&libraries=drawing,language=si,mgeometry,geometry,places"></script>--}}
<style>
    html{
        overflow: auto !important;
        font-size: 0.8em !important;
    }
    label{
        font-size: 0.8em !important;
    }
    /*::-webkit-scrollbar { width: 10px; height: 3px;}*/
    /*!*::-webkit-scrollbar-button {  background-color: #666; }*!*/
    /*::-webkit-scrollbar-track {  background-color: #646464;}*/
    /*::-webkit-scrollbar-track-piece { background-color: #000;}*/
    /*::-webkit-scrollbar-thumb { height: 50px; background-color: #666; border-radius: 3px;}*/
    /*::-webkit-scrollbar-corner { background-color: #646464;}*/
    /*::-webkit-resizer { background-color: #666;}*/
    /*.v-text-field input {*/
    /*    font-size: 0.8em !important;*/
    /*}*/
</style>
</head>
<body>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
<div id="app">
            @yield('content')
</div>

</body>

</html>
