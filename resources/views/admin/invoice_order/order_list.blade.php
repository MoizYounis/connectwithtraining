@extends('admin.layouts.master')
@section('content')
<div class="content p-4">
    <h2 class="mb-4" style="text-transform: uppercase;"> Manage Orders
    </h2>
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive">
              <table id="dataTableExample" class="table table-hover table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Invoice No</th>
                        <th>Order No</th>
                        <th>User Detail</th>
                        <th>Amount</th>
                        <th>Address</th>
                        <th>Coupon</th>
                        <th>Status</th>
                        <th>Customized</th>
                        <th>Delivery Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order_list as $row)
                        <tr>
                            <td>{{ $row->invoice_order_id }}</td>
                            <td>{{ $row->invoice_no }}</td>
                            <td>Name : {{ ucwords($row->name) }}</br>
                                Mobile : {{ ucwords($row->phone) }}</br>
                                Id : {{ ucwords($row->email) }}</td>
                            <td>{{ $row->total_price }}</td>
                            <td>{{ $row->address }}</td>
                            <td>
                                @if(!empty($row->coupon_id))
                                <strong>Code : </strong>{{ $row->coupon_code }}<br>
                                <strong>Amount : </strong>{{ $row->amount }}
                                @endif
                            </td>
                            <td>
                                @if($row->order_status  == 'pending')
                                    <a href="{{url('admin/order/status/update', [$row->invoice_order_id, 'complete'])}}"><button class="btn btn-sm btn-info">{{$row->order_status}}</button></a>
                                @endif
                                @if($row->order_status  == 'complete')
                                    <a href="{{url('admin/order/status/update', [$row->invoice_order_id, 'pending'])}}"><button class="btn btn-sm btn-success">{{$row->order_status}}</button></a>
                                @endif
                                @if($row->order_status  == 'cancel')
                                    <span class="badge badge-danger">{{$row->order_status}}</span><br>
                                    {{ucwords($row->cancel_reason)}}
                                @endif
                                @if($row->order_status  == 'return')
                                    <span class="badge badge-alert">{{$row->order_status}}</span>
                                @endif
                            </td>
                            <td>
                                @if($row->num_of_img != "")
                                <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#custom_{{$row->invoice_no}}">Cust. Detail</button>
                                <div class="modal fade" id="custom_{{$row->invoice_no}}" role="dialog" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">View Customized Detail</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <table id="table" class="table table-hover table-bordered" style="overflow-y:scroll; overflow-x:scroll; height:380px; display:block; width: 100%;">
                                                    <tr>
                                                        <th>Product</th>
                                                        <th>Img1</th>
                                                        <th>Img2</th>
                                                        <th>Img3</th>
                                                        <th>Img4</th>
                                                        <th>Img5</th>
                                                        <th>Img6</th>
                                                        <th>Img7</th>
                                                        <th>Img8</th>
                                                        <th>Img9</th>
                                                        <th>Img10</th>
                                                        <th>Text</th>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ucwords($row->product_name)}}</td>
                                                        <td>
                                                            @if($row->img1 != '')
                                                                <img src="{{asset('public/assets/custmize_product').'/'.$row->img1}}" width="60" height="60">
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($row->img2 != '')
                                                                <img src="{{asset('public/assets/custmize_product').'/'.$row->img2}}" width="60" height="60">
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($row->img3 != '')
                                                                <img src="{{asset('public/assets/custmize_product').'/'.$row->img3}}" width="60" height="60">
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($row->img4 != '')
                                                                <img src="{{asset('public/assets/custmize_product').'/'.$row->img4}}" width="60" height="60">
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($row->img5 != '')
                                                                <img src="{{asset('public/assets/custmize_product').'/'.$row->img5}}" width="60" height="60">
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($row->img6 != '')
                                                                <img src="{{asset('public/assets/custmize_product').'/'.$row->img6}}" width="60" height="60">
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($row->img7 != '')
                                                                <img src="{{asset('public/assets/custmize_product').'/'.$row->img7}}" width="60" height="60">
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($row->img8 != '')
                                                                <img src="{{asset('public/assets/custmize_product').'/'.$row->img8}}" width="60" height="60">
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($row->img9 != '')
                                                                <img src="{{asset('public/assets/custmize_product').'/'.$row->img9}}" width="60" height="60">
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($row->img10 != '')
                                                                <img src="{{asset('public/assets/custmize_product').'/'.$row->img10}}" width="60" height="60">
                                                            @endif
                                                        </td>
                                                        <td>{{ $row->img_text }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </td>
                            <td>{{ date('d-M-Y',strtotime($row->del_date)) }}</td>
                            <td>
                                <a href="{{url('admin/order/detail', [$row->invoice_order_id])}}" class="btn btn-info btn-sm">Show Details</a>
                                <form method="post" class="delete_form" action="{{ route('order.destroy', $row->invoice_no) }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="Delete">
                                    <button type="submit" class="btn btn-danger btn-sm" style="margin-top: 2px;"><i class="fa fa-trash-alt"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('.delete_form').on('submit', function(){
            if(confirm("Are you sure you want to delete it..?")){
                return true;
            }
            else{
                return false;
            }
        });
      
        $("#order").addClass("show");
        $("#order").addClass("active");
        // $('#table').DataTable();
    });
</script>
@endsection
