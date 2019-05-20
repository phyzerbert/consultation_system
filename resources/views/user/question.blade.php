@extends('layouts.dashboard')
@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-users"></i>&nbsp;User Questions</h1>
        <!-- <p>A free and open source Bootstrap 4 admin template</p> -->
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fa fa-home fa-lg"></i></a></li>
        <li class="breadcrumb-item"><a href="#">My Questions</a></li>
    </ul>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="col-md-12">
                    <form action="" method="POST" class="form-inline">
                        @csrf 
                        <label class="control-label mr-sm-2 mb-2" for="period">Type Of Issue: </label>
                        <select class="form-control form-control-sm mr-sm-3 mb-2" name="category_id" id="search_category">
                            <option value="">Select a type of issue</option>
                            @foreach ($categories as $item)
                                <option value="{{$item->id}}" @if ($category_id == $item->id) selected @endif>{{$item->name}}</option>
                            @endforeach
                        </select>
                        <label class="control-label mr-sm-2 mb-2" for="period">Consultant: </label>
                        <select class="form-control form-control-sm mr-sm-3 mb-2" name="consultant_id" id="search_consultant">
                            <option value="">Select a consultant</option>
                            @foreach ($consultants as $item)
                                <option value="{{$item->id}}" @if ($consultant_id == $item->id) selected @endif>{{$item->name}}</option>
                            @endforeach
                        </select>
                        <label class="control-label mr-sm-2 mb-2" for="period">Status: </label>
                        <select class="form-control form-control-sm mr-sm-3 mb-2" name="status" id="search_status">
                            <option value="">Select a Status</option>
                            <option value="0" @if ($status == '0') selected @endif>Pending</option>
                            <option value="1" @if ($status == '1') selected @endif>Answered</option>
                            <option value="2" @if ($status == '2') selected @endif>Closed</option>                            
                        </select>
                        <label class="control-label mr-sm-2 mb-2" for="period">Requested Time: </label>
                        <input type="text" class="form-control form-control-sm col-md-2 mr-sm-2 mb-2" name="period" id="period" autocomplete="off" value="{{$period}}">
                        <button type="submit" class="btn btn-sm btn-primary mb-2"><i class="fa fa-search"></i>&nbsp;Search</button>
                        <button type="button" class="btn btn-sm btn-info mb-2 ml-3" id="btn-reset"><i class="fa fa-eraser"></i>&nbsp;Reset</button>
                    </form>
                </div>
                <div class="tile-body mt-3">
                    <table class="table table-hover table-bordered text-center">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>UserID</th>
                                <th>Type of Issue</th>
                                <th>Subject</th>
                                <th>Consultant</th>
                                <th>Status</th>
                                <th>Requested Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>    
                        <tbody>
                            @foreach($data as $item)
                            <tr>
                                <input type="hidden" class="description" value="{{$item->description}}">
                                <input type="hidden" class="answer" value="{{$item->answer}}">
                                <input type="hidden" class="attachment" data-value="{{basename($item->file_path)}}" value="{{$item->file_path}}">
                                <td>{{ ($page_number-1) * 10 + $loop->index+1 }}</td>
                                <td class="user_id">{{$item->user->name}}</td>
                                <td class="category">{{$item->category->name}}</td>
                                <td class="subject">{{$item->subject}}</td>
                                <td class="consultant">@isset($item->consultant->name) {{$item->consultant->name}} @endisset</td>
                                <td class="status">
                                    @if ($item->status == 2)
                                        Closed
                                    @elseif($item->status == 1)
                                        Answered
                                    @else
                                        Pending
                                    @endif
                                </td>
                                <td class="timestamp">{{$item->created_at}}</td>
                                <td class="action py-2">
                                    <a href="#" class="btn btn-info btn-sm btn-view" data-id="{{$item->id}}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="View"><i class="fa fa-info-circle" style="font-size:20px"></i>View</a>
                                    {{-- <a href="#" class="btn btn-primary btn-sm btn-edit" data-id="{{$item->id}}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit"><i class="fa fa-edit" style="font-size:20px"></i>Edit</a> --}}
                                    <a href="{{route('question.close', $item->id)}}" class="btn btn-success btn-sm btn-close" onclick="return confirm('Are you sure?');" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Close"><i class="fa fa-times-circle" style="font-size:20px"></i>Close</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="clearfix">
                        <div class="pull-left" style="margin: 0;">
                            <p>Total <strong style="color: red">{{ $data->total() }}</strong> Items</p>
                        </div>
                        <div class="pull-right" style="margin: 0;">
                            {!! $data->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="viewModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Question Detail</h4>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
                <div class="modal-body p-5">
                    <div class="row mb-2">
                        <label class="col-sm-3 text-right">Subject :</label>
                        <label class="col-sm-9 subject"></label>
                    </div>
                    <div class="row mb-2">
                        <label class="col-sm-3 text-right">Type Of Issue :</label>
                        <label class="col-sm-9 category"></label>
                    </div>
                    <div class="row mb-2">
                        <label class="col-sm-3 text-right">Description :</label>
                        <pre class="col-sm-9 description"></pre>
                    </div>
                    
                    <div class="row mb-2">
                        <label class="col-sm-3 text-right">Attachment :</label>
                        <div class="col-sm-9 attachment"><a href="" download></a></div>
                    </div>
                    <div class="row mb-2">
                        <label class="col-sm-3 text-right">Status :</label>
                        <label class="col-sm-9 status"></label>
                    </div>
                    <div class="row mb-2">
                        <label class="col-sm-3 text-right">Consultant :</label>
                        <label class="col-sm-9 consultant"></label>
                    </div>                    
                    <div class="row mb-2">
                        <label class="col-sm-3 text-right">Answer :</label>
                        <pre class="col-sm-9 answer"></pre>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('script')

<script>
    $(document).ready(function () {
        var public_path = "{{asset('')}}";
        $(".btn-view").click(function(){
            let id = $(this).data('id');
            let category = $(this).parents('tr').find(".category").text();
            let subject = $(this).parents('tr').find(".subject").text();
            let consultant = $(this).parents('tr').find(".consultant").text();
            let status = $(this).parents('tr').find(".status").text();
            let description = $(this).parents('tr').find(".description").val().trim();
            let answer = $(this).parents('tr').find(".answer").val().trim();
            let attachment = $(this).parents('tr').find(".attachment").val().trim();
            let filename = $(this).parents('tr').find(".attachment").data('value');
            $("#viewModal .field").text('');
            $("#viewModal .category").text(category);
            $("#viewModal .subject").text(subject);
            $("#viewModal .consultant").text(consultant);
            $("#viewModal .status").text(status);
            $("#viewModal .description").text(description);
            $("#viewModal .answer").text(answer);
            $("#viewModal .attachment a").attr("href", public_path + attachment);
            $("#viewModal .attachment a").text(filename);            
            $("#viewModal").modal();
        });

        
        $("#btn-reset").click(function(){
            $("#search_category").val('');
            $("#search_consultant").val('');
            $("#search_status").val('');
            $("#period").val('');
        });
    });
</script>
@endsection