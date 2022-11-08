
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="icon" href="img/title_small.png" type="image">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        html{
            overflow-y: hidden;
            font-size:14px !important;
            scrollbar-face-color: #646464;
            scrollbar-base-color: #646464;
            scrollbar-3dlight-color: #646464;
            scrollbar-highlight-color: #646464;
            scrollbar-track-color: #F5F5F5;
            scrollbar-arrow-color: #F5F5F5;
            scrollbar-shadow-color: #646464;
            scrollbar-dark-shadow-color: #646464;
        }
        label{
            font-size:14px !important;
        }
        .v-list-item {
            text-decoration: none !important;
        }
        button:focus { outline-style: none; }

        ::-webkit-scrollbar { width: 7px; height: 7px;}
        /*::-webkit-scrollbar-button {  background-color: #666; }*/
        ::-webkit-scrollbar-track {  background-color: #646464;}
        ::-webkit-scrollbar-track-piece { background-color: #F5F5F5;}
        ::-webkit-scrollbar-thumb { height: 10px; background-color: #666; border-radius: 3px;}
        ::-webkit-scrollbar-corner { background-color: #646464;}
        ::-webkit-resizer { background-color: #666;}
        .v-text-field input {
            font-size: 0.8em !important;
        }

    </style>
    <script>

        window.Laravel = '{!! json_encode([
            'csrfToken' => csrf_token(),
            'user' => Auth::user(),
        ]) !!}';


    </script>
</head>
<body >
<div id="app">
    <v-app id="inspire">
        <main>
            <!--router-view></router-view-->
            <api-login></api-login>
        </main>
    </v-app>
</div>
</body>
</html>
