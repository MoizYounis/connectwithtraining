@extends('admin.layouts.master')
@section('title')Forum Reply | Forums @endsection
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void();"></a>Forum Reply</li>
                </ol>
            </div>
         
            <div class="col-sm-3">
                <div class="btn-group float-sm-right">
                    <a href="{{route('forum.create')}}" class="btn btn-behance text-white btn-sm waves-effect waves-light add_data"><i class="fa fa-plus mr-1"></i> Add Forum </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div id="messages"></div>
                <div class="card">
                    <div class="card-header"><i class="zmdi zmdi-receipt"></i> Forum Reply</div>
                    <div class="card-body">

                        @if(count($reply_list) > 0)
                            <ul class="list-group list-group-flush">
                                <h3>{{ucfirst($reply_list[0]->forum_title)}}</h3>
                                @foreach($reply_list as $row)
                                    <li class="list-group-item">
                                        <div class="media align-items-center">
                                            @if($row->image == '')
                                                <img src="{{asset('public/assets/admin/images/avatars/avtar.png')}}" alt="user avatar" class="customer-img rounded-circle">
                                            @else
                                                <img src="{{asset('public/assets/front/img/user').'/'.$row->image}}" alt="user avatar" class="customer-img rounded-circle">
                                            @endif
                                            <div class="media-body ml-3">
                                                <p class=""><strong><i class="fa fa-comment-o"></i> {{ucfirst($row->reply)}}.</strong></p>
                                                <p><i class="icon-user icons"></i> {{$row->email}} | <i class="icon-location-pin icons"></i>{{ucwords($row->state)}} | <i class="icon-calendar icons"></i> {{$row->created_at}}</p>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            No Replies Found.
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
        $("#forum").addClass("active");
    </script>
@endsection