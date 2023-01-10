@extends('admin.layouts.master')
@section('title')Edit Child-Category | Child Categories @endsection
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void();">Edit Child Category</a></li>
                </ol>
            </div>
         
            <div class="col-sm-3">
                <div class="btn-group float-sm-right">
                    <a href="{{route('childcategory.index')}}" class="btn btn-behance text-white btn-sm"> <i class="waves-effect waves-light add_data"></i> Child Category List </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div id="messages"></div>
                <div class="card">
                    <div class="card-header"><i class="zmdi zmdi-view-dashboard"></i> Update Child Category</div>
                    <div class="card-body">
                        <form method="post" action="{{route('childcategory.update', [$child_edit->id])}}"  enctype="multipart/form-data">
                            @csrf
                            {{ method_field('PATCH') }}
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Main Category*</label>
                                    <select style="width: 100%;" class="form-control select2" name="category_id"required id="category_id">
                                      <option value="0">Choose Main Category</option>
                                        @foreach($category_list as $row)
                                          <option <?php if($row->id == $child_edit->category_id){ echo 'selected';}?> value="{{$row->id}}">{{ucwords($row->category_name)}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Sub Category*</label>
                                    <select style="width: 100%;" class="form-control select2" name="sub_id"required id="sub_id">
                                      <option value="0">Choose Sub Category</option>
                                        @foreach($sub_cat_list as $row)
                                          <option <?php if($row->id == $child_edit->sub_id){ echo 'selected';}?> value="{{$row->id}}">{{ucwords($row->sub_name)}}</option>
                                        @endforeach
                                    </select>
                                </div>

                              <div class="form-group col-md-4">
                                <label>Child Category Name*</label>
                                <input type="text" class="form-control input-check" name="child_name" id="child_name" placeholder="Enter Child Category Name" value="{{$child_edit->child_name}}" required="">
                              </div>

                              <div class="form-group col-md-6">
                                <div class="">
                                  <label for="exampleInputFile">Child Category Logo*</label>
                                    <div class="input-group">
                                      <div class="custom-file">
                                        <input type="file" name="file" class="custom-file-input form-control" id="file">
                                        <label class="custom-file-label" for="file">Choose Logo</label>
                                      </div>
                                    </div>
                                </div>
                                <div style="margin-top: 10px;" id="image_file">
                                  <!-- <input type="hidden" name="brand_logo" id="brand_logo" value="" required/> -->
                                  <img src="{{asset('public/assets/front/img/childcat')}}/{{$child_edit->child_logo}}" style="width: 100px; width: 100px;" id="img">
                                </div>
                              </div>

                              <div class="form-group col-md-6">
                                <div class="">
                                  <label for="exampleInputBanner">Child Category Banner*</label>
                                    <div class="input-group">
                                      <div class="custom-file">
                                        <input type="file" class="custom-file-input form-control" id="file2" >
                                        <label class="custom-file-label" for="file2">Choose Banner</label>
                                      </div>
                                    </div>
                                </div>
                                <div style="margin-top: 10px;" id="image_file2">
                                  <!-- <input type="hidden" name="brand_banner" id="brand_banner" value="" required/> -->
                                  <img src="{{asset('public/assets/front/img/childcat_banner')}}/{{$child_edit->child_banner}}" style="width: 100px; width: 100px;" id="img2">
                                </div>
                              </div>


                              <div class="form-group col-md-12">
                                <label>Status</label>
                                <select name="child_status" id="child_status" class="form-control select-check">
                                  <option value="">Choose Status</option>
                                  @if($child_edit->child_status == 'Active')
                                    <option value="Active" selected>Active</option>
                                    <option value="Inactive">Inactive</option>
                                  @else
                                    <option value="Active">Active</option>
                                    <option value="Inactive" selected>Inactive</option>
                                  @endif
                                </select>
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
      // $('#img').hide();
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
            url:"{{ url('admin/childcategory/upload/image') }}",
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


      $(document).on('change', '#file2', function(){

        var name = document.getElementById("file2").files[0].name;
          var form_data = new FormData();
          var ext = name.split('.').pop().toLowerCase();
          if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
          {
           alert("Invalid Image File");
          }
          var oFReader = new FileReader();
          oFReader.readAsDataURL(document.getElementById("file2").files[0]);
          var f = document.getElementById("file2").files[0];
          var fsize = f.size||f.fileSize;
          if(fsize > 2000000)
          {
           alert("Image File Size is very big");
          }
          else
          {
            var _token = '<?= csrf_token(); ?>';
           form_data.append("file2", document.getElementById('file2').files[0]);
           form_data.append("_token", _token);
           $.ajax({
            url:"{{ url('admin/childcategory/upload/banner') }}",
            method:"POST",
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function(){
             $('#image_file2').html("<label class='text-success'>Image Uploading...</label>");
            },   
            success:function(data)
            {
             $('#image_file2').html(data);
            }
           });
          }
      });

      $('#category_id').on('change', function(){
        var category_id = $(this).val();
        if(category_id){
            $.ajax({
                type : "GET",
                url : "{{url('/get_sub_cat')}}/"+category_id,
                    dataType : "json",
                success : function(data){
                    if(data){
                        $("#sub_id").empty();
                        $("#sub_id").append('<option>--Select Sub Category--</option>');
                        $.each(data, function(key, value){
                            $("#sub_id").append('<option value="'+key+'">'+value+'</option>');    
                        });                            
                    }
                }
            }); 
        }else{
            $('#sub_id').html('<option value="">Select Category first</option>');
        }
        });

    });    
  </script>
@endsection