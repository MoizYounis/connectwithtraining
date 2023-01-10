@extends('admin.layouts.master')
@section('title')Add Brand | Brands @endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Brand</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Add Brand</li>  
                        <li class="breadcrumb-item"><a href="{{route('brand.index')}}" class="btn btn-primary btn-sm float-right">Brand List</a></li>
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
                            <form action="{{route('brand.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="brand_name">Brand Name*</label>
                                            <input class="form-control" type="text" name="brand_name"  value="{{old('brand_name')}}" placeholder="Enter Brand Name" id="brand_name">
                                            <p style="color: red;"><strong>Notice: </strong>Special characters not allowed</p>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="brand_logo">Brand Logo*</label>
                                            <input class="form-control" type="file" name="brand_logo">
                                            <p style="color: red;"><strong>Notice: </strong>image format must be JPG,JPEG,PNG</p>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="brand_banner">Brand Banner*</label>
                                            <input class="form-control" type="file" name="brand_banner">
                                            <p style="color: red;"><strong>Notice: </strong>image format must be JPG,JPEG,PNG</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="brand_name">Meta Title</label>
                                            <input class="form-control" type="text" name="brand_meta_title"  value="{{old('brand_meta_title')}}" placeholder="Enter Meta Title" id="brand_meta_title">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="brand_meta_desc">Meta Description</label>
                                            <textarea rows="5" class="form-control" name="brand_meta_desc" placeholder="Enter Meta Description" id="brand_meta_desc">{{old('brand_meta_desc')}}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="brand_status">Status</label>
                                            <input type="checkbox" name="brand_status" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">Create New Brand</button>
                                    </div>
                                </div>
                            </form>
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
        $("#brand").addClass("active");
        $("input[data-bootstrap-switch]").each(function(){
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });
    });
</script>
@endsection