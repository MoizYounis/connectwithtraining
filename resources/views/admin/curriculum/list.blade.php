@extends('admin.layouts.master')
@section('title')Curriculum List | Curriculum @endsection
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void();">Curriculum List</a></li>
                </ol>
            </div>
         
            <div class="col-sm-3">
                <div class="btn-group float-sm-right">
                    <a href="{{route('curriculum.create')}}" class="btn btn-behance text-white btn-sm"> <i class="waves-effect waves-light add_data"></i> Create Curriculum </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div id="messages"></div>
                <div class="card">
                    <div class="card-header"><i class="zmdi zmdi-book"></i> Curriculum List</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table style="zoom:90%;" id="datatable" class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Course Name</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($curr_list as $row)
                                        <tr>
                                            <td>{{$row->id}}</td>
                                            <td>{{ucwords($row->course_name)}}</td>
                                            <td>{{ucwords($row->curr_title)}}</td>
                                            <td>{{$row->curr_status}}</td>
                                            <td>
                                                <div class="btn-group m-1" role="group">
                                                    <button type="button" class="btn btn-behance btn-sm text-white waves-effect waves-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Action
                                                    </button>
                                                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 37px, 0px);">
                                                        <a href="{{route('curriculum.edit',[$row->id])}}" class="dropdown-item edit_data"><i class="fa fa-edit mr-1"></i> Edit Data</a>
                                                        <div class="dropdown-divider"></div>

                                                        <form method="post" class="delete_form" action="{{ action('Admin\CurriculumController@destroy', $row->id) }}">
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
    $(document).ready(function(){
        $("#course").addClass("active");
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