@extends('admin.layouts.master')
@section('title')Edit Variant | Variants @endsection
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void();">Edit Variant</a></li>
                </ol>
            </div>
         
            <div class="col-sm-3">
                <div class="btn-group float-sm-right">
                    <a href="{{route('variant.index')}}" class="btn btn-behance text-white btn-sm"> <i class="waves-effect waves-light add_data"></i> Variant List </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div id="messages"></div>
                <div class="card">
                    <div class="card-header"><i class="zmdi zmdi-view-dashboard"></i> Update Variant</div>
                    <div class="card-body">
                        <form method="post" action="{{route('variant.update', [$var_edit->id])}}"  enctype="multipart/form-data">
                            @csrf
                            {{ method_field('PATCH') }}
                            <div class="row">

                              <div class="form-group col-md-12">
                                <label>Variant Name*</label>
                                <input type="text" class="form-control input-check" name="variant_name" id="variant_name" placeholder="Enter Variant Name" value="{{$var_edit->variant_name}}" required="">
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
    </script>
@endsection