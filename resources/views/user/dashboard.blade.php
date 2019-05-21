@extends('layouts.dashboard')
@section('content')
    <style>
        .progress {
            display: none;
        }

        .progress-bar {
            width: 0%;
            height: 16px;
            border-radius: 4px;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
        }        

        #outputImage {
            display: none;
        }

        #outputImage img {
            max-width: 200px;
        }
    </style>
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
                    <form action="{{route("question.create")}}" method="POST" id="questionForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        <div class="tile-body">
                            <div class="form-group">
                                <label class="control-label">Type of Issue</label>
                                <select name="category_id" id="category_id" class="form-control" required>
                                    <option value="">Select a type of issue</option>
                                    @foreach ($categories as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Subject</label>
                                <input class="form-control" type="text" name="subject" id="subject" placeholder="Subject" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Query Description</label>
                                <textarea class="form-control" name="description" rows="4" id="description" placeholder="Description" re></textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Attachment</label>
                                <input class="form-control" type="file" name="file_path" id="attachment">                                
                            </div>
                            <div class="progress mb-1" id="progressDivId">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" id='progress-bar' role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                            </div>
                            <div id='outputImage' class="text-center"></div>
                        </div>
                        <div class="tile-footer" style="height: 60px;">
                            <div class="float-right">
                                <button class="btn btn-primary" id="btn-submit" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>
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
<script src="{{asset('main/js/plugins/jquery.form.min.js')}}"></script>
<script>
    $(function(){
        $('#questionForm').submit(function(e) {	
            let percent = 0;
            if($('#attachment').val()) {
                e.preventDefault();
                $(this).ajaxSubmit({ 
                    // target:   '#targetLayer', 
                    beforeSubmit: function() {
                        $("#progress-bar").width('0%');
                        $("#progressDivId").show();
                    },
                    uploadProgress: function (event, position, total, percentComplete){	
                        $("#progress-bar").width(percentComplete + '%');
                        $("#progress-bar").html('<div id="progress-status">' + percentComplete +' %</div>')
                        percent = percentComplete;
                    },
                    success:function (){
                        alert("Requested Successfully");
                        $("#progress-bar").width('100%');
                        window.location.reload(true);
                        $('#loader-icon').hide();
                    },
                    resetForm: true 
                }); 
                return false; 
            }
        });
        
        $("#btn-reset").click(function(){
            $("#category_id").val('');
            $("#subject").val('');
            $("#description").val('');
            $("#file_path").val('');
        });
    })
</script>
@endsection
