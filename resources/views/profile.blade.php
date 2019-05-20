@extends('layouts.dashboard')

@section('content')
<div class="row user">
    <div class="col-md-12">
        <div class="profile">
            <div class="info"><img class="user-img" src="@if (isset(Auth::user()->picture)){{asset(Auth::user()->picture)}} @else {{asset('images/avatar128.png')}} @endif" />
                <h4>{{Auth::user()->name}}</h4>
                <p></p>
            </div>
            <div class="cover-image"></div>
        </div>
    </div>
</div>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="tile user-settings">
                <h4 class="line-head">My Profile</h4>
                <form method="post" action="{{route('updateuser')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{Auth::user()->id}}" />
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <label>UserID</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{Auth::user()->name}}" readonly>
                        </div>
                        <div class="col-md-12 mb-4">
                            <label>Email</label>
                            <input class="form-control" type="email" name="email" id="email" value="{{Auth::user()->email}}">
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-12 mb-4">
                            <label>First Name</label>
                            <input class="form-control" type="text" name="first_name" id="first_name" value="{{Auth::user()->first_name}}" placeholder="First Name" />
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-12 mb-4">
                            <label>Last Name</label>
                            <input class="form-control" type="text" name="last_name" id="last_name" value="{{Auth::user()->last_name}}"  placeholder="Last Name" />
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-12 mb-4">
                            <label>Picture</label>
                            <input class="form-control" type="file" name="picture" id="picture" value="{{Auth::user()->picture}}" accept="image/*" />
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-12 mb-4">
                            <label>Phone Number</label>
                            <input class="form-control" type="text" name="phone" id="phone" value="{{Auth::user()->phone}}" />
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-12 mb-4">
                            <label>Date Of Birth</label>
                            <input class="form-control" type="text" name="birthday" id="birthday" autocomplete="off" value="{{Auth::user()->date_of_birth}}" />
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-12 mb-4">
                            <label>New Password</label>
                            <input class="form-control" name="newpassword" id="newpassword" type="password">
                            <span style="color:red; font-size:16px">If you don't want to change the password, leave this field empty.</span>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-12 mb-4">
                            <label>Password Confirm</label>
                            <input class="form-control" name="newpasswordconfirm" id="newpasswordconfirm" type="password">
                        </div>
                    </div>
                    <div class="row mb-10">
                        <div class="col-md-12">
                            <button class="btn btn-primary float-right" id="profile-submit" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $("#birthday").datepicker({dateFormat: 'yy-mm-dd'});
        $("#profile-submit").click(function(){

            let newpassword = $("#newpassword").val().trim();
            let newpasswordconfirm = $("#newpasswordconfirm").val().trim();
            if(newpassword.length < 6 && newpassword.length > 0){
                alert("Password should be minimum 6 characters.");
                return false;
            }
            if(newpassword != newpasswordconfirm && newpassword != ""){
                alert("Please Confirm new password.");
                $("#newpassword").focus();
                return false;
            }
        });
    });
</script>
@endsection
