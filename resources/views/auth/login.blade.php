@extends('layouts.portal')

@section('title')
    Login | {{ config('app.name') }}
@endsection


@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom/form-validation.css') }}"/>
@endsection


@section('js')
    <script src="{{ asset('js/custom/auth.js') }}"></script>
@endsection


@section('content')
    <form role="form" action="#" name="login-form">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user" style="color:grey; font-size:22px"></i></span>
            <input class="form-control validate[required,minSize[5]]" name="username" type="text" placeholder="Username">
        </div>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-key" style="color:grey; font-size:22px"></i></span>
            <input type="password" class="form-control validate[required,minSize[5]]" name="password"
                   placeholder="Password">
        </div>
        <div id="remember-me-wrapper">
            <div class="row">
                <a href="#" id="login-forget-link" class="col-xs-6">
                    Forgot password?
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <button type="submit" class="btn btn-success btn-submit col-xs-12">Login</button>
            </div>
        </div>
    </form>
@endsection