@extends('layouts.dashboard')
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-folder-open"></i>&nbsp;Create New Incident</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fa fa-home fa-lg"></i></a></li>
            <li class="breadcrumb-item"><a href="#">Create New Incident</a></li>
        </ul>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="tile">
                    <h3 class="tile-title">Create New Incident</h3>                    
                    <form action="{{route("incident.create")}}" method="POST">
                        @csrf
                        <div class="tile-body">
                            <div class="form-group">
                                <label class="control-label">User ID</label>
                                <input class="form-control" type="text" name="userid" value="{{Auth::user()->name}}" readonly placeholder="User ID">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Phone Number</label>
                                <input class="form-control" type="text" name="phone" value="{{Auth::user()->phone}}" placeholder="Phone Number">
                            </div>                            
                            <div class="form-group">
                                <label class="control-label">Urgency</label>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="urgency" value="0" checked>Low
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="urgency" value="1">High
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Fault Description</label>
                                <textarea class="form-control" name="description" rows="4" placeholder="Fault Description"></textarea>
                            </div>
                        </div>
                        <div class="tile-footer">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Create</button>&nbsp;&nbsp;&nbsp;
                            <a class="btn btn-secondary" href="#"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                        </div>
                    </form>
                </div>
            </div>            
        </div>
    </div>

@endsection
