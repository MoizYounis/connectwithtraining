@extends('front.layouts.master')
@section('title')Latest Courses | {{$gs->title}} @endsection
@section('content')

<main id="maincontent" class="page-main">
	<div class="columns">
		<div class="column main">
			<div class="list-lear-option">
				<ul>
					<li class="list-online-trng">
						<a href="{{url('courses/type/online')}}">
							<img src="{{asset('public/assets/front/images/list-learn-option-1.jpg')}}"/>
							<span class="title">Online Training</span>
						</a>
					</li>
					<li class="list-onsite-trng">
						<a href="{{url('courses/type/onsite')}}">
							<img src="{{asset('public/assets/front/images/list-learn-option-2.jpg')}}"/>
							<span class="title">Onsite Classroom</span>
						</a>
					</li>
					<li class="list-your-pace">
						<a href="{{url('courses/type/your-pace')}}">
							<img src="{{asset('public/assets/front/images/list-learn-option-3.jpg')}}"/>
							<span class="title">Your Pace</span>
						</a>
					</li>
				</ul>
				<h2 class="learn-title">Learning Options</h2>
			</div>
			
			<div class="toolbar toolbar-products top ">
				<div class="container">
					<div class="left">
						<div class="brows-drop">
						<select id="category" style="padding: 0px 0px;" onfocus='this.size=8;' onblur='this.size=0;' onchange='this.size=1; this.blur();' class="select-category border" >
							<!--style="border-style: solid; border-width: 5px; border-color: black;" -->
							<option value="">Select Category</option>
							@foreach($category_data as $cat)
							<option value="{{$cat->id}}">{{ucwords($cat->category_name)}}</option>
							@endforeach
						</select>
					</div>
    				</div>
					<div class="right">
						<div class="list-search">
							<input type="text" placeholder="Search.." id="search"/>
							<button>
								<span>btn</span>
							</button>
						</div>
						<div class="toolbar-sorter sorter">
							<label class="sorter-label">Sort By</label>
						    <ul class="price-range">
                                <?php
                                   $priceDiv = round($price->max_price/6);
                                   ?>
                                <li data-amount="0,{{$priceDiv}}">< {{Helper::changeCurrency($priceDiv)}} </li>
                                <li data-amount="{{$priceDiv+1}},{{$priceDiv*2}}">{{Helper::changeCurrency($priceDiv+1)}} - {{Helper::changeCurrency($priceDiv*2)}}</li>
                                <li data-amount="{{$priceDiv*2+1}},{{$priceDiv*3}}">{{Helper::changeCurrency($priceDiv*2+1)}} - {{Helper::changeCurrency($priceDiv*3)}}</li>
                                <li data-amount="{{$priceDiv*3+1}},{{$price->max_price}}">{{Helper::changeCurrency($priceDiv*3+1)}} +</li>
                                <li data-amount="">All</li>
                            </ul>
                        </div>
						<div class="brows-drop pops-drop">
							<!--<span id="con-selected" class="select-box">Popular Today</span>-->
							<select class="selected-1 select-pops" style="background-color: white; color: #000; border: 1px solid grey !important; z-index: 10242 !important;" id="change-cat" name="2" onfocus='this.size=5;' onblur='this.size=0;' onChange="this.size=1; this.blur(); filterCourse({courseStatus: this.options[this.selectedIndex].value}, '2', '.category-design-outer');">
								<option style="text-align: center;" value=""> &nbsp;&nbsp;&nbsp;Popular Today</option>
								<option value="Trending"> &nbsp;&nbsp;&nbsp;Trending Courses</option>
								<option value="lowtohigh"> &nbsp;&nbsp;&nbsp;Price: Low to High</option>
								<option value="hightolow"> &nbsp;&nbsp;&nbsp;Price: High to Low </option>
								<option value="Featured"> &nbsp;&nbsp;&nbsp;Newly Featured Courses</option>
							</select>
						</div>
						<!--<div class="toolbar-gride">-->
						<!--	<ul>-->
						<!--		<li class="first active">-->
						<!--			<span></span>-->
						<!--			<span></span>-->
						<!--			<span></span>-->
						<!--			<span></span>-->
						<!--			<span></span>-->
						<!--			<span></span>-->
						<!--			<span></span>-->
						<!--			<span></span>-->
						<!--			<span></span>-->
						<!--		</li>-->
						<!--		<li class="second">-->
						<!--			<span></span>-->
						<!--			<span></span>-->
						<!--			<span></span>-->
						<!--			<span></span>-->
						<!--		</li>-->
						<!--		<li class="third">-->
						<!--			<span></span>-->
						<!--			<span></span>-->
						<!--			<span></span>-->
						<!--			<span></span>-->
						<!--		</li>-->
						<!--		<li class="forth">-->
						<!--			<span></span>-->
						<!--		</li>-->
						<!--		<li class="five">-->
						<!--			<span></span>-->
						<!--			<span></span>-->
						<!--			<span></span>-->
						<!--		</li>-->
						<!--	</ul>-->
						<!--</div>-->
					</div>						
			    </div>
			</div>
	        
	        <div class="category-outer">
				<div class="container">
					<!--<h2 class="category-title">IT &amp; Software</h2>-->
					<div class="category-design-outer">
					    @foreach($category_data as $cat)
					    <?php
    					    $type = ucwords(str_replace('-', ' ', Request::segment(3)));
    					    if($type){
    					        $courses = \App\Model\Course::where('category_id', $cat->id)->where('course_learning_status', $type)->orderBy('id', 'DESC')->get();    
    					    }
    					    else{
    					        $courses = \App\Model\Course::where('category_id', $cat->id)->orderBy('id', 'DESC')->get();
    					    }
                		    
                        ?>
                        @if(count($courses) > 0)
                        
                            <h2>{{ucwords($cat->category_name)}}</h2>
						
    						<div class="traning-outer list-traning-outer">
    							<ul>
    							    <?php $a = array( "'",' ', '@', '&'); ?>
    			                    @foreach($course_list as $course)
    			                        @if($cat->category_name == $course->category_name)
    									<li>
    										<div class="trn-top">
    										<div class="list-trn-top">
    											<div class="left">
    												<h2 class="trn-title">Certification Training</h2>
    											<div class="img-part">
    													<img src="{{asset('public/assets/front/img/course/'.$course->course_image)}}" alt="">
    													<div class="ins">
    														<p>{{ucwords($course->category_name)}}</p>
    														<h3>{{ucwords($course->course_name)}}</h3>
    													</div>
    													<a class="learn-more" href="{{url('courses', str_replace(' ', '-', strtolower($course->course_name)))}}">Learn More</a>
    													<div class="quick-links">
    														<ul>
    															<li class="watch">
    																<a href="{{url('courses', str_replace(' ', '-', strtolower($course->course_name)))}}">
    																	<span class="icon"><i class="fa fa-eye"></i></span>
    																	<span class="con">Watch</span>
    																</a>
    															</li>
    															<li class="buy-now">
    																<a href="{{url('cart')}}">
    																	<span class="icon"><i class="fa fa-rss"></i></span>
    																	<span class="con">Buy Now</span>
    																</a>
    																
    															</li>
    															<li class="cart" onclick="addToCart('{{$course->course_name}}', '{{$course->id}}')">
    																<a href="javascript:void(0);">
    																	<span class="icon"><i class="fa fa-cart-plus"></i></span>
    																	<span class="con">Cart</span>
    																</a>
    															</li>
    															<li class="favr" onclick="addToFav('{{$course->course_name}}', '{{$course->id}}')">
    																<a href="javascript:void(0);">
    																	<span class="icon"><i class="fa fa-heart"></i></span>
    																	<span class="con">Favorite</span>
    																</a>
    															</li>
    														</ul>
    													</div>
    												</div>
    											</div>
    											<div class="right">
    												<div class="after-img-part">
    														<div class="left">
    															<h2>{{ucwords($course->course_name)}}</h2>
    															<p class="con">{{$course->course_details}}</p>
    														</div>
    														<div class="right">
    															<div class="take-cours"><a herf="javascript:void(0);" class="cus-btn" onclick="addToCart('<?= $course->course_name;?>','<?= $course->id;?>')">Take Course</a></div>
    															<div class="calender-date">
																    <!--<img src="{{asset('public/assets/front/images/start-date.jpg')}}" alt=""/>-->
																    <div>
																        <div class="cal-month">
																            <h5>{{ date("F", strtotime($course->course_start_date)) }}</h5>  
																        </div>
																        <div class="cal-date">
																            <h2>{{ date("d", strtotime($course->course_start_date)) }}</h2>
																        </div>
																    </div>
    															</div>
    															<div class="rating-outer">
    																<p class="rating-con"><?= App\Helpers\Helper::getRating($course->id)['str']; ?></p>
    																<div class="rating-star">
    																	<span class="fa fa-star @if(App\Helpers\Helper::getRating($course->id)['star_rating'] >= 1){{'checked'}} @endif"></span>
    																	<span class="fa fa-star @if(App\Helpers\Helper::getRating($course->id)['star_rating'] >= 2){{'checked'}} @endif"></span>
    																	<span class="fa fa-star @if(App\Helpers\Helper::getRating($course->id)['star_rating'] >= 3){{'checked'}} @endif"></span>
    																	<span class="fa fa-star @if(App\Helpers\Helper::getRating($course->id)['star_rating'] >= 4){{'checked'}} @endif"></span>
    																	<span class="fa fa-star @if(App\Helpers\Helper::getRating($course->id)['star_rating'] >= 5){{'checked'}} @endif"></span>
    																</div>
    															</div>
    															<div class="count-lec">
    																<p>187 lectures</p>
    																<p>{{$course->author_name}}</p>
    															</div>
    															
    														</div>
    												</div>
    											</div>
    										</div>
    											<div class="web-training-outer">
    												
    												<div class="lrn-option-outer">
    													<p class="option-title">Available Learning Options</p>
    													<ul class="option-crs">
    														<li class="online">
    															<a href="{{url('courses/type/online')}}">
    																<span class="icon"></span>
    																<span class="con">Select Online Training</span>
    															</a>
    														</li>
    														<li class="class-roome">
    															<a href="{{url('courses/type/onsite')}}">
    																<span class="icon"></span>
    																<span class="con">Select Onsite Classroom</span>
    															</a>
    														</li>
    														<li class="other">
    															<a href="{{url('courses/type/your-pace')}}">
    																<span class="icon"></span>
    																<span class="con">Select Your Pace</span>
    															</a>
    														</li>
    													</ul>
    													
    												</div>
    												<div class="chat-outer">
    													<ul>
    														<li class="chat-with">
    															<a href="javascript:void(0);" data-modalId="{{$course->id}}" class="openInsModal">Chat With Instructor</a>
    														</li>
    														<li class="price">
    															<span class="old-price">
    															    <?php
    															    if($course->course_discout_type == "Percentage"){
                                                                        $newPrice = $course->course_price * $course->course_discout / 100;
                                                                        $newPrice = $course->course_price - $newPrice;
                                                                        echo Helper::changeCurrency($course->course_price);
                                                                    }
                                                                    elseif($course->course_discout_type == "Amount"){
                                                                        $newPrice = $course->course_price - $course->course_discout;
                                                                        echo Helper::changeCurrency($course->course_price);
                                                                    }
                                                                    else{
                                                                        $newPrice = $course->course_price;
                                                                    }
                                                                    ?>
    															</span>
    															<span class="crunt-price">{{Helper::changeCurrency($newPrice)}}</span>
    														</li>
    													</ul>
    													<div class="radio-btn">
    														<input type="radio" name="online">
    														<span class="btn-radio">radio-btn</span>
    													</div>
    													<div class="request-btn">
    														<a href="#">Request for Classroom Course</a>
    													</div>
    												</div>
    											</div>
    										</div>
    									</li>
    									@endif
    								@endforeach
    							</ul>
    						</div>
    					@endif
						@endforeach
					</div>
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
       	$('.price-range li').click(function(){
       		var priceRange = {priceRange: $(this).attr('data-amount')};
       		filterCourse(priceRange, '2', '.category-design-outer');
       	});
       	$('#category').change(function(){
       		var category = {category: $(this).val()};
       		filterCourse(category, '2', '.category-design-outer');
       	});
       	$('#search').keyup(function(){
       		var search = {search: $(this).val()};
       		filterCourse(search, '2', '.category-design-outer');
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