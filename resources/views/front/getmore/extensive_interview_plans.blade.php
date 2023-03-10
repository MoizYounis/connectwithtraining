@extends('front.layouts.master')
@section('title')Extensive Interview Plans | {{$gs->title}} @endsection
@section('content')

<section class="breadcrums">
    <div class="container" style="max-width: 1223px;">
        <h2>Extensive Interview Plans</h2>
    </div>
</section>

<section class="interview_plans">
    <div class="row">
        <div class="col-md-12">
            <div class="curriculum-heading">
                <h2>curriculum</h2>
            </div>
            <ul class="slides">
                <input type="radio" name="radio-btn" id="img-1" checked />
                <li class="slide-container">
                    <div class="slide" style="border: none;">
                        <div class="slide-content" style="width: 100%;">
                            <div class="get-pricing-brown">
                                <h2>Pricing</h2>
                                <p>Great Plan That Fit Any Budget</p>
                                <div class="green-ribbion">
                                  <img src="{{asset('public/assets/front/images/green-ribbion.png')}}" style="width: auto; height: auto;">
                                  <h2>Free</h2>
                                  <p>Resume <br>Building</p>  
                                </div>
                            </div>
                            <div class="pricing-plans">
                                <?php
                                        $user_currency = Helper::getCurrencyWithIp();
                                        $currency_list = Helper::getCurrencyList();
                                    ?>
                                <div class="plans-section-price pricing_sec_2">
                                    <div class="single-border">
                                        <p><b>{{ $single_1 ? $single_1->pricing_name : 'SINGLE' }}</b></p>
                                        <div class="free-circle">
                                            <h2>FREE</h2>
                                        </div>
                                        <p><b>Membership Expires after {{ $single_1 ? $single_1->expiry_days : '180' }} Days</b></p>
                                        <p>{{ $single_1 ? $single_1->courses : '3' }} Courses</p>
                                        <p>{{ $single_1 ? $single_1->courses : '2' }} Certificate</p>
                                        <p>{{ $single_1 ? $single_1->badges : '1' }} Badge</p>
                                        <p>{{ $single_1 ? $single_1->days : '180' }} Days</p>
                                        <div class="single-btn">
                                            <a href="">Details</a>
                                        </div>
                                        <div class="list-share-icon-left cus_ico_des">
                                        <div class="buy-now">
                                            <a href=""><i><img src="{{asset('public/assets/front/images/bay1.png')}}" alt=""></i> Buy Now</a>
                                        </div>
                                        <div class="buy-now">
                                            <a href=""><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart</a>
                                        </div>
                                        <div class="buy-now">
                                            <a href=""><i class="fa fa-heart-o" aria-hidden="true"></i> Favorite</a>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="single-border">
                                        <p><b>{{ $single_2 ? $single_2->pricing_name : 'SINGLE' }}</b></p>
                                        <div class="second-free-circle">
                                            <h2>{{ $single_2 ? $single_2->price : '9.00' }} {{ $user_currency }}</h2>
                                            <h3>/month</h3>
                                            <p>No Delay<br>Interview</p>
                                        </div>
                                        <p><b>Membership Expires after {{ $single_2 ? $single_2->expiry_days : '180' }} Days</b></p>
                                        <p>{{ $single_2 ? $single_2->courses : '3' }} Courses</p>
                                        <p>{{ $single_2 ? $single_2->courses : '2' }} Certificate</p>
                                        <p>{{ $single_2 ? $single_2->badges : '1' }} Badge</p>
                                        <p>{{ $single_2 ? $single_2->days : '180' }} Days</p>
                                        <div class="single-btn">
                                            <a href="">Details</a>
                                        </div>
                                        <div class="list-share-icon-left cus_ico_des">
                                        <div class="buy-now">
                                            <a href=""><i><img src="{{asset('public/assets/front/images/bay1.png')}}" alt=""></i> Buy Now</a>
                                        </div>
                                        <div class="buy-now">
                                            <a href=""><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart</a>
                                        </div>
                                        <div class="buy-now">
                                            <a href=""><i class="fa fa-heart-o" aria-hidden="true"></i> Favorite</a>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="single-border">
                                        <p><b>{{ $corporate ? $corporate->pricing_name : 'CORPORATE' }}</b></p>
                                        <div class="second-free-circle">
                                            <h2 style="left: 46.5%;">{{ $corporate ? $corporate->price : '29.00' }} {{ $user_currency }}</h2>
                                            <h3 style="left: 47.5%;">/month</h3>
                                            <p>Prep Me Ahead<br>Interview</p>
                                        </div>
                                        <p><b>Membership Expires after {{ $corporate ? $corporate->expiry_days : '180' }} Days</b></p>
                                        <p>{{ $corporate ? $corporate->courses : '3' }} Courses</p>
                                        <p>{{ $corporate ? $corporate->courses : '2' }} Certificate</p>
                                        <p>{{ $corporate ? $corporate->badges : '1' }} Badge</p>
                                        <p>{{ $corporate ? $corporate->days : '180' }} Days</p>
                                        <div class="single-btn">
                                            <a href="">Details</a>
                                        </div>
                                         <div class="list-share-icon-left cus_ico_des">
                                        <div class="buy-now">
                                            <a href=""><i><img src="{{asset('public/assets/front/images/bay1.png')}}" alt=""></i> Buy Now</a>
                                        </div>
                                        <div class="buy-now">
                                            <a href=""><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart</a>
                                        </div>
                                        <div class="buy-now">
                                            <a href=""><i class="fa fa-heart-o" aria-hidden="true"></i> Favorite</a>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="single-border">
                                        <p><b>{{ $enterprise ? $enterprise->pricing_name : 'ENTERPRISE' }}</b></p>
                                        <div class="second-free-circle">
                                            <h2 style="left: 66%;">{{ $enterprise ? $enterprise->price : '99.00' }} {{ $user_currency }}</h2>
                                            <h3 style="left: 67%;">/month</h3>
                                            <p>Extensive<br>Interview</p>
                                        </div>
                                        <p><b>Membership Expires after {{ $enterprise ? $enterprise->expiry_days : '180' }} Days</b></p>
                                        <p>{{ $enterprise ? $enterprise->courses : '3' }} Courses</p>
                                        <p>{{ $enterprise ? $enterprise->courses : '2' }} Certificate</p>
                                        <p>{{ $enterprise ? $enterprise->badges : '1' }} Badge</p>
                                        <p>{{ $enterprise ? $enterprise->days : '180' }} Days</p>
                                        <div class="single-btn">
                                            <a href="">Details</a>
                                        </div>
                                        <div class="list-share-icon-left cus_ico_des">
                                        <div class="buy-now">
                                            <a href=""><i><img src="{{asset('public/assets/front/images/bay1.png')}}" alt=""></i> Buy Now</a>
                                        </div>
                                        <div class="buy-now">
                                            <a href=""><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart</a>
                                        </div>
                                        <div class="buy-now">
                                            <a href=""><i class="fa fa-heart-o" aria-hidden="true"></i> Favorite</a>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="single-border">
                                        <p><b>{{ $single_3 ? $single_3->pricing_name : 'SINGLE' }}</b></p>
                                        <div class="second-free-circle">
                                            <h2 style="left: 86%;">{{ $single_3 ? $single_3->price : '9.00' }} {{ $user_currency }}</h2>
                                            <h3 style="left: 86.5%;">/month</h3>
                                            <p>Tailored<br>Interview</p>
                                        </div>
                                        <p><b>Membership Expires after {{ $single_3 ? $single_3->expiry_days : '180' }} Days</b></p>
                                        <p>{{ $single_3 ? $single_3->courses : '3' }} Courses</p>
                                        <p>{{ $single_3 ? $single_3->courses : '2' }} Certificate</p>
                                        <p>{{ $single_3 ? $single_3->badges : '1' }} Badge</p>
                                        <p>{{ $single_3 ? $single_3->days : '180' }} Days</p>
                                        <div class="single-btn">
                                            <a href="">Details</a>
                                        </div>
                                        <div class="list-share-icon-left cus_ico_des">
                                        <div class="buy-now">
                                            <a href=""><i><img src="{{asset('public/assets/front/images/bay1.png')}}" alt=""></i> Buy Now</a>
                                        </div>
                                        <div class="buy-now">
                                            <a href=""><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart</a>
                                        </div>
                                        <div class="buy-now">
                                            <a href=""><i class="fa fa-heart" aria-hidden="true"></i> Favorite</a>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="stages">
                                <h2>7 Stages of our Interview Process</h2>
                               <!--  <img src="{{asset('public/assets/front/images/interview_plan.png')}}"> 
                               -->
                               <div class="intervie_sec">
                                    <div class="intervie_step">
                                        <div class="intervie_itm intervie_itm1">
                                            <div class="intervie_itm_tex">
                                                <span><small>1.</small> Decide What<br> you wat</span>
                                                <div class="intervie_tex_inr">
                                                    <div class="intervie_tex_inr_itm">
                                                        <span>Explore<br>yourself</span>
                                                        <div class="intervie_tex_subinr_itm">
                                                            <span>xxxxxxxxxxx</span>
                                                            <span>xxxxxxxxx</span>
                                                            <span>xxxxxxxxxxxxxxxxx</span>
                                                            <span>xxxxxxxxxxx</span>
                                                        </div>
                                                    </div>
                                                    <div class="intervie_tex_inr_itm">
                                                        <span>Research</span>
                                                        <div class="intervie_tex_subinr_itm">
                                                            <span>xxxxxxxxxxx</span>
                                                            <span>xxxxxxxxx</span>
                                                            <span>xxxxxxxxxxx</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="intervie_itm_tex">
                                                <span class="colo_1"><small>2.</small> Create job search<br> marketig plan</span>
                                                <div class="intervie_tex_inr">
                                                    <div class="intervie_tex_inr_itm">
                                                        <span class="colo_1">Make a<br>pla</span>
                                                        <div class="intervie_tex_subinr_itm">
                                                            <span>xxxxxxxxxxx</span>
                                                            <span>xxxxxxxxx</span>
                                                            <span>xxxxxxxxxxx</span>
                                                        </div>
                                                    </div>
                                                    <div class="intervie_tex_inr_itm">
                                                        <span class="colo_1">Make<br> comitments to yoursels</span>
                                                        <div class="intervie_tex_subinr_itm">
                                                            <span>xxxxxxxx</span>
                                                            <span>xxxxxxxxxxx</span>
                                                            <span>xxxxxxxxxxx</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="intervie_itm_tex">
                                                <span class="colo_2"><small>3.</small> Get tools<br> needed</span>
                                                <div class="intervie_tex_inr">
                                                    <div class="intervie_tex_inr_itm">
                                                        <span class="colo_2">Brand</span>
                                                        <div class="intervie_tex_subinr_itm">
                                                            <span>xxxxxxxxxxx</span>
                                                            <span>xxxxxxxxx</span>
                                                            <span>xxxx</span>
                                                        </div>
                                                    </div>
                                                    <div class="intervie_tex_inr_itm">
                                                        <span class="colo_2">People</span>
                                                        <div class="intervie_tex_subinr_itm">
                                                            <span>xxxxxxxx</span>
                                                            <span>xxxxxxxxxxx</span>
                                                            <span>xxxxxxxxxxx</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="midil_intervie">
                                            <span>Gat the job You want<br>(xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx)</span>
                                        </div>
                                        <div class="intervie_itm intervie_itm2">
                                            <div class="intervie_itm_tex">
                                                <span class="colo_3"><small>4.</small> Where to find<br> what you want?</span>
                                                <div class="intervie_tex_inr">
                                                    <div class="intervie_tex_inr_itm">
                                                        <span class="colo_3">Target<br>Companies</span>
                                                        <div class="intervie_tex_subinr_itm">
                                                            <span>xxxxxxxxxxx</span>
                                                            <span>xxxxxxxxx</span>
                                                            <span>xxxx</span>
                                                        </div>
                                                    </div>
                                                    <div class="intervie_tex_inr_itm">
                                                        <span class="colo_3">Target<br>People</span>
                                                        <div class="intervie_tex_subinr_itm">
                                                            <span>xxxxxxxx</span>
                                                            <span>xxxxxxxxxxx</span>
                                                            <span>xxxxxxxxxxx</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="intervie_itm_tex">
                                                <span class="colo_4"><small>5.</small> what are you <br> wiliong to do?</span>
                                                <div class="intervie_tex_inr">
                                                    <div class="intervie_tex_inr_itm">
                                                        <span class="colo_4">Commitmets<br>to yourself</span>
                                                        <div class="intervie_tex_subinr_itm">
                                                            <span>xxxxxxx</span>
                                                            <span>xxxxxxxxxxx</span>
                                                            <span>xxxxxxxxx</span>
                                                            <span>xxxx</span>
                                                        </div>
                                                    </div>
                                                    <div class="intervie_tex_inr_itm">
                                                        <span class="colo_4">Research &<br>outreach</span>
                                                        <div class="intervie_tex_subinr_itm">
                                                            <span>xxxxxxxx</span>
                                                            <span>xxxxxxxxxxx</span>
                                                            <span>xxxxxxxxxxx</span>
                                                        </div>
                                                    </div>
                                                    <div class="intervie_tex_inr_itm">
                                                        <span class="colo_4"> "Accountability</span>
                                                        <div class="intervie_tex_subinr_itm">
                                                            <span>xxxxxxxx</span>
                                                            <span>xxxxxxxxxxx</span>
                                                            <span>xxxxxxxxxxx</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="intervie_itm_tex">
                                                <span class="colo_5"><small>6.</small> What to<br> say?</span>
                                                <div class="intervie_tex_inr">
                                                    <div class="intervie_tex_inr_itm">
                                                        <span class="colo_5">Interview prep</span>
                                                        <div class="intervie_tex_subinr_itm">
                                                            <span>xxxxxxx</span>
                                                            <span>xxxxxxxxxxx</span>
                                                            <span>xxxxxxxxx</span>
                                                            <span>xxxx</span>
                                                        </div>
                                                    </div>
                                                    <div class="intervie_tex_inr_itm">
                                                        <span class="colo_5">Networking topics</span>
                                                        <div class="intervie_tex_subinr_itm">
                                                            <span>xxxxxxxx</span>
                                                            <span>xxxxxxxxxxx</span>
                                                            <span>xxxxxxxxxxx</span>
                                                        </div>
                                                    </div>
                                                    <div class="intervie_tex_inr_itm">
                                                        <span class="colo_5">Reading</span>
                                                        <div class="intervie_tex_subinr_itm">
                                                            <span>xxxxxxxx</span>
                                                            <span>xxxxxxxxxxx</span>
                                                            <span>xxxxxxxxxxx</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="interview_plans_text">
                                <h2 class="plans-inteview">Interview Plan</h2>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="step-one-plans">
                                            <p style="text-align: center; margin-bottom: 20px;"><b>Step 1: Interview Plan</b></p>
                                            <p>1. Identify employees XXXXX XXXXXX job best <br>
                                                2. Set up XXX XXXXXXXX XXXXX X XXXX XXX XXXXXX interviewed<br>
                                                3. Review XXXXXXXX XXXX XXXXX XXXXXX XXXXX XXXXXXXXXX working with
                                            </p>
                                        </div>
                                        <div class="second-one-plans">
                                            <p style="text-align: center; margin-bottom: 10px;"><b>Step 2: Explain Your Role</b></p>
                                            <p>1. Explain XXXXXXXX XXXXXX XXX XXX by you <br>
                                                2. Avoid XXXXXXXX XXXXX X XXXX XXX XXXXXX intrview<br>
                                                3. XXXXXX XXXXXXXX XXXX XXXXX XXXXXX XXXXX XXXXXXXXXX XXXXX XX<br>
                                                4. XXX XXXXXXXXXXX XXXXXX XXX XXXXXX XX<br>
                                                5. XXXXXXXX XXXXXXXX XXXXX X XXXX XXX XXXXXX XX<br>
                                                6. Built XXXXXXXX XXXX XXXXX XXXXXX XXXXX XXXXXXXXXX XXXXX results.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="second-one-plans">
                                            <p style="text-align: center; margin-bottom: 10px;"><b>Step 2: Explain Your Role</b></p>
                                            <p>1. Explain XXXXXXXX XXXXXX XXX XXX by you <br>
                                                2. Avoid XXXXXXXX XXXXX X XXXX XXX XXXXXX intrview<br>
                                                3. XXXXXX XXXXXXXX XXXX XXXXX XXXXXX XXXXX XXXXXXXXXX XXXXX XX<br>
                                                4. XXX XXXXXXXXXXX XXXXXX XXX XXXXXX XX<br>
                                                5. XXXXXXXX XXXXXXXX XXXXX X XXXX XXX XXXXXX XX<br>
                                                6. Built XXXXXXXX XXXX XXXXX XXXXXX XXXXX XXXXXXXXXX XXXXX results.
                                            </p>
                                        </div>
                                        <div class="step-one-plans">
                                            <p style="text-align: center; margin-bottom: 20px;"><b>Step 1: Interview Plan</b></p>
                                            <p>1. Identify employees XXXXX XXXXXX job best <br>
                                                2. Set up XXX XXXXXXXX XXXXX X XXXX XXX XXXXXX interviewed<br>
                                                3. Review XXXXXXXX XXXX XXXXX XXXXXX XXXXX XXXXXXXXXX working with
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

                <input type="radio" name="radio-btn" id="img-2" />
                <li class="slide-container">
                    <div class="slide" style="border: none;">
                        <div class="slide-content">
                            <div class="freeplans">
                                <h2>Free Interview Evaluation</h2>
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="mock">
                                            <h2>Mock Interview evaluation</h2>
                                            <div class="mock-text">
                                                <p><b>Before you get rated by Employer work on the below: This is how Job seeker  Client would be rated by Employer</b></p>
                                                <p>Rate the student XXXXXX XXXXXXXX XXXXXXXXXX XXXXXXXX XXXXXXXXX XXXXXXXXXX XXXXXX interview skill</p>
                                                <div class="nonverbal">
                                                    <h2>nonverbal behaviors</h2>
                                                    <div class="behavior-score">
                                                        <div class="behavior-text-score">
                                                            <h3>1. Dress approprilately</h3>
                                                            <p>1</p>
                                                            <p>2</p>
                                                            <p>3</p>
                                                            <p>4</p>
                                                            <p>2</p>
                                                        </div>
                                                        <div class="behavior-text-score">
                                                            <h3>2. Dress approprilately</h3>
                                                            <p>1</p>
                                                            <p>2</p>
                                                            <p>3</p>
                                                            <p>4</p>
                                                            <p>2</p>
                                                        </div>
                                                        <div class="behavior-text-score">
                                                            <h3>3. Dress approprilately</h3>
                                                            <p>1</p>
                                                            <p>2</p>
                                                            <p>3</p>
                                                            <p>4</p>
                                                            <p>2</p>
                                                        </div>
                                                        <div class="behavior-text-score">
                                                            <h3>4. Dress approprilately</h3>
                                                            <p>1</p>
                                                            <p>2</p>
                                                            <p>3</p>
                                                            <p>4</p>
                                                            <p>2</p>
                                                        </div>
                                                        <div class="behavior-text-score">
                                                            <h3>5. Dress approprilately</h3>
                                                            <p>1</p>
                                                            <p>2</p>
                                                            <p>3</p>
                                                            <p>4</p>
                                                            <p>2</p>
                                                        </div>
                                                        <div class="behavior-text-score">
                                                            <h3>6. Dress approprilately</h3>
                                                            <p>1</p>
                                                            <p>2</p>
                                                            <p>3</p>
                                                            <p>4</p>
                                                            <p>2</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nonverbal">
                                                    <h2>Verbal behaviors</h2>
                                                    <div class="behavior-score">
                                                        <div class="behavior-text-score">
                                                            <h3>1. Dress approprilately</h3>
                                                            <p>1</p>
                                                            <p>2</p>
                                                            <p>3</p>
                                                            <p>4</p>
                                                            <p>2</p>
                                                        </div>
                                                        <div class="behavior-text-score">
                                                            <h3>2. Dress approprilately</h3>
                                                            <p>1</p>
                                                            <p>2</p>
                                                            <p>3</p>
                                                            <p>4</p>
                                                            <p>2</p>
                                                        </div>
                                                        <div class="behavior-text-score">
                                                            <h3>3. Dress approprilately</h3>
                                                            <p>1</p>
                                                            <p>2</p>
                                                            <p>3</p>
                                                            <p>4</p>
                                                            <p>2</p>
                                                        </div>
                                                        <div class="behavior-text-score">
                                                            <h3>4. Dress approprilately</h3>
                                                            <p>1</p>
                                                            <p>2</p>
                                                            <p>3</p>
                                                            <p>4</p>
                                                            <p>2</p>
                                                        </div>
                                                        <div class="behavior-text-score">
                                                            <h3>5. Dress approprilately</h3>
                                                            <p>1</p>
                                                            <p>2</p>
                                                            <p>3</p>
                                                            <p>4</p>
                                                            <p>2</p>
                                                        </div>
                                                        <div class="behavior-text-score">
                                                            <h3>6. Dress approprilately</h3>
                                                            <p>1</p>
                                                            <p>2</p>
                                                            <p>3</p>
                                                            <p>4</p>
                                                            <p>2</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="rated-insterview">
                                            <p>How are you rated during the interview?</p>
                                            <img src="{{asset('public/assets/front/images/rated-img.png')}}">
                                        </div>
                                    </div>
                                </div>
                                <section class="get_more">
                                    <div class="container">
                                        <div class="resume-testimonials">
                                            <h2>Resume Building Testimonials</h2>
                                            <div class="resume-img">
                                                <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                                <p>Based on <span>1385 ratings</span></p>
                                            </div>
                                        </div>
                                        <div class="test-list">
                                            <div class="text-list-box">
                                                <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                                <p>Here???s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
                                                xxxxxx XXXXXX xxx XXX XXXX XXXXXXXXXXXXX XXXXX XX XXXXXXXXXX XXXX XXXXXXX XXXXXXXXXX XXXXXXX X XXXXX!!!</p>
                                                <div class="text-list-img">
                                                    <img src="{{asset('public/assets/front/images/text-image.png')}}">
                                                    <div class="text-list-heading">
                                                        <h2>PA_PAWJ</h2>
                                                        <p>Manufacturing 01-250<br>Employees</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-list-box">
                                                <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                                <p>Here???s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
                                                xxxxxx XXXXXX xxx XXX XXXX XXXXXXXXXXXXX XXXXX XX XXXXXXXXXX XXXX XXXXXXX XXXXXXXXXX XXXXXXX X XXXXX!!!</p>
                                                <div class="text-list-img">
                                                    <img src="{{asset('public/assets/front/images/text-image.png')}}">
                                                    <div class="text-list-heading">
                                                        <h2>PA_PAWJ</h2>
                                                        <p>Manufacturing 01-250<br>Employees</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-list-box">
                                                <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                                <p>Here???s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
                                                xxxxxx XXXXXX xxx XXX XXXX XXXXXXXXXXXXX XXXXX XX XXXXXXXXXX XXXX XXXXXXX XXXXXXXXXX XXXXXXX X XXXXX!!!</p>
                                                <div class="text-list-img">
                                                    <img src="{{asset('public/assets/front/images/text-image.png')}}">
                                                    <div class="text-list-heading">
                                                        <h2>PA_PAWJ</h2>
                                                        <p>Manufacturing 01-250<br>Employees</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-list-box">
                                                <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                                <p>Here???s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
                                                xxxxxx XXXXXX xxx XXX XXXX XXXXXXXXXXXXX XXXXX XX XXXXXXXXXX XXXX XXXXXXX XXXXXXXXXX XXXXXXX X XXXXX!!!</p>
                                                <div class="text-list-img">
                                                    <img src="{{asset('public/assets/front/images/text-image.png')}}">
                                                    <div class="text-list-heading">
                                                        <h2>PA_PAWJ</h2>
                                                        <p>Manufacturing 01-250<br>Employees</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="test-list">
                                            <div class="text-list-box">
                                                <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                                <p>Here???s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
                                                xxxxxx XXXXXX xxx XXX XXXX XXXXXXXXXXXXX XXXXX XX XXXXXXXXXX XXXX XXXXXXX XXXXXXXXXX XXXXXXX X XXXXX!!!</p>
                                                <div class="text-list-img">
                                                    <img src="{{asset('public/assets/front/images/text-image.png')}}">
                                                    <div class="text-list-heading">
                                                        <h2>PA_PAWJ</h2>
                                                        <p>Manufacturing 01-250<br>Employees</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-list-box">
                                                <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                                <p>Here???s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
                                                xxxxxx XXXXXX xxx XXX XXXX XXXXXXXXXXXXX XXXXX XX XXXXXXXXXX XXXX XXXXXXX XXXXXXXXXX XXXXXXX X XXXXX!!!</p>
                                                <div class="text-list-img">
                                                    <img src="{{asset('public/assets/front/images/text-image.png')}}">
                                                    <div class="text-list-heading">
                                                        <h2>PA_PAWJ</h2>
                                                        <p>Manufacturing 01-250<br>Employees</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-list-box">
                                                <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                                <p>Here???s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
                                                xxxxxx XXXXXX xxx XXX XXXX XXXXXXXXXXXXX XXXXX XX XXXXXXXXXX XXXX XXXXXXX XXXXXXXXXX XXXXXXX X XXXXX!!!</p>
                                                <div class="text-list-img">
                                                    <img src="{{asset('public/assets/front/images/text-image.png')}}">
                                                    <div class="text-list-heading">
                                                        <h2>PA_PAWJ</h2>
                                                        <p>Manufacturing 01-250<br>Employees</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-list-box">
                                                <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                                <p>Here???s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
                                                xxxxxx XXXXXX xxx XXX XXXX XXXXXXXXXXXXX XXXXX XX XXXXXXXXXX XXXX XXXXXXX XXXXXXXXXX XXXXXXX X XXXXX!!!</p>
                                                <div class="text-list-img">
                                                    <img src="{{asset('public/assets/front/images/text-image.png')}}">
                                                    <div class="text-list-heading">
                                                        <h2>PA_PAWJ</h2>
                                                        <p>Manufacturing 01-250<br>Employees</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="textimonial-btn">
                                            <button id="myBtn">Create testimonials</button>
                                            <div id="myModal" class="modal">

                                              <!-- Modal content -->
                                              <div class="modal-content">
                                                <span class="close">&times;</span>
                                                <div class="textimonial-heading">
                                                    <h2>Create Testimonials</h2>
                                                </div>
                                                <div class="textimonial-form">
                                                    <div class="testimonial-inout">
                                                        <p>Name:</p>
                                                        <input type="text" name="">
                                                    </div>
                                                    <div class="testimonial-inout">
                                                        <p>Image:</p>
                                                        <div class="upload-btn-wrapper">
                                                          <button class="btn">Upload a file</button>
                                                          <input type="file" name="myfile" />
                                                        </div>
                                                    </div>
                                                    <div class="testimonial-inout">
                                                        <p>Job Tiles:</p>
                                                        <input type="text" name="">
                                                    </div>
                                                    <div class="testimonial-inout">
                                                        <p>Rating:</p>
                                                        <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                                    </div>
                                                    <div class="testimonial-inout">
                                                        <p>Description:</p>
                                                        <textarea></textarea>
                                                    </div>
                                                    <div class="testimonial-btn">
                                                        <a href="" style="background-color: #0cf; color: #fff;">Submit for review</a>
                                                        <a href="">Cancel</a>
                                                    </div>
                                                </div>
                                                
                                              </div>

                                            </div>
                                        </div>
                                        <!-- The Modal -->
                                        
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </li>

                <input type="radio" name="radio-btn" id="img-3" />
                <li class="slide-container">
                    <div class="slide" style="border: none; ">
                        <div class="slide-content" style="width: 100%;">
                            <div class="no-delay">
                                <h2>No Delay Interview Plan</h2>
                                <div class="choose_interview">
                                    <div class="select_date">
                                        <select>
                                            <option>6-14 Days</option>
                                            <option>6-14 Days</option>
                                            <option>6-14 Days</option>
                                        </select>
                                    </div>
                                    <div class="choose_start_rane">
                                        <input type="date" name="">
                                        <input type="time" name="">
                                    </div>
                                    <div class="choose_start_rane">
                                        <input type="date" name="">
                                        <input type="time" name="">
                                    </div>
                                </div>
                                <div class="button_dv">
                                    <button class="cus-btn">Submit</button>
                                </div>
                                <div class="dealy-images">
                                   <!--  <img src="{{asset('public/assets/front/images/nodelay-text.png')}}"> -->
                                   <div class="info_curcal_sec">
    <div class="info_curcal_pael">
        <div class="info_medils">
            <b>No Delay<br>Interview</b>
        </div>
        <div class="info_shep info_shep1">
            <span>1. Information <br>Interview</span>
        </div>
        <div class="info_shep info_shep2">
            <span>2. Non-<br> Directive<br> Interview</span>
        </div>
        <div class="info_shep info_shep3">
            <span>3. Termination <br>Interview</span>
        </div>
        <div class="info_shep info_shep4">
            <span>4. Evaluation <br>Interview</span>
        </div>
        <div class="info_shep info_shep5">
            <span>5. Routine <br>Interview</span>
        </div>
        <div class="info_shep info_shep6">
            <span>6. Views <br>assessing <br>Interview</span>
        </div>
        <div class="info_shep info_shep7">
            <span>7. Individual<br>Interview</span>
        </div>
        <div class="info_shep info_shep8">
            <span>8. Exit<br>Interview</span>
        </div>
    </div>
    <div class="content_info">
        <div class="content_info_bx info_content1">
            <p>1. Here a prepared list of questions is used to collect information from the respondent</p>
        </div>
        <div class="content_info_bx info_content2">
            <p>2. In this type of interview there is
