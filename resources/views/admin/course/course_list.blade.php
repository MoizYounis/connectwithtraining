@extends('admin.layouts.master')
@section('title')Course List | Courses @endsection
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void();">Course List</a></li>
                </ol>
            </div>
         
            <div class="col-sm-3">
                <div class="btn-group float-sm-right">
                    <a href="{{route('course.create')}}" class="btn btn-behance text-white btn-sm"> <i class="waves-effect waves-light add_data"></i> Create Course </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><i class="zmdi zmdi-book"></i> Course List</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table style="zoom:90%;" id="datatable" class="table table-sm table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Course</th>
                                        <th>User Name</th>
                                        <th>Author Name</th>
                                        <th>Image</th>
                                        <th>Price</th>
                                        <th>Start Date</th>
                                        <th>Timing</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($course_list as $row)
                                        <tr>
                                            <td>{{$row->id}}</td>
                                            <td>
                                                <b>{{ucwords($row->course_name)}}</b><br>
                                                <span style="color:grey;">( {{$row->category_name}} ) </span>
                                            </td>
                                            <td>{{ucfirst($row->first_name.' '.$row->last_name)}}</td>
                                            <td>{{ucfirst($row->author_name)}}</td>
                                            <td><img src="{{asset('public/assets/front/img/course').'/'.$row->course_image}}" height="50" width="50" class="img img-thumbnail" /></td>
                                            <td>{{$row->course_price}}</td>
                                            <td>{{$row->course_start_date}}</td>
                                            <td>{{$row->course_timing}}</td>
                                            <td>
                                                <div class="btn-group m-1" role="group">
                                                    <button type="button" class="btn btn-behance btn-sm text-white waves-effect waves-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Action
                                                    </button>
                                                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 37px, 0px);">
                                                        <a href="{{route('course.edit',[$row->id])}}" class="dropdown-item edit_data"><i class="fa fa-edit mr-1"></i> Edit Data</a>
                                                        <div class="dropdown-divider"></div>

                                                        <form method="post" class="delete_form" action="{{ action('Admin\CourseController@destroy', $row->id) }}">
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