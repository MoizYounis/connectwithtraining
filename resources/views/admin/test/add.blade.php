@extends('admin.layouts.master')
@section('title')Create Test | Test @endsection
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void();"></a>Create Test</li>
                </ol>
            </div>
         
            <div class="col-sm-3">
                <div class="btn-group float-sm-right">
                    <a href="{{route('test.index')}}" class="btn btn-behance text-white btn-sm waves-effect waves-light add_data"><i class="fa fa-plus mr-1"></i> Test List</a>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <div id="messages"></div>
                <div class="card">
                    <div class="card-header"><i class="zmdi zmdi-edit"></i> Create Test</div>
                    <div class="card-body">
                        <form method="post" action="{{route('test.store')}}">
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

                              <div class="form-group col-md-6">
                                <label>Test Title*</label>
                                <input type="text" class="form-control input-check" name="test_title" id="test_title" placeholder="Enter Test Title" required="" value="{{old('test_title')}}" />
                              </div>

                              <div class="form-group col-md-12">
                                <label>Test Description*</label>
                                <textarea class="form-control input-check" name="test_desc" id="test_desc" placeholder="Enter Test Description" required="" rows="3">{{old('test_desc')}}</textarea>
                              </div>

                              <div class="form-group col-md-12">
                                <label>Test Process*</label>
                                <textarea class="form-control input-check" name="test_process" id="assign_desc" placeholder="Enter Test Process" required="" rows="3">{{old('test_process')}}</textarea>
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
        $("#test").addClass("active");
        $(document).ready(function () {
            $('.select2').select2();
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

    <script type="text/javascript">
    $(document).ready(function(){      
      
    });
  </script>
@endsection