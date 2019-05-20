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
        <form class="login-form" method="POST" action="{{ route('login') }}">
            <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>SIGN IN</h3>
            @csrf
            <div class="form-group">
                <label class="control-label">EMAIL ID</label>
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email ID" required autofocus>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label class="control-label">PASSWORD</label>
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <div class="utility">
                    <div class="animated-checkbox">
                        <label>
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}><span class="label-text">Remember Me</span>
                        </label>
                    </div>

                    @if (Route::has('password.request'))
                        <p class="semibold-text mb-2">
                            <a class="btn btn-link" href="{{ route('password.request') }}" data-toggle="flip">
                                {{ __('Forgot Password?') }}
                            </a>
                        </p>
                    @endif
                </div>
            </div>
            <div class="form-group btn-container">
                <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN IN</button>
            </div>
            <br />
            <p class="text-center">Don't have an account? <a href="{{ route('register') }}">Sign Up</a></p>
        </form>
        
        <form class="forget-form" action="{{ route('password.email') }}" method="POST">
            <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>Forgot Password ?</h3>
            @csrf
            <div class="form-group mt-3">
                <label class="control-label">EMAIL</label>
                <input name="email" class="form-control" type="text" placeholder="Email">
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group btn-container mt-3">
                <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>RESET</button>
            </div>
            <div class="form-group mt-3">
                <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i>
                        Back to Login</a></p>
            </div>
        </form>
        
    </div>
</section>

@endsection

@section('after_script')
<script type="text/javascript">
    // Login Page Flipbox control
    $('.login-content [data-toggle="flip"]').click(function() {
        $('.login-box').toggleClass('flipped');
        return false;
    });
</script>
@endsection
