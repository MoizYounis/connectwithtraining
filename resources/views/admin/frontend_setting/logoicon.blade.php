@extends('admin.layouts.master')
@section('title')Logo & Icon Setting | Website Setting @endsection
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Logo & Icon Setting</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Logo & Icon Setting</li>
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
                    @php
                    $gs = App\Model\General_setting::first();
                    @endphp
                    <form action="{{route('logoicon_update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                       
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="logo"><strong>Logo</strong></label>
                                    <input class="form-control" type="file" name="logo" >
                                    <small class="text-danger h6">[Image format: PNG]</small>
                                </div>
                                <img style="height: 50px;" class="thumbnail img-responsive" src="{{asset('public/assets/front/img/logo/'.$gs->logo)}}"/>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="favicon_icon"><strong>Favicon Icon</strong></label>
                                    <input class="form-control" type="file" name="favicon" >
                                    <small class="text-danger h6">[Image format: PNG]</small>
                                </div>
                                <img style="height: 50px;" class="thumbnail img-responsive" src="{{$gs->favicon}}"/>
                            </div>
                        </div>
                        <br>
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
    </section>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        $("#setting").addClass("active");
        $("#logo").addClass("active");
    });
</script>
@endsection