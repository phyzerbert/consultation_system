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
                <h3 class="tile-title pl-5">Subject: {{$question->subject}}</h3>
                <div class="tile-body mt-3">
                    <div class="row px-5">
                        <div class="col-md-6">                         
                            <h5>User :  <span class="text-primary"> {{$question->user->first_name}}, {{$question->user->last_name}}</span></h5>
                            <h5>Consultant :   <span class="text-primary"> {{$question->consultant->first_name}}, {{$question->consultant->last_name}}</span></h5>
                            <h5>Type Of Issue : <span class="text-primary"> {{$question->category->name}}</span></h5>
                            <h5>Query Description :</h5>
                            <p class="ml-5" style="font-size:18px;">{{$question->description}}</p>                           
                        </div>
                        <div class="col-md-6">
                            @isset($question->attachment->path)
                            @php
                                $path = $question->attachment->path;
                                $filename = basename($question->attachment->path);
                                $extension = pathinfo($question->attachment->path, PATHINFO_EXTENSION);
                                $image_array = array('jpg', 'png', 'jpeg');
                                $doc_array = array('doc', 'pptx', 'docx');
                                $audio_array = array('mp3', 'wav', 'ogg');
                                $video_array = array('avi', 'mp4', 'mpg');                                
                            @endphp
                            <h5>Attachment :</h5>
                            <div class="pl-5">
                                @if (in_array($extension, $image_array))
                                    <img width="120" src="{{asset($path)}}" alt="" />
                                @elseif(in_array($extension, $doc_array))
                                    <a href="{{asset($path)}}" download><img width="120" src="{{asset('images/word.png')}}" alt="" /></a>
                                @elseif(in_array($extension, $audio_array))
                                    <audio style="width:300px;height:40px;" controls><source src="{{asset($path)}}"></audio>
                                @elseif(in_array($extension, $video_array))
                                    <video width="160" height="120" controls><source src="{{asset($path)}}"></video>
                                @else
                                    <a href="{{asset($path)}}" download>{{$filename}}</a>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="p-5">
                        @php
                            $image_array = array('jpg', 'png', 'jpeg');
                            $doc_array = array('doc', 'pptx', 'docx');
                            $audio_array = array('mp3', 'wav', 'ogg');
                            $video_array = array('avi', 'mp4', 'mpg');                                
                        @endphp
                        <div class="messanger border border-primary border-bottom-0 rounded">
                            <div class="messages" id="msgbox" style="min-height: 40vh">
                                @foreach ($responses as $item)
                                    @php
                                        $me = $item->user->role->name == Auth::user()->role->name;                       
                                    @endphp
                                    <div class="message @if($me) me @endif">
                                        <img src="@if($item->user->picture != null){{asset($item->user->picture)}} @else {{asset('images/avatar.png')}} @endif" width="40">
                                        <p class="info">
                                            {{$item->response_text}}
                                            @isset($item->attachment->path)
                                                @php
                                                    $path = $item->attachment->path;
                                                    $filename = basename($item->attachment->path);
                                                    $extension = pathinfo($item->attachment->path, PATHINFO_EXTENSION);                               
                                                @endphp
                                                <br>
                                                    @if (in_array($extension, $image_array))
                                                        <img width="50" style="border-radius:0px;" src="{{asset($path)}}" alt="" />
                                                    @elseif(in_array($extension, $doc_array))
                                                        <a href="{{asset($path)}}" download><img width="50" style="border-radius:0px;" src="{{asset('images/word.png')}}" alt="" /></a>
                                                    @elseif(in_array($extension, $audio_array))
                                                        <audio style="width:200px;height:30px;" controls><source src="{{asset($path)}}"></audio>
                                                    @elseif(in_array($extension, $video_array))
                                                        <video width="160" height="120" controls><source src="{{asset($path)}}"></video>
                                                    @else
                                                        <a href="{{asset($path)}}" download>{{$filename}}</a>
                                                    @endif
                                                    {{-- <br> --}}
                                                    {{-- <a href="{{asset($item->attachment->path)}}" download="" class="@if($me) text-light @else text-dark @endif"><i class="fa fa-fw fa-paperclip"></i>{{basename($item->attachment->path)}}</a> --}}
                                            @endisset
                                        </p>
                                    </div>                                   
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