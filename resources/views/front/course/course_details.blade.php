@extends('front.layouts.master')
@section('title') {{ucwords($course_details->course_name)}} | {{$gs->title}} @endsection
@section('content')

	<main id="maincontent" class="page-main">
			<div class="columns">
				<div class="column main">
					<section class="breadcrumbs_block breadcrumbs_block-details">
						<div class="project-management-left">
							<ol class="breadcrumb_list">
								<li class="project-management-arrow">
									Project Management
								</li>
							</ol>
						</div>
						<!--<div class="proj-p-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, <br>sed do eiusmod tempor</div>-->
						<!--<div class="project-management-right">-->
						<!--	<a class="free-tool-btn">-->
						<!--		<span>Free Tools</span>-->
						<!--	</a>-->
						<!--</div>-->
					</section>
						
					<div class="class-features-outer">
						<div class="class-features-left">
							<div class="class-features-inner">
								<h3>Class features</h3>
								@if($course_details->class_features != "")
    								<ul>
    								    <?php
    								        $classFeatures = json_decode($course_details->class_features);
    								        $classFeaturesTitle = $classFeatures->class_feature_title;
    								        $classFeaturesTitleHover = $classFeatures->class_feature_title_hover;
    								        
    								        $i = 0;
    								        while($i < count($classFeaturesTitle)){ ?>
    								            <li class="features-{{$i+1}}"><span>{{ucwords($classFeaturesTitle[$i])}}</span><span class="class-tooltip">{{ucwords($classFeaturesTitleHover[$i])}}</span></li>
    								            <?php
    								            $i++;
    								        }
    								        
    								    ?>
    								</ul>
								@else
								    <p>No Class Features Available!</p>
								@endif
							</div>
						</div>
						<div class="class-features-right">
							<div class="project-management-img-outer">
								<div class="project-management-process">
									<img src="{{asset('public/assets/front/img/course/'.$course_details->course_image)}}" alt="{{$course_details->course_name}}">
									<!--<div class="enroll-round"><a href="#">Enroll</a></div>-->
									<ul>
										<li class="refer"><a href="javascript:void(0)">
											<span class="link-text">Refer someone</span>
											<span class="icon"><i class="fa fa-share"></i></span>
											</a>
										</li>
										<li i class="cart" onclick="addToCart('{{$course_details->course_name}}','{{$course_details->id}}');">
										    <a href="javascript:void(0)">
											<span class="link-text">Cart</span>
											<span class="icon"><i class="fa fa-shopping-cart"></i></span></a>
										</li>
										<li class="share"><a href="javascript:void(0)">
											<span class="link-text">Share</span>
											<span class="icon"><i class="fa fa-share-alt"></i></span>
											</a>
										</li>
										<li class="watch-video"><a href="javascript:void(0)">
											<span class="link-text">Watch video</span>
											<span class="icon"><i class="fa fa-play"></i></span></a>
										</li>
									</ul>
								</div>
								<div class="management-process-btm">
									<div class="manage-pro-btn-left">
										<div class="manage-pro-price">
										    <?php
										    if($course_details->course_discout_type == "Percentage"){
                                                $newPrice = $course_details->course_price * $course_details->course_discout / 100;
                                                $newPrice = $course_details->course_price - $newPrice;
                                                $oldPrice = $course_details->course_price;
                                            }
                                            elseif($course_details->course_discout_type == "Amount"){
                                                $newPrice = $course_details->course_price - $course_details->course_discout;
                                                $oldPrice = $course_details->course_price;
                                            }
                                            else{
                                                $newPrice = $course_details->course_price;
                                            }
                                            ?>
                                            
											<span class="current-price">{{App\Helpers\Helper::changeCurrency($newPrice)}}</span>
											<span class="old-price">{{isset($oldPrice)?App\Helpers\Helper::changeCurrency($oldPrice):""}}</span>
										</div>
										<div class="onsite-trainig-outer">
											<div class="onsite-trainig-left">
												<span class="icon"></span>
												<p class="gray-text">Onsite Training</p>
												<p class="green-text">Duration: {{ucwords($course_details->course_duration)}}</p>
											</div>
											<div class="onsite-trainig-right">
												<span class="time-img">{{ $day = date("l", strtotime($course_details->course_start_date)) }},</span>
												<p class="green-text">{{ $datemonth = date("M jS", strtotime($course_details->course_start_date)) }},</p>
												<p class="gray-text">{{ $timing = date("h:i A", strtotime($course_details->course_timing)) }}</p>
												<div class="training-popup">
													<h3>Online Training</h3>
													<p class="Online-t-text">{{$day.', '. $datemonth.' '.$timing}}</p>
													<span class="duration">Duration: {{ucwords($course_details->course_duration)}}</span>
													<!--<div class="join-btn">-->
													<!--	<a href="javascript:void(0)">Join Class</a>-->
													<!--	<a href="javascript:void(0)">Request a Class</a>-->
													<!--</div>-->
												</div>
											</div>
										</div>
									</div>
									<div class="manage-pro-chat">
										<a href="javascript:void(0)">Chat With Instructor</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="menu-tap-radio-outer">
						<div class="menu-tap-outer">
							<ul>
								<li class="abt-project-management active" onclick="openCity(event, 'apm')"><span>About Project Management</span></li>
								<li class="learning-option" onclick="openCity(event, 'lo')"><span>Learning Options</span></li>
								<li class="curriculam" onclick="openCity(event, 'cur')"><span>Curriculum</span></li>
								<li class="course-schedul" onclick="openCity(event, 'cs')"><span>Course Schedule</span></li>
								<li class="video-menu" onclick="openCity(event, 'vid')"><span>Video</span></li>
								<li class="about-instructor" onclick="openCity(event, 'ai')"><span>About Instructor</span></li>
								<li class="test-project" onclick="openCity(event, 'tp')"><span>Tests | Projects | Assignments</span></li>
								<li class="instractor" onclick="openCity(event, 'ins')"><span>Instructor Support</span></li>
								<li class="reviews-menu" onclick="openCity(event, 'rm')"><span>Reviews</span></li>
								<li class="faq-mnu" onclick="openCity(event, 'fm')"><span>FAQ</span></li>
								<li class="certification-tip" onclick="openCity(event, 'ct')"><span>Certification Tip</span></li>
							</ul>
						</div>
						<div class="online-onsite-checkbox">
							<!--<ul>-->
							<!--	<li>-->
							<!--		<input type="radio" name="online">-->
							<!--		<label>Online</label>-->
							<!--	</li>-->
							<!--	<li>-->
							<!--		<input type="radio" name="online">-->
							<!--		<label>Onsite</label>-->
							<!--	</li>-->
							<!--	<li>-->
							<!--		<input type="radio" name="online">-->
							<!--		<label>Your Pace</label>-->
							<!--	</li>-->
							<!--</ul>-->
						</div>
					</div>
					
					<div id="apm" class="tabcontent">
    					<div class="container">
    						<div class="cource-details-outer">
    							<h2>About Project Management</h2>
    							<div class="course-details-left">
    								<div class="course-details-left-top">
    									<h4>Course Details</h4>
    									<div class="course-details-box">
    										<?= $course_details->course_details; ?>
    									</div>
    									@if($course_details->course_resource != '')
    									<div class="course-details-box ourse-resor">
    										<h3>Course Resources</h3>
    										<span class="sky-blu-text"><?= $course_details->course_resource; ?></span>
    									</div>
    									@endif
    								</div>
    								@if($course_details->course_diff != '')
    								<div class="course-details-left-bottom">
    									<h4>Course Difference</h4>
    									<div class="course-details-box">
    										{{$course_details->course_diff}}
    									</div>
    								</div>
    								@endif
    							</div>
    							<!--<div class="course-details-right">-->
    							<!--	<div class="next-step-outer">-->
    							<!--		<p class="next-step-hdng">Next Steps</p>-->
    							<!--		<ul>-->
    							<!--			<li>Lorem ipsum dolor sit amet</li>-->
    							<!--			<li>Lorem ipsum dolor sit amet</li>-->
    							<!--			<li>Lorem ipsum dolor sit amet</li>-->
    							<!--			<li>Lorem ipsum dolor sit amet</li>-->
    							<!--		</ul>-->
    							<!--		<div class="gray-bck-color"></div>-->
    							<!--		<p class="interested next-step-hdng">Interested in Taking AP Calculus BC?</p>-->
    							<!--		<div class="interested-img"><img src="{{asset('public/assets/front/images/details-in-1.jpg')}}" alt=""></div>-->
    							<!--		<p class="why-take-app-text">Use this <a href="#">conversation starter </a>to talk to your teachers and counselors.</p>-->
    							<!--		<div class="gray-bck-color"></div>-->
    							<!--	</div>-->
    							<!--</div>-->
    						</div>
    					</div>
    					<div class="container">
    					    @if($course_details->course_goals != '')
    						<div class="course-goals-outer">
    							<div class="course-goals-left">
    								<h3>Course Goals</h3>
    								<p class="able-txt">By the end of the course you should be able to:</p>
    								<div class="course-goals-box course-details-box">
    									<ul>
    										<?= $course_details->course_goals; ?>
    									</ul>
    								</div>
    							</div>
    							<div class="course-goals-right">
    								<div class="bouns-outer">
    									<div class="bonus-circle-img"><img src="{{asset('public/assets/front/images/bonus-circle.png')}}" alt=""></div>
    									<h3 class="bonus-circle-hdng">Discount:</h3>
    									<p class="bonus-circle-txt">
    									    @if($course_details->course_discout_type == 'Amount')
    									        Get Amount {{$course_details->course_discout}} Discount.
    									    @elseif($course_details->course_discout_type == 'Percentage')
    									        Get {{$course_details->course_discout}}% Discount.
    									    @else
    									        No Discount Offer Available.
    									    @endif
    									</p>
    								</div>
    							</div>
    						</div>
    						@endif
    					</div>
    					<div class="container">
    					    @if($course_details->pmp_desc != '')
    						<div class="project-management-pointers">
    							<div class="project-management-pointers-top">
    								<div class="project-management-left">
    									<h2>Project Management Pointers</h2>
    									<p class="Project-Management-text">{{$course_details->pmp_desc}}</p>
    								</div>
    								<div class="project-management-right">
    									<img src="{{asset('public/assets/front/images/management-pointers.png')}}" alt="">
    								</div>
    							</div>
    							
    							<div class="Project-management-pointers-box">
    								<ul>
    								    <?php
                                           $pointer_title = explode(',', $course_details->pointer_title);
                                           $pointer_desc = explode(',', $course_details->pointer_desc);
                                           $i=0;
                                        ?>
                                        
                                        @if(count($pointer_title)>0)
                                            @while($i < count($pointer_title))
            									<li>
            										<h3 class="Project-management-icon-{{$i}}">{{$pointer_title[$i]}}</h3>
            										<p>{{$pointer_desc[$i]}}</p>
            									</li>
            									@php $i++; @endphp
        									@endwhile
    									@endif
    									
    									<!--<li class="start-now-btn">-->
    									<!--	<h4 class="tools-today-txt">Discover More Great Tools Today</h4>-->
    									<!--	<a href="javascript:void(0)">START NOW FREE</a>-->
    									<!--</li>-->
    								</ul>
    								</ul>
    							</div>
    						</div>
    						@endif
    					</div>
    					<div class="container">
        					<div class="recently-viewed-outer category-design-outer">
        						<h2 class="course-title">Top Trending Courses</h2>
    						    <div class="trendingCourse">
    							
								</div>
    					    </div>
    					</div>
    					
    					<div class="container">
        					<div class="recently-viewed-outer category-design-outer">
        						<h2 class="course-title">Featured Recommendations</h2>
        						<div class="featuredCourse">
    							
								</div>
    					    </div>
    					</div>
					</div>
					
					<div id="lo" class="tabcontent" style="display:none;">
    					<div class="container">
    						<div class="learning-option-outer">
    						    @if(count($lo) > 0)
    							<h2>Learning Options</h2>
    							<div class="learning-option-box">
    								<ul>
    								    @foreach($lo as $lo)
    									<li class="option-box-orrange">
    										<!--<h1>WHAT TO EXPECT IN</h1>-->
    										<!--<div class="online-training-img"><img src="{{asset('public/assets/front/images/onsite-training-img.png')}}" alt=""></div>-->
    										<h3 class="ways-that-mak">{{$lo->learn_title}}</h3>
    										<div class="option-box-text">
    										    <?= $lo->learn_desc; ?>
    										</div>
    									</li>
    									@endforeach
    								</ul>
    							</div>
    							@else
    							<h2>Learning Options Not Found</h2>
    							@endif
    						</div>
    					</div>
					
    					<!--<div class="container">-->
        	<!--				<div class="project-management-buzz-outer">-->
        	<!--					<div class="buzz-img"><img src="{{asset('public/assets/front/images/buzz-img.png')}}" alt=""></div>-->
        	<!--					<div class="buzz-hdng">-->
        	<!--						<h2>Project Management Buzz Words</h2>-->
        	<!--						<div class="buzz-words-box-outer">-->
        	<!--							<div class="buzz-box-left">-->
        	<!--								<ul>-->
        	<!--									<li>-->
        	<!--										<span class="buz-hed">JUMPING THE SHARK</span>-->
        	<!--										<span class="buzz-box">XX XXXXXXXXXXXXXXXXX XXXXXXXXXXXXXXXX XXXXXXXXXXXXXX XXXXXXXXXXXXXXXXXXXX XXXXXXXXXXX XXXXXXXXXXX XXXXXXXXXXXX</span>-->
        	<!--									</li>-->
        	<!--									<li>-->
        	<!--										<span  class="buz-hed">SYNERGY</span>-->
        	<!--										<span class="buzz-box">XX XXXXXXXXXXXXXXXXX XXXXXXXXXXXXXXXX XXXXXXXXXXXXXX XXXXXXXXXXXXXXXXXXXX XXXXXXXXXXX XXXXXXXXXXX XXXXXXXXXXXX</span>-->
        	<!--									</li>-->
        	<!--									<li>-->
        	<!--										<span  class="buz-hed">ZERO SUM GAME</span>-->
        	<!--										<span class="buzz-box">XX XXXXXXXXXXXXXXXXX XXXXXXXXXXXXXXXX XXXXXXXXXXXXXX XXXXXXXXXXXXXXXXXXXX XXXXXXXXXXX XXXXXXXXXXX XXXXXXXXXXXX</span>-->
        	<!--									</li>-->
        	<!--								</ul>-->
        	<!--							</div>-->
        	<!--							<div class="buzz-box-right">-->
        	<!--								<ul>-->
        	<!--									<li>-->
        	<!--										<span  class="buz-hed">JUMPING THE SHARK</span>-->
        	<!--										<span class="buzz-box">XX XXXXXXXXXXXXXXXXX XXXXXXXXXXXXXXXX XXXXXXXXXXXXXX XXXXXXXXXXXXXXXXXXXX XXXXXXXXXXX XXXXXXXXXXX XXXXXXXXXXXX</span>-->
        	<!--									</li>-->
        	<!--									<li>-->
        	<!--										<span  class="buz-hed">SYNERGY</span>-->
        	<!--										<span class="buzz-box">XX XXXXXXXXXXXXXXXXX XXXXXXXXXXXXXXXX XXXXXXXXXXXXXX XXXXXXXXXXXXXXXXXXXX XXXXXXXXXXX XXXXXXXXXXX XXXXXXXXXXXX</span>-->
        	<!--									</li>-->
        	<!--									<li>-->
        	<!--										<span  class="buz-hed">ZERO SUM GAME</span>-->
        	<!--										<span class="buzz-box">XX XXXXXXXXXXXXXXXXX XXXXXXXXXXXXXXXX XXXXXXXXXXXXXX XXXXXXXXXXXXXXXXXXXX XXXXXXXXXXX XXXXXXXXXXX XXXXXXXXXXXX</span>-->
        	<!--									</li>-->
        	<!--								</ul>-->
        	<!--							</div>							-->
        	<!--						</div>-->
        	<!--						<div class="viewall-btn"><a href="javascript:void(0)">View All</a></div>-->
        	<!--					</div>-->
        	<!--				</div>-->
    					<!--</div>-->
    					
    					<!--<div class="container">-->
        	<!--				<div class="view-all-outer">-->
        	<!--					<div class="view-all-box">-->
        	<!--						<p class="view-all-txt"><span>JUMPING THE SHARK:</span>XXXXXXXXXXXXXXXXX XXXXXXX XXXXXXXXXXXXXXXXXX XXXXXXXXXXXXXXXXXXXXX XXXXX XXXXXXX XXXXXXXX XXXXXXXXXXXX XXXXXXXXXXXXXXXXX XXXXXXXXXXXXX XXXXXXXXXXXXXXXXXXX XXXXXXXX XXXXXXXXXXXXX XXXXXXXXXXXXXXXXXXX XXXXXXXX</p>-->
        	<!--						<p class="view-all-txt">-->
        	<!--							XXXXXXXXXXXXXXXXX XXXXXXX XXXXXXXXXXXXXXXXXX XXXXXXXXXXXXXXXXXXXXX XXXXX XXXXXXX XXXXXXXX X-->
        	<!--							XXXXXXXXXXX XXXXXXXXXXXXXXXXX XXXXXXXXXXXXX XXXXXXXXXXXXXXXXXXX XXXXXXXX XXXXXXXXXXX XXXXXXX-->
        	<!--							XXXXXXXXXXXXXXXXX XXXXXXXXXXXXXXX XXXXXXXXXXXXXXXXX XXXXXXXXXXXXXXXXX XXXXXXXXXXXXXXXX-->
        	<!--							XXXXXXXXXXXXXX XXXXXXXXXXXXXXX XXXXXXXXXXXXXX XXXXXXXXXXXXXX XXXXXXXXXXXXXXXX XXXXXXXXXXXXX-->
        	<!--							XXXXXXXXXX XXXXXXXXXXXXXXXXX XXXXXXXXXXXXXXXX XXXXXXXXXXX XXXXXXXXXXX XXXXXXXX manager.-->
        	<!--						</p>-->
        	<!--					</div>-->
        	<!--					<div class="view-all-box">-->
        	<!--						<p class="view-all-txt"><span>JUMPING THE SHARK:</span>XXXXXXXXXXXXXXXXX XXXXXXX XXXXXXXXXXXXXXXXXX XXXXXXXXXXXXXXXXXXXXX XXXXX XXXXXXX XXXXXXXX XXXXXXXXXXXX XXXXXXXXXXXXXXXXX XXXXXXXXXXXXX XXXXXXXXXXXXXXXXXXX XXXXXXXX XXXXXXXXXXXXX XXXXXXXXXXXXXXXXXXX XXXXXXXX</p>-->
        	<!--						<p class="view-all-txt">-->
        	<!--							XXXXXXXXXXXXXXXXX XXXXXXX XXXXXXXXXXXXXXXXXX XXXXXXXXXXXXXXXXXXXXX XXXXX XXXXXXX XXXXXXXX X-->
        	<!--							XXXXXXXXXXX XXXXXXXXXXXXXXXXX XXXXXXXXXXXXX XXXXXXXXXXXXXXXXXXX XXXXXXXX XXXXXXXXXXX XXXXXXX-->
        	<!--							XXXXXXXXXXXXXXXXX XXXXXXXXXXXXXXX XXXXXXXXXXXXXXXXX XXXXXXXXXXXXXXXXX XXXXXXXXXXXXXXXX-->
        	<!--							XXXXXXXXXXXXXX XXXXXXXXXXXXXXX XXXXXXXXXXXXXX XXXXXXXXXXXXXX XXXXXXXXXXXXXXXX XXXXXXXXXXXXX-->
        	<!--							XXXXXXXXXX XXXXXXXXXXXXXXXXX XXXXXXXXXXXXXXXX XXXXXXXXXXX XXXXXXXXXXX XXXXXXXX manager.-->
        	<!--						</p>-->
        	<!--					</div>-->
        	<!--					<div class="view-all-box">-->
        	<!--						<p class="view-all-txt"><span>JUMPING THE SHARK:</span>XXXXXXXXXXXXXXXXX XXXXXXX XXXXXXXXXXXXXXXXXX XXXXXXXXXXXXXXXXXXXXX XXXXX XXXXXXX XXXXXXXX XXXXXXXXXXXX XXXXXXXXXXXXXXXXX XXXXXXXXXXXXX XXXXXXXXXXXXXXXXXXX XXXXXXXX XXXXXXXXXXXXX XXXXXXXXXXXXXXXXXXX XXXXXXXX</p>-->
        	<!--						<p class="view-all-txt">-->
        	<!--							XXXXXXXXXXXXXXXXX XXXXXXX XXXXXXXXXXXXXXXXXX XXXXXXXXXXXXXXXXXXXXX XXXXX XXXXXXX XXXXXXXX X-->
        	<!--							XXXXXXXXXXX XXXXXXXXXXXXXXXXX XXXXXXXXXXXXX XXXXXXXXXXXXXXXXXXX XXXXXXXX XXXXXXXXXXX XXXXXXX-->
        	<!--							XXXXXXXXXXXXXXXXX XXXXXXXXXXXXXXX XXXXXXXXXXXXXXXXX XXXXXXXXXXXXXXXXX XXXXXXXXXXXXXXXX-->
        	<!--							XXXXXXXXXXXXXX XXXXXXXXXXXXXXX XXXXXXXXXXXXXX XXXXXXXXXXXXXX XXXXXXXXXXXXXXXX XXXXXXXXXXXXX-->
        	<!--							XXXXXXXXXX XXXXXXXXXXXXXXXXX XXXXXXXXXXXXXXXX XXXXXXXXXXX XXXXXXXXXXX XXXXXXXX manager.-->
        	<!--						</p>-->
        	<!--					</div>-->
        	<!--				</div>-->
    					<!--</div>-->
					</div>
					
					<div id="cur" class="tabcontent" style="display:none;">
					    
    					<div class="container">
    					    <div class="curicullam-outer">
    							<h2>Curriculum</h2>
    							@if($curriculum_total_lecture > 0)
    							<ul>
    							    @php $i = 0 @endphp
                                    @while($i < $curriculum_total_lecture)
        								<li>
        									<input type="radio" name="lecture">
        									<div class="lecture-txt">Lecture {{$i+1}}</div>
        								</li>
        							    @php $i++ @endphp
                                    @endwhile
    							</ul>
    							@else
                                    <p>No Curriculum Available</p>
                                @endif
    						</div>
					    </div>
					    @if($curriculum_total_lecture > 0)
    					    <div class="container">
								


        					    <div class="container pmp-container">
        					        <div class="pmp-container-outer">
                						<div class="pmp-container-inr">
                							<div class="pmp-slider-outer-one">
												<!-- Swiper -->
												<div class="swiper-container swiper1">
													<div class="swiper-wrapper swiper-px">
														@php $i = 0 @endphp
    													@while($i < $curriculum_total_lecture)
														<div class="swiper-slide">
															<div class="swiper-px">
																<div class="swiper-img">
																	<h3>{{$course_details->course_name}}</h3>
																	<div class="pmp-img">
																	<img src="{{asset('public/assets/front/img/course/'.$course_details->course_image)}}" alt="{{$course_details->course_name}}">
																	</div>
																</div>

																<div class="swiper-heading">
																	<h5>{{$curriculum[$i]->curr_title}}</h5>
																	<p><?= $curriculum[$i]->curr_desc; ?></p>

																	<!--<ul>
																	<li class="MsoNormal" style="color:#1C1D1F;margin-bottom:0in;margin-bottom:.0001pt;
																		line-height:150%;mso-list:l0 level1 lfo1;tab-stops:list .5in"><span class="what-you-will-learn--objective-item--ecarc"><span lang="EN-IN" style="font-size:12.0pt;line-height:150%;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;">Use
																		SQL to query a database</span></span><span lang="EN-IN" style="font-size:
																		12.0pt;line-height:150%;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;"><o:p></o:p></span></li>
																	<li class="MsoNormal" style="color:#1C1D1F;margin-bottom:0in;margin-bottom:.0001pt;
																		line-height:150%;mso-list:l0 level1 lfo1;tab-stops:list .5in"><span class="what-you-will-learn--objective-item--ecarc"><span lang="EN-IN" style="font-size:12.0pt;line-height:150%;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;">Use
																		SQL to perform data analysis</span></span><span lang="EN-IN" style="font-size:12.0pt;line-height:150%;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;"><o:p></o:p></span></li>
																	<li class="MsoNormal" style="color:#1C1D1F;margin-bottom:0in;margin-bottom:.0001pt;
																		line-height:150%;mso-list:l0 level1 lfo1;tab-stops:list .5in"><span class="what-you-will-learn--objective-item--ecarc"><span lang="EN-IN" style="font-size:12.0pt;line-height:150%;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;">Be
																		comfortable putting SQL and PostgreSQL on their resume</span></span><span lang="EN-IN" style="font-size:12.0pt;line-height:150%;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;"><o:p></o:p></span></li>
																	<li class="MsoNormal" style="color:#1C1D1F;margin-bottom:0in;margin-bottom:.0001pt;
																		line-height:150%;mso-list:l0 level1 lfo1;tab-stops:list .5in"><span class="what-you-will-learn--objective-item--ecarc"><span lang="EN-IN" style="font-size:12.0pt;line-height:150%;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;">Learn
																		to perform GROUP BY statements</span></span><span lang="EN-IN" style="font-size:12.0pt;line-height:150%;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;"><o:p></o:p></span></li>
																	<li class="MsoNormal" style="color:#1C1D1F;margin-bottom:0in;margin-bottom:.0001pt;
																		line-height:150%;mso-list:l0 level1 lfo1;tab-stops:list .5in"><span class="what-you-will-learn--objective-item--ecarc"><span lang="EN-IN" style="font-size:12.0pt;line-height:150%;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;">Replicate
																		real-world situations and query reports</span></span><span lang="EN-IN" style="font-size:12.0pt;line-height:150%;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;"><o:p></o:p></span></li>
																	</ul>-->
																</div>

																<div class="pmp-btm-sec">
																	<ul>
																		<li>Section {{$i+1}}</li>
																		<li>Lecture {{$i+1}}</li>
																		<li>{{$timing}}</li>
																	</ul>
																</div>
															</div>
														</div>
														@php $i++ @endphp
    													@endwhile
														<!--<div class="swiper-slide">
															<div class="swiper-px">
																<div class="swiper-img">
																	<h3>Structured Query Language</h3>
																	<div class="pmp-img">
																		<img src="http://intelligentkoncept.com/cwt/public/assets/front/img/course/40671646677100.jpg" alt="Structured Query Language">
																	</div>
																</div>

																<div class="swiper-heading">
																	<h5>Learn Databases Live Online from top industry professionals</h5>
																	<p>You'll learn how to read and write
																	complex queries to a database using one of the most in demand skills -
																	PostgreSQL. These skills are also applicable to any other major SQL database,
																	such&nbsp;as MySQL, Microsoft SQL Server, Amazon Redshift, Oracle, and much
																	more.</p>

																	<ul style="margin-top:0in; margin-left: 20px;" type="disc">
																	<li class="MsoNormal" style="color:#1C1D1F;margin-bottom:0in;margin-bottom:.0001pt;
																		line-height:150%;mso-list:l0 level1 lfo1;tab-stops:list .5in"><span class="what-you-will-learn--objective-item--ecarc"><span lang="EN-IN" style="font-size:12.0pt;line-height:150%;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;">Use
																		SQL to query a database</span></span><span lang="EN-IN" style="font-size:
																		12.0pt;line-height:150%;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;"><o:p></o:p></span></li>
																	<li class="MsoNormal" style="color:#1C1D1F;margin-bottom:0in;margin-bottom:.0001pt;
																		line-height:150%;mso-list:l0 level1 lfo1;tab-stops:list .5in"><span class="what-you-will-learn--objective-item--ecarc"><span lang="EN-IN" style="font-size:12.0pt;line-height:150%;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;">Use
																		SQL to perform data analysis</span></span><span lang="EN-IN" style="font-size:12.0pt;line-height:150%;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;"><o:p></o:p></span></li>
																	<li class="MsoNormal" style="color:#1C1D1F;margin-bottom:0in;margin-bottom:.0001pt;
																		line-height:150%;mso-list:l0 level1 lfo1;tab-stops:list .5in"><span class="what-you-will-learn--objective-item--ecarc"><span lang="EN-IN" style="font-size:12.0pt;line-height:150%;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;">Be
																		comfortable putting SQL and PostgreSQL on their resume</span></span><span lang="EN-IN" style="font-size:12.0pt;line-height:150%;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;"><o:p></o:p></span></li>
																	<li class="MsoNormal" style="color:#1C1D1F;margin-bottom:0in;margin-bottom:.0001pt;
																		line-height:150%;mso-list:l0 level1 lfo1;tab-stops:list .5in"><span class="what-you-will-learn--objective-item--ecarc"><span lang="EN-IN" style="font-size:12.0pt;line-height:150%;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;">Learn
																		to perform GROUP BY statements</span></span><span lang="EN-IN" style="font-size:12.0pt;line-height:150%;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;"><o:p></o:p></span></li>
																	<li class="MsoNormal" style="color:#1C1D1F;margin-bottom:0in;margin-bottom:.0001pt;
																		line-height:150%;mso-list:l0 level1 lfo1;tab-stops:list .5in"><span class="what-you-will-learn--objective-item--ecarc"><span lang="EN-IN" style="font-size:12.0pt;line-height:150%;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;">Replicate
																		real-world situations and query reports</span></span><span lang="EN-IN" style="font-size:12.0pt;line-height:150%;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;"><o:p></o:p></span></li>
																	</ul>
																</div>

																<div class="pmp-btm-sec">
																	<ul>
																		<li>Section 1</li>
																		<li>Lecture 1</li>
																		<li>12:47 PM</li>
																	</ul>
																</div>
															</div>
														</div>-->
													</div>
													<!-- If we need navigation buttons -->
													<div class="swiper-button-prev button-black"></div>
													<div class="swiper-button-next button-black"></div>
												</div>

								
                								<!--<div class="pmp-slider-outer">
                								    @php $i = 0 @endphp
                                                    @while($i < $curriculum_total_lecture)
                    									<div class="pmp-slide-item">
                    										<div class="pmp-img-outer">
                    											<h3>{{$course_details->course_name}}</h3>
                    											<div class="pmp-img"><img src="{{asset('public/assets/front/img/course/'.$course_details->course_image)}}" alt="{{$course_details->course_name}}"></div>
                    										</div>
                    										<h5 class="pmp-txt-hdng">{{$curriculum[$i]->curr_title}}</h5>
                    										<p class="pmp-txt"><?= $curriculum[$i]->curr_desc; ?></p>
                    										<div class="pmp-btm-sec">
                    											<ul>
                    												<li>Section {{$i+1}}</li>
                    												<li>Lecture {{$i+1}}</li>
                    												<li>{{$timing}}</li>
                    											</ul>
                    										</div>
                    									</div>
                    								    @php $i++ @endphp
                                                    @endwhile
                								</div>-->
                							</div>
                						</div>
        					        </div>
        					    </div>
        			        </div>
        			    @endif   
    				</div>
					
					<div id="cs" class="tabcontent" style="display:none;">
    					<div class="container">
        					<div class="course-schedul-outer">
        						<h2>Course Schedule</h2>
        						@if(count($schedule) > 0)
            						<div class="course-schedul-left">
            							<!--<h4></h4>-->
            							@foreach($schedule as $sch)
                							<div class="militari-info">
                								<div class="date-month-outer">
                									<h2 class="date">{{date('d', strtotime($sch->schedule_date))}}</h2>
                									<p class="month">{{date('M', strtotime($sch->schedule_date))}}</p>
                								</div>
                								<div class="mili-Info">
                									<h3 class="mli-hdng">{{ucwords($sch->schedule_title)}}</h3>
                									<p class="mili-in">{{date('l, F d, Y', strtotime($sch->schedule_date))}} - {{date('h i A', strtotime($sch->schedule_time))}}</p>
                									<p class="mili-drk">{{$sch->schedule_desc}}</p>
                									<!--<p class="mili-light">XXXXXX XXXXXXXXXXXXXXXXXXX XXXXXXXX XXXXXXXXXXXXXXXXXXXXXXX</p>-->
                									<br>
                									<a href="javascript:void(0)">REGISTER</a>
                								</div>
                							</div>
            							@endforeach
            						</div>
            					@else
                                    <p>No Course Schedule Available</p>
                                @endif
            						
        						<!--<div class="course-schedul-right certification-tips-right">-->
        						<!--	<div class="ap-score-1">-->
        						<!--		<p class="college-board">You need a College Board account to get your AP Scores.</p>-->
        						<!--		<a href="javascript:void(0)">Sign up now &nbsp; > </a>-->
        						<!--	</div>-->
        						<!--	<div class="ap-score-2">-->
        						<!--		<p class="college-board">You need a College Board account to get your AP Scores.</p>-->
        						<!--		<a href="javascript:void(0)">Sign up now &nbsp; > </a>-->
        						<!--	</div>-->
        						<!--	<div class="ap-score-3">-->
        						<!--		<p class="college-board">You need a College Board account to get your AP Scores.</p>-->
        						<!--		<a href="javascript:void(0)">Sign up now &nbsp; > </a>-->
        						<!--	</div>-->
        						<!--</div>-->
        					</div>
    					</div>
    				</div>
					
					<div id="vid" class="tabcontent" style="display:none;">
    					<div class="container">
        					<div class="watch-video-outer">
        						<h3>Video</h3>
        						@if(isset($video))
            						<div class="wtch-vdeo">
                						<div class="video-ing">
                						    
                                                @if($video->video_type == "link")
                                                <video width="470" height="255" poster="{{asset('public/assets/front/img/videoBanner/')}}/{{$video->video_banner}}" controls>
                                                    <source src="{{$video->video_link}}" type="video/mp4">
                                                </video>
                                                @elseif($video->video_type == "upload")
                                                <video width="470" height="255" poster="{{asset('public/assets/front/img/videoBanner/')}}/{{$video->video_banner}}" controls>
                                                    <source src="{{asset('public/assets/front/img/videos/'.$video->video_link)}}" type="video/mp4">
                                                </video>
                                                @elseif($video->video_type == "embed")
                                                    <!--<source src="video.ogg" type="video/ogg">-->
                                                    <!--<source src="video.webm" type="video/webm">-->
                                                    <!--<object data="" width="470" height="255">-->
                                                    <!--    <embed src="" width="470" height="255">-->
                                                    <!--</object>-->
                                                    <?= $video->video_link; ?>
                                                @endif
                                            
                                            
                						</div>
                						<div class="watch-video-txt">
                							<li><span class="bl-round">i </span><span class="class-tooltip">Information</span></li>
                							<h4>{{ucwords($video->video_title)}}</h4>
                							<p class="wat-txt">{{$video->video_desc}}</p>
                						</div>
            						</div>
            					@else
                                    <p>No Videos Available</p>
                                @endif
        					</div>
    					</div>
    				</div>
					
					<div id="ai" class="tabcontent" style="display:none;">
    					<div class="container">
        					<div class="about-instuctor">
        						<h2>About Instuctor</h2>
        						<div class="about-inst-box">
        							<div class="avail-img-outer">
        								<h3>About Instuctor</h3>
        								<span class="avail-img"><img src="{{asset('public/assets/front/img/author/'.$course_details->author_image)}}" alt=""></span>
        							</div>
        							<h3 class="avi-hed">{{$course_details->author_name}}</h3>
        							<div class="avril-info">
        								<ul>
        									<li>
        										<h4>Summary</h4>
        										<p></p>{{$course_details->bio}}
        									</li>
        									<li>
        										<h4>Award</h4>
        										<p>{{$course_details->award}}</p>
        									</li>
        									<!--<li>-->
        									<!--	<h4>Author</h4>-->
        									<!--	<p>XXXXXXXXXXXXXXX XXXXXXXX XXXXXXXXXXXXXXX</p> -->
        									<!--	 <p>XX XXXXXXXXXXX XXXXXXXXXXXXXXXXXX XXXXXX</p>-->
        									<!--</li>-->
        									<li>
        										<h4>Hobbies</h4>
        										<p>{{$course_details->hobbies}}</p>
        									</li>
        								</ul>
        							</div>
        							<a href="javascript:void(0)">Chat With Instuctor</a>
        						</div>
        					</div>
    					</div>
    				</div>
					
					<div id="tp" class="tabcontent" style="display:none;">
    					<div class="container">
        					<div class="Tests-Assignments-outer">
        						<h2>Tests | Assignments | Projects</h2>
        						<div class="Tests-Assignments-box">
        							<div class="Tests-Assignments-left">
        								<div class="Assignments-box-top">
        									<div class="Assignments-box-top-left">
        										<h2 class="hdng-test">Test</h2>
        										<ul>
        										    @if(count($test) > 0)
                                                        @foreach($test as $test)
                											<li>
                												<h4>{{ucwords($test->test_title)}}</h4>
                												<p>{{$test->test_desc}}</p>
                											</li>
        											    @endforeach
                                                    @else
                                                        No Tests Available..
                                                    @endif
        										</ul>
        										<div class="search-assignment search-orrange">
        											<input type="text" name="search">
        											<button class="Assignments-btn">SEARCH</button>
        										</div>
        									</div>
        								
        								<div class="Assignments-box-midd">
        									<div class="Assignments-box-midd-left">
        										<h2 class="heading-blue">Test Planning Process</h2>
        										<ul>
        										    @if(count($test2) > 0)
                                                        @foreach($test2 as $test)
                											<li>
                												<h4>{{ucwords($test->test_title)}}</h4>
                												<p>{{$test->test_process}}</p>
                											</li>
        											    @endforeach
                                                    @else
                                                        No Tests Available..
                                                    @endif
        										</ul>
        										<div class="search-assignment search-blue">
        												<input type="text" name="search">
        												<button class="Assignments-btn">SEARCH</button>
        										</div>
        									</div>
        									<!--<div class="Assignments-box-midd-left">-->
        									<!--	<h2 class="assignment-hdng">Test Planning Process</h2>-->
        									<!--	<ul>-->
        									<!--		<li>-->
        									<!--			<p>Acountants</p>-->
        									<!--			<p>XXXXXXXXX XXXXXXXXXX XXXXXXXX XXXXXXXXXXX XXXXXXXX</p>-->
        									<!--			<p>XXXXXXXX XXXXXXXXX XXXXXXX</p>-->
        									<!--			<p>XXXXXXX XXXXXXXXXXX XXXXXXXXXX</p>-->
        									<!--			<p>XXXXXXXXXXX XXXXXXXXXXXXX XXXXXXXXXXXXX XXXXXXXX</p>-->
        									<!--			<p>XXXXXXX XXXXXXXXX XXXXXXXX</p>-->
        									<!--			<p>XXXXXXXXXX XXXXXXXXXX XXXXXXXX XXXXXXXXXX XXXXXXXXXXXX XX</p>-->
        									<!--		</li>-->
        									<!--		<li>-->
        									<!--			<p>Acountants</p>-->
        									<!--			<p>XXXXXXXXX XXXXXXXXXX XXXXXXXX XXXXXXXXXXX XXXXXXXX</p>-->
        									<!--			<p>XXXXXXXX XXXXXXXXX XXXXXXX</p>-->
        									<!--			<p>XXXXXXX XXXXXXXXXXX XXXXXXXXXX</p>-->
        									<!--			<p>XXXXXXXXXXX XXXXXXXXXXXXX XXXXXXXXXXXXX XXXXXXXX</p>-->
        									<!--			<p>XXXXXXX XXXXXXXXX XXXXXXXX</p>-->
        									<!--			<p>XXXXXXXXXX XXXXXXXXXX XXXXXXXX XXXXXXXXXX XXXXXXXXXXXX XX</p>-->
        									<!--		</li>-->
        									<!--	</ul>-->
        									<!--	<div class="search-assignment search-red">-->
        									<!--			<input type="text" name="search">-->
        									<!--			<button class="Assignments-btn">SEARCH</button>-->
        									<!--	</div>-->
        									<!--</div>-->
        								</div>
        								<!--<div class="Assignments-box-bottan">-->
        								<!--	<h2 class="heading-green">Performance Check</h2>-->
        								<!--		<ul>-->
        								<!--			<li>-->
        								<!--				<h4>EduOpen: Italian MOOC Platform</h4>-->
        								<!--				<p>XXXXXXXXXXX XXXXXXXXXXXXXX XXXXXX XXXXXXXXXXXXXXXXXXXXXX XXXXXXXXXX XXXXXX XXXXXXXXXX XXXXXXXXXXXX...</p>-->
        								<!--			</li>-->
        								<!--			<li>-->
        								<!--				<h4>EduOpen: Italian MOOC Platform</h4>-->
        								<!--				<p>XXXXXXXXXXX XXXXXXXXXXXXXX XXXXXX XXXXXXXXXXXXXXXXXXXXXX XXXXXXXXXX XXXXXX XXXXXXXXXX XXXXXXXXXXXX...</p>-->
        								<!--			</li>-->
        								<!--			<li>-->
        								<!--				<h4>EduOpen: Italian MOOC Platform</h4>-->
        								<!--				<p>XXXXXXXXXXX XXXXXXXXXXXXXX XXXXXX XXXXXXXXXXXXXXXXXXXXXX XXXXXXXXXX XXXXXX XXXXXXXXXX XXXXXXXXXXXX...</p>-->
        								<!--			</li>-->
        								<!--			<li>-->
        								<!--				<h4>EduOpen: Italian MOOC Platform</h4>-->
        								<!--				<p>XXXXXXXXXXX XXXXXXXXXXXXXX XXXXXX XXXXXXXXXXXXXXXXXXXXXX XXXXXXXXXX XXXXXX XXXXXXXXXX XXXXXXXXXXXX...</p>-->
        								<!--			</li>-->
        								<!--			<li>-->
        								<!--				<h4>EduOpen: Italian MOOC Platform</h4>-->
        								<!--				<p>XXXXXXXXXXX XXXXXXXXXXXXXX XXXXXX XXXXXXXXXXXXXXXXXXXXXX XXXXXXXXXX XXXXXX XXXXXXXXXX XXXXXXXXXXXX...</p>-->
        								<!--			</li>-->
        								<!--			<li>-->
        								<!--				<h4>EduOpen: Italian MOOC Platform</h4>-->
        								<!--				<p>XXXXXXXXXXX XXXXXXXXXXXXXX XXXXXX XXXXXXXXXXXXXXXXXXXXXX XXXXXXXXXX XXXXXX XXXXXXXXXX XXXXXXXXXXXX...</p>-->
        								<!--			</li>-->
        								<!--		</ul>-->
        								<!--		<div class="search-assignment search-green">-->
        								<!--			<input type="text" name="search">-->
        								<!--			<button class="Assignments-btn">SEARCH</button>-->
        								<!--		</div>-->
        								<!--</div>-->
        							</div>
        							<div class="Tests-Assignments-right">
        								<div class="Tests-Assignments-right-top">
        									<h2 class="assignment-hdng">Assignments</h2>
        									<ul>
        									    @if(count($assignment) > 0)
                                                    @foreach($assignment as $assign)
            											<li>
            												<h4>{{$assign->assign_title}}</h4>
                                                            <p>{{$assign->assign_desc}}</p>
            											</li>
    											    @endforeach
                                                @else
                                                    No Assignments Available..
                                                @endif
    										</ul>
    										<div class="search-assignment search-red">
    											<input type="text" name="search">
    											<button class="Assignments-btn">SEARCH</button>
    										</div>
        								</div>
        								<div class="Tests-Assignments-right-bottam">
        									<h2 class="heading-blue">Assignment Planning Process</h2>
        									<ul>
        									    @if(count($assignment) > 0)
            									    @foreach($assignment as $assign)
            											<li>
            												<h4>{{$assign->assign_title}}</h4>
            												<p>{{$assign->assign_process}}</p>
            											</li>
    											    @endforeach
    											@else
                                                    No Assignments Planning Process Available..
                                                @endif
    										</ul>
    										<div class="search-assignment search-blue">
    											<input type="text" name="search">
    											<button class="Assignments-btn">SEARCH</button>
    										</div>
        								</div>
        							</div>
        						</div>
        
        					</div>
    					</div>
    				</div>
    			</div>
					
				<div id="ins" class="tabcontent" style="display:none;">
					<div class="container">
    					<div class="instructor-support-outer">
    						<h2>Instructor Support</h2>
    						<ul>
    						    @if(isset($ins->title1) and $ins->title1 != "" and $ins->details1)
    							<li class="online-train-oval">
    								<h2>{{$ins->title1}}</h2>
    								<p class="online-train-txt">{{$ins->details1}}</p>
    							</li>
    							@endif
    							@if(isset($ins->title1) and $ins->title2 != "" and $ins->details2)
    							<li class="Onsite-train-oval">
    								<h2>{{$ins->title2}}</h2>
    								<p class="online-train-txt">{{$ins->details2}}</p>
    							</li>
    							@endif
    							@if(isset($ins->title1) and $ins->title3 != "" and $ins->details3)
    							<li class="Pace-train-oval">
    								<h2>{{$ins->title3}}</h2>
    								<p class="online-train-txt">{{$ins->details3}}</p>
    							</li>
    							@endif
    						</ul>
    					</div>
					</div>
				</div>
					
				<div id="rm" class="tabcontent" style="display:none;">
					<div class="container">
    					<div class="review-outer">
    						<h2>Reviews</h2>
    						@if(count($review) > 0)
        						<div class="review-l-r-outer">
            						<div class="review-left">
            							<div class="customar-rev">
            								<h3>{{count($review)}} Customer Reviews</h3>
            								<span class="rating-star"><img src="{{asset('public/assets/front/images/review-star.png')}}"></span>
            							</div>
            							<div class="progress-bar">
            								<h3 class="pro-bar-hdng">
            								    <?php
                                                    $rating_count_total = $rating;
                                                    $rat = 0;
                                                    foreach($rating as $rating){
                                                        $rating_data[] = $rating->rating;
                                                        $rat += $rating->total * $rating->rating;
                                                    }
                                                    echo round($rat/count($review), 1);
                                                ?>
                                                out of 5 stars <i class="fa fa-arrow-down" aria-hidden="true"></i>
            								</h3>
            								<?php
                                                $i = 5;
                                                while($i > 0){
                                                    if(in_array($i, $rating_data)){
                                                        foreach($rating_count_total as $key => $value) {
                                                            if ($value->rating == $i) {
                                                                $per = ($value->total / count($review))*100;
        								                            echo '<div class="progress-rate"><span>'.$i.' star</span><progress value = "'.$per.'" max = "100"></progress><span>'.round($per).'%</span></div>';
                                                            }
                                                        }
                                                                
                                                    }
                                                    else{
                                                        echo '<div class="progress-rate"><span>'.$i.' star</span><progress value = "0" max = "100"></progress><span>0%</span></div>';
                                                    }
                                                    $i--;
                                                }
                                            ?>
            							</div>
            						</div>
            						<!--<div class="review-right">-->
            						<!--	<h3>Discover Electa Live</h3>-->
            						<!--	<ul>-->
            						<!--		<li>XXXXXX XXXXXXX XXXXX</li>-->
            						<!--		<li>XXXXXX XXXXXXX XXXXX</li>-->
            						<!--		<li>XXXXXX XXXXXXX XXXXX</li>-->
            						<!--		<li>XXXXXX XXXXXXX XXXXX</li>-->
            						<!--		<li>XXXXXX XXXXXXX XXXXX</li>-->
            						<!--		<li>XXXXXX XXXXXXX XXXXX</li>-->
            						<!--		<li>XXXXXX XXXXXXX XXXXX</li>-->
            						<!--		<li>XXXXXX XXXXXXX XXXXX</li>-->
            						<!--	</ul>-->
            						<!--</div>-->
        						</div>
        						<div class="post-review">
        							<ul class="showReviews">
        							    @foreach($review as $review)
            								<li>
            									<div class="reviewr-img">
            										<div class="megna-img">
            										    @if($review->image == '')
            										        <img src="{{asset('public/assets/front/img/user/avtar.png')}}" alt="user avatar" class="customer-img rounded-circle" style="width: 58%;">
            										    @else
            										        <img src="{{asset('public/assets/front/img/user').'/'.$review->image}}" alt="user avatar" class="customer-img rounded-circle">
            										    @endif
            								        </div>
            										<h4>{{ucwords($review->first_name.' '.$review->last_name)}}</h4>
            									</div>
            									<div class="reviewrs-details">
        										    <div class="rating-outer">
        										        <div class="rating-star">
                                                            <span class="fa fa-star @if($review->rating >= 1) {{ "checked" }} @endif"></span>
                                                            <span class="fa fa-star @if($review->rating >= 2) {{ "checked" }} @endif"></span>
                                                            <span class="fa fa-star @if($review->rating >= 3) {{ "checked" }} @endif"></span>
                                                            <span class="fa fa-star @if($review->rating >= 4) {{ "checked" }} @endif"></span>
                                                            <span class="fa fa-star @if($review->rating >= 5) {{ "checked" }} @endif"></span>
                                                        </div>
        										    </div>
            										    
            										<p class="reviewrs-details-1">{{date('F d, Y', strtotime($review->created_at))}}</p>
            										<p class="reviewrs-details-2">{{$review->comment}}</p>
            									</div>
            								</li>
        								@endforeach
        							</ul>
        							<div class="post-review-btn"><a href="javascript:void(0)" class="openReviewModel">Post a Review</a></div>
        						</div>
        					@else
                                <p>No Reviews Available..</p>
                                <div class="post-review-btn"><a href="javascript:void(0);" class="openReviewModel">Post a Review</a></div>
                            @endif
                            
                            <div id="ReviewModel" class="modal">
                                <!-- Modal content -->
                                <div class="modal-content modal-width">
                                    <div class="testimonial-heading">
										<div>
											<h2>Post Your Review</h2>
										</div>
										<span class="closeReviewModel" style="cursor:pointer;">&times;</span>
									</div>
                                    
                                    <form class="testimonial-design">
										<div class="textimonial-form">
											<div class="testimonial-inout">
												<p>Name:</p>
												<input class="form-field" type="text" name="">
											</div>
											<div class="testimonial-inout">
												<p>Title:</p>
												<input class="form-field" type="text" name="">
											</div>
											<div class="testimonial-inout">
												<p>Rating:</p>
												<select  class="">
													<option>Select</option>
													<option>1</option>
													<option>2</option>
													<option>3</option>
													<option>4</option>
													<option>5</option>
												</select>
											</div>
											<div class="testimonial-inout">
												<p>Description:</p>
												<textarea class="form-field" rows="7"></textarea>
											</div><br><br>
											<div class="testimonial-btn">
												<a href="#" class="btn" >Submit for review</a>
												<a href="javascript:void(0);" class="btn closeReviewModel">Cancel</a>
											</div>
										</div>
									</form>
                                </div>
                            </div>
                            
                            
    					</div>
					</div>
				</div>
					
				<div id="fm" class="tabcontent" style="display:none;">
					<div class="container">
    					<div class="faQ-outer">
    						<div class="faQ-img"><a href="#"><img src="{{asset('public/assets/front/images/faq-img.png')}}" alt=""></a></div>
    						<div class="frequently-box-section">
    							<h2>Frequently Asked Questions</h2>
    							@if(count($faq) > 0)
    							<ul>
    							    @foreach($faq as $faq)
    								<li>
    									<h4>{{ucwords($faq->faq_type)}}</h4>
    									<h3>{{ucwords($faq->question)}}</h3>
    									<p class="faq-text">{{$faq->answer}}</p>
    									@if($faq->faq_file != '')
    									<div class="faq-pdf-section">
    										<div class="faq-pdf">{{ $ext = strtoupper(pathinfo(asset('public/assets/front/img/faq/'.'/'.$faq->faq_file), PATHINFO_EXTENSION)) }}</div>
    										<div class="pdf-file-name">
    										    <?php $filesize = \File::size(public_path('assets/front/img/faq/'.'/'.$faq->faq_file)); ?>
    											<h3>Instruction ({{ round($filesize / 1024, 2) }}KB)</h3>
    											<a href="{{asset('public/assets/front/img/faq/'.'/'.$faq->faq_file)}}" download>Download</a>
    										</div>
    									</div>
    									@endif
    								</li>
    								@endforeach
    							</ul>
    							@else
    							    <p>No Faq Available</p>
    							@endif
    							<!--<div class="faq-btn">-->
    							<!--	<a href="javascript:void(0)">View All</a>-->
    							<!--</div>-->
    						</div>
    					</div>
					</div>
			
				
					<!--<div class="container">-->
    	<!--				<div class="frequently-asked-section">-->
    	<!--					<h2>Frequently Asked Questions</h2>-->
    	<!--					<ul>-->
    	<!--						<li>-->
    	<!--							<h3>General</h3>-->
    	<!--							<p class="faq-comment">XXXXXXXXXXXXXXXX XXXXXXXXX?</p>-->
    	<!--							<p class="faq-comment">XXXXXXXX XXXXXXXXXXXX XXXXXXXX?</p>-->
    	<!--							<p class="faq-comment">XXXXXXXX XXXXXXXXXXX XXXXXXXX XXXXXXX XXXXXX?</p>-->
    	<!--						</li>-->
    	<!--						<li>-->
    	<!--							<h3>WhatsApp Web</h3>-->
    	<!--							<p class="faq-comment">XXXXXXXXXXXXXXXX XXXXXXXXX?</p>-->
    	<!--							<p class="faq-comment">XXXXXXXX XXXXXXXXXXXX XXXXXXXX?</p>-->
    	<!--							<p class="faq-comment">XXXXXXXX XXXXXXXXXXX XXXXXXXX XXXXXXX XXXXXX?</p>-->
    	<!--						</li>-->
    	<!--						<li>-->
    	<!--							<h3>Android</h3>-->
    	<!--							<p class="faq-comment">XXXXXXXXXXXXXXXX XXXXXXXXX?</p>-->
    	<!--							<p class="faq-comment">XXXXXXXX XXXXXXXXXXXX XXXXXXXX?</p>-->
    	<!--							<p class="faq-comment">XXXXXXXX XXXXXXXXXXX XXXXXXXX XXXXXXX XXXXXX?</p>-->
    	<!--						</li>-->
    	<!--						<li>-->
    	<!--							<h3>General</h3>-->
    	<!--							<p class="faq-comment">XXXXXXXXXXXXXXXX XXXXXXXXX?</p>-->
    	<!--							<p class="faq-comment">XXXXXXXX XXXXXXXXXXXX XXXXXXXX?</p>-->
    	<!--							<p class="faq-comment">XXXXXXXX XXXXXXXXXXX XXXXXXXX XXXXXXX XXXXXX?</p>-->
    	<!--						</li>-->
    	<!--						<li>-->
    	<!--							<h3>WhatsApp Web</h3>-->
    	<!--							<p class="faq-comment">XXXXXXXXXXXXXXXX XXXXXXXXX?</p>-->
    	<!--							<p class="faq-comment">XXXXXXXX XXXXXXXXXXXX XXXXXXXX?</p>-->
    	<!--							<p class="faq-comment">XXXXXXXX XXXXXXXXXXX XXXXXXXX XXXXXXX XXXXXX?</p>-->
    	<!--						</li>-->
    	<!--						<li>-->
    	<!--							<h3>Android</h3>-->
    	<!--							<p class="faq-comment">XXXXXXXXXXXXXXXX XXXXXXXXX?</p>-->
    	<!--							<p class="faq-comment">XXXXXXXX XXXXXXXXXXXX XXXXXXXX?</p>-->
    	<!--							<p class="faq-comment">XXXXXXXX XXXXXXXXXXX XXXXXXXX XXXXXXX XXXXXX?</p>-->
    	<!--						</li>-->
    	<!--						<li>-->
    	<!--							<h3>General</h3>-->
    	<!--							<p class="faq-comment">XXXXXXXXXXXXXXXX XXXXXXXXX?</p>-->
    	<!--							<p class="faq-comment">XXXXXXXX XXXXXXXXXXXX XXXXXXXX?</p>-->
    	<!--							<p class="faq-comment">XXXXXXXX XXXXXXXXXXX XXXXXXXX XXXXXXX XXXXXX?</p>-->
    	<!--						</li>-->
    	<!--						<li>-->
    	<!--							<h3>WhatsApp Web</h3>-->
    	<!--							<p class="faq-comment">XXXXXXXXXXXXXXXX XXXXXXXXX?</p>-->
    	<!--							<p class="faq-comment">XXXXXXXX XXXXXXXXXXXX XXXXXXXX?</p>-->
    	<!--							<p class="faq-comment">XXXXXXXX XXXXXXXXXXX XXXXXXXX XXXXXXX XXXXXX?</p>-->
    	<!--						</li>-->
    	<!--						<li>-->
    	<!--							<h3>Android</h3>-->
    	<!--							<p class="faq-comment">XXXXXXXXXXXXXXXX XXXXXXXXX?</p>-->
    	<!--							<p class="faq-comment">XXXXXXXX XXXXXXXXXXXX XXXXXXXX?</p>-->
    	<!--							<p class="faq-comment">XXXXXXXX XXXXXXXXXXX XXXXXXXX XXXXXXX XXXXXX?</p>-->
    	<!--						</li>-->
    	<!--					</ul>-->
    	<!--				</div>-->
					<!--</div>-->
			    </div>
				
				<div id="ct" class="tabcontent" style="display:none;">
					<div class="container">
    					<div class="certification-tips">
    						<h2>Certification Tips</h2>
    						<h4>Taking The Exam</h4>
    						<p>{{$course_details->course_details}}</p>
    						<div class="certification-tips-detail">
    							<div class="certification-tips-left">
    								<ul>
    								    @if( count($test2) > 0 )
    								        @foreach($test2 as $test)
            									<li>
            										<div class="certification-img">
            											<img src="{{asset('public/assets/front/img/course/'.$course_details->course_image)}}" alt="">
            										</div>
            										<div class="certification-text">
            											<h3>{{ucwords($test->test_title)}}</h3>
            											<p>{{$test->test_desc}}</p>
            											<!--<p class="text-blu">Get Lorem ipsum dolor Exams</p>-->
            										</div>
            									</li>
        									@endforeach
        								@else
        								    <p>No Tips Available</p>
    									@endif
    								</ul>
    							</div>
    							<!--<div class="certification-tips-right">-->
    							<!--	<div class="ap-score-1">-->
    							<!--		<p class="college-board">You need a College Board account to get your AP Scores.</p>-->
    							<!--		<a href="javascript:void(0)">Sign up now &nbsp; > </a>-->
    							<!--	</div>-->
    							<!--	<div class="ap-score-2">-->
    							<!--		<p class="college-board">You need a College Board account to get your AP Scores.</p>-->
    							<!--		<a href="javascript:void(0)">Sign up now &nbsp; > </a>-->
    							<!--	</div>-->
    							<!--	<div class="ap-score-3">-->
    							<!--		<p class="college-board">You need a College Board account to get your AP Scores.</p>-->
    							<!--		<a href="javascript:void(0)">Sign up now &nbsp; > </a>-->
    							<!--	</div>-->
    							<!--</div>-->
    						</div>	
    					</div>
					</div>
				</div>
    				<!---------main colunn----------->
			</div>
		</div>
	</main>


