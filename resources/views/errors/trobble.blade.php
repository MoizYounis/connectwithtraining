@extends('front.layouts.master')
@section('content')
<section class="page-header error-page lighten-4" style="background: url({{ asset('public/assets/frontend/images/cover-1.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <h2>Error..</h2>
                    <h6>Something went wrong please try again later...</h6>
                    <div class="row m-t-50">
                        <div class="col-sm-6 m-b-15 col-sm-offset-3">
                            <a href="{{route('home')}}" class="btn btn-primary btn-lg btn-block">Go to Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection