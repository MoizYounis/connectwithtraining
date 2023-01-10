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
                                <div class="plans-section-price">
                                    <div class="single-border">
                                        <p><b>SINGLE</b></p>
                                        <div class="free-circle">
                                            <h2>FREE</h2>
                                        </div>
                                        <p><b>Membership Expires after 180 Days</b></p>
                                        <p>3 Courses</p>
                                        <p>2 Certificate</p>
                                        <p>1 Badge</p>
                                        <p>180 Days</p>
                                        <div class="single-btn">
                                            <a href="">Details</a>
                                        </div>
                                    </div>
                                    <div class="single-border">
                                        <p><b>SINGLE</b></p>
                                        <div class="second-free-circle">
                                            <h2>$9.00</h2>
                                            <h3>/month</h3>
                                            <p>No Delay<br>Interview</p>
                                        </div>
                                        <p><b>Membership Expires after 180 Days</b></p>
                                        <p>3 Courses</p>
                                        <p>2 Certificate</p>
                                        <p>1 Badge</p>
                                        <p>180 Days</p>
                                        <div class="single-btn">
                                            <a href="">Details</a>
                                        </div>
                                    </div>
                                    <div class="single-border">
                                        <p><b>Corporate</b></p>
                                        <div class="second-free-circle">
                                            <h2 style="left: 46.5%;">$29.00</h2>
                                            <h3 style="left: 47.5%;">/month</h3>
                                            <p>Prep Me Ahead<br>Interview</p>
                                        </div>
                                        <p><b>Membership Expires after 180 Days</b></p>
                                        <p>3 Courses</p>
                                        <p>2 Certificate</p>
                                        <p>1 Badge</p>
                                        <p>180 Days</p>
                                        <div class="single-btn">
                                            <a href="">Details</a>
                                        </div>
                                    </div>
                                    <div class="single-border">
                                        <p><b>Enterprise</b></p>
                                        <div class="second-free-circle">
                                            <h2 style="left: 66%;">$99.00</h2>
                                            <h3 style="left: 67%;">/month</h3>
                                            <p>Extensive<br>Interview</p>
                                        </div>
                                        <p><b>Membership Expires after 180 Days</b></p>
                                        <p>3 Courses</p>
                                        <p>2 Certificate</p>
                                        <p>1 Badge</p>
                                        <p>180 Days</p>
                                        <div class="single-btn">
                                            <a href="">Details</a>
                                        </div>
                                    </div>
                                    <div class="single-border">
                                        <p><b>SINGLE</b></p>
                                        <div class="second-free-circle">
                                            <h2 style="left: 86%;">$9.00</h2>
                                            <h3 style="left: 86.5%;">/month</h3>
                                            <p>Tailored<br>Interview</p>
                                        </div>
                                        <p><b>Membership Expires after 180 Days</b></p>
                                        <p>3 Courses</p>
                                        <p>2 Certificate</p>
                                        <p>1 Badge</p>
                                        <p>180 Days</p>
                                        <div class="single-btn">
                                            <a href="">Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="stages">
                                <h2>7 Stages of our Interview Process</h2>
                                <img src="{{asset('public/assets/front/images/interview_plan.png')}}">
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
                                                <p>Here’s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
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
                                                <p>Here’s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
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
                                                <p>Here’s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
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
                                                <p>Here’s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
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
                                                <p>Here’s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
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
                                                <p>Here’s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
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
                                                <p>Here’s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
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
                                                <p>Here’s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
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
                                <div class="dealy-images">
                                    <img src="{{asset('public/assets/front/images/nodelay-text.png')}}">
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
                                                <p>Here’s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
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
                                                <p>Here’s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
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
                                                <p>Here’s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
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
                                                <p>Here’s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
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
                                                <p>Here’s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
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
                                                <p>Here’s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
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
                                                <p>Here’s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
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
                                                <p>Here’s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
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
                            <div class="dealy-images">
                                <img src="{{asset('public/assets/front/images/prep-head.png')}}" style="width: 600px; height: auto;">
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
                                            <p>Here’s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
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
                                            <p>Here’s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
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
                                            <p>Here’s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
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
                                            <p>Here’s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
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
                                            <p>Here’s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
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
                                            <p>Here’s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
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
                                            <p>Here’s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
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
                                            <p>Here’s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
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
                        <section class="plan-image">
                            <div class="container">
                               <div class="plan-img-text">
                                    <img src="{{asset('public/assets/front/images/extensive_image.png')}}" style="width: 600px; height: auto;">
                                </div>
                                <div class="images-over-heading">
                                    <p class="image-center-text">Extensive<br> Interview<br> Plan</p>
                                    <p class="first-text">1. Information<br> Interview</p>
                                    <p class="second-text">2. Non<br> Directive<br> Interview</p>
                                    <p class="third-text">3. Termination <br>Interview</p>
                                    <p class="fourth-text">4. Evaluation<br> Interview</p>
                                    <p class="fifth-text">5. Routine<br> Interview</p>
                                    <p class="sixth-text">6. Views<br> assessing<br> Interview</p>
                                    <p class="seventh-text">7. Individual<br> Interview</p>
                                    <p class="eight-text">8. Exit<br> Interview</p>
                                </div> 
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
                                        <p>Here’s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
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
                                        <p>Here’s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
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
                                        <p>Here’s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
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
                                        <p>Here’s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
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
                                        <p>Here’s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
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
                                        <p>Here’s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
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
                                        <p>Here’s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
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
                                        <p>Here’s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
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
                            <div class="dealy-images">
                                <img src="{{asset('public/assets/front/images/tailored-interview.png')}}" style="width: 600px; height: auto;">
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
                                            <p>Here’s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
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
                                            <p>Here’s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
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
                                            <p>Here’s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
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
                                            <p>Here’s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
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
                                            <p>Here’s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
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
                                            <p>Here’s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
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
                                            <p>Here’s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
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
                                            <p>Here’s xxxx xxxxxxxx xxxxxxx xxx XXXXXXXXX XXXXXXX XXXXX XXXX XXXXXX XXXX XXXX XXX XX XXXXXXXXXXX XXXXXXX XXXXXXXX XXXXXXX XXXX XXXXXXX XXXXXXXX XXX XX XXXXXX XXXXXXX XXXX XXXX X XXXXXXX XXXXXXX XXXXXXXX XXXXXXXX XXXXXXXX XXXXX XXXXXXX XXXXX XXX XXX XX
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