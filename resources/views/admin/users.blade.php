@extends('layouts.dashboard')
@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-users"></i>&nbsp;User Management</h1>
        <!-- <p>A free and open source Bootstrap 4 admin template</p> -->
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fa fa-home fa-lg"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Users</a></li>
    </ul>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="btn-group mb-3 float-right">
                    <a class="btn btn-info btn-sm" href="#" id="btn-add" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Add New"><i class="fa fa-lg fa-plus"></i>Add New Consultant</a>
                </div>
                <div class="tile-body mt-3">
                    <table class="table table-hover table-bordered text-center">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>UserID</th>
                                <th>Email</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Phone</th>
                                <th>Date Of Birth</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ ($page_number-1) * 10 + $loop->index+1 }}</td>
                                <td class="username">{{$user->name}}</td>
                                <td class="email">{{$user->email}}</td>
                                <td class="first_name">{{$user->first_name}}</td>
                                <td class="last_name">{{$user->last_name}}</td>
                                <td class="phone">{{$user->phone}}</td>
                                <td class="birthday">{{$user->date_of_birth}}</td>
                                <td class="role">{{$user->role->name}}</td>
                                <td class="py-2">
                                    <a href="#" class="btn btn-info btn-sm btn-edit" data-value="{{$user->id}}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit"><i class="fa fa-edit" style="font-size:20px"></i>Edit</a>
                                    <a href="{{route('user.delete', $user->id)}}" class="btn btn-danger btn-sm btn-delete" onclick="return confirm('Are you sure?');" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete"><i class="fa fa-trash-o" style="font-size:20px"></i>&nbsp;Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="clearfix">
                        <div class="pull-left" style="margin: 0;">
                            <p>Total <strong style="color: red">{{ $users->total() }}</strong> Items</p>
                        </div>
                        <div class="pull-right" style="margin: 0;">
                            {!! $users->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal fade" id="userModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create Consultant</h4>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <form action="" id="create_form" method="post">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="id" />
                    <div class="form-group">
                        <label class="control-label">User ID</label>
                        <input class="form-control" type="text" name="name" id="name" placeholder="UserID">
                        <span id="name_error" class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Email</label>
                        <input class="form-control" type="email" name="email" id="email" placeholder="Email ID">
                        <span id="email_error" class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <label class="control-label">First Name</label>
                        <input class="form-control" type="text" name="first_name" id="firstname" placeholder="First Name">
                        <span id="first_name_error" class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Last Name</label>
                        <input class="form-control" type="text" name="last_name" id="lastname" placeholder="Last Name">
                        <span id="last_name_error" class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Phone Number</label>
                        <input class="form-control" type="text" name="phone" id="phone" placeholder="Phone Number">
                        <span id="phone_error" class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Date Of Birth</label>
                        <input class="form-control datepicker" type="text" name="birthday" id="birthday" autocomplete="off" placeholder="Date Of Birth">
                    </div>
                    <div class="form-group password-field">
                        <label class="control-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                        <span id="password_error" class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>

                    <div class="form-group password-field">
                        <label class="control-label">Password Confirm</label>
                        <input type="password" name="password_confirmation" id="confirmpassword" class="form-control" placeholder="Password Confirm">
                        <span id="confirmpassword_error" class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" id="btn_create" class="btn btn-primary btn-submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>&nbsp;Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>&nbsp;Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="editModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit User</h4>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <form action="" id="edit_form" method="post">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit_id" />                    
                    <div class="form-group">
                        <label class="control-label">User ID</label>
                        <input class="form-control" type="text" name="name" id="edit_name" placeholder="UserID">
                        <span id="edit_name_error" class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Email</label>
                        <input class="form-control" type="email" name="email" id="edit_email" placeholder="Email ID">
                        <span id="edit_email_error" class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <label class="control-label">First Name</label>
                        <input class="form-control" type="text" name="first_name" id="edit_first_name" placeholder="First Name">
                        <span id="edit_first_name_error" class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Last Name</label>
                        <input class="form-control" type="text" name="last_name" id="edit_last_name" placeholder="Last Name">
                        <span id="edit_last_name_error" class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Phone Number</label>
                        <input class="form-control" type="text" name="phone" id="edit_phone" placeholder="Phone Number">
                        <span id="edit_phone_error" class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Date Of Birth</label>
                        <input class="form-control datepicker" type="text" name="birthday" id="edit_birthday" autocomplete="off" placeholder="Date Of Birth">
                    </div>
                    <div class="form-group password-field">
                        <label class="control-label">Password</label>
                        <input type="password" name="password" id="edit_password" class="form-control" placeholder="Password">
                        <span id="edit_password_error" class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>

                    <div class="form-group password-field">
                        <label class="control-label">Password Confirm</label>
                        <input type="password" name="password_confirmation" id="edit_confirmpassword" class="form-control" placeholder="Password Confirm">
                        <span id="edit_confirmpassword_error" class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" id="btn_update" class="btn btn-primary btn-submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>&nbsp;Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>&nbsp;Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        $(".datepicker").datepicker({dateFormat: 'yy-mm-dd'});
        $("#btn-add").click(function(){
            $("#create_form input.form-control").val('');
            $("#create_form .invalid-feedback strong").text('');
            $("#userModal").modal();
        });

        $("#btn_create").click(function(){          
            $.ajax({
                url: "{{route('user.create')}}",
                type: 'post',
                dataType: 'json',
                data: $('#create_form').serialize(),
                success : function(data) {
                    // console.log(data);
                    if(data == 'success') {
                        alert('Created consultant successfully.');
                        window.location.reload();
                    }
                    else if(data.message == 'The given data was invalid.') {
                        alert(data.message);
                    }
                },
                error: function(data) {
                    console.log(data.responseJSON);
                    if(data.responseJSON.message == 'The given data was invalid.') {
                        let messages = data.responseJSON.errors;
                        if(messages.name) {
                            $('#name_error strong').text(data.responseJSON.errors.name[0]);
                            $('#name_error').show();
                            $('#create_form #name').focus();
                        }

                        if(messages.email) {
                            $('#email_error strong').text(data.responseJSON.errors.email[0]);
                            $('#email_error').show();
                            $('#create_form #email').focus();
                        }

                        if(messages.first_name) {
                            $('#first_name_error strong').text(data.responseJSON.errors.first_name[0]);
                            $('#first_name_error').show();
                            $('#create_form #first_name').focus();
                        }

                        if(messages.last_name) {
                            $('#last_name_error strong').text(data.responseJSON.errors.last_name[0]);
                            $('#last_name_error').show();
                            $('#create_form #last_name').focus();
                        }

                        if(messages.password) {
                            $('#password_error strong').text(data.responseJSON.errors.password[0]);
                            $('#password_error').show();
                            $('#create_form #password').focus();
                        }

                        if(messages.phone) {
                            $('#phone_error strong').text(data.responseJSON.errors.phone[0]);
                            $('#phone_error').show();
                            $('#create_form #phone').focus();
                        }
                    }
                }
            });
        });

        $(".btn-edit").click(function(){
            let user_id = $(this).attr("data-value");
            let username = $(this).parents('tr').find(".username").text().trim();
            let email = $(this).parents('tr').find(".email").text().trim();
            let first_name = $(this).parents('tr').find(".first_name").text().trim();
            let last_name = $(this).parents('tr').find(".last_name").text().trim();
            let phone = $(this).parents('tr').find(".phone").text().trim();           
            let birthday = $(this).parents('tr').find(".birthday").text().trim();           

            $("#edit_form input.form-control").val('');
            $("#editModal #edit_id").val(user_id);
            $("#editModal #edit_name").val(username);
            $("#editModal #edit_email").val(email);
            $("#editModal #edit_first_name").val(first_name);
            $("#editModal #edit_last_name").val(last_name);
            $("#editModal #edit_phone").val(phone);
            $("#editModal #edit_birthday").val(birthday);  

            $("#editModal").modal();
        });

        $("#btn_update").click(function(){
            $.ajax({
                url: "{{route('user.edit')}}",
                type: 'post',
                dataType: 'json',
                data: $('#edit_form').serialize(),
                success : function(data) {
                    console.log(data);
                    if(data == 'success') {
                        alert('Updated user successfully.');
                        window.location.reload();
                    }
                    else if(data.message == 'The given data was invalid.') {
                        alert(data.message);
                    }
                },
                error: function(data) {
                    console.log(data.responseJSON);
                    if(data.responseJSON.message == 'The given data was invalid.') {
                        let messages = data.responseJSON.errors;
                        if(messages.name) {
                            $('#edit_name_error strong').text(data.responseJSON.errors.name[0]);
                            $('#edit_name_error').show();
                            $('#edit_form #edit_name').focus();
                        }

                        if(messages.email) {
                            $('#edit_email_error strong').text(data.responseJSON.errors.email[0]);
                            $('#edit_email_error').show();
                            $('#edit_form #edit_email').focus();
                        }

                        if(messages.first_name) {
                            $('#edit_first_name_error strong').text(data.responseJSON.errors.firstname[0]);
                            $('#edit_firstname_error').show();
                            $('#edit_form #edit_firstname').focus();
                        }

                        if(messages.last_name) {
                            $('#edit_last_name_error strong').text(data.responseJSON.errors.lastname[0]);
                            $('#edit_lastname_error').show();
                            $('#edit_form #edit_lastname').focus();
                        }

                        if(messages.password) {
                            $('#edit_password_error strong').text(data.responseJSON.errors.password[0]);
                            $('#edit_password_error').show();
                            $('#edit_form #edit_password').focus();
                        }

                        if(messages.phone) {
                            $('#edit_phone_error strong').text(data.responseJSON.errors.phone[0]);
                            $('#edit_phone_error').show();
                            $('#edit_form #edit_phone').focus();
                        }
                    }
                }
            });
        });

    });
</script>
@endsection