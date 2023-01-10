@php
$blogs = App\Model\Blog::Join('blog_categories as bc', 'bc.id', '=' ,'blogs.blog_cat_id')->selectRaw('blogs.blog_title, bc.blog_cat_name, blogs.blog_content')->where('blogs.blog_status', 'Publish')->orderBy('blogs.id', 'DESC')->limit(4)->get();
@endphp
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
								<a href="#">Service</a>
							</li>
							<li class="has-sub">
								<a href="#">Protfolio</a>
								<ul class="footer-sub">
									<li>
										<a href="#">Testimonials</a>
									</li>
									<li>
										<a href="#">Forum</a>
									</li>
									<li>
										<a href="#">Advertise with Us</a>
									</li>
									<li>
										<a href="#">Partnerships</a>
									</li>
									<li>
										<a href="#">Affiliates Program</a>
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
								<a href="#">Blog</a>
							</li>
							<li>
								<a href="{{url('contact')}}">Contact Us</a>
							</li>
						</ul>
					</div>
					<div class="right"><a href="#">Business with Connect <span class="orange">With</span> <span class="green">Training</span></a></div>
				</div>
			</div>
			<div class="footer-bottom">
			<div class="footer-container">
			<div class="footer-social-link-outer" >
				<div class="facebook">
					<p class="title">FACEBOOK</p>
					<div class="face-con">
						<div class="face-img"><img src="{{asset('public/assets/front/images/face-book-img.png')}}" alt=""></div>
						<div class="face-pro">
							<span class="pro-img"><img src="{{asset('public/assets/front/images/pro-img.png')}}" alt=""></span>
							<div class="face-pro-con">
								<p class="mail">Connectwithtraining.com</p>
								<p class="time">3 hours ago</p>
							</div>
						</div>
						<div class="face-des">
							<p>{{$gs->title}}</p>
						</div>
					</div>
				</div>
				<div class="tweets">
					<p class="title">TWEETS</p>
					<div class="tweets-con">
						<ul>
							<li>
								<div class="tweet-con">RT <a href="#">@drinksfeed:</a> 5 Drinks that should be on your south african summer Holiday checklist <a href="#">https://t.co/U1UiXFJVrH</a></div>
								<p class="mail">@winelands_co_za - 2 hours ago</p>
							</li>
							<li>
								<div class="tweet-con">RT <a href="#">@drinksfeed:</a> 5 Drinks that should be on your south african summer Holiday checklist <a href="#">https://t.co/U1UiXFJVrH</a></div>
								<p class="mail">@winelands_co_za - 2 hours ago</p>
							</li>
						</ul>
					</div>
					<div class="tweet-btn">
						<button><span><i class="fa fa-twitter"></i>Follow</span></button>
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
									<a href="#">
									    <?php
									    if(strlen($blog->blog_content)>20){
											$blogContent = substr($blog->blog_content, 0, 260);
											$blogContent = $blogContent."...";
									    }
										else{
										    $blogContent = $blog->blog_content;
										}
										echo $blogContent."</p>";
										?>
									</a>
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
						<p class="cnt-img"><img src="{{asset('public/assets/front/images/connect-img.png')}}" alt=""></p>
						<ul>
							<li class="home"> <i class="fa fa-home"></i>{{$gs->contact_address}} </li>
							<li class="mail"><i class="fa fa-envelope-o"></i>{{$gs->contact_email}}</li>
							<!-- <li class="number-1"><i class="fa fa-clock-o"></i> 1+202-683-8583 </li> -->
							<li class="number-2"><i class="fa fa-plus-square"></i>{{$gs->customer_no}} </li>
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
						</ul>
						<!--<div class="subcribe-button">-->
						<!--	<button>-->
						<!--		<span>Subscribe</span>-->
						<!--	</button>-->
						<!--</div>-->
					</div>
				</div>
			</div>
			</div>
			</div>
			<div class="copyright">
				<a href="#" class="logo"><img src="{{asset('public/assets/front/images/footer-logo.png')}}"></a>
				<p class="copyright-con">{{'Copyright © '.date("Y").' | All Rights Reserved.'}}</p>
				<!--<a href="#" class="sitemap">SITEMAP</a>-->
			</div>
			<div class="top-arrow">arrow</div>
		</footer>
	</div>
</div>