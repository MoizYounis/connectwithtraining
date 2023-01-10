@extends('admin.layouts.master')
@section('title')Child Categroy List | Child Categories @endsection
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void();"></a>Child Categories</li>
                </ol>
            </div>
         
            <div class="col-sm-3">
                <div class="btn-group float-sm-right">
                    <button type="button" class="btn btn-behance text-white btn-sm waves-effect waves-light add_data" data-toggle="modal" data-target="#addchildcategory"><i class="fa fa-plus mr-1"></i> Add </button>
                </div>
            </div>
        </div>

        <div class="modal fade" id="addchildcategory" data-backdrop="static">
          <div class="modal-dialog modal-dialog-scrollable modal-md">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title modal_title_creat_update">Insert Child Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                  <form method="post" action="{{route('childcategory.store')}}">
                    @csrf
                    <div class="row">
                      <div class="form-group col-md-12">
                        <label>Main Category*</label>
                        <select style="width: 100%;" class="form-control select2" name="category_id"required id="category_id">
                          <option value="0">Choose Main Category</option>
                          <?php 
                            foreach($category_list as $row){
                              echo '<option value="'.$row->id.'">'.ucwords($row->category_name).'</option>';
                            }
                          ?>
                        </select>
                      </div>


                      <div class="form-group col-md-12">
                        <label>Sub Category*</label>
                        <select style="width: 100%;" class="form-control select2" name="sub_id"required id="sub_id">
                          <option value="0">Choose Sub Category</option>
                        </select>
                      </div>


                      <div class="form-group col-md-12">
                        <label>Child Category Name*</label>
                        <input type="text" class="form-control input-check" name="child_name" id="child_name" placeholder="Enter Child Category Name" value="{{old('child_name')}}" required="">
                      </div>
                      
                      <div class="form-group col-md-12">
                        <div class="">
                          <label for="exampleInputFile">Child Category Logo*</label>
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

                      <div class="form-group col-md-12">
                        <div class="">
                          <label for="exampleInputBanner">Child Category Banner*</label>
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
                        <label>Status</label>
                        <select name="child_status" id="child_status" class="form-control select-check">
                          <option value="">Choose Status</option>
                          <option value="Active" selected>Active</option>
                          <option value="Inactive">Inactive</option>
                        </select>
                      </div>
                      <div class="form-group col-md-12">
                        <button type="submit" id="submit_btn" class="btn btn-sm btn-success px-3"><i class="fa fa-arrow-circle-right"></i> Insert</button>
                      </div>
                    </div>
                  </form>
                </div>

            </div>
          </div>
      </div>

        <div class="row">
            <div class="col-lg-12">
                <div id="messages"></div>
                <div class="card">
                    <div class="card-header"><i class="zmdi zmdi-view-dashboard"></i> Child Categories</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table style="zoom:90%;" id="datatable" class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>Sno.</th>                        
                                        <th>Name</th>
                                        <th>Logo</th>
                                        <th>Banner</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($child_list as $row)
                                        <tr>
                                            <td>{{$row->id}}</td>
                                            <td>
                                                <b>{{ucwords($row->child_name)}}</b><br>
                                                <span style="color:grey;">( {{ucwords($row->category_name)}} / {{ucwords($row->sub_name)}}) </span>
                                            </td>
                                            <td><img src="{{asset('public/assets/front/img/childcat')}}/{{$row->child_logo}}" class="img img-circle" height="50" width="50"></td>
                                            <td><img src="{{asset('public/assets/front/img/childcat_banner')}}/{{$row->child_banner}}" class="img img-circle" height="50" width="50"></td>
                                            <td>
                                                @if($row->child_status  == 'Active')
                                                    <button type="button" class="btn btn-outline-success btn-sm btn-round waves-effect waves-light m-1">Active</button>
                                                @else
                                                    <button type="button" class="btn btn-outline-danger btn-sm btn-round waves-effect waves-light m-1">Inactive</button>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group m-1" role="group">
                                                    <button type="button" class="btn btn-behance btn-sm text-white waves-effect waves-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Action
                                                    </button>
                                                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 37px, 0px);">
                                                        <a href="{{route('childcategory.edit',[$row->id])}}" class="dropdown-item edit_data"><i class="fa fa-edit mr-1"></i> Edit Data</a>
                                                        <div class="dropdown-divider"></div>

                                                        <form method="post" class="delete_form" action="{{ action('Admin\ChildCatConroller@destroy', $row->id) }}">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="_method" value="Delete">
                                                            <button type="submit" class="dropdown-item delete_data"><i class="fa fa-trash mr-1"></i> Delete</button>
                                                        </form>    
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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
      $('#img').hide();
      
      $('.select2').select2();
      
      
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
    
  </script>
@endsection