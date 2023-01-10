@extends('admin.layouts.master')
@section('title')Update About Course | Course @endsection
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void();"></a>Update About Course</li>
                </ol>
            </div>
         
            <div class="col-sm-3">
                <div class="btn-group float-sm-right">
                    <a href="{{route('aboutCourse.index')}}" class="btn btn-behance text-white btn-sm waves-effect waves-light add_data"><i class="fa fa-plus mr-1"></i> List</a>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <div id="messages"></div>
                <div class="card">
                    <div class="card-header"><i class="zmdi zmdi-book"></i> Update About Course</div>
                    <div class="card-body">
                        <form method="post" action="{{route('aboutCourse.update', $about_edit->id)}}">
                            @csrf {{ method_field('PATCH') }}
                            <div class="row">

                              <div class="form-group col-md-12">
                                <label>Select Course*</label>
                                <select style="width: 100%;" name="course_id" class="form-control input-check select2" id="course_id" required="">
                                    <option value="">--Select Course--</option>
                                    @foreach($course_list as $course)
                                        @if($about_edit->course_id == $course->id)
                                            <option selected="" value="{{$course->id}}">{{ucwords($course->course_name)}}</option>
                                        @else
                                            <option value="{{$course->id}}">{{ucwords($course->course_name)}}</option>
                                        @endif
                                    @endforeach
                                </select>
                              </div>

                              <div class="form-group col-md-12">
                                <label>Course Details*</label>
                                <textarea class="form-control input-check" name="course_details" id="course_details" placeholder="Enter Details" required="" rows="5">{{$about_edit->course_details}}</textarea>
                              </div>

                              <div class="form-group col-md-12">
                                <label>Course Goals</label>
                                <textarea id="summernoteEditor" name="course_goals">{{$about_edit->course_goals}}</textarea>
                              </div>
                              
                              <div class="form-group col-md-12">
                                <label>Course Difference</label>
                                <textarea class="form-control input-check" name="course_diff" id="course_diff" placeholder="Enter Difference" rows="5">{{$about_edit->course_diff}}</textarea>
                              </div>
                              
                              <div class="form-group col-md-12">
                                <label>Project Management Pointers Description</label>
                                <textarea class="form-control input-check" name="pmp_desc" id="v" placeholder="Project Management Pointers Description" rows="5">{{$about_edit->pmp_desc}}</textarea>
                              </div>
                            </div>
                            
                            <?php
                               $pointer_title = explode(',', $about_edit->pointer_title);
                               $pointer_desc = explode(',', $about_edit->pointer_desc);
                               $i=0;
                            ?>
                            
                            @while($i < count($pointer_title))
                                <div class="row" id="inputFormRow">
                                    <div class="col-md-6">
                                        <label>Pointer Title</label>
                                        <textarea class="form-control input-check" name="pointer_title[]" id="pointer_title" placeholder="Pointer Title">{{$pointer_title[$i]}}</textarea>
                                    </div>
    
                                    <div class="col-md-6">
                                        <label>Pointer Description</label>
                                        <textarea class="form-control input-check" name="pointer_desc[]" id="pointer_desc" placeholder="Pointer Description">{{$pointer_desc[$i]}}</textarea>
                                    </div>
                                </div>
                                @php $i++; @endphp
                            @endwhile
                            
                            <div id="newRow" style="flex: 0 0 100%;max-width: 100%;"></div>
                            
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <button type="button" id="addRow" class="btn btn-sm btn-primary px-3"><i class="fa fa-plus"></i> Add Pointer Title & Description</button>
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
            $('.select2').select2();
            $('#summernoteEditor').summernote({
                height: 300,
                tabsize: 1
            });
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
        $("#addRow").on('click', function(){
            let html = '';
            html += '<div class="row" id="inputFormRow">';
            html += '<div class="col-md-6">';
            html += '<label>Pointer Title</label>';
            html += '<textarea class="form-control input-check" name="pointer_title[]" id="pointer_title" placeholder="Pointer Title">{{old('pointer_title')}}</textarea>';
            html += '</div>';

            html += '<div class="col-md-6">';
            html += '<label>Pointer Description</label>';
            html += '<textarea class="form-control input-check" name="pointer_desc[]" id="pointer_desc" placeholder="Pointer Description">{{old('pointer_desc')}}</textarea>';
            html += '<br><button type="button" class="btn btn-sm btn-danger px-3 removeRow"><i class="fa fa-minus"></i> Remove Field</button>';
            html += '</div></div>';

            $("#newRow").append(html);
            if($("#newRow").html() != ''){
                $(".removeRow").show();                
            }
        });

        $(document).on('click', '.removeRow', function(){
            $(this).closest("#inputFormRow").remove();
        });
    });
  </script>
@endsection