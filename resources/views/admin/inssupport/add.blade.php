@extends('admin.layouts.master')
@section('title')Create Instructor Support | Courses @endsection
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void();"></a>Create Instructor Support</li>
                </ol>
            </div>
         
            <div class="col-sm-3">
                <div class="btn-group float-sm-right">
                    <a href="{{route('inssupport.index')}}" class="btn btn-behance text-white btn-sm waves-effect waves-light add_data"><i class="fa fa-list mr-1"></i> List</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div id="messages"></div>
                <div class="card">
                    <div class="card-header"><i class="zmdi zmdi-book"></i> Create Instructor Support</div>
                    <div class="card-body">
                        <form method="post" action="{{route('inssupport.store')}}">
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
                                <label>title1*</label>
                                <input type="text" class="form-control input-check" name="title1" placeholder="Enter Title" required="" value="{{old('title1')}}">
                              </div>
                              <div class="form-group col-md-12">
                                <label>Details*</label>
                                <textarea class="form-control input-check" name="details1" placeholder="Enter Text" required="">{{old('details1')}}</textarea>
                              </div>
                              
                              <div class="form-group col-md-12">
                                <label>title2*</label>
                                <input type="text" class="form-control input-check" name="title2" placeholder="Enter Title" required="" value="{{old('title2')}}">
                              </div>
                              <div class="form-group col-md-12">
                                <label>Details*</label>
                                <textarea class="form-control input-check" name="details2" placeholder="Enter Text" required="">{{old('details2')}}</textarea>
                              </div>
                              
                              <div class="form-group col-md-12">
                                <label>title3*</label>
                                <input type="text" class="form-control input-check" name="title3" placeholder="Enter Title" required="" value="{{old('title3')}}">
                              </div>
                              <div class="form-group col-md-12">
                                <label>Details*</label>
                                <textarea class="form-control input-check" name="details3" placeholder="Enter Text" required="">{{old('details3')}}</textarea>
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
    </script>
@endsection