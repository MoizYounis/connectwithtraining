@extends('admin.layouts.master')
@section('title')Faq List | Faq @endsection
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void();">Faq</a></li>
                </ol>
            </div>
         
            <div class="col-sm-3">
                <div class="btn-group float-sm-right">
                    <a href="{{route('faq.create')}}" class="btn btn-behance text-white btn-sm waves-effect waves-light add_data"><i class="fa fa-plus mr-1"></i> Add Faq</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div id="messages"></div>
                <div class="card">
                    <div class="card-header"><i class="zmdi zmdi-help-outline"></i> Faq</div>
                    <div class="card-body">
                        @if($faq->faq_filetype == "Video")
                            <video width="400">
                                <source src="{{asset('public/assets/front/img/faq')}}/{{$faq->faq_file}}" type="video/mp4">
                            </video>
                        @else
                            <embed src="{{asset('public/assets/front/img/faq')}}/{{$faq->faq_file}}"
                                type="application/pdf" 
                                height="100%"></embed>
                        @endif
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
        $("#course").addClass("active");
        $(document).ready(function () {
            
        });
    </script>
@endsection