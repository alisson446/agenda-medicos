@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/iCheck/square/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
    @yield('css')
@stop

@section('body_class', 'login-page')

@section('body')
{{--    <div class="login-box">--}}
{{--        <div class="login-logo">--}}
{{--            {!! config('adminlte.logo', '<b>Admin</b>LTE') !!}--}}
{{--        </div>--}}
{{--        <!-- /.login-logo -->--}}
{{--        <div class="login-box-body">--}}
{{--            <p class="login-box-msg">{{ __("Realize o login para ter acesso ao sistema") }}</p>--}}
{{--            <form action="{{ route("makeLogin") }}" method="post">--}}
{{--                {!! csrf_field() !!}--}}

{{--                <div class="form-group has-feedback {{ $email ? 'has-error' : '' }}">--}}
{{--                    <input type="email" name="email" class="form-control" value="{{ $email }}"--}}
{{--                           placeholder="{{ __("Email") }}">--}}
{{--                    <span class="fa fa-envelope form-control-feedback"></span>--}}
{{--                    @if ($email)--}}
{{--                        <span class="help-block">--}}
{{--                            <strong>{{ __("Email ou senha não batem") }}</strong>--}}
{{--                        </span>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--                <div class="form-group has-feedback {{ $email ? 'has-error' : '' }}">--}}
{{--                    <input type="password" name="password" class="form-control"--}}
{{--                           placeholder="{{ __("Senha") }}">--}}
{{--                    <span class="fa fa-key form-control-feedback"></span>--}}
{{--                </div>--}}
{{--                <div class="row">--}}
{{--                    <!-- /.col -->--}}
{{--                    <div class="col-md-12">--}}
{{--                        <button type="submit" class="btn btn-primary btn-block pull-right"--}}
{{--                                style="width: max-content;">{{ __("Logar") }}</button>--}}
{{--                    </div>--}}
{{--                    <!-- /.col -->--}}
{{--                </div>--}}
{{--            </form>--}}
{{--            <div class="auth-links">--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- /.login-box-body -->--}}
{{--    </div><!-- /.login-box -->--}}
<div class="login-box">
    <div class="login-logo hide">
        <i class="fa fa-user-md"></i> Agenda
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <h1>Login Agenda</h1>
        <p class="login-box-msg" align="left">Realize o login para ter acesso ao sistema</p>
        <form action="{{ route("makeLogin") }}" method="post">
            {!! csrf_field() !!}

            <div class="form-group has-feedback ">
                <input type="email" name="email" class="form-control" value=""
                       placeholder="Email">
                <span class="fa fa-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback ">
                <input type="password" name="password" class="form-control"
                       placeholder="Senha">
                <span class="fa fa-key form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="reset-pass">
                        <a class="color-blue" href="#">Resetar senha</a>
                    </div>

                </div>
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-block pull-right btn-login">Logar</button>
                </div>
                <!-- /.col -->
            </div>


            <div class="row">
                <!-- /.col -->
                <div class="col-md-12">
                    <div class="call-register">
                        <p>
                            Ainda não possui conta? <a class="color-blue" href="#">Registre-se!</a>
                        </p>
                    </div>

                </div>
            </div>
        </form>
        <div class="auth-links">
        </div>
    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->

    <style>

        .login-box{


        }

        body, .login-page, .register-page{

            position: relative;

            padding: 100px 0;
            background: url("../../../images/background-medice.svg") no-repeat center fixed!important;
            background-size: contain!important;
        }

        .login-box-body h1, .register-box-body h1 {
            font-size: 35px;
            font-weight: 700;
            color: #0e0dd3;
        }


        .call-register, .reset-pass{
            margin: 8px 0!important;
        }

        .login-box-msg, .register-box-msg{
            text-align: left;
            padding: 20px 0;
        }

        .login-box-body, .register-box-body{
            border-radius: 20px;
            padding: 60px;
            /*width: 460px;*/
            /*margin: auto;*/
            box-shadow: 0 1px 12px rgba(0,0,0,0.15);

        }

        .form-control{
            padding: 20px 12px;
            border-radius: 6px!important;
        }

        .form-control:focus {
            border-color: #0e0dd3;
        }

        .w-100{
            width: 100%;
        }
        .color-blue{
            color: #0e0dd3 !important;
        }
        .btn-login{

            background-color: #0e0dd3 !important;
            border-color: #0e0dd3 !important;
            border-radius: 6px;
            padding: 10px 12px;
        }

    </style>
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
    @yield('js')
@stop
