@extends('front.layouts.master')
@section('title')Cart | {{$gs->title}} @endsection
@section('content')

	<main id="maincontent" class="page-main">
			<div class="columns">
				<div class="column main">
					<section class="breadcrumbs_block">
						<div class="container">
							<ol class="breadcrumb_list">
								<li>
									Cart
								</li>
							</ol>
						</div>
					</section>
					<div class="container">
						<!--<div class="add-massage">-->
						<!--	<span>Item added to your cart</span>-->
						<!--</div>-->
						<!--<div class="cart-intro-outer">-->
						<!--	<table>-->
						<!--		<tbody>-->
						<!--			<tr>-->
						<!--				<td width="225px"><img src="{{asset('public/assets/front/images/cart-tarn-img.jpg')}}" alt="car-image" class="image"/></td>-->
						<!--				<td>-->
						<!--					<h3 class="itro">Introduction</h3>-->
						<!--					<h2 class="pro-name">Project Management</h2>-->
						<!--					<p class="curs-name">Web Training and Tutorials</p>-->
						<!--					<p class="teacher-name">Class by Gretathemes</p>-->
						<!--					<div class="buy-btn">-->
						<!--						<button class="btn cus-btn btn1">Buy Now</button>-->
						<!--					</div>-->
						<!--					<div class="duration">-->
						<!--						<span class="c-d">Class Duration</span>-->
						<!--						<span class="wk">12-16 weeks</span>-->
						<!--					</div>-->
						<!--					<div class="des"><b>Extend support to 12 months. +$18</b> <span>Save $24</span></div>-->
						<!--				</td>-->
						<!--				<td>-->
						<!--					<div class="crt-rating" style="margin-left:0;"> -->
						<!--						<div class="rating-outer">-->
						<!--												<p class="rating-con"><b>4.6</b>(1074)</p>-->
						<!--												<div class="rating-star">-->
						<!--													<span class="fa fa-star checked"></span>-->
						<!--													<span class="fa fa-star checked"></span>-->
						<!--													<span class="fa fa-star checked"></span>-->
						<!--													<span class="fa fa-star"></span>-->
						<!--													<span class="fa fa-star"></span>-->
						<!--												</div>-->
						<!--										</div>-->
												
						<!--					</div>-->
						<!--					<div class="Pro-code duration">-->
						<!--						<span class="c-d">Promo Code :</span>-->
						<!--						<input type="text" class="wk" placeholder="SPRING356"/>-->
						<!--					</div>-->
						<!--					<a href="#" class="learn-more">Learn More</a>-->
						<!--				</td>-->
						<!--				<td>-->
						<!--					<div class="abt-class">-->
						<!--						<span class="con-title">Class Starts On</span>-->
						<!--						<span class="calendar"><img src="{{asset('public/assets/front/images/start-date.jpg')}}" alt=""/></span>-->
						<!--					</div>-->
						<!--					<div class="price">-->
						<!--						<span>Prices</span>$1250-->
						<!--					</div>-->
						<!--				</td>-->
						<!--				<td style=" vertical-align: middle;" class="buy-btn">-->
						<!--					<a href="#" class=" btn cus-btn" >Move to Wishlist</a>-->
						<!--					<a href="#" class=" btn cus-btn">Remove</a>-->
						<!--				</td>-->
										
						<!--			</tr>-->
						<!--		</tbody>-->
						<!--	</table>-->
						<!--</div>-->
						
						
						<div class="your-cart-outer">
							<div class="your-cart">
								<h2 class="cart-title">Your Shopping Cart</h2>
								<a href="{{url('courses')}}" class="kp-brws">Keep Browsing</a>
							</div>
							<!--<div class="your-cart-pop">-->
							<!--	<p class="cart-itm-con">The following item has changed prices:</p>-->
							<!--	<p class="cart-itm-detail">Ambiance Linear Delux 2 Fireplace, 80”, Stainless... <span>Price has changed from $2,424.99 to $2,424.03.</span></p>-->
							<!--	<div class="list-cnt-item">-->
							<!--		<select>-->
							<!--			<option>1</option>-->
							<!--			<option>2</option>-->
							<!--			<option>3</option>-->
							<!--		</select>-->
							<!--		<div class="move-cart">-->
							<!--			<a href="#" class="remove">Remove</a>-->
							<!--			<a href="#" class="move-wish">Move to Wish List</a>-->
							<!--		</div>-->
							<!--	</div>-->
							<!--	<a class="cross-icon">X</a>-->
							<!--</div>-->
						</div>
						<div class="your-cours-outer">
							<div class="left-part">
								<h2 class="you-may-title">You may also be interested:</h2>
								<ul class="cart-pro-list">
								    @foreach($related_list as $rl)
									<li>
										<div class="cart-products-outer">
											<div class="pro-img">
												<img src="{{asset('public/assets/front/img/course/'.$rl->course_image)}}" alt="{{$rl->course_name}}" class="image"/>
											</div>
											<div class="pro-details">
												<h3 class="itro">{{ucwords($rl->course_certification_type)}}</h3>
												<h2 class="pro-name">{{ucwords($rl->course_name)}}</h2>
												<p class="curs-name">{{ucwords($rl->category_name)}}</p>
												<p class="teacher-name">Class by {{ucwords($rl->author_name)}}</p>
												<div class="buy-btn">
													<button class="btn cus-btn" onclick="addToCart('{{ucwords($rl->course_name)}}', '{{$rl->id}}')">Buy Now</button>
												</div>
												<div class="duration">
													<span class="c-d">Class Duration</span>
													<span class="wk">{{ucwords($rl->course_duration)}}</span>
												</div>
												<div class="des"> <span>
												    @if($rl->course_discout_type == 'Amount')
												        {{'Get Amount '.$rl->course_discout.' Discount.'}}
												    @elseif($rl->course_discout_type == 'Percentage')
        									            {{'Get '.$rl->course_discout.'% Discount.'}}
        									        @else
        									            {{'No Discount Offer Available.'}}
        									        @endif
												</span>original price {{App\Helpers\Helper::changeCurrency($rl->course_price)}}</div>
											</div>
											<div class="cart-left-rating-outer">
												<div class="crt-rating">
													<div class="rating-outer">
														<p class="rating-con"><?= \App\Helpers\Helper::getRating($rl->id)['str']; ?></p>
														<div class="rating-star">
															<span class="fa fa-star @if(\App\Helpers\Helper::getRating($rl->id)['star_rating'] >= 1){{" checked" }}@endif"></span>
															<span class="fa fa-star @if(\App\Helpers\Helper::getRating($rl->id)['star_rating'] >= 2){{" checked" }}@endif"></span>
															<span class="fa fa-star @if(\App\Helpers\Helper::getRating($rl->id)['star_rating'] >= 3){{" checked" }}@endif"></span>
															<span class="fa fa-star @if(\App\Helpers\Helper::getRating($rl->id)['star_rating'] >= 4){{" checked" }}@endif"></span>
															<span class="fa fa-star @if(\App\Helpers\Helper::getRating($rl->id)['star_rating'] >= 5){{" checked" }}@endif"></span>
														</div>
													</div>
																		
												</div>
											</div>
										</div>
									</li>
									@endforeach
								</ul>
								<!--<div class="view-cart-outer">-->
								<!--	<a href="#" class="view-cart">View Cart</a>-->
								<!--</div>-->
							</div>
							<div class="right-part">
								<!--<div class="course-outer">-->
								<!--	<h2 class="title"> Your Courses </h2>-->
								<!--	<div class="cart-menu">-->
								<!--		<ul>-->
								<!--		    <li><a href="void:javascript();">No Course Available</a></li>-->
								<!--		</ul>-->
								<!--		<div class="cart-search">-->
								<!--			<input type="text" placeholder="Search"/>-->
								<!--			<button>-->
								<!--				<span><i class="fa fa-search" aria-hidden="true"></i></span>-->
								<!--			</button>-->
								<!--		</div>-->
								<!--	</div>-->
								<!--	<div class="cart-breadcrumb">-->
								<!--		<ul class="breadcrumb_list">-->
								<!--			<li><a href="{{route('home')}}">Home</a></li>-->
								<!--		</ul>-->
								<!--	</div>-->
								<!--</div>-->
								<div class="cart-product-order-outer">
								<div class="cart-product-left">
									<div class="cart-product-outer">
										<div class="continue-shoping-head">
											<a href="{{url('courses')}}" style="color:white;"><span class="title">Continue Shopping</span></a>
											<span class="pro-item"></span>
											<div class="pro-cart-item emptyCart">
												<span class="cart-icon"></span>
												<a class="cross">x<span class="class-tooltip">Empty Cart</span></a>
											</div>
										</div>
										<div class="add-cart-item">
											<div class="add-box add-all">
												<a>
													<span class=""><input type="checkbox" id="checkAll"></span>
													<span class="minus">-</span>
													<span class="con">All</span>
												</a>
											</div>
											<div class="add-box add-item moveToFav" style="cursor:pointer;">
												<a>Add Checked Items to Favorites</a>
											</div>
											<div class="add-box remove-item removeFromCart" style="cursor:pointer;">
												<a>Remove Checked Items</a>
											</div>
										</div>
										
									
										<div class="cartData"></div>
										
										<div class="continue-shopping-outer">
											<div class="continue-shopping">
												<a href="{{url('courses')}}">Continue Shopping</a>
											</div>
											<div class="total-right">
												<div class="total-price">
													<span>Total</span>
													<span class="price subTotal"></span>
												</div>
												<div class="check-btn">
												    <a href="{{url('checkout')}}" style="color:white; text-decoration:none;">
													<button>
														<span>Checkout</span>
													</button>
													</a>
												</div>
											</div>
										</div>
										
									</div>
								</div>
								<div class="product-pro-right">
									<div class="order-details-outer">
										<div class="cart-live-chat">
											<a href="#">Live Chat</a>
										</div>
										<h2>Order Details</h2>
										<div class="total">
											<ul>
												<li>
													<span class="title">Subtotal</span>
													<span class="price subTotal"></span>
												</li>
												<!--<li>-->
												<!--	<span class="title">Shipping</span>-->
												<!--	<span class="price shippingCharges"></span>-->
												<!--</li>-->
												<!--<li>-->
												<!--	<span class="title">Promo Code</span>-->
												<!--	<input type="text" placeholder="SPRING356" class="price code"/>-->
												<!--</li>-->
												<!--<li>-->
												<!--	<span class="title">Tax</span>-->
												<!--	<span class="price tax-qnt">- -</span>-->
												<!--</li>-->
												<!--<li class="discount">-->
												<!--	<span class="title">Discount</span>-->
												<!--	<span class="price">- -</span>-->
												<!--</li>-->
												<li class="total">
													<span class="title">Total</span>
													<span class="price cartTotalPrice"></span>
												</li>
											</ul>
										</div>
										<div class="chk-btn">
											<a href="{{url('checkout')}}">Checkout</a>
										</div>
										<div class="cont-shopping">
											<a href="{{url('courses')}}"><< Continue Shopping</a>
										</div>
									</div>
								</div>
								</div>
							</div>
						</div>
						<div class="cart-wish-list-outer favList"></div>
						
						<!--<div class="cart-sign-up-outer">-->
						<!--	<ul>-->
						<!--		<li>-->
						<!--			<div class="cart-sign-up-inr">-->
						<!--				<p class="name">Student</p>-->
						<!--				<p class="con">Sign up for a TORCH student account</p>-->
						<!--				<button>-->
						<!--					<span>Student signup</span>-->
						<!--				</button>-->
						<!--				<span class="free">Free!</span>-->
						<!--			</div>-->
						<!--			<a class="cross">X</a>-->
						<!--		</li>-->
						<!--		<li>-->
						<!--			<div class="cart-sign-up-inr">-->
						<!--				<p class="name">Instructors</p>-->
						<!--				<p class="con">Sign up for a TORCH instructor account</p>-->
						<!--				<button>-->
						<!--					<span>Instructor signup</span>-->
						<!--				</button>-->
						<!--				<span class="free">Free!</span>-->
						<!--			</div>-->
						<!--			<a class="cross">X</a>-->
						<!--		</li>-->
						<!--	</ul>-->
						<!--</div>-->
						<div class="popular-course">
							<h2 class="course-title">Popular Courses</h2>
							<div class="course-detals-outer">
								<div class="left-side trendingCourse">
								
								</div>
								<div class="right-side">
									<div class="add-fav-outer">	
										<h2>Add to Favorites</h2>
										<ul>
										    @php $i=1 @endphp
										    @foreach($course_names as $cn)
											<li class="stu-ico{{$i}}">
												<span>{{ucwords($cn->course_name)}}</span>
												<a href="javascript:void();" onclick="addToFav('{{ucwords($cn->course_name)}}','{{$cn->id}}');">+add</a>
											</li>
											@php $i++ @endphp
											@endforeach
										</ul>
										<a href="{{url('courses')}}" class="add-fav-btn">Continue</a>
									</div>	
								</div>
							</div>
						</div>
						
						<div class="popular-course also-like" >
							<h2 class="course-title">You May Also Like</h2>
							<div class="featuredCourse"></div>
						</div>
						
					</div>
					
				</div>
			</div>
		</main>

