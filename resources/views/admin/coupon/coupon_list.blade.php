@extends('admin.layouts.master')
@section('content')
<div class="content p-4">
    <h2 class="mb-4" style="text-transform: uppercase;"> Coupons List
        <a href="{{route('coupon.create')}}" class="btn btn-primary btn-md float-right">
            <i class="fa fa-plus"></i>  Add Coupon
        </a>
    </h2><br>
    <div class="card mb-4">
        <div class="card-body">
          <div class="table-responsive">
            <table id="dataTableExample" class="table table-hover table-bordered" cellspacing="0" width="100%">
              <thead>
                  <tr>
                      <th>Sr.No.</th>
                      <th>Coupon Code</th>
                      <th>Amount</th>
                      <th>Status</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach($coupon as $row)
                  <tr>
                      <td>{{ $row->coupon_id }}</td>
                      <td>{{ $row->coupon_code }}</td>
                      <td>{{ $row->amount }}</td>
                      <td>
                          @if($row->coupon_status  == 'Active')
                          <span class="badge badge-success">Active</span>
                          @else
                          <span class="badge badge-danger">Inactive</span>
                          @endif
                      </td>
                      <td>
                          <a href="{{route('coupon.edit',[$row->coupon_id])}}" style="display:inline-block;"><button class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i> EDIT</button></a>
                          <form method="post" class="delete_form" action="{{ action('Admin\CouponController@destroy', $row->coupon_id) }}" style="display:inline-block;">
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

        $("#coupon").addClass("show");
        $("#coupon").addClass("active");
        //$('#table').DataTable();
    });
</script>
@endsection
