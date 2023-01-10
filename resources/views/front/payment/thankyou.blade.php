@extends('front.layouts.master')
@section('title')Thankyou For Placing Order | {{$gs->title}} @endsection
@section('content')

<section class="breadcrums">
    <div class="container" style="max-width: 1223px;">
        <h2>Training Checkout Thankyou</h2>    
    </div>
</section>
<div class="checkout-thankyou">
    <div class="container">
        <div class="checkout-bg">
            <div class="con-img">
                <img src="{{asset('public/assets/front/images/thread.png')}}">
            </div>
            <div class="con-text">
                <h2>Thank You</h2>
                <p>Your Order Has been Placed</p>
                <div class="con-form">
                    <div class="checkout-info">
                        <h2>Order Details Sent to</h2>
                        <h3>{{Auth::user()->email}}</h3>
                    </div>
                    <div class="thnakyou-btn">
                        <a href="{{url('courses')}}">Keep Shopping</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

@endsection