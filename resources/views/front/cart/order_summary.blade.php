@extends('front.layouts.master')
@section('title')Your Order Summary | {{$gs->title}} @endsection
@section('content')

<section class="breadcrums">
        <div class="container" style="max-width: 1223px;">
            <h2 >Order Summary</h2>    
        </div>
    </section>
    <section class="order-summary">
        <div class="container">
             <div class="summary-head">
                 <img src="{{asset('public/assets/front/images/thread.png')}}">
                 <h2>Your Order Summary</h2>
             </div>
             <div class="summary-body">
                 <div class="summary-heading">
                     <h3>Description</h3>
                     <h3>Amount</h3>
                 </div>
                 <div class="summary-item">
                     <div class="order-item">
                        <h2>Courses</h2>
                        <div class="gift-item">
                            
                            @php $price=0; $i=1; @endphp
                            @foreach($cart as $c)
                                <ul>
                                    <li class="{{$i / 2}}">
                                        <div class="item-text">
                                            <div class="item-body">
                                                <div class="item-image">
                                                    <div class="item-heading">
                                                        <h5>Certifiaction Training</h5>
                                                    </div>
                                                    <img src="{{asset('public/assets/front/img/course/'.$c->course_image)}}">
                                                    <!--<div class="image-over">-->
                                                    <!--    <p>Introduction</p>-->
                                                        
                                                    <!--</div>-->
                                                </div>
                                                <div class="text-up">
                                                    <h2>{{ucwords($c->course_name)}}</h2>    
                                                    <h4>{{ucwords($c->category_name)}}</h4>
                                                    <p>{{$c->course_details}}</p>
                                                    <a href="{{url('courses', str_replace(' ', '-', strtolower($c->course_name)))}}">Course</a>  
                                                </div>
                                            </div>
                                        <!--<div class="item-below">-->
                                        <!--    <img src="{{asset('public/assets/front/images/ultrasound.png')}}">-->
                                        <!--    <h2>$1250</h2>-->
                                        <!--    <div class="gift-btn">-->
                                        <!--      <a href="">Your Gifts</a>  -->
                                        <!--    </div>-->
                                        <!--</div>-->
                                        </div>
                                    </li>
                                </ul>
                                @if($i % 2 == 0)
                                <br>
                                @endif
                                @php $price += $c->course_price; $i++ @endphp
                            @endforeach
                            <!--<div class="item-trash">-->
                            <!--    <p><i class="fa fa-edit"></i> Edit</p>-->
                            <!--    <p><i class="fa fa-close"></i> Remove</p>-->
                            <!--</div>-->
                         </div>
                     </div>
                     <div class="summary-amount">
                         <h2>${{$price}}</h2>
                     </div>
                 </div>
                 <div class="summary-pormo">
                     <h2>Shipping</h2>
                     <h2>${{$gs->shipping_charges}}</h2>
                 </div>
                 <div class="summary-pormo">
                    <div class="promo-text">
                       <h2>Item Total</h2>
                       <h2>${{$price}}</h2> 
                    </div>
                    <div class="promo-text">
                       <h2>Tax:</h2>
                       <h2>$0.00</h2> 
                    </div>
                 </div>
                 <div class="summary-pormo" style="border-bottom: none;">
                     <h2 class="exp">Total</h2>
                     <h2>${{$gs->shipping_charges+$price}}</h2>
                 </div>
                 <div class="summary-pormo" style="border-bottom: none;">
                     <a href="{{url('courses')}}" class="keep-btn">Keep Browsing</a>
                     <a href="{{url('payment-plan')}}" class="place-btn">Select payment plan</a>
                 </div>
             </div>
        </div>
    </section>
    
@endsection