@endsection

@section('script')
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
   <script>
    function openForm() {
      document.getElementById("myForm").style.display = "block";
    }

    function closeForm() {
      document.getElementById("myForm").style.display = "none";
    }
    </script>
    <!--<script>-->
    <!--    $(document).ready(function(){       -->
    <!--        $('#myModal').modal('show');-->
    <!--        $('#apm').css("display", "block");-->
    <!--    }); -->
    <!--</script>-->
    <script>
        function openCity(evt, cityName) {
          var i, tabcontent, tablinks;
          tabcontent = document.getElementsByClassName("tabcontent");
          for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
          }
          tablinks = document.getElementsByClassName("tablinks");
          for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
          }
          document.getElementById(cityName).style.display = "block";
          evt.currentTarget.className += " active";
        }
    </script>
    
    <script src="{{asset('public/assets/front/js/custom.js')}}"></script>
    <script>
        $(document).ready(function(){
            getRelatedCourse({courseStatus: "Trending"}, '.trendingCourse', '6', '2', '{{csrf_token()}}');
   		    getRelatedCourse({courseStatus: "Featured"}, '.featuredCourse', '6', '2', '{{csrf_token()}}');
        });


		// swiper-master    
		var swiper1 = new Swiper( '.swiper1', {
            spaceBetween: 20,
            loop: false,
            slidesPerView: 1,
            

            //autoplay: {
            //    delay: 5000,
            //},

			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},
        } );
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
    
    <script>
        // Get the modal
        var modal = document.getElementById("ReviewModel");
        
        $(document).on("click", ".openReviewModel", function(event) { 
            modal.style.display = "block";
        });
        
        $(document).on("click", ".closeReviewModel", function(event) { 
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