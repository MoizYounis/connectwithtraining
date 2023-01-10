@extends('admin.layouts.master')
@section('title')Brand List | Categories @endsection
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:void();"></a></li>
         </ol>
     </div>
     
     <div class="col-sm-3">
       <div class="btn-group float-sm-right">
        <button type="button" class="btn btn-behance text-white btn-sm waves-effect waves-light sort_btn mr-2" ><i class="fa fa-sort mr-1"></i> Sort Columns </button>
        <button type="button" class="btn btn-behance text-white btn-sm waves-effect waves-light add_data" data-toggle="modal" data-target="#addbrand"><i class="fa fa-plus mr-1"></i> Add </button>

      </div>
     </div>

     <div class="modal fade" id="addbrand" data-backdrop="static">
      <div class="modal-dialog modal-dialog-scrollable modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title modal_title_creat_update">Insert Brand</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
              <form id="upload_form" method="post" action="javascript:void(0)">
                @csrf
                <div class="row">

                  <div class="form-group col-md-12">
                    <label>Brand Name</label>
                    <input type="text" class="form-control input-check" name="brand_name" id="brand_name" placeholder="Enter Brand Name">
                    <span class="text-danger" id="brand_name_error"></span>
                  </div>
                  
                  <div class="form-group col-md-12">
                    <div class="">
                      <label for="exampleInputFile">Brand Logo</label>
                      <span class="text-danger" id="brand_logo_error"></span>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" name="file" class="custom-file-input form-control" id="file">
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
                      <label for="exampleInputBanner">Brand Banner</label>
                      <span class="text-danger" id="brand_banner_error"></span>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input form-control" id="file2">
                            <label class="custom-file-label" for="file2">Choose Banner</label>
                          </div>
                        </div>
                    </div>
                    <div style="margin-top: 10px;" id="image_file2">
                      <!-- <input type="hidden" name="brand_banner" id="brand_banner" value="" required/> -->
                    </div>
                  </div>

                  <div class="form-group col-md-12">
                    <label>Meta Title</label>
                    <input type="text" class="form-control input-check" name="brand_meta_title" id="brand_meta_title" placeholder="Enter Brand Meta Title">
                  </div>

                  <div class="form-group col-md-12">
                    <label>Meta Description</label>
                    <textarea class="form-control input-check" name="brand_meta_desc" id="brand_meta_desc" placeholder="Enter Meta Description"></textarea>
                  </div>


                  <div class="form-group col-md-12">
                    <label>Status</label>
                    <select name="brand_status" id="brand_status" class="form-control select-check">
                      <option value="">Choose Status</option>
                      <option value="Active" selected>Active</option>
                      <option value="Inactive">Inactive</option>
                    </select>
                  </div>
                  <div class="form-group col-md-12">
                    <hr>
                    <input type="hidden" name="id" id="id" value="0">
                    <input type="hidden" name="last_sort" id="last_sort" value="0">
                    <button type="submit" id="submit_btn" class="btn btn-sm btn-success px-3"><i class="fa fa-arrow-circle-right"></i> Insert</button>
                  </div>
                </div>
              </form>
            </div>

        </div>
      </div>
  </div>
   
     </div>
    <!-- End Breadcrumb-->
      <div class="row">
        <div class="col-lg-12">
          <div id="messages"></div>
          <div class="card">
            <div class="card-header"><i class="fab fa-"></i>  </div>
            <div class="card-body">
              <div class="table-responsive">
              <table style="zoom:90%;" id="datatable" class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>Sno.</th>                        
                        <th>Brand Name</th>
                        <th>Logo</th>
                        <th>Banner</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
            </table>
            </div>
            </div>
          </div>
        </div>
      </div><!-- End Row-->
    </div>
    <!-- End container-fluid-->
  </div><!--End content-wrapper-->
  

  <div class="modal fade" id="SortModal" data-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Sort Columns</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>

          <div class="modal-body">
            <div class="list-group" id="page_list"></div>
          </div>
      </div>
    </div>
  </div>
  
@endsection
@section('script')
  <script type="text/javascript">

    $(document).ready(function () {

      var manageTable;
      // initialize the datatable 
      manageTable = $('#datatable').DataTable({
        "ajax": "{{url('admin/brand/fetchdata')}}",
        "order": [],
        "pageLength" : 100
      });
      // initialize the datatable 

      function get_datatable(){
        $('#datatable').DataTable();  
      }
      get_datatable();

      $('.delete_form').on('submit', function(){
          if(confirm("Are you sure you want to delete it..?")){
              return true;
          }
          else{
              return false;
          }
      });
      
      $("#brand").addClass("active");

		$('#upload_form').on('submit', function(e){
			e.preventDefault();        
			let brand_name = $("#brand_name").val();
			let brand_meta_title = $("#brand_meta_title").val();
			let brand_meta_desc = $("#brand_meta_desc").val();
      let brand_logo = $("#brand_logo").val();
      let brand_banner = $("#brand_banner").val();
      let brand_status = $("#brand_status").val();
			var _token = '<?= csrf_token(); ?>';
			$.ajax({
          url:"{{url('admin/brand/store')}}",
          data: {
            brand_name: brand_name, 
            brand_meta_title: brand_meta_title,
            brand_meta_desc: brand_meta_desc,
            brand_logo : brand_logo,
            brand_banner: brand_banner,
            brand_status : brand_status, 
            _token:_token
          },
          method:"post",
          success:function(response){
            alert("Data Inserted..");
            $("#res_message").html(response.msg);
            $("#addbrand").modal("hide");
            manageTable.ajax.reload(null, false); 
          },
          error:function (response) {
            $('#brand_name_error').text(response.responseJSON.errors.brand_name);
            $('#brand_logo_error').text(response.responseJSON.errors.brand_logo);
            $('#brand_banner_error').text(response.responseJSON.errors.brand_banner);
          }
      });
		});


      //delete
      $(document).on('click', '.delete_data', function(){
        let id = $(this).attr("id");
        $.ajax({
          url : "{{url('admin/brand/delete/')}}/"+id,
          method : "get",
          dataType: 'json',
          success:function(response) {            
            if(response.success == true) {
              // success_noti(response.messages);
              manageTable.ajax.reload(null, false);
            } else {
              error_noti(response.messages);
            }
          }
        });
      });


      // edit user
      $(document).on('click', '.edit_data', function(){
        $('.modal_title_creat_update').text('Edit Brand');
        $('#submit_btn').html(`<i class="fa fa-arrow-circle-up fa-lg px-1"></i> Update`);
        let id = $(this).attr("id");
        $.ajax({
          url: "{{url('admin/brand/edit')}}/"+id,
          type: 'get',
          dataType:'json',
          success:function(response) {
            console.log(response);
            $("#brand_name").val(response.brand_name);
            // $("#status").val(response.status);
            // $('#last_sort').val(response.sort);
            // if(response.logo != ''){
            //   $('#image_file').html(`<img src="${base_url}images/brands/${response.logo}" style="width:100px; height:100px; object-fit:contain;;" />
            //              <input type="hidden" name="logo" id="logo" value="${response.logo}" required/>`);
            // }
            // $('#id').val(response.id);
            // if(response.brand_categories != ''){
            //   let brand_category = JSON.parse(response.brand_categories);
            //   var select_array = new Array();
            //   for(x in brand_category){
            //     select_array.push(brand_category[x]);
            //   }
            //   $('#multipleVal').val(select_array).change();
            // }
            
            $('#addbrand').modal('show');
          }
        });
      });


  });
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
            url:"{{ url('admin/brand/upload/image') }}",
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
            url:"{{ url('admin/brand/upload/banner') }}",
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
