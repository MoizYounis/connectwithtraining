@extends('admin.layouts.master')
@section('title')Profile | Manage Profile @endsection
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void();"></a>Profile</li>
                </ol>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <div id="messages"></div>
                <div class="card">
                    <div class="card-header"><i class="zmdi zmdi-account"></i> Manage Profile</div>
                    <div class="card-body">
                        <form action="{{route('update_admin_profile')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>First Name</label>
                                    <input class="form-control" type="text" name="first_name" placeholder="Enter First Name" value="{{ Auth::user()->first_name }}">
                                </div>                                
                            
                                <div class="form-group col-md-6">
                                    <label>Last Name</label>
                                    <input class="form-control" type="text" name="last_name" placeholder="Enter Last Name" value="{{ Auth::user()->last_name }}">
                                </div>
                            
                                <div class="form-group col-md-6">
                                    <label>Email</label>
                                    <input class="form-control" type="text" name="email" placeholder="Enter Email" value="{{ Auth::user()->email }}">
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label>Image</label>
                                    <input class="form-control" type="file" name="image">
                                </div>
                                
                                <div class="form-group col-md-6">
                                    @if(Auth::user()->image)
                                        <img style="width: 80px;height: 80px;" class="mr-3 side-user-img" src="{{asset('public/assets/front/img/user').'/'.Auth::user()->image}}" alt="user avatar">
                                    @else
                                        <img style="width: 80px; height: 80px;" class="mr-3 side-user-img" src="{{asset('public/assets/admin/images/avatars/avtar.png')}}" alt="user avatar">
                                    @endif
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
        $(document).ready(function () {
            
        });
    </script>
@endsection