no preplanned set of questions.
Here the interviewer encourages
the respondent or employee to
talk about his/her problem,
without questioning him/her.
A supervisor can create a suitable
atmosphere in which the
employee is able to speak freely
about the problem</p>
        </div>
        <div class="content_info_bx info_content3">
            <p>3. In this type of interview a
supervisor inform an employee
about the reasons for termination
and tries to maintain a positive
relationship with the employee
to avoid legal procedures.</p>
        </div>
        <div class="content_info_bx info_content4">
            <p>4. Here executives or supervisors
discuss with employees about
their expected performances and
evaluate areas that require
improvement.</p>
        </div>
        <div class="content_info_bx info_content5">
            <p>5. One of the routine functions of
a company is evaluating candidates
who are seeking job in the company.
To explore the abilities and experiences
of the applicant an organized interview
is conducted.</p>
        </div>
        <div class="content_info_bx info_content6">
            <p>6. To know the views of the consumers
about the products and services of the
company this type of interviews are
conducted.</p>
        </div>
        <div class="content_info_bx info_content7">
            <p>7. In this case an individual is interviewed.
Here a supervisor takes measures to rectify
the behavior of an employee.</p>
        </div>
        <div class="content_info_bx info_content8">
            <p>8. In this method the interviewer tries to
find out the causes of employee turnover.
That is why an employee is leaving the
organization can be revealed by this type
of interviews. </p>
        </div>      
    </div>
