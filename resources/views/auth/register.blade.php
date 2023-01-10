@extends('front.layouts.master')
@section('title')User Login | Maatisu @endsection
@section('content')

    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="container">   
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <!-- <h3>Register</h3> -->
                        <ul>
                            <li><a href="{{route('home')}}">home</a></li>
                            <li>Register</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>         
    </div>
    <!--breadcrumbs area end-->

    <!-- customer login start -->
    <div class="customer_login">
        <div class="container">
            <div class="row">
               <!--login area start-->
                <div class="col-lg-6 col-md-6 offset-md-3">
                    <div class="account_form">
                        <h2>Register</h2>
                        @if(\Session::has('success'))
                            <div class="alert alert-success" id="msg_div" style="width: 100%;">
                                {{ \Session::get('success') }}
                            </div>
                        @endif
                        <form action="{{ route('register') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <p>
                                        <label>First Name <span>*</span></label>
                                        @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong style="color: red;">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <input type="text" name="first_name" value="{{old('first_name')}}" autofocus="" placeholder="First Name" value="{{old('first_name')}}">
                                    </p>
                                </div>
                                <div class="col-sm-6">
                                    <p>
                                        <label>Last Name <span>*</span></label>
                                        @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong style="color: red;">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <input type="text" name="last_name" value="{{old('last_name')}}" placeholder="Last Name" value="{{old('last_name')}}">
                                    </p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <p>
                                        <label>Email <span>*</span></label>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong style="color: red;">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <input type="email" name="email" value="{{old('email')}}" autofocus="" placeholder="Email" value="{{old('email')}}">
                                    </p>
                                </div>
                                <div class="col-sm-6">
                                    <p>
                                        <label>Phone <span>*</span></label>
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong style="color: red;">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <input type="number" name="phone" value="{{old('phone')}}" placeholder="Phone" value="{{old('phone')}}">
                                    </p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <p>
                                        <label>Password <span>*</span></label><br>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong style="color: red;">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <input type="password" name="password" placeholder="Password">
                                    </p>
                                </div>
                            </div>
                                
                            <div class="login_submit">
                                <a href="{{route('login')}}">Have an account?</a>                                
                                <button type="submit">Register</button>                                
                            </div>

                        </form>
                     </div>    
                </div>
                <!--login area start-->

                <!--register area start-->
                <!-- <div class="col-lg-6 col-md-6">
                    <div class="account_form register">
                        <h2>Register</h2>
                        <form action="#">
                            <p>   
                                <label>Email address  <span>*</span></label>
                                <input type="text">
                             </p>
                             <p>   
                                <label>Passwords <span>*</span></label>
                                <input type="password">
                             </p>
                            <div class="login_submit">
                                <button type="submit">Register</button>
                            </div>
                        </form>
                    </div>    
                </div> -->
                <!--register area end-->
            </div>
        </div>    
    </div>
    <!-- customer login end -->

@endsection
