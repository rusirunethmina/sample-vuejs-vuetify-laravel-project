

<html lang="en" class="no-js">
<head>
    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="img/covid_icon.png" type="image">
    <meta name="description" content="Covid-19 Operational Dashboard">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{asset('js/plugins/material/css/materialize.css')}}" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/companylogo.css')}}">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }
        main {
            flex: 1 0 auto;
        }
        body {
            background: #fff;
        }
        .input-field input[type=date]:focus + label,
        .input-field input[type=text]:focus + label,
        .input-field input[type=email]:focus + label,
        .input-field input[type=password]:focus + label {
            color: #e91e63;
        }

        .input-field input[type=date]:focus,
        .input-field input[type=text]:focus,
        .input-field input[type=email]:focus,
        .input-field input[type=password]:focus {
            border-bottom: 2px solid #e91e63;
            box-shadow: none;
        }
        .center {
            margin: auto;
        /*    width: 50%;*/
            padding: 10px;
        }
        .rowsmall{
            margin: 2px !important;
        }
    </style>
</head>
<body>
<div class="section center">
    <main>@yield('content')</main>
</div>
<footer>
    <label class="text_logo">Powered By <strong>G-Sentry</strong></label>
</footer>
</body>
{{----------------------------jquery------------------------------------}}
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{asset('AnimatedHeaderBackgrounds/js/demo-3.js')}}" type="text/javascript"></script>
{{---------------------------------------------------pnotify----------------------------------}}
<script src="https://unpkg.com/pnotify@4.0.0/dist/umd/PNotify.js"></script>
<script src="https://unpkg.com/pnotify@4.0.0/lib/umd/PNotifyAnimate.js"></script>
<script src="https://unpkg.com/pnotify@4.0.0/lib/umd/PNotifyStyleMaterial.js"></script>
<script src="{{asset('js/plugins/material/js/materialize.js')}}"></script>
<script src="{{asset('js/plugins/material/js/init.js')}}"></script>
<script>
    // Set default styling.
    PNotify.defaults.styling = 'material';
    // This icon setting requires the Material Icons font. (See below.)
    PNotify.defaults.icons = 'material';
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
@yield('javaScript')
</html>

