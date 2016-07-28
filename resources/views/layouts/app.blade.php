<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <meta name="app-root" content="{{ asset('') }}"/>
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- bootstrap -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap/bootstrap.min.css') }}" />

    <!-- libraries -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/libs/font-awesome.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/libs/nanoscroller.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/libs/alertify.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/alertify-themes/default.min.css') }}" />

    <!-- global styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/compiled/theme_styles.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom/app.css') }}" />


    @yield('css')

    <!-- Favicon -->
    <link type="image/x-icon" href="favicon.png" rel="shortcut icon" />

    <!-- google font libraries -->
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'>

    <!--[if lt IE 9]>
    <script src="{{ asset('js/html5shiv.js') }}"></script>
    <script src="{{ asset('js/respond.min.js')}}"></script>
    <![endif]-->
</head>
<body  v-cloak>
<div id="theme-wrapper">
    @include('includes.header')
    <div id="page-wrapper" class="container">
        <div class="row">
            @include('includes.sidebar')
            <div id="content-wrapper">

                @yield('content')

                <footer id="footer-bar" class="row">
                    <p id="footer-copyright" class="col-xs-12">
                        Powered by Cube Theme.
                    </p>
                </footer>
            </div>
        </div>
    </div>
</div>

<div class="md-overlay"></div><!-- the overlay element -->

<div class="ajax-error"></div>

<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="{{ asset('js/jquery.nanoscroller.min.js') }}"></script>

<!-- this page specific scripts -->
<script src="{{ asset('js/validation/validate.min.js') }}"></script> <!-- jQuery Form Validation Library -->
<script src="{{ asset('js/validation/validationEngine.min.js') }}"></script> <!-- jQuery Form Validation Library - requirred with above js -->
<script src="{{ asset('js/moment.min.js') }}"></script>
<!-- theme scripts -->
<script src="{{ asset('js/scripts.js') }}"></script>
<script src="{{ asset('js/pace.min.js') }}"></script>

<script src="{{ asset('js/vue.js') }}"></script>
<script src="{{ asset('js/vue-resource.js') }}"></script>
<script src="{{ asset('js/alertify.min.js') }}"></script>

<script src="{{ asset('js/custom/helper.js') }}"></script>
<script src="{{ asset('js/custom/vuejs-prototypes.js') }}"></script>
<script src="{{ asset('js/custom/app.js') }}"></script>

<!-- this page specific inline scripts -->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

</script>

<script>
    Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#csrf-token').getAttribute('content');
</script>


@yield('js')

</body>
</html>