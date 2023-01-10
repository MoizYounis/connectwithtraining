@extends('admin.layouts.master')
@section('title')Update User | Users @endsection
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void();">Users</a></li>
                </ol>
            </div>
         
            <div class="col-sm-3">
                <div class="btn-group float-sm-right">
                    <a href="{{url('admin/user_list')}}" class="btn btn-behance text-white btn-sm waves-effect waves-light add_data"><i class="fa fa-plus mr-1"></i> Users List </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div id="messages"></div>
                <div class="card">
                    <div class="card-header"><i class="zmdi zmdi-accounts-alt"></i>Update User</div>
                    <div class="card-body">
                        <form action="{{url('admin/user/update', [$user_edit->id])}}" method="post" enctype="multipart/form-data">
                            @csrf
                            
                            <h5>Persnol Details</h5><br>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First Name*</label>
                                        <input class="form-control input-check" type="text" name="first_name"  value="{{$user_edit->first_name}}" placeholder="First Name" id="first_name" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Last Name*</label>
                                        <input class="form-control input-check" type="text" name="last_name"  value="{{$user_edit->last_name}}" placeholder="Last Name" id="technician_lname" >
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input class="form-control" type="number" name="phone"  value="{{$user_edit->phone}}" placeholder="Phone Number" id="phone">
                                    </div>
                                </div>
                            

                                <div class="form-group col-md-6">
                                    <label for="exampleInputFile">Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="file" class="custom-file-input form-control" id="file">
                                            <label class="custom-file-label" for="file">Image</label>
                                        </div>
                                    </div>
                                    <div style="margin-top: 10px;" id="image_file">
                                        @if($user_edit->image)
                                        <img src="{{asset('public/assets/front/img/user')}}/{{$user_edit->image}}" id="img" style="width:100px; height:100px; object-fit:contain;">
                                        @endif
                                        <input type="hidden" name="image" id="image" value="
                                        @if($user_edit->image){{$user_edit->image}} @endif" />
                                    </div>
                                </div>
                            </div>               

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Select User Type*</label>
                                    <select name="user_type_id" class="form-control input-check select2" id="user_type_id" >
                                        <option value="">--Select User Type--</option>
                                        @foreach($user_types as $type)
                                            @if($user_edit->user_type_id == $type->id)
                                                <option selected="" value="{{$type->id}}">{{ucwords($type->type_name)}}</option>
                                            @else
                                                <option value="{{$type->id}}">{{ucwords($type->type_name)}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Status</label>
                                    <div class="icheck-material-primary">                                        
                                        <input type="checkbox" name="status" id="user-checkbox5" 
                                        @if($user_edit->status) checked="" @else @endif
                                        />
                                        <label for="user-checkbox5">Active / Inactive</label>
                                    </div>
                                </div>                                
                            </div>

                            <hr>

                            <h5>Login Details</h5><br>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email*</label>
                                        <input class="form-control input-check" type="text" name="email"  value="{{$user_edit->email}}" placeholder="Email" id="email" >
                                    </div>
                                </div>

                                <!-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Password*</label>
                                        <input class="form-control input-check" type="password" name="password" placeholder="Password" value="{{$user_edit->password}}" id="password" >
                                    </div>
                                </div> -->
                            </div>

                            <hr>

                            <h5>Location Datails</h5><br>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>City Name</label>
                                        <input class="form-control" type="text" name="city"  value="{{$user_edit->city}}" placeholder="City Name" id="city">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>State Name</label>
                                        <input class="form-control" type="text" name="state" placeholder="State Name" value="{{$user_edit->state}}" id="State">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Pincode</label>
                                        <input class="form-control" type="number" name="pincode" placeholder="Pincode" value="{{$user_edit->pincode}}" id="pincode">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea class="form-control" name="address" id="address" placeholder="Address">{{$user_edit->address}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary btn-sm">Update User</button>
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

    $(document).ready(function () {
        $('.delete_form').on('submit', function(){
            if(confirm("Are you sure you want to delete it..?")){
                return true;
            }
            else{
                return false;
            }
        });
        $('#user').addClass('active');
        $('.select2').select2();
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
                url:"{{ url('admin/user/upload/image') }}",
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