@endsection
@section('script')
<script src="{{asset('public/assets/front/js/custom.js')}}"></script>
<script>
    $(document).ready(function(){
   		loadCart();
   		
        getRelatedCourse({courseStatus: "Trending"}, '.trendingCourse', '6', '2', '{{csrf_token()}}');
   	    getRelatedCourse({courseStatus: "Featured"}, '.featuredCourse', '6', '2', '{{csrf_token()}}');
        
        loadFav();
        
        $('.emptyCart').click(function(){
            emptyCart('{{csrf_token()}}');
        });
        
        var items = [];
        $("#checkAll").change(function() {
            if (this.checked) {
                $(".checkSingle").each(function() {
                    this.checked=true;
                });
            }
            else {
                $(".checkSingle").each(function() {
                    this.checked=false;
                });
            }
        });
        
        $('.moveToFav').click(function(){
            items = [];
            $(".checkSingle:checked").each(function(){
                items.push($(this).val());
            });
            if(items.length > 0){
                moveToFav(items);
            }
            else{
                round_error_noti('Please select course');
            }
        });
        
        $('.removeFromCart').click(function(){
            items = [];
            $(".checkSingle:checked").each(function(){
                items.push($(this).val());
            });
            if(items.length > 0){
                removeFromCart(items);
            }
            else{
                round_error_noti('Please select course');
            }
        });
    });
</script>
<script>
    // Get the modal
    var modal = document.getElementById("insModal");
    
    $(document).on("click", ".openInsModal", function(event) { 
        $('.emailError').html("");
        $('.phoneError').html("");
        $('.successMsg p').html("");
        $('.inscid').val($(this).attr("data-modalid"));
        modal.style.display = "block";
    });
    
    $(document).on("click", ".closeInsModal", function(event) { 
        modal.style.display = "none";
    });
    
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
</script>
@endsection