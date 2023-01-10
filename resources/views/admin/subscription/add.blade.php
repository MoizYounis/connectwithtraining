@extends('admin.layouts.master')
@section('title')Create Subscription | Subscriptions @endsection
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void();">Create Subscription</a></li>
                </ol>
            </div>
         
            <div class="col-sm-3">
                <div class="btn-group float-sm-right">
                    <a href="{{route('subscription.index')}}" class="btn btn-behance text-white btn-sm"> <i class="waves-effect waves-light add_data"></i> Subscription List </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div id="messages"></div>
                <div class="card">
                    <div class="card-header"><i class="zmdi zmdi-book"></i> Create Subscription</div>
                    <div class="card-body">
                        <form method="post" action="{{route('subscription.store')}}">
                            @csrf
                            <div class="row">                               

                                <div class="form-group col-md-4">
                                    <label>Select Payment Id*</label>
                                    <select name="payment_id" class="form-control input-check select2" id="payment_id" required="">
                                        @if(!old('payment_id'))
                                            <option value="">--Select Payment Id--</option>
                                        @endif
                                        @foreach($pay_list as $pay)
                                            @if(old('payment_id') == $pay->id)
                                                <option selected="" value="{{$pay->id}}">{{ucwords($pay->TXNID)}}</option>
                                            @else
                                                <option value="{{$pay->id}}">{{ucwords($pay->TXNID)}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Select User*</label>
                                    <select name="user_id" class="form-control input-check select2" id="user_id" required="">
                                        @if(!old('user_id'))
                                            <option value="">--Select User--</option>
                                        @endif
                                        @foreach($user_list as $users)
                                            @if(old('user_id') == $users->id)
                                                <option selected="" value="{{$users->id}}">{{ucwords($users->first_name.' '.$users->last_name)}}</option>
                                            @else
                                                <option value="{{$users->id}}">{{ucwords($users->first_name.' '.$users->last_name)}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Select Course*</label>
                                    <select name="course_id" class="form-control input-check select2" id="course_id" required="">
                                        @if(!old('course_id'))
                                            <option value="">--Select Course--</option>
                                        @endif
                                        @foreach($course_list as $course)
                                            @if(old('course_id') == $course->id)
                                                <option selected="" value="{{$course->id}}">{{ucwords($course->course_name)}}</option>
                                            @else
                                                <option value="{{$course->id}}">{{ucwords($course->course_name)}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                              <div class="form-group col-md-6">
                                <label>Subscription type*</label>
                                <input type="text" class="form-control input-check" name="subscribe_type" id="subscribe_type" placeholder="Enter Subscribe type" value="{{old('subscribe_type')}}">
                              </div>

                              <div class="form-group col-md-6">
                                <?php
                                    $dt = date('Y-m-d', strtotime(date('Y-m-d'). ' + 1 month'));
                                ?>
                                <label>Subscription Expire Date*</label>
                                <input type="date" class="form-control input-check" name="subscribe_expired_on" id="subscribe_expired_on" placeholder="Subscription Expire Date" value="{{$dt}}" required="">
                              </div>
                            </div>

                            <div class="row">
                              <div class="form-group col-md-12">
                                <button type="submit" id="submit_btn" class="btn btn-sm btn-success px-3"><i class="fa fa-arrow-circle-right"></i> Create</button>
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
    $(document).ready(function(){
        $("#subscription").addClass("active");
        $('.select2').select2();
    });        
  </script>
@endsection