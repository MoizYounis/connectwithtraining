@extends('front.layouts.master')
@section('title')Resume Building | {{$gs->title}} @endsection
@section('content')

<section class="breadcrums">
    <div class="container" style="max-width: 1223px;">
        <h2>Resume Building</h2>
    </div>
</section>

<section class="get_more">
        <div class="resume-building">
            <h2>Resume Building Plan</h2>
            <div class="formatting">
                <div class="formatting-radio">
                    <input type="radio" name="">
                    <p>Pricing</p>
                </div>
                <div class="formatting-radio">
                    <input type="radio" name="">
                    <p>Free</p>
                </div>
                <div class="formatting-radio">
                    <input type="radio" name="">
                    <p>Formatting</p>
                </div>
                <div class="formatting-radio">
                    <input type="radio" name="">
                    <p>Reviewing</p>
                </div>
                <div class="formatting-radio">
                    <input type="radio" name="">
                    <p>Get Help</p>
                </div>
            </div>
        </div>
        <style>
            .row {
                display: -ms-flexbox;
                display: flex;
                -ms-flex-wrap: wrap;
                flex-wrap: wrap;
                margin-right: -15px;
                margin-left: -15px;
            }
            .col-md-3 {
                -ms-flex: 0 0 25%;
                flex: 0 0 25%;
                max-width: 25%;
            }
            .col-md-6 {
                -ms-flex: 0 0 50%;
                flex: 0 0 50%;
                max-width: 50%;
            }
            .col, .col-1, .col-10, .col-11, .col-12, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-auto, .col-lg, .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-auto, .col-md, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-auto, .col-sm, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-auto, .col-xl, .col-xl-1, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-auto {
                position: relative;
                width: 100%;
                min-height: 1px;
                padding-right: 15px;
                padding-left: 15px;
            }
        </style>

        <div class="free-resume">
            <h2>Free Resume Building</h2>
            <!-- 30-06-2022 -->
            <div class="resume-head" style="margin-bottom: -35px;">
                                <h2>Preview</h2>
        </div>
            <div class="index">
            <i class="fa fa-share-alt" aria-hidden="true"></i>
            <i class="fa fa-envelope-o" aria-hidden="true"></i>
            <i class="fa fa-print" aria-hidden="true"></i>
            <i class="fa fa-floppy-o" aria-hidden="true"></i>
         </div>
            <div class="resume-section">
                <div class="row">
                    <div class="col-md-3">
                        <div class="resume-fields">
                            <div class="cont-info-btn">
                                <a href="">Contact Info</a>
                            </div>
                            <div class="cont-fields">
                                <div class="cont-name">
                                    <p>First Name</p>
                                    <input type="text" name="">
                                </div>
                                <div class="cont-name">
                                    <p>last Name</p>
                                    <input type="text" name="">
                                </div>
                                <div class="cont-name">
                                    <p>Phone</p>
                                    <input type="number" name="">
                                </div>
                                <div class="cont-name">
                                    <p>Email</p>
                                    <input type="email" name="">
                                </div>
                            </div>
                            <div class="clearance">
                                <h2>Clearnce</h2>
                                <textarea></textarea>
                                <div class="link-btn">
                                    <a href=""><i class="fa fa-plus" aria-hidden="true"></i> Add More</a>
                                </div>
                                
                            </div>
                            <div class="summary-resume">
                                <h2>Summary</h2>
                                <textarea></textarea>
                            </div>
                            <div class="skill">
                                <h2>Skill Competence</h2>
                                <textarea></textarea>
                                <div class="link-btn">
                                    <a href=""><i class="fa fa-plus" aria-hidden="true"></i> Add More</a>
                                </div>
                            </div>
                            <div class="experience">
                                <h2>Experience</h2>
                                <div class="present">
                                    <p><b>Company worked for...</b></p>
                                    <div class="title-date">
                                        <p>Title</p>
                                        <p>Month</p>
                                        <input type="text" name="">
                                        <p>Year</p>
                                        <input type="text" name="">
                                        <p>to Present</p>
                                    </div>
                                </div>
                                <div class="link-btn">
                                    <a href=""><i class="fa fa-plus" aria-hidden="true"></i> Add More</a>
                                </div>
                            </div>
                            <div class="educat">
                                <h2>Education</h2>
                                <div class="school">
                                    School
                                </div>
                                <div class="year">
                                    <div class="year-start">
                                        Year
                                    </div>
                                    <p>to</p>
                                    <div class="year-start">
                                        Year
                                    </div>
                                </div>
                                <div class="school">
                                    Degree
                                </div>
                                <div class="link-btn">
                                    <a href=""><i class="fa fa-plus" aria-hidden="true"></i> Add More</a>
                                </div>
                            </div>
                            <div class="skill">
                                <h2>Awards</h2>
                                <textarea></textarea>
                                <div class="link-btn">
                                    <a href=""><i class="fa fa-plus" aria-hidden="true"></i> Add More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="preview-resume">
                            <div class="resume-head">
                                <h2>John Doe</h2>
                                <p>XXXXX XXXX</p>
                                <p>XXXXX XXXX XXXX</p>
                            </div>
                            <div class="green-line"></div>
                            <div class="resume-text">
                                <h2>Clearance</h2>
                                <p>XXXXXX XXXXXXXXXX XXXXXXXX XXXXXXXXXX XXXXXXXXX XXXXXXXX XXXXXXXX XXXXXXXXXXXX XXXXXXXXXXX XXXXXXXXXXXXXXXX XXXXXXXXXX XXXXXXXXXXX XXXXXXXXXX XXX XXXXXXXXXXXXX XXXXXXXXXXXXXX XXXXXXXXXXXXXX XXXXXXXXXXXXXXXX XXXXXXXXXXXXXX XXXXXXXXXXX XXXXXXXXXXX XXXXXXXXXX XXXXXXXXXXXX XXXXXXXX</p>
                            </div>
                            <div class="resume-text">
                                <h2>Summary</h2>
                                <p>XXXXXX XXXXXXXXXX XXXXXXXX XXXXXXXXXX XXXXXXXXX XXXXXXXX XXXXXXXX XXXXXXXXXXXX XXXXXXXXXXX XXXXXXXXXXXXXXXX XXXXXXXXXX XXXXXXXXXXX XXXXXXXXXX XXX XXXXXXXXXXXXX XXXXXXXXXXXXXX XXXXXXXXXXXXXX XXXXXXXXXXXXXXXX XXXXXXXXXXXXXX XXXXXXXXXXX XXXXXXXXXXX XXXXXXXXXX XXXXXXXXXXXX XXXXXXXX</p>
                            </div>
                            <div class="resume-text">
                                <h2>Skill Competence</h2>
                                <p><i class="fa fa-circle" aria-hidden="true"></i> XXXXXX XXXXXXXXXX XXXXXXXX XXXXXXXXXX XXXXXXXXX XXXXXXXX</p>
                            </div>
                            <div class="resume-text">
                                <h2>Experience</h2>
                                <p><b>XXXXXX XXXXXXXXXX XXXXXXXXXX</b></p>
                                <p>XXXXXX XXXXXXXXXX XXXXXXXXXX</p>
                                <br>
                                <p><b>XXXXXX XXXXXXXXXX XXXXXXXXXX</b></p>
                                <p><i class="fa fa-circle" aria-hidden="true"></i> XXXXXXXXXXXX XXXXXXXXXXXX XXXXXXXXXXXXXXXX XXXXXXXXXXXX XXXXXXXXXXXXXXXXXXXXXX XXXX XXXXXXXX XXXXXXXXXXXX XXXXXXX</p>
                                <p><i class="fa fa-circle" aria-hidden="true"></i> XXXXXXXXXXXX XXXXXXXXXXXX XXXXXXXXXXXXXXXX XXXXXXXXXXXX XXXXXXXXXXXXXXXXXXXXXX XXXX XXXXXXXX XXXXXXXXXXXX XXXXXXX</p>
                                <p><i class="fa fa-circle" aria-hidden="true"></i> XXXXXXXXXXXX XXXXXXXXXXXX XXXXXXXXXXXXXXXX XXXXXXXXXXXX XXXXXXXXXXXXXXXXXXXXXX XXXX XXXXXXXX XXXXXXXXXXXX XXXXXXX</p>
                            </div>
                            <div class="resume-text">
                                <h2>Education</h2>
                                <p><b>XXXXXX XXXXXXXXXX XXXXXXXXXX</b></p>
                                <p>XXXXXX XXXXXXXXXX XXXXXXXXXX</p>
                            </div>
                            <div class="resume-text">
                                <h2>Awards</h2>
                                <p><b>XXXXXX XXXXXXXXXX XXXXXXXXXX</b></p>
                                <p>XXXXXX XXXXXXXXXX XXXXXXXXXX</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="tips">
                            <div class="certificate-tips">
                                <h2>Certificate Tips</h2>
                                <p><span><i class="fa fa-circle" aria-hidden="true"></i></span> XXXXXXXX XXXXXXX XXXXXXXXXX XXX XXXXXXXXXX XXXXXXXXXXXXX XXXXX XXXXXXXXX</p>
                                <p><span><i class="fa fa-circle" aria-hidden="true"></i></span> XXXXXXXX XXXXXXX XXXXXXXXXX XXX XXXXXXXXXX XXXXXXXXXXXXX XXXXX XXXXXXXXX</p>
                                <p><span><i class="fa fa-circle" aria-hidden="true"></i></span> XXXXXXXX XXXXXXX XXXXXXXXXX XXX XXXXXXXXXX XXXXXXXXXXXXX XXXXX XXXXXXXXX</p>
                                <p><span><i class="fa fa-circle" aria-hidden="true"></i></span> XXXXXXXX XXXXXXX XXXXXXXXXX XXX XXXXXXXXXX XXXXXXXXXXXXX XXXXX XXXXXXXXX</p>
                            </div>
                            <div class="certificate-tips">
                                <h2>Have a professional re-wrtie your resume:</h2>
                                <p>XXXXXXXX XXXXXXX XXXXXXXXXX XXXXXX XXXXXXXXXX XXXXXXXXXXXXX XXXXXXXX XXXXXXXXX XXX XXXXX XXXXXX</p>
                                <p>XXXXXXXX XXXXXXX XXXXXXXXXX XXXXXX XXXXXXXXXX XXXXXXXXXXXXX XXXXXXXX XXXXXXXXX XXXXXXXX XXXXXXXXX XXXXX XXXXXXXXX XXXXXXXXXX XXXXXXXXXXXX XXXXXXXX XXXXXXXXXX XXXXXXXX</p>
                            </div>
                        </div>
                        <div class="tips">
                            <div class="action-verbs">
                                <h2>Action Verbs to Strengthen Your Resume</h2>
                                <div class="verbs-text">
                                    <p> Chaired<br>
                                        Controlled<br>
                                        Coordinated<br>
                                        Executed<br>
                                        Headed<br>
                                        Operated<br>
                                        Orchestrated<br>
                                        Organized<br>
                                        Oversaw<br>
                                        Planned<br>
                                        Produced<br>
                                        Programmed<br>
                                        Administered<br>
                                        Built<br>
                                        Charted<br>
                                        Created<br>
                                        Designed<br>
                                        Developed<br>
                                        Devised<br>
                                        Founded<br>
                                        Engineered<br>
                                        Established<br>
                                        Formalized<br>
                                        Formed<br>
                                        Formulated<br>
                                        Implemented<br>
                                        Incorporated<br>
                                        Initiated<br>
                                        Instituted<br>
                                        Introduced<br>
                                        Launched<br>
                                        Pioneered<br>
                                        Spearheaded<br>
                                        Conserved<br>
                                        Consolidated<br>
                                        Decreased<br>
                                        Deducted<br>
                                        Diagnosed<br>
                                        Lessened<br>
                                        Reconciled<br>
                                        Reduced<br>
                                        Yielded
                                    </p>
                                    <p> Chaired<br>
                                        Controlled<br>
                                        Coordinated<br>
                                        Executed<br>
                                        Headed<br>
                                        Operated<br>
                                        Orchestrated<br>
                                        Organized<br>
                                        Oversaw<br>
                                        Planned<br>
                                        Produced<br>
                                        Programmed<br>
                                        Administered<br>
                                        Built<br>
                                        Charted<br>
                                        Created<br>
                                        Designed<br>
                                        Developed<br>
                                        Devised<br>
                                        Founded<br>
                                        Engineered<br>
                                        Established<br>
                                        Formalized<br>
                                        Formed<br>
                                        Formulated<br>
                                        Implemented<br>
                                        Incorporated<br>
                                        Initiated<br>
                                        Instituted<br>
                                        Introduced<br>
                                        Launched<br>
                                        Pioneered<br>
                                        Spearheaded<br>
                                        Conserved<br>
                                        Consolidated<br>
                                        Decreased<br>
                                        Deducted<br>
                                        Diagnosed<br>
                                        Lessened<br>
                                        Reconciled<br>
                                        Reduced<br>
                                        Yielded
                                    </p>
                                    <p> Chaired<br>
                                        Controlled<br>
                                        Coordinated<br>
                                        Executed<br>
                                        Headed<br>
                                        Operated<br>
                                        Orchestrated<br>
                                        Organized<br>
                                        Oversaw<br>
                                        Planned<br>
                                        Produced<br>
                                        Programmed<br>
                                        Administered<br>
                                        Built<br>
                                        Charted<br>
                                        Created<br>
                                        Designed<br>
                                        Developed<br>
                                        Devised<br>
                                        Founded<br>
                                        Engineered<br>
                                        Established<br>
                                        Formalized<br>
                                        Formed<br>
                                        Formulated<br>
                                        Implemented<br>
                                        Incorporated<br>
                                        Initiated<br>
                                        Instituted<br>
                                        Introduced<br>
                                        Launched<br>
                                        Pioneered<br>
                                        Spearheaded<br>
                                        Conserved<br>
                                        Consolidated<br>
                                        Decreased<br>
                                        Deducted<br>
                                        Diagnosed<br>
                                        Lessened<br>
                                        Reconciled<br>
                                        Reduced<br>
                                        Yielded
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                
                <p>Some text in the Modal..</p>
              </div>

            </div>
        </div>
        <!-- The Modal -->
    
</section>
@endsection

@section('files')
  
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

@endsection