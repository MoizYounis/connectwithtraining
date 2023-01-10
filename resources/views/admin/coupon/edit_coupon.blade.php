@extends('admin.layouts.master')
@section('content')
<div class="content p-4">
    <h2 class="mb-4" style="text-transform: uppercase;">Update Coupon
        <a href="{{ route('coupon.index') }}" class="btn btn-primary btn-md float-right">
            <i class="fa fa-list"></i>   View Coupons
        </a>
    </h2><br>
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{route('coupon.update', [$edit->coupon_id])}}" method="post">
                @csrf
                {{ method_field('PATCH') }}
                <div class="col-md-12  container-fluid">
                    <div class="form-group">
                        <label for="coupon_code" style="text-transform: uppercase;"><strong>Coupon Code&nbsp;<span class="mark">*</span></strong></label>
                        <input class="form-control form-control-lg mb-3" type="text" name="coupon_code"  value="{{$edit->coupon_code}}" placeholder="Enter Coupon" id="coupon_code">
                    </div>
                </div>

                <div class="col-md-12  container-fluid">
                    <div class="form-group">
                        <label for="amount" style="text-transform: uppercase;"><strong>Amount&nbsp;<span class="mark">*</span></strong></label>
                        <input class="form-control form-control-lg mb-3" type="number" name="amount"  value="{{$edit->amount}}" placeholder="Enter Coupon Amount" id="amount">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="coupon_status" style="text-transform: uppercase;"><strong>Status</strong></label>
                        @if($edit->coupon_status == "Active")
                        <input type="checkbox" data-onstyle="success" data-offstyle="danger" data-width="100%" data-on="Active" data-off="Inactive" data-toggle="toggle" name="coupon_status" checked="">
                        @else
                        <input type="checkbox" data-onstyle="success" data-offstyle="danger" data-width="100%" data-on="Active" data-off="Inactive" data-toggle="toggle" name="coupon_status">
                        @endif
                    </div>
                </div>

                <br>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-block btn-lg">Update Coupon</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#coupon").addClass("show");
        $("#coupon").addClass("active");
    });
</script>
@endsection
