@extends('admin.layouts.master')
@section('content')
<div class="content p-4">
    <h2 class="mb-4" style="text-transform: uppercase;"> Manage Payments
    </h2>
    <div class="card mb-4">
        <div class="card-body">
           <div class="table-responsive">
              <table id="dataTableExample" class="table table-hover table-bordered" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                          <th>Order Id</th>
                          <th>RazorPay Id</th>
                          <th>Name</th>
                          <th>Amount</th>
                          <th>Message</th>
                          <th>Date</th>
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($pay_list as $row)
                      <tr>
                          <td>{{ $row->ORDERID }}</td>
                          <td>{{ $row->razorpay_payment_id }}</td>
                          <td>{{ ucwords($row->first_name.' '.$row->last_name) }}</td>
                          <td>{{ $row->TXNAMOUNT }}</td>
                          <td>{{ $row->RESPMSG}}</td>
                          <td>{{ $row->created_at}}</td>
                          <td>
                              @if($row->STATUS  == 'TXN_FAILURE')
                              <span class="badge badge-danger">FAILURE</span>
                              @else
                              <span class="badge badge-success">SUCCESS</span>
                              @endif
                          </td>
                          <td>
                            <form method="post" class="delete_form" action="{{ action('Admin\PayController@destroy', $row->payment_id) }}">
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
        $("#pay").addClass("show");
        $("#pay").addClass("active");
        //$('#table').DataTable();
    });
</script>
@endsection
