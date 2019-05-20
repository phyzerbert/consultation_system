@extends('layouts.master')

@section('content')

<section class="material-half-bg">
    <div class="cover"></div>
</section>

<section class="login-content">
    <a href="{{ url('/') }}" style="text-decoration:none;">
        <div class="logo">
            <h1>Consultation System</h1>
        </div>
    </a>
    <div class="login-box" style="min-height:450px">
        <form class="login-form" method="POST" action="{{ route('password.update') }}">
            <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>{{ __('Reset Password') }}</h3>
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-group">
                <label class="control-label">EMAIL</label>
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" placeholder="Email" required autofocus>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label class="control-label">Password</label>
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label class="control-label">Confirm Password</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Password Confirmation" />
            </div>
            

            <div class="form-group btn-container">
                <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>{{ __('Reset Password') }}</button>
            </div>            
        </form>        
    </div>
</section>

@endsection

