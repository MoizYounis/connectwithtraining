@extends('admin.layouts.master')
@section('title')Faq List | Faq @endsection
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void();">Faq</a></li>
                </ol>
            </div>
         
            <div class="col-sm-3">
                <div class="btn-group float-sm-right">
                    <a href="{{route('faq.create')}}" class="btn btn-behance text-white btn-sm waves-effect waves-light add_data"><i class="fa fa-plus mr-1"></i> Add Faq</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div id="messages"></div>
                <div class="card">
                    <div class="card-header"><i class="zmdi zmdi-help-outline"></i> Faq</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-sm table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>Sno.</th>                        
                                        <th>Course Name</th>
                                        <th>Ques & Ans</th>
                                        <th>File</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($faq_list as $row)
                                        <tr>
                                            <td>{{$row->id}}</td>
                                            <td>{{ucwords($row->course_name)}}</td>

                                            <td><button class="btn btn-behance btn-sm btn-round text-white" data-toggle="modal" data-target="#load{{$row->id}}">Load</button></td>

                                            <div class="modal fade" id="load{{$row->id}}" data-backdrop="static">
                                              <div class="modal-dialog modal-dialog-scrollable modal-md">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h5 class="modal-title modal_title_creat_update">Question Answer</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body" style="overflow-x: hidden;white-space: normal;">
                                                      <p><strong>Ques. {{ucwords($row->question)}} ?</strong></p>
                                                      <p><strong>Ans.</strong> {{ucwords($row->answer)}}.</p>
                                                    </div>
                                                </div>
                                              </div>
                                            </div>

                                            <td>
                                              @if($row->faq_filetype == "Image")
                                                <a href="{{asset('public/assets/front/img/faq')}}/{{$row->faq_file}}" target="_blank"><img src="{{asset('public/assets/front/img/faq')}}/{{$row->faq_file}}" class="img img-thumbnail" height="50" width="50"></a>
                                              @elseif($row->faq_filetype == "Video")
                                                <a href="{{route('faq.show', $row->id)}}" target="_blank">Play Video</a>
                                              @elseif($row->faq_filetype == "PDF")
                                                <a href="{{route('faq.show', $row->id)}}">View PDF</a>
                                              @else

                                              @endif
                                            </td>
                                            
                                            <td>
                                                <div class="btn-group m-1" role="group">
                                                    <button type="button" class="btn btn-behance btn-sm text-white waves-effect waves-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Action
                                                    </button>
                                                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 37px, 0px);">
                                                        <a href="{{route('faq.edit',[$row->id])}}" class="dropdown-item edit_data"><i class="fa fa-edit mr-1"></i> Edit Data</a>
                                                        <div class="dropdown-divider"></div>

                                                        <form method="post" class="delete_form" action="{{ action('Admin\FaqController@destroy', $row->id) }}">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="_method" value="Delete">
                                                            <button type="submit" class="dropdown-item delete_data"><i class="fa fa-trash mr-1"></i> Delete</button>
                                                        </form>    
                                                    </div>
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
        </div><!-- End Row-->
    </div>
    <!-- End container-fluid-->
</div><!--End content-wrapper-->
@endsection
@section('script')
    <script type="text/javascript">
        $("#course").addClass("active");
        $(document).ready(function () {
            $('#datatable').DataTable({ order: [[0, 'desc']] });

            $('.delete_form').on('submit', function(){
                if(confirm("Are you sure you want to delete it..?")){
                    return true;
                }
                else{
                  return false;
                }
            });
        });
    </script>
@endsection