@extends('admin.layouts.master')
@section('title')Update Curriculum Course | Curriculum @endsection
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void();"></a>Update Curriculum</li>
                </ol>
            </div>
         
            <div class="col-sm-3">
                <div class="btn-group float-sm-right">
                    <a href="{{route('curriculum.index')}}" class="btn btn-behance text-white btn-sm waves-effect waves-light add_data"><i class="fa fa-plus mr-1"></i> List</a>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <div id="messages"></div>
                <div class="card">
                    <div class="card-header"><i class="zmdi zmdi-book"></i> Update Curriculum</div>
                    <div class="card-body">
                        <form method="post" action="{{route('curriculum.update', $curr_edit->id)}}">
                            @csrf {{ method_field('PATCH') }}
                            <div class="row">

                              <div class="form-group col-md-6">
                                <label>Select Course*</label>
                                <select style="width: 100%;" name="course_id" class="form-control input-check select2" id="course_id" required="">
                                    <option value="">--Select Course--</option>
                                    @foreach($course_list as $course)
                                        @if($curr_edit->course_id == $course->id)
                                            <option selected="" value="{{$course->id}}">{{ucwords($course->course_name)}}</option>
                                        @else
                                            <option value="{{$course->id}}">{{ucwords($course->course_name)}}</option>
                                        @endif
                                    @endforeach
                                </select>
                              </div>

                              <div class="form-group col-md-6">
                                <label>Curriculum Title*</label>
                                <input class="form-control input-check" name="curr_title" id="curr_title" placeholder="Enter Title" required="" value="{{$curr_edit->curr_title}}" />
                              </div>

                              <div class="form-group col-md-12">
                                <label>Curriculum Description</label>
                                <textarea class="form-control input-check" name="curr_desc" id="summernoteEditor" placeholder="Enter Description" required="" rows="5">{{$curr_edit->curr_desc}}</textarea>
                              </div>

                              <div class="form-group col-md-4">
                                <label>Curriculum File Link</label>
                                <input class="form-control input-check" name="curr_file_link" id="curr_file_link" placeholder="Enter Link" value="{{$curr_edit->curr_file_link}}" />
                              </div>

                              <div class="form-group col-md-4">
                                <label>Curriculum Type</label>
                                <input class="form-control input-check" name="curr_type" id="curr_type" placeholder="Enter Type" value="{{$curr_edit->curr_type}}" />
                              </div>

                              <div class="form-group col-md-4">
                                <label> Status</label>
                                <div class="icheck-material-primary">
                                    <input type="checkbox" name="curr_status" id="user-checkbox5" 
                                    @if($curr_edit->curr_status == 'Active') checked="" @else @endif
                                    />
                                    <label for="user-checkbox5">Active / Inactive</label>
                                </div>
                              </div>

                              <div class="form-group col-md-12">
                                <button type="submit" id="submit_btn" class="btn btn-sm btn-success px-3"><i class="fa fa-arrow-circle-right"></i> Update</button>
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
            $('#summernoteEditor').summernote({
                height: 300,
                tabsize: 1
            });
            
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