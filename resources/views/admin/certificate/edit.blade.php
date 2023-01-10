@extends('admin.layouts.master')
@section('title')Update Certificate | Certificates @endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Certificate</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Certificates</li>  
                        <li class="breadcrumb-item"><a href="{{route('certificates.index')}}" class="btn btn-primary btn-sm float-right">Certificate List</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="card-body">
                                <form action="{{route('certificates.update', [$certificate_edit->id])}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    {{ method_field('PATCH') }}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="certificate_name"><strong>Certificate Name&nbsp;<span class="mark">*</span></strong></label>
                                                <input class="form-control" type="text" name="certificate_name"  value="{{$certificate_edit->certificate_name}}" placeholder="Enter Certificate Name" id="certificate_name">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="certificate_url"><strong>Certificate Url&nbsp;<span class="mark">*</span></strong></label>
                                                <input class="form-control" type="text" name="certificate_url"  value="{{$certificate_edit->certificate_url}}" placeholder="Enter Certificate Url" id="certificate_url">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="certificate_desc"><strong>Certificate Description</strong></label>
                                                <textarea rows="5" class="form-control" name="certificate_desc" placeholder="Enter Certificate Description" id="certificate_desc">{{$certificate_edit->certificate_desc}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <img src="{{asset('public/assets/front/img/certificate/'.$certificate_edit->certificate_image)}}" height="100" width="100">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="certificate_image"><strong>Image&nbsp;<span class="mark">*</span></strong></label>
                                                <input class="form-control" type="file" name="certificate_image">
                                                <p style="color: red;"><strong>Notice: </strong>image format must be JPG,JPEG,PNG</p>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="certificate_status"><strong>Status</strong></label><br>
                                                @if($certificate_edit->certificate_status == "Active")
                                                    <input type="checkbox" name="certificate_status" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                                @else
                                                    <input type="checkbox" name="certificate_status" data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        $("#certificate").addClass("active");
        $("input[data-bootstrap-switch]").each(function(){
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });
    });
</script>
@endsection
