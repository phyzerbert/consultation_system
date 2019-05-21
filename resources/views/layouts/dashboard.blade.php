<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
        <!-- Open Graph Meta-->
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="{{env('APP_NAME', 'Ductu')}}">
        <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
        <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
        <meta property="og:image" content="{{asset('images/favicon.png')}}>
        <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
        <title>{{env('APP_NAME', 'Ductu')}}</title>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{asset('images/favicon.png')}}">
        <!-- Font-icon css-->
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        {{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous"> --}}
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="{{asset('main/css/daterangepicker.min.css')}}">
        <!-- Main CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('main/css/main.css') }}">
    </head>
    <body class="app sidebar-mini rtl">
        <!-- Navbar-->
        <header class="app-header">
            @include('layouts.header')            
        </header>
        <!-- Sidebar menu-->
        <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
        <aside class="app-sidebar">
            @include('layouts.aside')
        </aside>
        <main class="app-content">
            <input type="hidden" id="role" value="{{Auth::user()->role_id}}" />
            @yield('content')
        </main>

        <!-- Essential javascripts for application to work-->
        <script src="{{ asset('main/js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('main/js/popper.min.js') }}"></script>
        <script src="{{ asset('main/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('main/js/main.js') }}"></script>
        <script src="{{ asset('main/js/pusher.min.js') }}"></script>
        <script src="{{ asset('main/js/notification.js') }}"></script>
        <!-- The javascript plugin to display page loading on top-->
        <script src="{{ asset('main/js/plugins/pace.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('main/js/plugins/bootstrap-notify.min.js') }}"></script>

        <script src="{{ asset('main/js/plugins/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('main/js/plugins/daterangepicker/moment.min.js') }}"></script>
        <script src="{{ asset('main/js/plugins/daterangepicker/jquery.daterangepicker.min.js') }}"></script>

        @yield('script')
        
        <!-- Google analytics script-->
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
        <script>$("#period").dateRangePicker();</script>
        <script type="text/javascript">            
            var notification = '<?php echo session()->get("success"); ?>';
            if(notification != ''){
                $.notify({
                    title: "Message : ",
                    message: notification,
                    icon: 'fa fa-check' 
                },{
                    type: "success"
                });
            }
            var errors_string = '<?php echo json_encode($errors->all()); ?>';
            errors_string=errors_string.replace("[","").replace("]","").replace(/\"/g,"");
            var errors = errors_string.split(",");
            if (errors_string != "") {
                for (let i = 0; i < errors.length; i++) {
                    const element = errors[i];
                    $.notify({
                        title: "Error : ",
                        message: element,
                        icon: 'fa fa-exclamation-circle' 
                    },{
                        type: "danger"
                    });                
                } 
            }            
            console.log(errors_string);
            if(document.location.hostname == 'pratikborsadiya.in') {
                (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
                ga('create', 'UA-72504830-1', 'auto');
                ga('send', 'pageview');
            }
        </script>
    </body>
</html>