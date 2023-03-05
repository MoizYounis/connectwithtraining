@extends('front.layouts.master')
@section('title')
    User SignIn & SignUp | {{ $gs->title }}
@endsection
@section('content')
    <section class="breadcrums">
        <div class="container" style="max-width: 1223px;">
            <h2>Sign In & Sign Up</h2>
        </div>
    </section>

    <section class="signin signin_log_pg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="login-box">
                        <div class="thread">
                            <img src="{{ asset('public/assets/front/images/thread.png') }}">
                        </div>
                        <div class="form-wrap">
                            <div class="tabs">
                                {{-- <h3 class="signup-tab"><a href="#signup-tab-content">SIGNUP</a></h3> --}}
                                {{-- <h3 class="login-tab"><a class="active" href="#login-tab-content">LOGIN</a></h3> --}}
                                <h3 class="forget-tab"><a class="active" href="#forget-tab-content">FORGET PASSWORD</a></h3>
                            </div>
                            <!--.tabs-->

                            <div class="tabs-content">
                                <div id="signup-tab-content">

                                    <form class="signup-form" action="{{ route('register') }}" method="post">
                                        <div class="fb_icon">
                                            <?php $social = json_decode($gs->social_links); ?>
                                            <ul>
                                                <li><a target="_blank" href="{{ $social->facebook }}"><img
                                                            src="{{ asset('public/assets/front/images/sos1.png') }}"></a>
                                                </li>
                                                <li><a target="_blank" href="{{ $social->twitter }}"><img
                                                            src="{{ asset('public/assets/front/images/sos2.png') }}"></a>
                                                </li>
                                                <li><a target="_blank" href="{{ $social->google }}"><img
                                                            src="{{ asset('public/assets/front/images/sos3.png') }}"></a>
                                                </li>
                                            </ul>
                                        </div>
                                        @csrf
                                        <div class="ipt_bx">
                                            <input type="text" name="first_name" value="{{ old('first_name') }}"
                                                class="input" id="first_name" autocomplete="off" placeholder="First Name">
                                            <span><img
                                                    src="{{ asset('public/assets/front/images/input-ico1.png') }}"></span>
                                        </div>
                                        <div class="ipt_bx">
                                            <input type="text" name="last_name" value="{{ old('last_name') }}"
                                                class="input" id="last_name" autocomplete="off" placeholder="Last Name">
                                            <span><img
                                                    src="{{ asset('public/assets/front/images/input-ico2.png') }}"></span>
                                        </div>
                                        <div class="ipt_bx">
                                            <input type="text" name="email" value="{{ old('email') }}" class="input"
                                                id="user_email" autocomplete="off" placeholder="Email">
                                            <span><img
                                                    src="{{ asset('public/assets/front/images/input-ico2.png') }}"></span>
                                        </div>
                                        <!-- <div class="ipt_bx">
                                                <input type="text" name="phone" value="{{ old('phone') }}" class="input" id="user_email" autocomplete="off" placeholder="Phone">
                                                <span><img src="{{ asset('public/assets/front/images/input-ico4.png') }}"></span>
                                            </div> -->
                                        <div class="ipt_bx">
                                            <input type="password" class="input" name="password" id="user_pass"
                                                autocomplete="off" placeholder="Password">
                                            <span><img
                                                    src="{{ asset('public/assets/front/images/input-ico3.png') }}"></span>
                                        </div>
                                        <div class="ipt_bx">
                                            <input type="password" class="input" name="password_confirmation"
                                                id="user_pass" autocomplete="off" placeholder="Confirm Password">
                                            <span><img
                                                    src="{{ asset('public/assets/front/images/input-ico4.png') }}"></span>
                                        </div>
                                        <div class="help-text">
                                            <p>By signing up, you agree to our <a
                                                    href="{{ url('terms-conditions') }}">Terms of service</a></p>
                                            <!--  <p><a href="{{ url('terms-conditions') }}">Terms of service</a></p> -->
                                        </div>
                                        <div class="iput_sub_btn iput_sub_btn1">
                                            <input type="submit" class="button" value="">
                                        </div>

                                    </form>
                                    <!--.login-form-->
                                    <!--.help-text-->
                                </div>
                                <!--.signup-tab-content-->

                                <div id="login-tab-content">
                                    <form class="login-form" action="{{ route('login') }}" method="post">
                                        @csrf
                                        <div class="ipt_bx">
                                            <input type="text" name="email" value="{{ old('email') }}" class="input"
                                                id="user_login" autocomplete="off" placeholder="Username">
                                            <span><img
                                                    src="{{ asset('public/assets/front/images/input-ico1.png') }}"></span>
                                        </div>
                                        <div class="ipt_bx">
                                            <input type="password" class="input" id="user_pass" name="password"
                                                autocomplete="off" placeholder="Password">
                                            <span><img
                                                    src="{{ asset('public/assets/front/images/input-ico4.png') }}"></span>
                                        </div>
                                        <div class="log_rem">
                                            <div><input type="checkbox" class="checkbox" id="remember_me"
                                                    name="remember" checked>
                                                <label for="remember_me">Remember me</label>
                                            </div>

                                            <div><a href="{{ url("user_forgot_password") }}">Forgot Password</a></div>
                                        </div>
                                        <div class="iput_sub_btn iput_sub_btn2">
                                            <input type="submit" class="button" value="">
                                        </div>
                                        <!--  <input type="submit" class="button" value="Login"> -->
                                    </form>
                                </div>
                                <div id="forget-tab-content" class="active">
                                    <form class="login-form" action="{{ route('login') }}" method="post">
                                        @csrf
                                        <div class="ipt_bx">
                                            <input type="password" class="input" id="user_pass" name="password"
                                                autocomplete="off" placeholder="Old Password">
                                            <span><img
                                                    src="{{ asset('public/assets/front/images/input-ico4.png') }}"></span>
                                        </div>
                                        <div class="ipt_bx">
                                            <input type="password" class="input" id="user_pass" name="password"
                                                autocomplete="off" placeholder="New Password">
                                            <span><img
                                                    src="{{ asset('public/assets/front/images/input-ico4.png') }}"></span>
                                        </div>
                                        <div class="ipt_bx">
                                            <input type="password" class="input" id="user_pass" name="password"
                                                autocomplete="off" placeholder="Confirm New Password">
                                            <span><img
                                                    src="{{ asset('public/assets/front/images/input-ico4.png') }}"></span>
                                        </div>
                                        <div class="iput_sub_btn iput_sub_btn3">
                                            <input type="submit" class="button" value="">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!--.tabs-content-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="cwt-image">
                <h4>We make it easy <br>When you forget your password</h4>
                <img src="{{ asset('public/assets/front/images/signup-image.png') }}">
            </div>
            
            <div class="forgot-form" id="ForgetPassword">
                <div class="thread">
                    <img src="{{ asset('public/assets/front/images/thread.png') }}">
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
            </div> -->

        <div class="verify-account" style="display:none;">
            <div class="sign-popup">
                <div class="sign-form">
                    <i style="right: 25.5%;" class="fa fa-times-circle" aria-hidden="true"></i>
                    <h2>Verify Your Account!</h2>
                    <p>A confirmation Code has been sent to your email.</p>
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
        $(document).ready(function() {
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