</div>
                                </div>
                                <section class="get_more">
                                    <div class="container">
                                        <div class="resume-testimonials">
                                            <h2>Resume Building Testimonials</h2>
                                            <div class="resume-img">
                                                <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                                <p>Based on <span>1385 ratings</span></p>
                                            </div>
                                        </div>
                                        <div class="test-list">
                                            <div class="text-list-box">
                                                <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                                <p>Here???s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
                                                xxxxxx XXXXXX xxx XXX XXXX XXXXXXXXXXXXX XXXXX XX XXXXXXXXXX XXXX XXXXXXX XXXXXXXXXX XXXXXXX X XXXXX!!!</p>
                                                <div class="text-list-img">
                                                    <img src="{{asset('public/assets/front/images/text-image.png')}}">
                                                    <div class="text-list-heading">
                                                        <h2>PA_PAWJ</h2>
                                                        <p>Manufacturing 01-250<br>Employees</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-list-box">
                                                <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                                <p>Here???s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
                                                xxxxxx XXXXXX xxx XXX XXXX XXXXXXXXXXXXX XXXXX XX XXXXXXXXXX XXXX XXXXXXX XXXXXXXXXX XXXXXXX X XXXXX!!!</p>
                                                <div class="text-list-img">
                                                    <img src="{{asset('public/assets/front/images/text-image.png')}}">
                                                    <div class="text-list-heading">
                                                        <h2>PA_PAWJ</h2>
                                                        <p>Manufacturing 01-250<br>Employees</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-list-box">
                                                <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                                <p>Here???s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
                                                xxxxxx XXXXXX xxx XXX XXXX XXXXXXXXXXXXX XXXXX XX XXXXXXXXXX XXXX XXXXXXX XXXXXXXXXX XXXXXXX X XXXXX!!!</p>
                                                <div class="text-list-img">
                                                    <img src="{{asset('public/assets/front/images/text-image.png')}}">
                                                    <div class="text-list-heading">
                                                        <h2>PA_PAWJ</h2>
                                                        <p>Manufacturing 01-250<br>Employees</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-list-box">
                                                <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                                <p>Here???s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
                                                xxxxxx XXXXXX xxx XXX XXXX XXXXXXXXXXXXX XXXXX XX XXXXXXXXXX XXXX XXXXXXX XXXXXXXXXX XXXXXXX X XXXXX!!!</p>
                                                <div class="text-list-img">
                                                    <img src="{{asset('public/assets/front/images/text-image.png')}}">
                                                    <div class="text-list-heading">
                                                        <h2>PA_PAWJ</h2>
                                                        <p>Manufacturing 01-250<br>Employees</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="test-list">
                                            <div class="text-list-box">
                                                <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                                <p>Here???s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
                                                xxxxxx XXXXXX xxx XXX XXXX XXXXXXXXXXXXX XXXXX XX XXXXXXXXXX XXXX XXXXXXX XXXXXXXXXX XXXXXXX X XXXXX!!!</p>
                                                <div class="text-list-img">
                                                    <img src="{{asset('public/assets/front/images/text-image.png')}}">
                                                    <div class="text-list-heading">
                                                        <h2>PA_PAWJ</h2>
                                                        <p>Manufacturing 01-250<br>Employees</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-list-box">
                                                <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                                <p>Here???s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
                                                xxxxxx XXXXXX xxx XXX XXXX XXXXXXXXXXXXX XXXXX XX XXXXXXXXXX XXXX XXXXXXX XXXXXXXXXX XXXXXXX X XXXXX!!!</p>
                                                <div class="text-list-img">
                                                    <img src="{{asset('public/assets/front/images/text-image.png')}}">
                                                    <div class="text-list-heading">
                                                        <h2>PA_PAWJ</h2>
                                                        <p>Manufacturing 01-250<br>Employees</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-list-box">
                                                <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                                <p>Here???s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
                                                xxxxxx XXXXXX xxx XXX XXXX XXXXXXXXXXXXX XXXXX XX XXXXXXXXXX XXXX XXXXXXX XXXXXXXXXX XXXXXXX X XXXXX!!!</p>
                                                <div class="text-list-img">
                                                    <img src="{{asset('public/assets/front/images/text-image.png')}}">
                                                    <div class="text-list-heading">
                                                        <h2>PA_PAWJ</h2>
                                                        <p>Manufacturing 01-250<br>Employees</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-list-box">
                                                <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                                <p>Here???s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
                                                xxxxxx XXXXXX xxx XXX XXXX XXXXXXXXXXXXX XXXXX XX XXXXXXXXXX XXXX XXXXXXX XXXXXXXXXX XXXXXXX X XXXXX!!!</p>
                                                <div class="text-list-img">
                                                    <img src="{{asset('public/assets/front/images/text-image.png')}}">
                                                    <div class="text-list-heading">
                                                        <h2>PA_PAWJ</h2>
                                                        <p>Manufacturing 01-250<br>Employees</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="textimonial-btn">
                                            <button id="myBtn">Create testimonials</button>
                                            <div id="myModal" class="modal">

                                              <!-- Modal content -->
                                              <div class="modal-content">
                                                <span class="close">&times;</span>
                                                <div class="textimonial-heading">
                                                    <h2>Create Testimonials</h2>
                                                </div>
                                                <div class="textimonial-form">
                                                    <div class="testimonial-inout">
                                                        <p>Name:</p>
                                                        <input type="text" name="">
                                                    </div>
                                                    <div class="testimonial-inout">
                                                        <p>Image:</p>
                                                        <div class="upload-btn-wrapper">
                                                          <button class="btn">Upload a file</button>
                                                          <input type="file" name="myfile" />
                                                        </div>
                                                    </div>
                                                    <div class="testimonial-inout">
                                                        <p>Job Tiles:</p>
                                                        <input type="text" name="">
                                                    </div>
                                                    <div class="testimonial-inout">
                                                        <p>Rating:</p>
                                                        <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                                    </div>
                                                    <div class="testimonial-inout">
                                                        <p>Description:</p>
                                                        <textarea></textarea>
                                                    </div>
                                                    <div class="testimonial-btn">
                                                        <a href="" style="background-color: #0cf; color: #fff;">Submit for review</a>
                                                        <a href="">Cancel</a>
                                                    </div>
                                                </div>
                                              </div>

                                            </div>
                                        </div>
                                        <!-- The Modal -->
                                        
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </li>

                <input type="radio" name="radio-btn" id="img-4" />
                <li class="slide-container">
                    <div class="slide" style="border: none;">
                        <div class="no-delay">
                            <h2>Prep Me Ahead Interviewplan</h2>
                            <div class="choose_interview">
                                <div class="select_date">
                                    <select>
                                        <option>6-14 Days</option>
                                        <option>6-14 Days</option>
                                        <option>6-14 Days</option>
                                    </select>
                                </div>
                                <div class="choose_start_rane">
                                    <input type="date" name="">
                                    <input type="time" name="">
                                </div>
                                <div class="choose_start_rane">
                                    <input type="date" name="">
                                    <input type="time" name="">
                                </div>
                            </div>
                            <div class="button_dv">
                                    <button class="cus-btn">Submit</button>
                                </div>
                            <div class="dealy-images">
                                <!-- <img src="{{asset('public/assets/front/images/prep-head.png')}}" style="width: 600px; height: auto;"> -->
                                <div class="info_curcal_sec">
    <div class="info_curcal_pael">
        <div class="info_medils">
            <b>Prep Me<br>Ahead <r>Interview</b>
        </div>
        <div class="info_shep info_shep1">
            <span>1. Employment <br>Interview</span>
        </div>
        <div class="info_shep info_shep2">
            <span>2. Direct<br> Interview</span>
        </div>
        <div class="info_shep info_shep3">
            <span>3. Indirect <br>Interview</span>
        </div>
        <div class="info_shep info_shep4">
            <span>4. Board or Pane <br>Interview</span>
        </div>
        <div class="info_shep info_shep5">
            <span>5. Group <br>Interview</span>
        </div>
        <div class="info_shep info_shep6">
            <span>6. In Department <br>Interview</span>
        </div>
        <div class="info_shep info_shep7">
            <span>6. Stress<br>Interview</span>
        </div>
        <div class="info_shep info_shep8">
            <span>8. Patterned<br>Interview</span>
        </div>
    </div>
    
</div>
                            </div>
                            <section class="get_more">
                                <div class="container">
                                    <div class="resume-testimonials">
                                        <h2>Resume Building Testimonials</h2>
                                        <div class="resume-img">
                                            <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                            <p>Based on <span>1385 ratings</span></p>
                                        </div>
                                    </div>
                                    <div class="test-list">
                                        <div class="text-list-box">
                                            <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                            <p>Here???s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
                                            xxxxxx XXXXXX xxx XXX XXXX XXXXXXXXXXXXX XXXXX XX XXXXXXXXXX XXXX XXXXXXX XXXXXXXXXX XXXXXXX X XXXXX!!!</p>
                                            <div class="text-list-img">
                                                <img src="{{asset('public/assets/front/images/text-image.png')}}">
                                                <div class="text-list-heading">
                                                    <h2>PA_PAWJ</h2>
                                                    <p>Manufacturing 01-250<br>Employees</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-list-box">
                                            <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                            <p>Here???s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
                                            xxxxxx XXXXXX xxx XXX XXXX XXXXXXXXXXXXX XXXXX XX XXXXXXXXXX XXXX XXXXXXX XXXXXXXXXX XXXXXXX X XXXXX!!!</p>
                                            <div class="text-list-img">
                                                <img src="{{asset('public/assets/front/images/text-image.png')}}">
                                                <div class="text-list-heading">
                                                    <h2>PA_PAWJ</h2>
                                                    <p>Manufacturing 01-250<br>Employees</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-list-box">
                                            <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                            <p>Here???s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
                                            xxxxxx XXXXXX xxx XXX XXXX XXXXXXXXXXXXX XXXXX XX XXXXXXXXXX XXXX XXXXXXX XXXXXXXXXX XXXXXXX X XXXXX!!!</p>
                                            <div class="text-list-img">
                                                <img src="{{asset('public/assets/front/images/text-image.png')}}">
                                                <div class="text-list-heading">
                                                    <h2>PA_PAWJ</h2>
                                                    <p>Manufacturing 01-250<br>Employees</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-list-box">
                                            <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                            <p>Here???s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
                                            xxxxxx XXXXXX xxx XXX XXXX XXXXXXXXXXXXX XXXXX XX XXXXXXXXXX XXXX XXXXXXX XXXXXXXXXX XXXXXXX X XXXXX!!!</p>
                                            <div class="text-list-img">
                                                <img src="{{asset('public/assets/front/images/text-image.png')}}">
                                                <div class="text-list-heading">
                                                    <h2>PA_PAWJ</h2>
                                                    <p>Manufacturing 01-250<br>Employees</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="test-list">
                                        <div class="text-list-box">
                                            <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                            <p>Here???s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
                                            xxxxxx XXXXXX xxx XXX XXXX XXXXXXXXXXXXX XXXXX XX XXXXXXXXXX XXXX XXXXXXX XXXXXXXXXX XXXXXXX X XXXXX!!!</p>
                                            <div class="text-list-img">
                                                <img src="{{asset('public/assets/front/images/text-image.png')}}">
                                                <div class="text-list-heading">
                                                    <h2>PA_PAWJ</h2>
                                                    <p>Manufacturing 01-250<br>Employees</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-list-box">
                                            <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                            <p>Here???s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
                                            xxxxxx XXXXXX xxx XXX XXXX XXXXXXXXXXXXX XXXXX XX XXXXXXXXXX XXXX XXXXXXX XXXXXXXXXX XXXXXXX X XXXXX!!!</p>
                                            <div class="text-list-img">
                                                <img src="{{asset('public/assets/front/images/text-image.png')}}">
                                                <div class="text-list-heading">
                                                    <h2>PA_PAWJ</h2>
                                                    <p>Manufacturing 01-250<br>Employees</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-list-box">
                                            <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                            <p>Here???s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
                                            xxxxxx XXXXXX xxx XXX XXXX XXXXXXXXXXXXX XXXXX XX XXXXXXXXXX XXXX XXXXXXX XXXXXXXXXX XXXXXXX X XXXXX!!!</p>
                                            <div class="text-list-img">
                                                <img src="{{asset('public/assets/front/images/text-image.png')}}">
                                                <div class="text-list-heading">
                                                    <h2>PA_PAWJ</h2>
                                                    <p>Manufacturing 01-250<br>Employees</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-list-box">
                                            <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                            <p>Here???s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
                                            xxxxxx XXXXXX xxx XXX XXXX XXXXXXXXXXXXX XXXXX XX XXXXXXXXXX XXXX XXXXXXX XXXXXXXXXX XXXXXXX X XXXXX!!!</p>
                                            <div class="text-list-img">
                                                <img src="{{asset('public/assets/front/images/text-image.png')}}">
                                                <div class="text-list-heading">
                                                    <h2>PA_PAWJ</h2>
                                                    <p>Manufacturing 01-250<br>Employees</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="textimonial-btn">
                                        <button id="myBtn">Create testimonials</button>
                                        <div id="myModal" class="modal">

                                          <!-- Modal content -->
                                          <div class="modal-content">
                                            <span class="close">&times;</span>
                                            <div class="textimonial-heading">
                                                <h2>Create Testimonials</h2>
                                            </div>
                                            <div class="textimonial-form">
                                                <div class="testimonial-inout">
                                                    <p>Name:</p>
                                                    <input type="text" name="">
                                                </div>
                                                <div class="testimonial-inout">
                                                    <p>Image:</p>
                                                    <div class="upload-btn-wrapper">
                                                      <button class="btn">Upload a file</button>
                                                      <input type="file" name="myfile" />
                                                    </div>
                                                </div>
                                                <div class="testimonial-inout">
                                                    <p>Job Tiles:</p>
                                                    <input type="text" name="">
                                                </div>
                                                <div class="testimonial-inout">
                                                    <p>Rating:</p>
                                                    <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                                </div>
                                                <div class="testimonial-inout">
                                                    <p>Description:</p>
                                                    <textarea></textarea>
                                                </div>
                                                <div class="testimonial-btn">
                                                    <a href="" style="background-color: #0cf; color: #fff;">Submit for review</a>
                                                    <a href="">Cancel</a>
                                                </div>
                                            </div>
                                          </div>

                                        </div>
                                    </div>
                                    <!-- The Modal -->
                                    
                                </div>
                            </section>
                        </div>
                    </div>
                </li>

                <input type="radio" name="radio-btn" id="img-5" />
                <li class="slide-container">
                    <div class="slide" style="border: none;"> 
                        <div class="inteview-plans">
                            <h2>Extensive Interview Plan</h2>
                            <div class="choose_interview">
                                <div class="select_date">
                                    <select>
                                        <option>6-14 Days</option>
                                        <option>6-14 Days</option>
                                        <option>6-14 Days</option>
                                    </select>
                                </div>
                                <div class="choose_start_rane">
                                    <input type="date" name="">
                                    <input type="time" name="">
                                </div>
                                <div class="choose_start_rane">
                                    <input type="date" name="">
                                    <input type="time" name="">
                                </div>
                            </div>
                        </div>
                        <div class="button_dv">
                                    <button class="cus-btn">Submit</button>
                                </div>
                        <section class="plan-image">
                            <div class="container">
                               <div class="plan-img-text">
                                    <!-- <img src="{{asset('public/assets/front/images/extensive_image.png')}}" style="width: 600px; height: auto;"> -->
                                    <div class="info_curcal_sec">
    <div class="info_curcal_pael">
        <div class="info_medils">
            <b>Prep Me<br>Ahead <br>Interview</b>
        </div>
        <div class="info_shep info_shep1">
            <span>1. Employment <br>Interview</span>
        </div>
        <div class="info_shep info_shep2">
            <span>2. Direct<br> Interview</span>
        </div>
        <div class="info_shep info_shep3">
            <span>3. Indirect <br>Interview</span>
        </div>
        <div class="info_shep info_shep4">
            <span>4. Board or Pane <br>Interview</span>
        </div>
        <div class="info_shep info_shep5">
            <span>5. Group <br>Interview</span>
        </div>
        <div class="info_shep info_shep6">
            <span>6. In Department <br>Interview</span>
        </div>
        <div class="info_shep info_shep7">
            <span>7. Stress<br>Interview</span>
        </div>
        <div class="info_shep info_shep8">
            <span>8. Patterned<br>Interview</span>
        </div>
    </div>
    
