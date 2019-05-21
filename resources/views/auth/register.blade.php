@extends('layouts.master')

@section('content')

    <section class="material-half-bg">
        <div class="cover"></div>
    </section>
    <section class="login-content">
        <a href="{{ url('/') }}" style="text-decoration:none;">
            <div class="logo">
                <h1>{{env('APP_NAME', 'Ductu')}}</h1>
            </div>
        </a>
        <div class="login-box" style="min-height:650px; min-width:380px;">
            <form class="login-form" method="POST" action="{{ route('register') }}">
                <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>SIGN UP</h3>
                @csrf

                <div class="form-group row">
                    <label class="col-md-4 control-label mt-2">User ID</label>
                    <input id="name" type="text" class="col-md-8 form-control" name="name" value="{{ old('name') }}" placeholder="Username" required autofocus>
                    @if ($errors->has('name'))
                        <span class="invalid-feedback ml-5" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group row">
                    <label class="col-md-4 control-label mt-2">Email</label>
                    <input id="email" type="email" class="col-md-8 form-control" name="email" value="{{ old('email') }}" placeholder="Email ID" required autofocus>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback ml-5" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                
                <div class="form-group row">
                    <label class="col-md-4 control-label mt-2">First Name</label>
                    <input id="first_name" type="text" class="col-md-8 form-control" name="first_name" value="{{ old('first_name') }}" placeholder="First Name" required autofocus>
                    @if ($errors->has('first_name'))
                        <span class="invalid-feedback ml-5" role="alert">
                            <strong>{{ $errors->first('first_name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group row">
                    <label class="col-md-4 control-label mt-2">Last Name</label>
                    <input id="last_name" type="text" class="col-md-8 form-control" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name" required autofocus>
                    @if ($errors->has('last_name'))
                        <span class="invalid-feedback ml-5" role="alert">
                            <strong>{{ $errors->first('last_name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group row">
                    <label class="col-md-4 control-label mt-2">Phone</label>
                    <input id="phone" type="text" class="col-md-8 form-control" name="phone" value="{{ old('phone') }}" placeholder="Mobile Number" required autofocus>
                    @if ($errors->has('phone'))
                        <span class="invalid-feedback ml-5" role="alert">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group row">
                    <label class="col-md-4 control-label mt-2">Birthday</label>
                    <input id="birthday" type="text" class="col-md-8 form-control" name="birthday" value="{{ old('birthday') }}" autocomplete="off" placeholder="Date Of Birth" autofocus>
                    @if ($errors->has('birthday'))
                        <span class="invalid-feedback ml-5" role="alert">
                            <strong>{{ $errors->first('birthday') }}</strong>
                        </span>
                    @endif
                </div>
                    
                <div class="form-group row">
                    <label class="col-md-4 control-label mt-2">Password</label>
                    <input id="password" type="password" class="col-md-8 form-control" name="password" value="{{ old('password') }}" placeholder="Password" required>
                    @if ($errors->has('password'))
                        <div class="invalid-feedback ml-5" role="alert" style="display: block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </div>
                    @endif
                </div>

                <div class="form-group row">
                    <label class="col-md-4 control-label mt-2">Confirm</label>
                    <input id="password_confirm" type="password" class="col-md-8 form-control" name="password_confirmation" placeholder="Confirm Password" required>
                    @if ($errors->has('password_confirmation'))
                        <span class="invalid-feedback ml-5" role="alert">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group btn-container">
                    <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN UP</button>
                </div>
                <br />
                <p class="text-center mb-4">Already have an account? <a href="/login"> Log In </a></p>
            </form>
        </div>
    </section>

@endsection

@section('after_script')
    <script src="{{ asset('main/js/plugins/jquery-ui.min.js') }}"></script>
    <script>
        $(function(){
            $("#birthday").datepicker({dateFormat: "yy-mm-dd"});
        });
    </script>
@endsection
