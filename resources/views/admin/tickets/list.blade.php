@extends('admin.layouts.master')
@section('title')Tickets List | Tickets @endsection
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void();"></a>Tickets</li>
                </ol>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><i class="zmdi zmdi-ticket-star"></i> Tickets</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table style="zoom:90%;" id="datatable" class="table table-bordered table-sm text-center">
                                <thead>
                                    <tr>
                                        <th>Sno.</th>
                                        <th>UserName</th>
                                        <th>Title</th>
                                        <th>Details</th>
                                        <th>Time</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ticket_list as $row)
                                        <tr>
                                            <td>{{$row->id}}</td>
                                            <td>{{ucwords($row->first_name.' '.$row->last_name)}}</td>
                                            <td>{{ucwords($row->ticket_title)}}</td>
                                            <td>{{$row->ticket_details}}</td>
                                            <td>{{date("d-M-Y h:i:sa", strtotime($row->created_at))}}</td>
                                            <td>
                                                <select class="form-control ticket_status" name="ticket_status" data-id="{{$row->id}}">
                                                    <option value="Open" {{($row->ticket_status == "Open") ? "selected":""}}>Open</option>
                                                    <option value="Closed" {{($row->ticket_status == "Closed") ? "selected":""}}>Closed</option>
                                                    <option value="Resolve" {{($row->ticket_status == "Resolve") ? "selected":""}}>Resolve</option>
                                                </select>
                                            </td>
                                            <td>
                                                <div class="btn-group m-1" role="group">
                                                    <button type="button" class="btn btn-behance btn-sm text-white waves-effect waves-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Action
                                                    </button>
                                                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 37px, 0px);">
                                                        
                                                        <a href="{{url('admin/ticket/reply', $row->id)}}" class="dropdown-item edit_data"><i class="fa fa-edit mr-1"></i> Reply</a>
                                                        
                                                        <div class="dropdown-divider"></div>

                                                        <form method="post" class="delete_form" action="{{ action('Admin\TicketController@destroy', $row->id) }}">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="_method" value="Delete">
                                                            <button type="submit" class="dropdown-item delete_data"><i class="fa fa-trash mr-1"></i> Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
        $(document).ready(function () {
            $('#datatable').DataTable();
            $('.delete_form').on('submit', function(){
                if(confirm("Are you sure you want to delete it..?")){
                    return true;
                }
                else{
                  return false;
                }
            });
        });
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