@extends('admin.layouts.master')
@section('title')Create Faq | Faq @endsection
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
                    <a href="{{route('faq.index')}}" class="btn btn-behance text-white btn-sm waves-effect waves-light add_data"><i class="fa fa-list mr-1"></i> Faq List</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div id="messages"></div>
                <div class="card">
                    <div class="card-header"><i class="zmdi zmdi-view-dashboard"></i> Faq</div>
                    <div class="card-body">
                        <form method="post" action="{{route('faq.store')}}" enctype="multipart/form-data">
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
                                <label>Faq Type</label>
                                <input type="text" name="faq_type" value="{{old('faq_type')}}" placeholder="Enter Type" class="form-control input-check">
                              </div>


                              <div class="form-group col-md-12">
                                <label>Question*</label>
                                <input type="text" name="question" value="{{old('question')}}" placeholder="Enter Question" class="form-control input-check" required="">
                              </div>

                              <div class="form-group col-md-12">
                                <label>Answer*</label>
                                <textarea name="answer" placeholder="Enter Answer" class="form-control input-check" required="">{{old('answer')}}</textarea>
                              </div>

                              <div class="form-group col-md-6">
                                <label>File Type</label>
                                <select class="form-control" name="faq_filetype">
                                  <option value="">Select File Type</option>
                                  <option value="Image">Image</option>
                                  <option value="Video">Video</option>
                                  <option value="PDF">PDF</option>
                                </select>
                              </div>                              

                              <div class="form-group col-md-6">
                                <div class="">
                                  <label for="exampleInputBanner">File</label>
                                    <div class="input-group">
                                      <div class="custom-file">
                                        <input type="file" class="custom-file-input form-control" name="faq_file">
                                        <label class="custom-file-label" for="file">File</label>
                                      </div>
                                    </div>
                                </div>
                                <div style="margin-top: 10px;" id="image_file">
                                  <!-- <input type="hidden" name="brand_banner" id="brand_banner" value="" required/> -->
                                </div>
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
    </script>
@endsection