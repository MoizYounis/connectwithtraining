@extends('admin.layouts.master')
@section('title')Tickets Reply | Tickets @endsection
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void();"></a>Tickets Reply</li>
                </ol>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><i class="zmdi zmdi-ticket-star"></i> Tickets Reply</div>
                    <div class="card-body">                        
                        <ul class="list-group list-group-flush">
                            <h4>{{ucfirst($ticket->ticket_title)}}</h4>
                            <li class="list-group-item">
                                <div class="media align-items-center">
                                    @if($ticket->image == '')
                                        <img src="{{asset('public/assets/admin/images/avatars/avtar.png')}}" alt="user avatar" class="customer-img rounded-circle">
                                    @else
                                        <img src="{{asset('public/assets/front/img/user').'/'.$ticket->image}}" alt="user avatar" class="customer-img rounded-circle">
                                    @endif
                                    <div class="media-body ml-3">
                                        <p class=""><strong><i class="fa fa-comment-o"></i> {{ucfirst($ticket->ticket_details)}}.</strong></p>
                                        <p><i class="icon-user icons"></i> {{$ticket->email}} | 
                                        <i class="icon-calendar icons"></i> {{date("d-M-Y h:sa", strtotime($ticket->created_at))}}</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="my-4">
                            <h6>Reply :</h6>
                            @if(count($reply_list) > 0)
                                @foreach($reply_list as $row)
                                    <p><strong><i class="fa fa-comment-o"></i> {{ucfirst($row->reply)}}.</strong></p>
                                    <p><i class="icon-calendar icons"></i> {{date("d-M-Y h:sa", strtotime($row->created_at))}}</p>
                                @endforeach
                            @else
                                No Replies Found.
                            @endif
                            <hr>
                            <form action="{{url('admin/ticket/sendReply')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <input type="hidden" name="ticket_id" value="{{$ticket->id}}">
                                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                    <textarea class="form-control" rows="4" placeholder="Enter Message..." name="reply"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Send" class="btn btn-sm btn-primary">
                                </div>
                            </form>
                        </div>
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
        $("#ticket").addClass("active");
    </script>

    <script type="text/javascript">
    $(document).ready(function(){      
        $(".ticket_status").change(function(){
            var ticket_status = $(this).val();
            var id = $(this).attr("data-id");
            $.ajax({
                url:"{{ url('admin/ticket/statusUpdate') }}",
                method:"get",
                data: {ticket_status:ticket_status, id:id},
                success:function(data)
                {
                    success_noti("Status Changed");
                }
            });
        });
    });
  </script>
@endsection