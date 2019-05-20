@extends('layouts.dashboard')
@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-users"></i>&nbsp;Consultant Dashboard</h1>
        <!-- <p>A free and open source Bootstrap 4 admin template</p> -->
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fa fa-home fa-lg"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Consultant Dashboard</a></li>
    </ul>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Subject: {{$question->subject}}</h3>
                <div class="tile-body mt-3">
                    <h5>User : {{$question->user->first_name}}, {{$question->user->last_name}}</h5>
                    <h5>Type Of Issue : {{$question->category->name}}</h5>
                    <h5>Query Description :</h5>
                    <p class="ml-5">{{$question->description}}</p>
                    <br><br>
                    <div class="messanger p-5">
                        <div class="messages" id="msgbox">
                            @foreach ($responses as $item)
                                @if ($item->user->role->name == Auth::user()->role->name)                               
                                    <div class="message me">
                                        <img src="@if($item->user->picture != null){{asset($item->user->picture)}} @else {{asset('images/avatar.png')}} @endif" width="40">
                                        <p class="info">
                                            {{$item->response_text}}
                                            @isset($item->attachment->path)
                                                <br><a href="{{asset($item->attachment->path)}}" download="" class="text-light"><i class="fa fa-fw fa-paperclip"></i>{{basename($item->attachment->path)}}</a>
                                            @endisset
                                        </p>
                                    </div>
                                @else 
                                    <div class="message">
                                        <img src="@if($item->user->picture != null){{asset($item->user->picture)}} @else {{asset('images/avatar.png')}} @endif" width="40">
                                        <p class="info">
                                            {{$item->response_text}}
                                            @isset($item->attachment->path)
                                                <br><a href="{{asset($item->attachment->path)}}" download="" class="text-dark"><i class="fa fa-fw fa-paperclip"></i>{{basename($item->attachment->path)}}</a>
                                            @endisset
                                        </p>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <form action="{{route('question.reply')}}" method="post" enctype="multipart/form-data">
                            <div class="sender">  
                                @csrf                          
                                <input type="hidden" name="question_id" value="{{$question->id}}">
                                <input type="text" name="response_text" autocomplete="off" placeholder="Type a response text" />
                                <input type="file" name="file_path" id="attachment" style="display:none" />
                                <label class="btn btn-success" for="attachment" style="margin-bottom:0; border-radius:0"><i class="fa fa-lg fa-fw fa-paperclip"></i></label>
                                <button class="btn btn-primary" type="submit"><i class="fa fa-lg fa-fw fa-paper-plane"></i></button>                            
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@section('script')
<script>
    var elmnt = document.getElementById("msgbox");
    var elmnt1 = document.getElementById("msgbox");
    var temp_height = elmnt.scrollHeight;
    elmnt1.scrollTop = temp_height;
</script>
@endsection