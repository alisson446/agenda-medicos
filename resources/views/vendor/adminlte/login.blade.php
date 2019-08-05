@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/iCheck/square/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
    @yield('css')
@stop

@section('body_class', 'login-page')

@section('body')
    <div class="login-box">
        <div class="login-logo">
            {!! config('adminlte.logo', '<b>Admin</b>LTE') !!}
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">{{ __("Realize o login para ter acesso ao sistema") }}</p>
            <form action="{{ route("makeLogin") }}" method="post">
                {!! csrf_field() !!}

                <div class="form-group has-feedback {{ $email ? 'has-error' : '' }}">
                    <input type="email" name="email" class="form-control" value="{{ $email }}"
                           placeholder="{{ __("Email") }}">
                    <span class="fa fa-envelope form-control-feedback"></span>
                    @if ($email)
                        <span class="help-block">
                            <strong>{{ __("Email ou senha não batem") }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $email ? 'has-error' : '' }}">
                    <input type="password" name="password" class="form-control"
                           placeholder="{{ __("Senha") }}">
                    <span class="fa fa-key form-control-feedback"></span>
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-block pull-right"
                                style="width: max-content;">{{ __("Logar") }}</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <div class="auth-links">
            </div>
        </div>
        <!-- /.login-box-body -->
    </div><!-- /.login-box -->
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
