@extends('admin.layouts.master')
@section('title')Edit Banner | Categories @endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Banner</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Banners</li>
                        <li class="breadcrumb-item"><a href="{{route('banner_list')}}" class="btn btn-primary btn-sm float-right">Banner List</a></li>
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
                                <form action="{{route('update_banner', [$banner_edit[0]->banner_id])}}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="banner_name"><strong>Banner Name&nbsp;<span class="mark">*</span></strong></label>
                                                <input class="form-control" type="text" name="banner_name"  value="{{$banner_edit[0]->banner_name}}" placeholder="Enter Banner Name" id="banner_name">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="banner_title"><strong>Banner Title&nbsp;<span class="mark">*</span></strong></label>
                                                <input class="form-control" type="text" name="banner_title"  value="{{$banner_edit[0]->banner_title}}" placeholder="Enter Banner Title" id="banner_title">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="banner_url"><strong>Banner Url&nbsp;<span class="mark">*</span></strong></label>
                                                <input class="form-control" type="text" name="banner_url"  value="{{$banner_edit[0]->banner_url}}" placeholder="Enter Banner Url" id="banner_url">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="banner_desc"><strong>Banner Description&nbsp;<span class="mark">*</span></strong></label>
                                                <textarea rows="5" class="form-control" name="banner_desc" placeholder="Enter Banner Description" id="banner_desc">{{$banner_edit[0]->banner_desc}}</textarea>
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="banner_img"><strong>Image</strong></label><br>
                                                @if(!empty($banner_edit[0]->banner_img))
                                                    <img src="{{ asset('public/assets/banner/')}}/{{$banner_edit[0]->banner_img }}" height="80" width="80">
                                                @endif

                                                <input class="form-control" type="file" name="banner_img">
                                                <p style="color: red;"><strong>Notice: </strong>image format must be JPG,JPEG,PNG</p>
                                            </div>
                                        </div>
                                    
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="banner_status">Status</label><br>
                                                @if($banner_edit[0]->banner_status == 'Active')
                                                    <input type="checkbox" name="banner_status" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                                @else
                                                    <input type="checkbox" name="banner_status" data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary">Update Banner</button>
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
        $("#banner").addClass("active");
        $("input[data-bootstrap-switch]").each(function(){
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });
    });
</script>
@endsection
