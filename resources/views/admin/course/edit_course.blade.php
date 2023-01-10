@extends('admin.layouts.master')
@section('title')Update Course | Courses @endsection
@section('content')

<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void();">Update Course</a></li>
                </ol>
            </div>
         
            <div class="col-sm-3">
                <div class="btn-group float-sm-right">
                    <a href="{{route('course.index')}}" class="btn btn-behance text-white btn-sm"> <i class="waves-effect waves-light add_data"></i> Course List </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div id="messages"></div>
                <div class="card">
                    <div class="card-header"><i class="zmdi zmdi-book"></i> Update Course</div>
                    <div class="card-body">
                        <form method="post" action="{{route('course.update', [$course_edit->id])}}">
                            @csrf {{ method_field('PATCH') }}
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Select Category*</label>
                                    <select name="category_id" class="form-control input-check select2" id="category_id" required="">
                                        <option value="">--Select Category--</option>
                                        @foreach($category_list as $category)
                                            @if($course_edit->category_id == $category->id)
                                                <option selected="" value="{{$category->id}}">{{ucwords($category->category_name)}}</option>
                                            @else
                                                <option value="{{$category->id}}">{{ucwords($category->category_name)}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Course Name*</label>
                                    <input type="text" class="form-control input-check" name="course_name" id="course_name" placeholder="Enter Course Name" value="{{$course_edit->course_name}}" required="">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Select Author*</label>
                                    <select name="author_id" class="form-control input-check select2" id="author_id" required="">
                                        <option value="">--Select Author--</option>
                                        @foreach($author_list as $author)
                                            @if($course_edit->author_id == $author->id)
                                                <option selected="" value="{{$author->id}}">{{ucwords($author->author_name)}}</option>
                                            @else
                                                <option value="{{$author->id}}">{{ucwords($author->author_name)}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                @if(Auth::user()->userType == "superadmin")
                                <div class="form-group col-md-6">
                                    <label>Select User*</label>
                                    <select name="user_id" class="form-control input-check select2" id="user_id" required="">
                                        <option value="">--Select User--</option>
                                        @foreach($user_list as $users)
                                            @if($course_edit->user_id == $users->id)
                                                <option selected="" value="{{$users->id}}">{{ucwords($users->first_name.' '.$users->last_name)}}</option>
                                            @else
                                                <option value="{{$users->id}}">{{ucwords($users->first_name.' '.$users->last_name)}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                @endif
                            </div>

                            <div class="row">
                              <div class="form-group col-md-6">
                                <label>Course Duration*</label>
                                <input type="text" class="form-control input-check" name="course_duration" id="course_duration" placeholder="Enter Course Duration" value="{{$course_edit->course_duration}}" required="">
                              </div>

                              <div class="form-group col-md-6">
                                <label>Course Price*</label>
                                <input type="number" class="form-control input-check" name="course_price" id="course_price" placeholder="Enter Course Price" value="{{$course_edit->course_price}}" required="">
                              </div>
                            </div>

                            <div class="row">
                              <div class="form-group col-md-6">
                                <label>Select Discount</label>
                                <select name="course_discout_type" class="form-control" id="course_discout_type">
                                    <option value="No Discount" @if($course_edit->course_discout_type == "No Discount") selected="" @else @endif>No Discount</option>
                                    <option value="Amount" @if($course_edit->course_discout_type == "Amount") selected="" @else @endif>Amount</option>
                                    <option value="Percentage" @if($course_edit->course_discout_type == "Percentage") selected="" @else @endif>Percentage</option>
                                </select>                                
                              </div>

                              <div class="form-group col-md-6" id="course_discout">
                                <label>Enter Discount</label>
                                <input type="text" class="form-control input-check" name="course_discout" id="course_discout" placeholder="Enter Discount" value="{{$course_edit->course_discout}}">
                              </div>
                            </div>

                            <div class="row">
                              <div class="form-group col-md-6">
                                <label>Course Start Date*</label>
                                <input type="date" class="form-control input-check" name="course_start_date" id="course_start_date" placeholder="Enter Course Start Date" value="{{$course_edit->course_start_date}}" required="">
                              </div>

                              <div class="form-group col-md-6">
                                <label>Course Timing*</label>
                                <input type="time" class="form-control input-check" name="course_timing" id="course_timing" placeholder="Enter Course Timing" value="{{$course_edit->course_timing}}" required="">
                              </div>
                            </div>

                            <div class="row">
                              <div class="form-group col-md-6">
                                <label>Course Certification type</label>
                                <input type="text" class="form-control input-check" name="course_certification_type" id="course_certification_type" placeholder="Enter Course Certification type" value="{{$course_edit->course_certification_type}}">
                              </div>

                              <div class="form-group col-md-6">
                                <label for="exampleInputFile">Course Image*</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="file" class="custom-file-input form-control" id="file" >
                                        <label class="custom-file-label" for="file">Course Image</label>
                                    </div>
                                </div>
                                <div style="margin-top: 10px;" id="image_file">
                                    <img src="{{asset('public/assets/front/img/course')}}/{{$course_edit->course_image}}" style="width: 100px; width: 100px;" id="img">
                                </div>
                              </div>
                            </div>
                            
                            <div class="row">
                              <div class="form-group col-md-6">
                                <label>Course Status*</label>
                                <select name="course_status" class="form-control" id="course_status">
                                    <option value="Default" @if($course_edit->course_status == "Default") selected="" @else @endif>Default</option>
                                    <option value="Popular" @if($course_edit->course_status == "Popular") selected="" @else @endif>Popular</option>
                                    <option value="Trending" @if($course_edit->course_status == "Trending") selected="" @else @endif>Trending</option>
                                    <option value="Featured" @if($course_edit->course_status == "Featured") selected="" @else @endif>Featured</option>
                                </select> 
                              </div>

                              <div class="form-group col-md-6">
                                <label>Course Type*</label>
                                <select name="course_learning_status" class="form-control" id="course_learning_status">
                                    <option value="Online" @if($course_edit->course_learning_status == "Online") selected="" @else @endif>Online</option>
                                    <option value="Onsite" @if($course_edit->course_learning_status == "Onsite") selected="" @else @endif>Onsite</option>
                                    <option value="Your Pace" @if($course_edit->course_learning_status == "Your Pace") selected="" @else @endif>Your Pace</option>
                                </select> 
                              </div>
                            </div>
                            <?php 
                                if($course_edit->class_features != ""){
                                    $classFeature = json_decode($course_edit->class_features);
                                    $classFeatureTitle = $classFeature->class_feature_title;
                                    $classFeatureTitleHover = $classFeature->class_feature_title_hover;
                                
                                    if($course_edit->class_features != "" && count($classFeatureTitle) > 0){
                                        $i = 0;
                                        while($i < count($classFeatureTitle)){ ?>
                                            <div class="row inputFormRow">
                                                <div class="form-group col-md-6">
                                                    <label>class features title</label>
                                                    <input type="text" class="form-control input-check" name="class_feature_title[]" placeholder="Enter Class Feature Title" value="{{$classFeatureTitle[$i]}}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>class features title hover text</label>
                                                    <input type="text" class="form-control input-check" name="class_feature_title_hover[]" placeholder="Enter Class Feature Title Hover Text" value="{{$classFeatureTitleHover[$i]}}">
                                                    
                                                    <br><button type="button" class="btn btn-sm btn-danger px-3 removeRow"><i class="fa fa-minus"></i> Remove Field</button>
                                                </div>
                                            </div>
                                            <?php
                                            $i++;
                                        }
                                    }
                                }
                            ?>
                            <div id="newRow" style="flex: 0 0 100%;max-width: 100%;"></div>

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <button type="button" id="addRow" class="btn btn-sm btn-primary px-3"><i class="fa fa-plus"></i> Add Class & Features</button>
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
    $(document).ready(function(){
        $('.select2').select2();
        $("#course").addClass("active");

        if($("#course_discout_type").val() == "No Discount"){
            $("#course_discout").hide();
        }

        $("#course_discout_type").change(function(){
            if($(this).val() == "Amount" || $(this).val() == "Percentage"){
                $("#course_discout").show();
            }
            else{
                $("#course_discout").hide();
            }
        });
        
        $("#addRow").on('click', function(){
            let html = '';
            html += '<div class="row inputFormRow">';
            html += '<div class="form-group col-md-6">';
            html += '<label>class features title</label>';
            html += '<input type="text" class="form-control input-check" name="class_feature_title[]" placeholder="Enter Class Feature Title" value="{{old('course_certification_type')}}">';
            html += '</div>';

            html += '<div class="form-group col-md-6">';
            html += '<label>class features title hover text</label>';
            html += '<input type="text" class="form-control input-check" name="class_feature_title_hover[]" placeholder="Enter Class Feature Title Hover Text" value="{{old('course_certification_type')}}">';
            html += '<br><button type="button" class="btn btn-sm btn-danger px-3 removeRow"><i class="fa fa-minus"></i> Remove Field</button>';
            html += '</div></div>';

            $("#newRow").append(html);
            if($("#newRow").html() != ''){
                $(".removeRow").show();                
            }
        });
        
        $(document).on('click', '.removeRow', function(){
            $(this).closest(".inputFormRow").remove();
        });
    });

    $(document).on('change', '#file', function(){
        var name = document.getElementById("file").files[0].name;
        var form_data = new FormData();
        var ext = name.split('.').pop().toLowerCase();
        if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
        {
           alert("Invalid Image File");
        }
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("file").files[0]);
        var f = document.getElementById("file").files[0];
        var fsize = f.size||f.fileSize;
        if(fsize > 2000000)
        {
            alert("Image File Size is very big");
        }
        else
        {
            var _token = '<?= csrf_token(); ?>';
            form_data.append("file", document.getElementById('file').files[0]);
            form_data.append("_token", _token);
            $.ajax({
                url:"{{ url('admin/course/upload/image') }}",
                method:"POST",
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend:function(){
                    $('#image_file').html("<label class='text-success'>Image Uploading...</label>");
                },
                success:function(data)
                {
                    $('#image_file').html(data);
                }
            });
        }
    });    
  </script>
@endsection