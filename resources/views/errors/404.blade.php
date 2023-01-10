@extends('front.layouts.master')
@section('title') 404 Page Not Found | {{$gs->title}} @endsection
@section('content')
    <!--error section area start-->
    <section class="error">
        <div class="error-text">
            <div class="error-img">
                <img src="{{asset('public/assets/front/images/error-img.png')}}">
                <h2>Oooooh Noooooo…</h2>
                <p>This is not what I am looking for…<br>
                BUT Don’t worry, we are always thinking of you!</p>
            </div>
            <div class="next-btn">
                <div class="return-btn">
                    <a href="{{ url()->previous() }}">Return to Previous Page</a>
                </div>
                <div class="lines">
                    <div class="retunr-line">
                       <img src="{{asset('public/assets/front/images/line1.png')}}"> 
                    </div> 
                    <div class="support-line">
                        <img src="{{asset('public/assets/front/images/line2.png')}}">
                    </div>
                </div>
                <div class="support-btn">
                    <a href="{{route('home')}}">Go to Home Page</a>
                </div> 
            </div>
        </div>
    </section>
    <!--error section area end-->

@endsection