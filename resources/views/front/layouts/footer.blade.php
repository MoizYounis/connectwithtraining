@php
$blogs = App\Model\Blog::Join('blog_categories as bc', 'bc.id', '=' ,'blogs.blog_cat_id')->selectRaw('blogs.blog_title, bc.blog_cat_name, blogs.blog_content')->where('blogs.blog_status', 'Publish')->orderBy('blogs.id', 'DESC')->limit(4)->get();
@endphp

    <!-- The Modal -->
    <div id="insModal" class="modal" style="display:none;">
        <!-- Modal content -->
        <div class="modal-content chat-modal">
            <div>
				<span class="closeModal closeInsModal">&times;</span>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-12 col-sm-12 col-md-8 col-lg-8 mb-4">
						<div class="">
							<form method="post" class="chat-design modal-padd-rght" method="post" id="chatWithInstructor">
								<div>
									<h2>I Would Like To Chat With Instructor</h2>
								</div>
								<div class="row contact-Containers">
									<div class="columns-contacts chat-padding-rght">
										<img style="width: 100%;" src="{{asset('public/assets/front/images/img1.png')}}">
									</div>
									<div class="columns-contacts" style="margin-top: 30px;">
										<div class="form-group">
											<label>Email</label>
											<input type="text" class="form-field email" name="email" placeholder="Email" value="" > 
											<span style="color:red;" class="emailError"></span>
										</div><br>
										<div class="form-group">
											<label>Phone Number</label>
											<input class="form-field phone" type="tel" name="phone" pattern="[0-9\-]*" placeholder="Phone Number" value="">
											<span style="color:red;" class="phoneError"></span>
										</div>
										<div class="form-group">
										    <input type="hidden" name="course_id" class="inscid" value="">
											<input type="submit" class="btn" value="Send Message">
										</div><br>
										<div class="successMsg">
											<p></p>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
    <!--End The Modal -->
    
	<div class="footer-accordion">
		<footer class="footer">
			<div class="footer-top">
				<div class="footer-container">
					<div class="left">
						<ul class="nav navbar-nav">
							<li>
								<a href="{{route('home')}}">Home</a>
							</li>
							<li>
								<a href="{{url('about')}}">About us</a>
							</li>
							<li>
								<a href="{{url('get-more')}}">Services</a>
							</li>
							<li class="has-sub">
								<a href="#">Protfolio</a>
								<ul class="footer-sub">
									<li>
										<a href="{{url('coming-soon')}}">Testimonials</a>
									</li>
									<li>
										<a href="{{url('coming-soon')}}">Forum</a>
									</li>
									<li>
										<a href="{{url('coming-soon')}}">Advertise with Us</a>
									</li>
									<li>
										<a href="{{url('coming-soon')}}">Partnerships</a>
									</li>
									<li>
										<a href="{{url('coming-soon')}}">Affiliates Program</a>
									</li>
									<li>
										<a href="{{url('press')}}">Press</a>
									</li>
									<li>
										<a href="{{url('copyrights')}}">Copyrights</a>
									</li>
								</ul>
							</li>
							<li class="has-sub">
								<a href="#">More</a>
								<ul class="footer-sub">
									<li>
										<a href="{{url('privacy-policy')}}">Privacy Policy</a>
									</li>
									<li>
										<a href="{{url('terms-conditions')}}">Terms &amp; Condition</a>
									</li>
									<li>
										<a href="{{url('trust-safety')}}">Trust &amp; Safety</a>
									</li>
									<li>
										<a href="{{url('security')}}">Security</a>
									</li>
									<li>
										<a href="{{url('legal')}}">Legal</a>
									</li>
									<li>
										<a href="{{url('fees-charges')}}">Fees and Charges</a>
									</li>
								</ul>
								
							</li>
							<li>
								<a href="{{url('coming-soon')}}">Blog</a>
							</li>
							<li>
								<a href="{{url('contact')}}">Contact Us</a>
							</li>
						</ul>
					</div>
					<div class="right"><a href="{{route('home')}}">Business with Connect <span class="orange">With</span> <span class="green">Training</span></a></div>
				</div>
			</div>
			<div class="footer-bottom">
			<div class="footer-container">
			<div class="footer-social-link-outer" >
				<div class="facebook">
					<p class="title">FACEBOOK</p>
					<div class="face-con">
						<div id="fb-root"></div>
						<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v6.0&appId=796275190867853&autoLogAppEvents=1"></script>
						<div class="fb-page" data-href="https://www.facebook.com/Test-103447155754764" data-tabs="timeline" data-width="250" data-height="250" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"></div>
						{{--<div class="face-img"><img src="{{asset('public/assets/front/images/face-book-img.png')}}" alt=""></div>--}}
						{{--<div class="face-pro">--}}
							{{--<span class="pro-img"><img src="{{asset('public/assets/front/images/pro-img.png')}}" alt=""></span>--}}
							{{--<div class="face-pro-con">--}}
								{{--<p class="mail">Connectwithtraining.com</p>--}}
								{{--<p class="time">3 hours ago</p>--}}
							{{--</div>--}}
						{{--</div>--}}
						{{--<div class="face-des">--}}
							{{--<p>{{$gs->title}}</p>--}}
						{{--</div>--}}
					</div>
				</div>
				<div class="tweets">
					<p class="title">TWEETS</p>
					<div class="tweets-con">
						{{--<ul>--}}
							{{--<li>--}}
								{{--<div class="tweet-con">RT <a href="#">@drinksfeed:</a> 5 Drinks that should be on your south african summer Holiday checklist <a href="#">https://t.co/U1UiXFJVrH</a></div>--}}
								{{--<p class="mail">@winelands_co_za - 2 hours ago</p>--}}
							{{--</li>--}}
							{{--<li>--}}
								{{--<div class="tweet-con">RT <a href="#">@drinksfeed:</a> 5 Drinks that should be on your south african summer Holiday checklist <a href="#">https://t.co/U1UiXFJVrH</a></div>--}}
								{{--<p class="mail">@winelands_co_za - 2 hours ago</p>--}}
							{{--</li>--}}
						{{--</ul>--}}
						<a class="twitter-timeline" data-width="250" data-height="250" data-theme="light" href="https://twitter.com/conectwithtrain?ref_src=twsrc%5Etfw">Tweets by conectwithtrain</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
					</div>
					<div class="tweet-btn">
						{{--<button><span><i class="fa fa-twitter"></i>Follow</span></button>--}}
					</div>
				</div>
				<div class="from-blog">
					<p class="title">FROM OUR BLOG</p>
					<div class="frm-blg-outer">
						@if(count($blogs)>0)
							<?php $i=1; ?>
							@foreach($blogs as $blog)
								<div class="cont" style="padding-left:0;">
									<!--<span class="img"><img src="{{asset('public/assets/front/images/blog-img-'.$i.'.png')}}" alt=""></span>-->
									<?php 
										if(strlen($blog->blog_title)>20){
											$blogTitle = substr($blog->blog_title, 0, 30);
											$blogTitle = $blogTitle."...";
										}
										else{ $blogTitle = $blog->blog_title; }
									 ?>
									<h2 class="title" title="{{$blog->blog_title}}">{{$blogTitle}}</h2>
									<p class="con">{{$blog->blog_cat_name}}</p>
							
									    <?php
									    if(strlen($blog->blog_content)>20){
											$blogContent = substr($blog->blog_content, 0, 260);
											// $blogContent = $blogContent."<a href='#'>... Read full article</a>";
									     }
										else{
										    $blogContent = $blog->blog_content;
										}
										echo $blogContent."</p>";
										?>
									
								</div>
								<?php $i++; ?>
							@endforeach
						@else
							<h2 style="color:white;">No Blogs Found..</h2>
						@endif
					</div>
				</div>
				<div class="cont-info">
					<p class="title">CONTACT INFO</p>
					<div class="cont-info-outer">
						<p class="cnt-img">
							<a href="{{route('home')}}"><img src="{{asset('public/assets/front/images/connect-img.png')}}" alt=""></a>
						</p>
						<ul>
							<li class="home"> <i class="fa fa-home"></i>{{$gs->contact_address}} </li>
							<li class="mail"><i class="fa fa-envelope-o"></i>
								<a href="mailto:{{$gs->contact_email}}">{{$gs->contact_email}}</a>
							</li>
							<!-- <li class="number-1"><i class="fa fa-clock-o"></i> 1+202-683-8583 </li> -->
							<li class="number-2"><i class="fa fa-plus-square"></i> 
								<a href="tel:{{$gs->customer_no}}">{{$gs->customer_no}}</a>
							</li>
						</ul>
					</div>
					<!--<div class="live-chat">-->
					<!--	<a href="#">Live Chat</a>-->
					<!--</div>-->
				</div>
				
			</div>
			<div class="footer-floow-us-outer">
				<div class="floow-us">
					<h2 class="title">Follow Us</h2>
					<?php $social = json_decode($gs->social_links); ?>
					<ul>
					    @if(isset($social->twitter))
						<li class="twiter">
							<a target="_blank" href="{{$social->twitter}}"><i class="fa fa-twitter"></i></a>
						</li>
						@endif
						
						@if(isset($social->facebook))
						<li class="face-book">
							<a target="_blank" href="{{$social->facebook}}"><i class="fa fa-facebook"></i></a>
						</li>
						@endif
						
						@if(isset($social->google))
						<li class="ins">
							<a target="_blank" href="{{$social->google}}"><i class="fa fa-google-plus"></i></a>
						</li>
						@endif
						
						@if(isset($social->youtube))
						<li class="twiter">
							<a target="_blank" href="{{$social->youtube}}"><i class="fa fa-youtube"></i></a>
						</li>
						@endif
						
						@if(isset($social->linkdin))
						<li class="face-book">
							<a target="_blank" href="{{$social->linkdin}}"><i class="fa fa-linkedin"></i></a>
						</li>
						@endif
						
						@if(isset($social->instagram))
						<li class="ins">
							<a target="_blank" href="{{$social->instagram}}"><i class="fa fa-instagram"></i></a>
						</li>
						@endif
						
					</ul>
					<div class="newsletter">
						<input type="text" placeholder="Email Address.." id="emailAddress">
						<button onclick="doSubscribe('<?= csrf_token(); ?>');">
							<span>Subscribe</span>
						</button>
					</div>
				</div>
				<div class="useful-res">
					<h2 class="title">Useful Resources</h2>
					<div class="subcribe-sec">
						<ul class="left">
							<li><a href="{{url('login')}}">Signup</a></li>
							<li><a href="{{url('refer-a-friend')}}">Invite Friend</a></li>
							<li><a href="{{url('gift-card')}}">Gift Card</a></li>
							<li><a href="{{url('our-payment-plan')}}">Payment Plan</a></li>
							<li><a href="{{url('coming-soon')}}">Careers</a></li>
							<li><a href="{{url('resume-building')}}">Resume Building</a></li>
						</ul>
					</div>
				</div>
			</div>
			</div>
			</div>
			<div class="copyright">
				<a href="{{route('home')}}" class="logo"><img src="{{asset('public/assets/front/images/footer-logo.png')}}"></a>
				<p class="copyright-con">{{'Copyright © '.date("Y").' | All Rights Reserved.'}}</p>
				<!--<a href="#" class="sitemap">SITEMAP</a>-->
			</div>
			<div class="top-arrow">arrow</div>
		</footer>
	</div>
</div>