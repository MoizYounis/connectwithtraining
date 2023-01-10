@extends('admin.layouts.master')
@section('title')Create Categroy | Categories @endsection
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void();">Categories</a></li>
                </ol>
            </div>
         
            <div class="col-sm-3">
                <div class="btn-group float-sm-right">
                    <a href="{{route('category.index')}}" class="btn btn-behance text-white btn-sm waves-effect waves-light add_data"><i class="fa fa-list mr-1"></i> Category List</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div id="messages"></div>
                <div class="card">
                    <div class="card-header"><i class="zmdi zmdi-view-dashboard"></i> Categories</div>
                    <div class="card-body">
                        <form method="post" action="{{route('category.store')}}">
                            @csrf
                            <div class="row">

                              <div class="form-group col-md-6">
                                <label>Category Name*</label>
                                <input type="text" class="form-control input-check" name="category_name" id="category_name" placeholder="Enter Category Name" value="{{old('category_name')}}" required="">
                              </div>

                              <div class="form-group col-md-6">
                                <label>Category Status</label>
                                <select name="category_status" id="brand_status" class="form-control select-check">
                                  <option value="">Choose Status</option>
                                  <option value="Active" selected>Active</option>
                                  <option value="Inactive">Inactive</option>
                                </select>
                              </div>
                              
                              <div class="form-group col-md-6">
                                <div class="">
                                  <label for="exampleInputFile">Category Logo*</label>
                                    <div class="input-group">
                                      <div class="custom-file">
                                        <input type="file" name="file" class="custom-file-input form-control" id="file" required="">
                                        <label class="custom-file-label" for="file">Choose Logo</label>
                                      </div>
                                    </div>
                                </div>
                                <div style="margin-top: 10px;" id="image_file">
                                  <!-- <input type="hidden" name="brand_logo" id="brand_logo" value="" required/> -->
                                  <img src="" id="img" width="100" height="100">
                                </div>
                              </div>

                              <div class="form-group col-md-6">
                                <div class="">
                                  <label for="exampleInputBanner">Category Banner*</label>
                                    <div class="input-group">
                                      <div class="custom-file">
                                        <input type="file" class="custom-file-input form-control" id="file2" required="">
                                        <label class="custom-file-label" for="file2">Choose Banner</label>
                                      </div>
                                    </div>
                                </div>
                                <div style="margin-top: 10px;" id="image_file2">
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
        $("#category").addClass("active");
    </script>

    <script type="text/javascript">
    $(document).ready(function(){
      $('#img').hide();
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
            url:"{{ url('admin/category/upload/image') }}",
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
            url:"{{ url('admin/category/upload/banner') }}",
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

    });
    
  </script>
@endsection