<!DOCTYPE html>

<html class="no-js" lang="en">

	<head>

		<meta name="description" content="description">

		<meta name="viewport" content="width=device-width, initial-scale=1">

		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">

		<title>@yield('title')</title>

		<!--favicon-->

  		<link rel="icon" href="{{asset('public/assets/front/img/logo/')}}/{{$gs->favicon}}" type="image/x-icon">

  		

  		    

  		<link rel="stylesheet" href="{{asset('public/assets/front/css/custom.css')}}">

  		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>

		<link rel="stylesheet" href="{{asset('public/assets/front/notifications/css/lobibox.min.css')}}"/>

		<!-- swiper slider -->
		<link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

		

		@if( Request::segment(1)=='' || Request::segment(1)=='courses' || Request::segment(1)=='cart' )

  	        

  	    @else

  	        <link rel="stylesheet" href="{{asset('public/assets/front/css/style.css')}}">

  	    @endif

    		

        <script src="{{asset('public/assets/front/js/jquery.min.js')}}"></script>

        <script src="{{asset('public/assets/front/js/jquery.bxslider.min.js')}}" type="text/javascript"></script>

		<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
        

	</head>

	<body>

	    <div class="page-wrapper">

		    <header id="header">

				<div class="header-top">

					<div class="panel wrapper">

						<div class="panel header">

							<div class="switcher country">

								<div class="head-top-drp country">
                                    
                                    <?php
                                        $user_currency = Helper::getCurrencyWithIp();
                                        $currency_list = Helper::getCurrencyList();
                                    ?>
									<select class="currencyList" onfocus='this.size=5;' onblur='this.size=0;' onchange="this.size=1; this.blur(); setCurrency(this, '{{csrf_token()}}')">
									    @foreach($currency_list as $key => $value)
									        <option value="{{$value}}" @if($key == $user_currency) selected @endif>{{$key}}</option>
									    @endforeach
									</select>
									
									<div class="flags_img"></div>

								</div>

							</div>

							<div class="switcher language switcher-language">

							    <div id="google_translate_element"></div>

								<!--<div class="head-top-drp lng">-->

								<!--	<select>-->

								<!--		<option>ENGLISH</option>-->

								<!--		<option>HINDI</option>-->

								<!--		<option>ARABIC</option>-->

								<!--	</select>-->

								<!--</div>-->

							</div>

						</div>

					</div>

				</div>

		    <!--End Top Header-->

		    <!--Header-->

		        <div class="header-bottom">

					<a class="logo" href="{{route('home')}}"><img src="{{asset('public/assets/front/images/logo.png')}}" alt=""/></a>

					<nav class="navbar">

						<div class="mob-menu">

							<span></span>

							<span></span>

							<span></span>

						</div>

						<ul class="nav navbar-nav">

							<li class=""><a href="{{url('coming-soon')}}">How it works</a></li>

							<li class="ui-menu-icon">

								<a href="javascript:void(0);">Courses</a>

								<ul class="child-menu">

									<li class="online-crs"><a href="{{url('courses/type/online')}}"><i class="fa fa-graduation-cap"></i>Online Courses</a></li>

									<li class="onsight-cls"><a href="{{url('courses/type/onsite')}}"><i class="fa fa-users"></i>Onsight Classroom </a></li>

									<li class="yrp"><a href="{{url('courses/type/your-pace')}}"><i class="fa fa-eercast"></i>Your Pace</a></li>

									<li class="pymt-pln"><a href="{{url('payment-plan')}}"><i class="fa fa-credit-card"></i>Payment Plan</a></li>

								</ul>

							</li>

							<li class="ui-menu-icon">

								<a href="javascript:void(0);">Get More</a>

								<ul class="child-menu">

									<li class="online-crs">

									    <!--<a href="{{url('courses')}}"><i class="fa fa-graduation-cap"></i>Online Courses</a>-->

									    <nav>

                                            <ul>

                                                <li><a href="{{url('coming-soon')}}"><i class="fa fa-graduation-cap"></i>Careers</a>

                                                    <!-- First Tier Drop Down -->

                                                    <ul>

                                                        <li><a href="#"> <i class="fa fa-group"></i> Preparations</a>

                                                            <ul class="another-sunmenu">

                                                            <li><a href="{{url('resume-building')}}"> <i class="fa fa-file-o"></i> Resume Building</a></li>

                                                            <li><a href="{{url('extensive-interview-plans')}}"><i class="fa fa-pie-chart"></i> Interview Plans</a></li>

                                                            <li><a href="{{url('interview-questions')}}"><i class="fa fa-question"></i> Interview Questions</a></li>

                                                        </ul>

                                                        </li>

                                                        <li><a href="{{url('coming-soon')}}"> <i class="fa fa-heart-o"></i> Jobs</a></li>

                                                        <li><a href="{{url('coming-soon')}}"> <i class="fa fa-graduation-cap"></i> Placement</a>

                                                    	<!-- Second Tier Drop Down -->

                                                        

                                                        </li>

                                                    </ul>

                                                </li>

                                                <li><a href="{{url('coming-soon')}}"><i class="fa fa-handshake-o"></i>Franchise</a></li>

                                                <!--<li><a href="{{url('courses')}}"><i class="fa fa-vcard"></i>Referral Prog.</a></li>-->

                                                <li><a href="{{url('coming-soon')}}"><i class="fa fa-bell"></i>Notification</a></li>

                                                <li><a href="{{url('coming-soon')}}"><i class="fa fa-credit-card"></i>Connect Credit</a></li>

                                                <li><a href="{{url('coming-soon')}}"><i class="fa fa-calendar"></i>Host A Training</a></li>

                                                <li><a href="{{url('coming-soon')}}"><i class="fa fa-graduation-cap"></i>Internship</a></li>

                                                <li><a href="{{url('gift-card')}}"><i class="fa fa-gift"></i>Gift Card</a></li>

                                                <li><a href="{{url('refer-a-friend')}}"><i class="fa fa-user-plus"></i>Invite Friends</a></li>

                                            </ul>

                                        </nav>

									</li>

								</ul>

							</li>

							

							<?php

	                        if(isset(Auth::user()->id) && Auth::user()->id != ''){ ?>

    							<li class="ui-menu-icon">

    							    <a href="{{route('user_dashboard')}}"><?= ucwords(Auth::user()->first_name); ?></a>

    							    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">

                                        @csrf

                                    </form>

    							    <ul class="child-menu">

    									<li class="onsight-cls"><a href="{{url('user/profile')}}"><i class="fa fa-users"></i>My Profile </a></li>

    									<li class="online-crs"><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-graduation-cap"></i>Logout</a></li>

    								</ul>

    							</li>

							<?php }

							else{ ?>

						        <li class="ui-menu-icon">

	                                <a href="{{route('login')}}"><b>I'm In!</b> </a>
	                                
	                                <ul class="child-menu">

    									<li class="online-crs"><a href="{{url('login')}}"><i class="fa fa-graduation-cap"></i>Login</a></li>
    
    									<li class="onsight-cls"><a href="{{url('login')}}#signup-tab-content"><i class="fa fa-users"></i>Signup </a></li>
    
    								</ul>

							    </li>

							<?php }?>

						</ul>

					</nav>

					<div class="minicart-wrapper link-inline">

						<a href="{{url('cart')}}" class="action showcart cart-icon cartCount" data-count="<?= App\Helpers\Helper::getcountcart(); ?>" style="text-decoration: none;">

							<span class="desktop-userTitle"><i class="fa fa-cart-plus" aria-hidden="true"></i></span>

						</a>

					</div>

				</div>

		    <!--End Header-->

		    <!--Mobile Menu-->

                <div class="mobile-nav-wrapper" role="navigation" style="display:none;">

            		<div class="closemobileMenu"><i class="icon anm anm-times-l pull-right"></i> Close Menu</div>

                    <ul id="MobileNav" class="mobile-nav">

                    	<li class="lvl1 parent megamenu"><a href="{{url('coming-soon')}}">How it works</a></li>

                    	<li class="lvl1 parent megamenu"><a href="">Courses <i class="anm anm-plus-l"></i></a>

            	          <ul>

            	            <li><a href="{{url('courses/type/online')}}" class="site-nav"><i class="fa fa-graduation-cap"></i> online Course</a></li>

            	            <li><a href="{{url('courses/type/onsite')}}" class="site-nav"><i class="fa fa-users"></i> Onsight Classroom </a></li>

            	            <li><a href="{{url('courses/type/your-pace')}}" class="site-nav"><i class="fa fa-eercast"></i> Your Pace</a></li>

            	            <li><a href="{{url('courses/type/payment-plan')}}" class="site-nav"><i class="fa fa-credit-card"></i> Payment Plan</a></li>

            	          </ul>

            	        </li>

            	        <li class="lvl1 parent megamenu"><a href="{{url('coming-soon')}}">Get More</a></li>

            	        <li class="lvl1 parent megamenu"><a href="{{url('login')}}">I'm In!</a></li>

                  	</ul>

            	</div>

            	<!--End Mobile Menu-->

		  </header>