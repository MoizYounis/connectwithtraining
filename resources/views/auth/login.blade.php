@extends('front.layouts.master')
@section('title')User SignIn & SignUp | {{$gs->title}} @endsection
@section('content')
        
    <section class="breadcrums">
        <div class="container" style="max-width: 1223px;">
            <h2>Sign In & Sign Up</h2>    
        </div>
    </section>

    <section class="signin">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="login-box">
                        <div class="thread">
                            <img src="{{asset('public/assets/front/images/thread.png')}}">
                        </div>
                       <div class="form-wrap">
                            <div class="tabs">
                                <h3 class="signup-tab"><a href="#signup-tab-content">Sign Up</a></h3>
                                <h3 class="login-tab"><a class="active" href="#login-tab-content">Login</a></h3>
                            </div><!--.tabs-->

                            <div class="tabs-content">
                                <div id="signup-tab-content">
                                    <form class="signup-form" action="{{ route('register') }}" method="post">
                                        @csrf
                                        <input type="text" name="first_name" value="{{ old('first_name') }}" class="input" id="user_name" autocomplete="off" placeholder="First Name">
                                        <input type="text" name="last_name" value="{{ old('last_name') }}" class="input" id="user_name" autocomplete="off" placeholder="Last Name">
                                        <input type="text" name="email" value="{{ old('email') }}" class="input" id="user_email" autocomplete="off" placeholder="Email">
                                        <input type="text" name="phone" value="{{ old('phone') }}" class="input" id="user_email" autocomplete="off" placeholder="Phone">
                                        <input type="password" class="input" name="password" id="user_pass" autocomplete="off" placeholder="Password">
                                        <input type="submit" class="button" value="Sign Up">
                                    </form><!--.login-form-->
                                    <div class="help-text">
                                        <p>By signing up, you agree to our</p>
                                        <p><a href="{{url('terms-conditions')}}">Terms of service</a></p>
                                    </div><!--.help-text-->
                                </div><!--.signup-tab-content-->

                                <div id="login-tab-content" class="active">
                                    <form class="login-form" action="{{ route('login') }}" method="post">
                                        @csrf
                                        <input type="text" name="email" value="{{ old('email') }}" class="input" id="user_login" autocomplete="off" placeholder="Email">
                                        <input type="password" class="input" id="user_pass" name="password" autocomplete="off" placeholder="Password">
                                        <input type="checkbox" class="checkbox" id="remember_me" name="remember" checked>
                                        <label for="remember_me">Remember me</label><br>
                                        <div style="margin-top: 10px; margin-bottom: 10px;"><a href="#ForgetPassword">Forgot Password</a></div>
                                        <input type="submit" class="button" value="Login">
                                    </form>
                                </div>
                            </div><!--.tabs-content-->
                        </div> 
                    </div>
                </div>
            </div>
        </div>
        <div class="cwt-image">
            <h4>We make it easy <br>When you forget your password</h4>
            <img src="{{asset('public/assets/front/images/signup-image.png')}}">
        </div>
        
        <div class="forgot-form" id="ForgetPassword">
            <div class="thread">
                <img src="{{asset('public/assets/front/images/thread.png')}}">
            </div>
            <h2 class="forgot-pas">Forgot Password</h2>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
           <form class="login-form" action="{{ route('password.email') }}" method="post">
                @csrf
                <input type="text" name="email" value="{{ old('email') }}" class="input" id="user_login" autocomplete="off" placeholder="Enter Your Email">
                <input type="submit" class="button" value="Submit">
            </form>
        </div>
        
        <div class="verify-account" style="display:none;">
            <div class="sign-popup">
                <div class="sign-form">
                    <i style="right: 25.5%;" class="fa fa-times-circle" aria-hidden="true"></i>
                    <h2>Verify Your Account!</h2>
                    <p>A confirmation Code has been sent to your  email.</p>
                    <div class="con-code">
                        <h3>Confirmation Code:</h3>
                        <input type="text" name="">
                    </div>
                    <div class="con-code">
                        <p>Resend my confirmation code</p>
                        <div class="con-code-btn">
                            <a href="">Confirm</a>
                            <a href="">Cancel</a>
                        </div>
                    </div>
                </div>
                <div class="sign-ribbion">
                    <h1><span>xxxxx</span> <br>xxxxxxx</h1>
                </div>
            </div>
        </div>
        
    </section>
    
    
@endsection
@section('script')
<script>
$(document).ready(function(){
    tab = $('.tabs h3 a');

    tab.on('click', function(event) {
        event.preventDefault();
        tab.removeClass('active');
        $(this).addClass('active');

        tab_content = $(this).attr('href');
        $('div[id$="tab-content"]').removeClass('active');
        $(tab_content).addClass('active');
    });
});
</script>
@endsection