</div>
                                </div>
                                <div class="images-over-heading pogi_re">
                                <!--     <p class="image-center-text">Extensive<br> Interview<br> Plan</p>
                                    <p class="first-text">1. Information<br> Interview</p>
                                    <p class="second-text">2. Non<br> Directive<br> Interview</p>
                                    <p class="third-text">3. Termination <br>Interview</p>
                                    <p class="fourth-text">4. Evaluation<br> Interview</p>
                                    <p class="fifth-text">5. Routine<br> Interview</p>
                                    <p class="sixth-text">6. Views<br> assessing<br> Interview</p>
                                    <p class="seventh-text">7. Individual<br> Interview</p>
                                    <p class="eight-text">8. Exit<br> Interview</p>
                                </div>  -->
                            </div>
                        </section>
                        <section class="get_more">
                            <div class="container">
                                <div class="resume-testimonials">
                                    <h2>Resume Building Testimonials</h2>
                                    <div class="resume-img">
                                        <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                        <p>Based on <span>1385 ratings</span></p>
                                    </div>
                                </div>
                                <div class="test-list">
                                    <div class="text-list-box">
                                        <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                        <p>Here???s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
                                        xxxxxx XXXXXX xxx XXX XXXX XXXXXXXXXXXXX XXXXX XX XXXXXXXXXX XXXX XXXXXXX XXXXXXXXXX XXXXXXX X XXXXX!!!</p>
                                        <div class="text-list-img">
                                            <img src="{{asset('public/assets/front/images/text-image.png')}}">
                                            <div class="text-list-heading">
                                                <h2>PA_PAWJ</h2>
                                                <p>Manufacturing 01-250<br>Employees</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-list-box">
                                        <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                        <p>Here???s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
                                        xxxxxx XXXXXX xxx XXX XXXX XXXXXXXXXXXXX XXXXX XX XXXXXXXXXX XXXX XXXXXXX XXXXXXXXXX XXXXXXX X XXXXX!!!</p>
                                        <div class="text-list-img">
                                            <img src="{{asset('public/assets/front/images/text-image.png')}}">
                                            <div class="text-list-heading">
                                                <h2>PA_PAWJ</h2>
                                                <p>Manufacturing 01-250<br>Employees</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-list-box">
                                        <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                        <p>Here???s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
                                        xxxxxx XXXXXX xxx XXX XXXX XXXXXXXXXXXXX XXXXX XX XXXXXXXXXX XXXX XXXXXXX XXXXXXXXXX XXXXXXX X XXXXX!!!</p>
                                        <div class="text-list-img">
                                            <img src="{{asset('public/assets/front/images/text-image.png')}}">
                                            <div class="text-list-heading">
                                                <h2>PA_PAWJ</h2>
                                                <p>Manufacturing 01-250<br>Employees</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-list-box">
                                        <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                        <p>Here???s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
                                        xxxxxx XXXXXX xxx XXX XXXX XXXXXXXXXXXXX XXXXX XX XXXXXXXXXX XXXX XXXXXXX XXXXXXXXXX XXXXXXX X XXXXX!!!</p>
                                        <div class="text-list-img">
                                            <img src="{{asset('public/assets/front/images/text-image.png')}}">
                                            <div class="text-list-heading">
                                                <h2>PA_PAWJ</h2>
                                                <p>Manufacturing 01-250<br>Employees</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="test-list">
                                    <div class="text-list-box">
                                        <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                        <p>Here???s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
                                        xxxxxx XXXXXX xxx XXX XXXX XXXXXXXXXXXXX XXXXX XX XXXXXXXXXX XXXX XXXXXXX XXXXXXXXXX XXXXXXX X XXXXX!!!</p>
                                        <div class="text-list-img">
                                            <img src="{{asset('public/assets/front/images/text-image.png')}}">
                                            <div class="text-list-heading">
                                                <h2>PA_PAWJ</h2>
                                                <p>Manufacturing 01-250<br>Employees</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-list-box">
                                        <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                        <p>Here???s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
                                        xxxxxx XXXXXX xxx XXX XXXX XXXXXXXXXXXXX XXXXX XX XXXXXXXXXX XXXX XXXXXXX XXXXXXXXXX XXXXXXX X XXXXX!!!</p>
                                        <div class="text-list-img">
                                            <img src="{{asset('public/assets/front/images/text-image.png')}}">
                                            <div class="text-list-heading">
                                                <h2>PA_PAWJ</h2>
                                                <p>Manufacturing 01-250<br>Employees</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-list-box">
                                        <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                        <p>Here???s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
                                        xxxxxx XXXXXX xxx XXX XXXX XXXXXXXXXXXXX XXXXX XX XXXXXXXXXX XXXX XXXXXXX XXXXXXXXXX XXXXXXX X XXXXX!!!</p>
                                        <div class="text-list-img">
                                            <img src="{{asset('public/assets/front/images/text-image.png')}}">
                                            <div class="text-list-heading">
                                                <h2>PA_PAWJ</h2>
                                                <p>Manufacturing 01-250<br>Employees</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-list-box">
                                        <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                        <p>Here???s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
                                        xxxxxx XXXXXX xxx XXX XXXX XXXXXXXXXXXXX XXXXX XX XXXXXXXXXX XXXX XXXXXXX XXXXXXXXXX XXXXXXX X XXXXX!!!</p>
                                        <div class="text-list-img">
                                            <img src="{{asset('public/assets/front/images/text-image.png')}}">
                                            <div class="text-list-heading">
                                                <h2>PA_PAWJ</h2>
                                                <p>Manufacturing 01-250<br>Employees</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="textimonial-btn">
                                    <button id="myBtn">Create testimonials</button>
                                    <div id="myModal" class="modal" >

                                      <!-- Modal content -->
                                      <div class="modal-content">
                                        <span class="close">&times;</span>
                                        <div class="textimonial-heading">
                                            <h2>Create Testimonials</h2>
                                        </div>
                                        <div class="textimonial-form">
                                            <div class="testimonial-inout">
                                                <p>Name:</p>
                                                <input type="text" name="">
                                            </div>
                                            <div class="testimonial-inout">
                                                <p>Image:</p>
                                                <div class="upload-btn-wrapper">
                                                  <button class="btn">Upload a file</button>
                                                  <input type="file" name="myfile" />
                                                </div>
                                            </div>
                                            <div class="testimonial-inout">
                                                <p>Job Tiles:</p>
                                                <input type="text" name="">
                                            </div>
                                            <div class="testimonial-inout">
                                                <p>Rating:</p>
                                                <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                            </div>
                                            <div class="testimonial-inout">
                                                <p>Description:</p>
                                                <textarea></textarea>
                                            </div>
                                            <div class="testimonial-btn">
                                                <a href="" style="background-color: #0cf; color: #fff;">Submit for review</a>
                                                <a href="">Cancel</a>
                                            </div>
                                        </div>
                                        
                                      </div>

                                    </div>
                                </div>
                                <!-- The Modal -->
                                
                            </div>
                        </section>
                    </div>
                </li>

                <input type="radio" name="radio-btn" id="img-6" />
                <li class="slide-container">
                    <div class="slide" style="border: none;">
                        <div class="no-delay">
                            <h2>Tailored Interview Plan</h2>
                            <div class="choose_interview">
                                <div class="select_date">
                                    <select>
                                        <option>6-14 Days</option>
                                        <option>6-14 Days</option>
                                        <option>6-14 Days</option>
                                    </select>
                                </div>
                                <div class="choose_start_rane">
                                    <input type="date" name="">
                                    <input type="time" name="">
                                </div>
                                <div class="choose_start_rane">
                                    <input type="date" name="">
                                    <input type="time" name="">
                                </div>
                            </div>
                            <div class="button_dv">
                                    <button class="cus-btn">Submit</button>
                                </div>
                            <div class="dealy-images">
                                <!-- <img src="{{asset('public/assets/front/images/tailored-interview.png')}}" style="width: 600px; height: auto;"> -->
                                <div class="info_curcal_sec">
    <div class="info_curcal_pael">
        <div class="info_medils">
            <b>Tailored<br> Interview<br>Plan </b>
        </div>
        <div class="info_shep info_shep1">
            <span>1. Information <br>Interview</span>
        </div>
        <div class="info_shep info_shep2">
            <span>2. Non-
