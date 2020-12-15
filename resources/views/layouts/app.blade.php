<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <title>{{ $title }}  - PAA Online Conference 2020</title>
    <link rel="icon" href="{{asset('assets')}}/images/favicon.ico" type="image/x-icon" sizes="16x16"> 
    
    <link rel="stylesheet" href="{{asset('assets')}}/css/main.min.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/weather-icon.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/weather-icons.min.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/style.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/color.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/responsive.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/toast-notification.css">

    <meta name="csrf-token" content="{{ csrf_token() }}">


</head>

<body>

    @auth

    <div class="theme-layout">

        @include('layouts.menu-responsive')
        @include('layouts.headbar')
        @include('layouts.menu')

    @endauth


    <!-- content -->
    @yield('content')
    <!-- end content -->

    @auth

        @include('layouts.bottom')

    </div>

    @endauth


    <script src="{{asset('assets')}}/js/main.min.js"></script>
    <script src="{{asset('assets')}}/js/script.js"></script>
    <script src="{{asset('assets')}}/js/date.js"></script>
    <script src="{{asset('assets')}}/js/toast-notificatons.js"></script>

    <script type="text/javascript">
        jQuery(document).ready(function($) {

            $.ajaxSetup({
               headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
            });

        });
        
        // Show Notif Toast
        function showNotif(title,content,icon,time,position) {
            if(title == ''){
                title = 'Notification';
            }
            if(content == ''){
                content = 'Something error!';
            }
            if(icon == ''){
                icon = 'error';
            }
            if(time == ''){
                time = 5000;
            }
            if(position == ''){
                position = 'bottom-right'
            }

            $.toast({
                    heading: title,
                    text: content,
                    showHideTransition: 'fade',
                    icon: icon,
                    hideAfter: time,
                    loaderBg: '#fa6342',
                    position: position,
                });
        }  

    </script>

    @stack('custom-scripts')

</body> 
</html>