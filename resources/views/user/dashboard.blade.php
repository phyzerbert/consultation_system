@extends('layouts.dashboard')
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-folder-open"></i>&nbsp;Get a Consultant</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fa fa-home fa-lg"></i></a></li>
            <li class="breadcrumb-item"><a href="#">Get a Consultant</a></li>
        </ul>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="tile">
                    <h3 class="tile-title">Get a Consultant</h3>                    
                    <form action="{{route("question.create")}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        <div class="tile-body">
                            <div class="form-group">
                                <label class="control-label">Type of Issue</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="">Select a type of issue</option>
                                    @foreach ($categories as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Subject</label>
                                <input class="form-control" type="text" name="subject" id="subject" placeholder="Subject">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Query Description</label>
                                <textarea class="form-control" name="description" rows="4" id="description" placeholder="Description"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Attachment</label>
                                <input class="form-control" type="file" name="file_path">
                            </div>
                        </div>
                        <div class="tile-footer" style="height: 60px;">
                            <div class="float-right">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>
                                <a class="btn btn-secondary" id="btn-reset" href="#"><i class="fa fa-fw fa-lg fa-times-circle"></i>Reset</a>
                            </div>                            
                        </div>
                    </form>
                </div>
            </div>            
        </div>
    </div>

@endsection

@section('script')
<script>
    $(function(){
        $("#btn-reset").click(function(){
            $("#category_id").val('');
            $("#subject").val('');
            $("#description").val('');
            $("#file_path").val('');
        });
    })
</script>
@endsection
