@extends('admin.layouts.master')
@section('title')Change Password | Password @endsection
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void();"></a>Change Password</li>
                </ol>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <div id="messages"></div>
                <div class="card">
                    <div class="card-header"><i class="zmdi zmdi-lock"></i> Change Password</div>
                    <div class="card-body">
                        <form action="{{ route('change_password') }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Current Password</label>
                                    <input type="password" class="form-control" id="oldword" name="oldword" placeholder="Enter Current Password">
                                </div>
                                
                                <div class="form-group col-md-12">
                                    <label>New Password</label>
                                    <input type="password" class="form-control" id="newword" name="newword" placeholder="New Password">
                                </div>
                                
                                <div class="form-group col-md-12">
                                    <label>Re-type Password</label>
                                    <input type="password" class="form-control" id="newword_confirmation" name="newword_confirmation" placeholder="Enter Password Again">
                                </div>
                                <div class="form-group col-md-6">
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
