<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <title>
        @yield('title_prefix', config('adminlte.title_prefix', ''))
        @yield('title', config('adminlte.title', 'AdminLTE 2'))
        @yield('title_postfix', config('adminlte.title_postfix', ''))
    </title>
    
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/Bootstrap/css/bootstrap.min.css')}} ">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/skins/skin-blue.min.css') }} ">
    <link rel="stylesheet" href="{{ asset("vendor/adminlte/plugins/style.css") }}">
    <link rel="stylesheet" href="{{ asset("vendor/adminlte/plugins/vue-multiselect.min.css") }}">

</head>
<body class="hold-transition @yield('body_class')">

<div id="app">
    @yield('body')
</div>
<script src="{{ asset("js/app.js") }}"></script>
<script src="{{asset("js/menuRules.js")}}"></script>
<script src="{{ asset('vendor/adminlte/plugins/Bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/plugins/main.js') }}"></script>
@yield('adminlte_js')
    <button class="btn-backtop" title="Segure SHIFT para me esconder"> <i class="fa fa-chevron-up"></i> </button>
</body>
</html>
