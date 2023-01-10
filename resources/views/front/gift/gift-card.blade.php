@extends('front.layouts.master')
@section('title')Gift Card | {{$gs->title}} @endsection
@section('content')

<section class="breadcrums">
    <div class="container" style="max-width: 1223px;">
        <h2>Gift Card</h2>    
    </div>
</section>

<div class="gift-card">
    <div class="container">
        <div class="confirmation">
            <div class="con-img">
                <img src="{{asset('public/assets/front/images/thread.png')}}">
            </div>
            <div class="con-text">
                <h2>Confiramtion</h2>
                <div class="con-form">
                    <div class="con-text">
                        <label>Send Gifts to</label>
                        <input type="text" name="" placeholder="johnspencer@yahoo.com">
                    </div>
                    <div class="con-text">
                        <label>Send receipt to</label>
                        <input type="text" name="" placeholder="Nmasweet@yahoo.com">
                    </div>
                    <div class="terms">
                        <input type="checkbox" name="" style="width: auto;">
                        <p>I agree to the <a href=""> terms and conditions </a>and <a href=""> privacy policy</a></p>
                    </div>
                    <div class="con-btn">
                        <a href="">purchase</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection