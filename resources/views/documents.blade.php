@extends('layouts.dashboard')
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-folder-open"></i>&nbsp;Assign Department</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Document Management</a></li>
            <li class="breadcrumb-item"><a href="#">Assign Department</a></li>
        </ul>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="btn-group float-right">
                        <a class="btn btn-info btn-sm" href="#" id="btn-assign-selected" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Assign selected documents"><i class="fa fa-lg fa-code-fork"></i></a>
                    </div>
                    <div class="tile-body">
                        @csrf
                        <table class="table table-hover table-bordered text-center" id="documentTable">
                            <thead>
                            <tr>
                                <th class="no-sort animated-checkbox"><label data-toggle="tooltip" data-placement="top" title="" data-original-title="Select All"><input type="checkbox" name="" id="select-all"> <span class="label-text"></span></label></th>
                                <th class="no-sort">No</th>
                                <th>FileName</th>
                                <th>Path</th>
                                <th>Department</th>
                                <th>Date</th>
                                <th class="no-sort">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($documents as $document)
                                    <tr>
                                        <td class="animated-checkbox py-2"><label><input type="checkbox" name="" class="selectdoc" data-value="{{ $document->id }}"> <span class="label-text"></span></label></td>
                                        <td>{{$loop->index+1}}</td>
                                        <td class="title"><?php echo isset($document->title) ? $document->title : "---" ; ?></td>
                                        <td class="path"><?php echo isset($document->path) ? $document->path : "---" ; ?></td>
                                        <td class="department">
                                            @foreach ($document->departments as $item)
                                                {{$item->name}},&nbsp;
                                            @endforeach
                                        </td>
                                        <td>{{$document->created_at}}</td>
                                        <td class="py-2">
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-primary btn-sm btn-assign" data-value="{{$document->id}}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Assign Department"><i class="fa fa-code-fork" style="font-size:18px"></i></a>
                                                <a href="#" class="btn btn-info btn-sm btn-preview" data-value="{{$document->path}}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Preview"><i class="fa fa-file-pdf-o" style="font-size:18px"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach                 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>            
        </div>
    </div>

    <div class="modal fade" id="departmentModal">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <h4 class="modal-title">Assign Department</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <form action="/assurance/documentassigndepartment" method="post">
                    @csrf
                    <input type="hidden" name="document_id" id="document_id" />
                    <input type="hidden" name="selecteddocs" id="selecteddocs" />
                    <div class="modal-body animated-checkbox">
                        <div class="modal-body animated-checkbox">
                            @foreach ($all_departments as $item)
                                <label><input type="checkbox" name="department[]" id="department{{ $item->id }}" value="{{$item->id}}"> <span class="label-text">{{ $item->name }}</span></label>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-lg fa-check-circle"></i>&nbsp;Assign</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>&nbsp;Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="previewModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">                
                <div class="modal-header">
                    <h4 class="modal-title">Preview Document</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body animated-checkbox">
                    <input type="hidden" value="{{asset("/")}}" id="public_path">
                    <iframe src="" id="pdf_preview" style="width:100%; height:75vh;" frameborder="0"></iframe>
                </div>
                
                <div class="modal-footer">                        
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>&nbsp;Close</button>
                </div>                   
            </div>
        </div>
    </div>

@endsection
@section('script')
    <!-- Data table plugin-->
    <script type="text/javascript" src="{{ asset('master/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('master/js/plugins/dataTables.bootstrap.min.js') }}"></script>

    <script>
        $(document).ready(function(){
            var public_path = $("#public_path").val();
            var documenttable = $('#documentTable').DataTable({
                                    "aaSorting": [],
                                    "columnDefs": [{
                                        "targets": 'no-sort',
                                        "orderable": false,
                                    }]
                                });
            assign_event();
            preview_event();
            documenttable.on("draw", function(){
                assign_event();
                preview_event();
            });
            function assign_event(){                
                $(".btn-assign").click(function(){
                    let document_id = $(this).attr("data-value");
                    $("#departmentModal #document_id").val(document_id);
                    $.ajax({
                        url: "/assurance/getdocumentsdepartment",
                        data: {document_id:document_id},
                        type: "get",
                        cache: false,
                        dataType: "json",
                        success: function(data){
                            
                            $("#departmentModal [type='checkbox']").attr("checked", false);
                            for (let i = 0; i < data.length; i++) {
                                const element = data[i];
                                $("#departmentModal #department" + element).attr("checked", true);
                            }
                            $("#departmentModal form").attr("action", "/assurance/documentassigndepartment");
                            $("#departmentModal").modal();
                        }
                    });
                });
            }

            $("#select-all").change(function(){
                if(this.checked){
                    $(".selectdoc").attr("checked", true);
                }else{
                    $(".selectdoc").attr("checked", false);
                }
            })

            $("#btn-assign-selected").click(function(){
                let self = $(this);
                let selected_docs = [];
                let _token = $("input[name='_token']").val();
                $(".selectdoc:checked").each(function(){
                    selected_docs.push($(this).attr("data-value"));
                });
                
                selected_docs_string = selected_docs.toString();
                $("#departmentModal form").attr("action", "/assurance/assignselecteddocs");
                $("#departmentModal #selecteddocs").val(selected_docs_string);
                $("#departmentModal form input[type='checkbox']").attr("checked", false);
                $("#departmentModal").modal();
            });
            function preview_event(){
                $("#documentTable .btn-preview").click(function(){
                    var path = $(this).data("value");
                    $("#pdf_preview").attr("src", public_path + path);
                    $("#previewModal").modal();
                });
            }
        });
    </script>
@endsection