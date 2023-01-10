@extends('admin.layouts.master')
@section('title')Web Settings | Website Settings @endsection
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void();"></a>Website Settings</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div id="messages"></div>
                <div class="card">
                    <div class="card-header"><i class="zmdi zmdi-settings"></i> Website Settings</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        @php
                                            $social = json_decode($gs->social_links);
                                        @endphp
                                        <ul class="nav nav-pills" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="pill" href="#piil-1"><span class="">Logo</span></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="pill" href="#piil-2"> <span class="">Copyright</span></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="pill" href="#piil-3"> <span class="">Contact Details</span></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="pill" href="#piil-4"> <span class="">Social Links</span></a>
                                            </li>
                                        </ul>

                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div id="piil-1" class="container tab-pane active">
                                                 <form action="{{url('admin/website/update/logo')}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="form-group col-md-4">
                                                            <label for="file">Logo</label>
                                                            <input type="file" class="custom-file-input form-control" id="file">
                                                            <label class="custom-file-label" for="file">Logo</label>
                                                            
                                                            <div style="margin-top: 10px;" id="msg1"></div>
                                                            <img style="height: 50px;" class="thumbnail img-responsive" src="{{asset('public/assets/front/img/logo/'.$gs->logo)}}" id="img"/>
                                                            <input type="hidden" name="logo" value="{{$gs->logo}}" id="logo">    
                                                        </div>

                                                        <div class="form-group col-md-1"></div>
                                                    
                                                        <div class="form-group col-md-4">
                                                            <label for="file2">Favicon</label>
                                                            <input type="file" class="custom-file-input form-control" id="file2">
                                                            <label class="custom-file-label" for="file2">Favicon</label>
                                                            
                                                            <div style="margin-top: 10px;" id="msg2"></div>
                                                            <img style="height: 50px;" class="thumbnail img-responsive" src="{{asset('public/assets/front/img/logo/'.$gs->favicon)}}" id="img2"/>
                                                            <input type="hidden" name="favicon" value="{{$gs->favicon}}" id="favicon">
                                                        </div>

                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn btn-sm btn-primary">Update</button>                           
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            

                                            <div id="piil-2" class="container tab-pane fade">
                                                <form action="{{ url('admin/website/updateFooter') }}" method="post">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="form-group col-md-6">                   
                                                            <label>Footer Description</label>
                                                            <textarea class="form-control" name="copyright" type="text" rows="5">Copyright © {{date('Y')}} | All Rights Reserved.</textarea>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                            <div id="piil-3" class="container tab-pane fade">
                                                <form action="{{route('contactus_update')}}" method="post">
                                                  @csrf
                                                  <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Title</label>
                                                            <input class="form-control" name="contact_title" value="{{ $gs->contact_title ?? old('contact_title') }}" placeholder="Title"  type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Address</label>
                                                            <input class="form-control" name="contact_address" value="{{ $gs->contact_address ?? old('contact_address') }}" placeholder="Address"  type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Phone</label>
                                                            <input class="form-control" name="contact_phone" value="{{ $gs->contact_phone ?? old('contact_phone') }}" placeholder="Phone" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Customer Care Number</label>
                                                            <input class="form-control" name="customer_no" value="{{ $gs->customer_no ?? old('customer_no') }}" placeholder="Customer Phone" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Email</label>
                                                            <input class="form-control" name="contact_email" value="{{ $gs->contact_email ?? old('contact_email') }}" placeholder="Email" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Whatsapp Number</label>
                                                            <input class="form-control" name="wp_phone" value="{{ $gs->wp_phone ?? old('wp_phone') }}" placeholder="Whatsapp Number" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Contact Map</label>
                                                            <textarea class="form-control" id="map" rows="2" name="map">{!! $gs->map !!}</textarea>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-primary btn-sm">UPDATE</button>
                                                    </div>
                                                </div>
                                                </form>
                                            </div>
                                            
                                            <div id="piil-4" class="container tab-pane fade">
                                                <form action="{{url('admin/frontend/socialAdd')}}" method="post">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="form-group col-md-6">                   
                                                            <label>Facebook</label>
                                                            <input class="form-control" name="facebook" type="text" value="{{isset($social->facebook)?$social->facebook:""}}">
                                                        </div>
                                                        <div class="form-group col-md-6">                   
                                                            <label>Twitter</label>
                                                            <input class="form-control" name="twitter" type="text" value="{{isset($social->twitter)?$social->twitter:""}}">
                                                        </div>
                                                        <div class="form-group col-md-6">                   
                                                            <label>Google+</label>
                                                            <input class="form-control" name="google" type="text" value="{{isset($social->google)?$social->google:""}}">
                                                        </div>
                                                        <div class="form-group col-md-6">                   
                                                            <label>YouTube</label>
                                                            <input class="form-control" name="youtube" type="text" value="{{isset($social->youtube)?$social->youtube:""}}">
                                                        </div>
                                                        <div class="form-group col-md-6">                   
                                                            <label>LinkdIn</label>
                                                            <input class="form-control" name="linkdin" type="text" value="{{isset($social->linkdin)?$social->linkdin:""}}">
                                                        </div>
                                                        <div class="form-group col-md-6">                   
                                                            <label>Instagram</label>
                                                            <input class="form-control" name="instagram" type="text" value="{{isset($social->instagram)?$social->instagram:""}}">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
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
    $(document).ready(function(){
        $("#setting").addClass("active");

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
            url:"{{ url('admin/website/upload_logo') }}",
            method:"POST",
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function(){
             $('#msg1').html("<label class='text-success'>Image Uploading...</label>");
            },   
            success:function(data)
            {
                $('#msg1').hide();
                $('#img').attr("src", "{{asset('public/assets/front/img/logo/')}}/"+data);
                $('#logo').val(data);
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
            url:"{{ url('admin/website/upload_logo') }}",
            method:"POST",
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function(){
             $('#msg2').html("<label class='text-success'>Image Uploading...</label>");
            },   
            success:function(data)
            {
                $('#msg2').hide();
                $('#img2').attr("src", "{{asset('public/assets/front/img/logo/')}}/"+data);
                $('#favicon').val(data);
            }
           });
          }
      });

    });
</script>
@endsection