Directive<br> Interview</span>
        </div>
        <div class="info_shep info_shep3">
            <span>3. Termination <br>Interview</span>
        </div>
        <div class="info_shep info_shep4">
            <span>4. Evaluation<br>Interview</span>
        </div>
        <div class="info_shep info_shep5">
            <span>5. Routine <br>Interview</span>
        </div>
        <div class="info_shep info_shep6">
            <span>6. Views <br> assessing <br>Interview</span>
        </div>
        <div class="info_shep info_shep7">
            <span>6. Individual<br>Interview</span>
        </div>
        <div class="info_shep info_shep8">
            <span>8. Exit<br>Interview</span>
        </div>
    </div>
    
</div>
                            </div>
                            <section class="get_more">
                                <div class="container">
                                    <div class="resume-testimonials">
                                        <h2>Resume Building Testimonials</h2>
                                        <div class="resume-img">
                                            <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                            <p>Based on <span>1385 ratings</span></p>
                                        </div>
                                    </div>
                                    <div class="test-list">
                                        <div class="text-list-box">
                                            <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                            <p>Here???s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
                                            xxxxxx XXXXXX xxx XXX XXXX XXXXXXXXXXXXX XXXXX XX XXXXXXXXXX XXXX XXXXXXX XXXXXXXXXX XXXXXXX X XXXXX!!!</p>
                                            <div class="text-list-img">
                                                <img src="{{asset('public/assets/front/images/text-image.png')}}">
                                                <div class="text-list-heading">
                                                    <h2>PA_PAWJ</h2>
                                                    <p>Manufacturing 01-250<br>Employees</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-list-box">
                                            <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                            <p>Here???s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
                                            xxxxxx XXXXXX xxx XXX XXXX XXXXXXXXXXXXX XXXXX XX XXXXXXXXXX XXXX XXXXXXX XXXXXXXXXX XXXXXXX X XXXXX!!!</p>
                                            <div class="text-list-img">
                                                <img src="{{asset('public/assets/front/images/text-image.png')}}">
                                                <div class="text-list-heading">
                                                    <h2>PA_PAWJ</h2>
                                                    <p>Manufacturing 01-250<br>Employees</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-list-box">
                                            <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                            <p>Here???s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
                                            xxxxxx XXXXXX xxx XXX XXXX XXXXXXXXXXXXX XXXXX XX XXXXXXXXXX XXXX XXXXXXX XXXXXXXXXX XXXXXXX X XXXXX!!!</p>
                                            <div class="text-list-img">
                                                <img src="{{asset('public/assets/front/images/text-image.png')}}">
                                                <div class="text-list-heading">
                                                    <h2>PA_PAWJ</h2>
                                                    <p>Manufacturing 01-250<br>Employees</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-list-box">
                                            <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                            <p>Here???s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
                                            xxxxxx XXXXXX xxx XXX XXXX XXXXXXXXXXXXX XXXXX XX XXXXXXXXXX XXXX XXXXXXX XXXXXXXXXX XXXXXXX X XXXXX!!!</p>
                                            <div class="text-list-img">
                                                <img src="{{asset('public/assets/front/images/text-image.png')}}">
                                                <div class="text-list-heading">
                                                    <h2>PA_PAWJ</h2>
                                                    <p>Manufacturing 01-250<br>Employees</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="test-list">
                                        <div class="text-list-box">
                                            <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                            <p>Here???s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
                                            xxxxxx XXXXXX xxx XXX XXXX XXXXXXXXXXXXX XXXXX XX XXXXXXXXXX XXXX XXXXXXX XXXXXXXXXX XXXXXXX X XXXXX!!!</p>
                                            <div class="text-list-img">
                                                <img src="{{asset('public/assets/front/images/text-image.png')}}">
                                                <div class="text-list-heading">
                                                    <h2>PA_PAWJ</h2>
                                                    <p>Manufacturing 01-250<br>Employees</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-list-box">
                                            <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                            <p>Here???s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
                                            xxxxxx XXXXXX xxx XXX XXXX XXXXXXXXXXXXX XXXXX XX XXXXXXXXXX XXXX XXXXXXX XXXXXXXXXX XXXXXXX X XXXXX!!!</p>
                                            <div class="text-list-img">
                                                <img src="{{asset('public/assets/front/images/text-image.png')}}">
                                                <div class="text-list-heading">
                                                    <h2>PA_PAWJ</h2>
                                                    <p>Manufacturing 01-250<br>Employees</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-list-box">
                                            <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                            <p>Here???s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
                                            xxxxxx XXXXXX xxx XXX XXXX XXXXXXXXXXXXX XXXXX XX XXXXXXXXXX XXXX XXXXXXX XXXXXXXXXX XXXXXXX X XXXXX!!!</p>
                                            <div class="text-list-img">
                                                <img src="{{asset('public/assets/front/images/text-image.png')}}">
                                                <div class="text-list-heading">
                                                    <h2>PA_PAWJ</h2>
                                                    <p>Manufacturing 01-250<br>Employees</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-list-box">
                                            <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                            <p>Here???s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
                                            xxxxxx XXXXXX xxx XXX XXXX XXXXXXXXXXXXX XXXXX XX XXXXXXXXXX XXXX XXXXXXX XXXXXXXXXX XXXXXXX X XXXXX!!!</p>
                                            <div class="text-list-img">
                                                <img src="{{asset('public/assets/front/images/text-image.png')}}">
                                                <div class="text-list-heading">
                                                    <h2>PA_PAWJ</h2>
                                                    <p>Manufacturing 01-250<br>Employees</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="textimonial-btn">
                                        <button id="myBtn">Create testimonials</button>
                                        
                                    </div>
                                    <!-- The Modal -->
                                    
                                </div>
                            </section>
                        </div>
                    </div>
                </li>
                
                
                
                
                

                <li class="nav-dots">
                  <label for="img-1" class="nav-dot" id="img-dot-1"> <p>Pricing</p></label>
                  <label for="img-2" class="nav-dot" id="img-dot-2"> <p>Free</p></label>
                  <label for="img-3" class="nav-dot" id="img-dot-3"> <p>No Delay</p></label>
                  <label for="img-4" class="nav-dot" id="img-dot-4"> <p>Prep Me Ahead</p></label>
                  <label for="img-5" class="nav-dot" id="img-dot-5"> <p>Extensive</p></label>
                  <label for="img-6" class="nav-dot" id="img-dot-6"> <p>Tailored</p></label>
                </li>
            </ul>
        </div>
    </div>

</section>


<div id="myModal" class="modal" style="display:none;">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="textimonial-heading">
        <h2>Create Testimonials</h2>
    </div>
    <div class="textimonial-form">
        <div class="testimonial-inout">
            <p>Name:</p>
            <input type="text" name="">
        </div>
        <div class="testimonial-inout">
            <p>Image:</p>
            <div class="upload-btn-wrapper">
              <button class="btn">Upload a file</button>
              <input type="file" name="myfile" />
            </div>
        </div>
        <div class="testimonial-inout">
            <p>Job Tiles:</p>
            <input type="text" name="">
        </div>
        <div class="testimonial-inout">
            <p>Rating:</p>
            <img src="{{asset('public/assets/front/images/rating-img.png')}}">
        </div>
        <div class="testimonial-inout">
            <p>Description:</p>
            <textarea></textarea>
        </div>
        <div class="testimonial-btn">
            <a href="" style="background-color: #0cf; color: #fff;">Submit for review</a>
            <a href="">Cancel</a>
        </div>
    </div>
  </div>

</div>

@endsection

@section('script')
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
  
<script>   
function openCity(evt, cityName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>
@endsection