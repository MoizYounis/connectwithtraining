@extends('admin.layouts.master')
@section('title')Add Videos | Videos @endsection
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void();">Add Videos</a></li>
                </ol>
            </div>
         
            <div class="col-sm-3">
                <div class="btn-group float-sm-right">
                    <a href="{{route('video.index')}}" class="btn btn-behance text-white btn-sm"> <i class="waves-effect waves-light add_data"></i> All videos </a>
                </div>
            </div>
        </div>        

        <div class="row">
            <div class="col-lg-12">
                <div id="messages"></div>
                <div class="card">
                    <div class="card-header"><i class="zmdi zmdi-collection-video"></i> Videos</div>
                    <div class="card-body">
                        
                        <form method="post" action="{{route('video.store')}}" enctype="multipart/form-data">
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
                                    <label>Video Title*</label>
                                    <input type="text" class="form-control input-check" name="video_title" id="video_title" placeholder="Enter Video Title" value="{{old('video_title')}}" required="">
                                </div>

                                <div class="form-group col-md-12">
                                    <label>Video Description</label>
                                    <textarea class="form-control input-check" name="video_desc" id="video_desc" placeholder="Enter Video Description" rows="5">{{old('video_desc')}}</textarea>
                                </div>
                      
                                <div class="form-group col-md-6">
                                    <div class="">
                                        <label for="exampleInputFile">Video Banner*</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="file" class="custom-file-input form-control" id="file" required="">
                                                <label class="custom-file-label" for="file">Choose Video Banner</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="margin-top: 10px;" id="image_file">
                                    </div>
                                </div>                                

                                <div class="form-group col-md-6">
                                    <label>Select Video Type</label>
                                    <select name="video_type" id="video_type" class="form-control select-check" required="">
                                        <option value="" disabled="" selected="">Select Video Type</option>
                                        <option value="link">Link</option>
                                        <option value="upload">Upload Video</option>
                                        <option value="embed">Embed Video</option>
                                    </select>                      
                                </div>

                                <!-- Dynamic -->
                                <div class="form-group col-md-12" style="display: none;" id="videoUpload">
                                    <div class="">
                                        <label for="exampleInputBanner">Upload Video*</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input form-control" id="file2" name="file2">
                                                <label class="custom-file-label" for="file2">Choose Video</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="margin-top: 10px;" id="image_file2">
                                    </div>
                                </div>

                                <div class="form-group col-md-12" style="display: none;" id="videoLink">
                                    <label id="labeltxt">Video Link*</label>
                                    <input type="text" class="form-control input-check" name="video_link" id="video_link" placeholder="Enter Link" value="{{old('video_link')}}">
                                </div>

                                <!-- End Dynamic -->

                                <div class="form-group col-md-12">
                                    <!-- <label>Blog Status*</label> -->
                                    <div class="icheck-material-primary">
                                        <input type="checkbox" name="video_status" id="user-checkbox5" 
                                        @if(old('video_status')) checked="" @else @endif
                                        />
                                        <label for="user-checkbox5">Publish The Video ?</label>
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
        $(document).ready(function () {
            $('#datatable').DataTable();

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
        $('.select2').select2();
        
        $('#video_type').change(function(){
            let type = $(this).val();
            if(type == 'link'){
                $('#videoLink').show();
                $('#videoUpload').hide();
            }
            else if(type == 'embed'){
                $('#videoLink').show();
                $('#videoUpload').hide();
            }
            else{
                $('#videoUpload').show();
                $('#videoLink').hide();
            }
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
                    url:"{{ url('admin/video/upload/image') }}",
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
    });
    </script>
@endsection