@extends('layouts.app_login')

@section('titles')
    Gathering Prize | Admin Login
@endsection

@section('css')
    <style>
        .login-page {
            margin: 15% auto;
        }
    </style>
@endsection

@section('content')
    <div class="login-box">
        <div class="card">
            <div class="body">
                <div class="row">
                </div>
                <form id="log_in" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    @if ($errors->has('email'))
                        <div class="alert dark alert-icon bg-red alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <i class="material-icons">info_outline</i>
                                {{ $errors->first('email') }}
                        </div>
                    @endif
                    @if ($errors->has('password'))
                        <div class="alert dark alert-icon bg-red alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <i class="material-icons">info_outline</i>
                                {{ $errors->first('passsword') }}
                        </div>
                    @endif
                    <div class="input-group addon-line">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input id="email" type="email" class="form-control" name="email" placeholder="Email" required autofocus>
                        </div>
                    </div>
                    <div class="input-group addon-line">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>

                    <button class="btn btn-block btn-primary waves-effect" type="submit">LOG IN</button>

                </form>
            </div>
        </div>
    </div>
@endsection
