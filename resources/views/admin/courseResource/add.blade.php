@extends('admin.layouts.master')
@section('title')Create Resources | Courses @endsection
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void();"></a>Create Course Resources</li>
                </ol>
            </div>
         
            <div class="col-sm-3">
                <div class="btn-group float-sm-right">
                    <a href="{{route('courseResources.index')}}" class="btn btn-behance text-white btn-sm waves-effect waves-light add_data"><i class="fa fa-list mr-1"></i> Resource List</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div id="messages"></div>
                <div class="card">
                    <div class="card-header"><i class="zmdi zmdi-book"></i> Create Resource</div>
                    <div class="card-body">
                        <form method="post" action="{{route('courseResources.store')}}">
                            @csrf
                            <div class="row">

                              <div class="form-group col-md-6">
                                <label>Select Course*</label>
                                <select style="width: 100%;" name="course_id" class="form-control input-check select2" id="course_id" required="">
                                    @if(!old('course_id'))
                                        <option value="">--Select Course--</option>
                                    @endif
                                    @foreach($course_list as $course)
                                        @if(old('course_id') == $course->id)
                                            <option selected="" value="{{$course->id}}">{{ucwords($course->course_name)}}</option>
                                        @else
                                            <option value="{{$course->id}}">{{ucwords($course->course_name)}}</option>
                                        @endif
                                    @endforeach
                                </select>
                              </div>

                              <div class="form-group col-md-12">
                                <label>Resource*</label>
                                <textarea type="text" class="form-control input-check" name="course_resource" id="summernoteEditor" placeholder="Enter Resource" required="">{{old('course_resource')}}</textarea>
                              </div>

                              <div class="form-group col-md-12">
                                <button type="submit" id="submit_btn" class="btn btn-sm btn-success px-3"><i class="fa fa-arrow-circle-right"></i> Insert</button>
                              </div>
                            </div>
                          </form>
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
            $('.select2').select2();
        });
        $('#summernoteEditor').summernote({
            height: 300,
            tabsize: 1
        });
    </script>

    <script type="text/javascript">
    $(document).ready(function(){      
      
    });
  </script>
@endsection