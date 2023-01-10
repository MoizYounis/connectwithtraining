@extends('front.layouts.master')
@section('title')Get More | {{$gs->title}} @endsection
@section('content')

<section class="breadcrums">
    <div class="container" style="max-width: 1223px;">
        <h2>Get More</h2>
    </div>
</section>

<!--<div class="get_popup">-->
<!--    <div id="myModal1" class="modal fade" role="dialog">-->
<!--      <div class="modal-dialog">-->
        <!-- Modal content-->
<!--        <div class="modal-content" style="background-color: transparent; border: none;">-->
<!--          <div class="modal-header">-->
<!--            <button type="button" class="close" data-dismiss="modal">&times;</button>-->
            <!--         <h4 class="modal-title">Modal Header</h4> -->
<!--          </div>-->
<!--          <div class="modal-body text-center">-->
<!--            <img id="popup-getmore" src="{{asset('public/assets/front/images/get_more_popup.png')}}">-->
<!--          </div>-->
<!--        </div>-->

<!--      </div>-->
<!--    </div>-->
<!--</div>-->
<section class="get_more">
    <div class="container">
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
            <div class="multi-circle">
                <img src="{{asset('public/assets/front/images/multi-circle.png')}}">
                <h2 class="multi-heading">Resume<br> building<br> process</h2>
                <p class="multi-orange">Your resume<br> XXXXX XXXX<br> database</p>
                <p class="multi-red">You buy the<br> services XXX<br> XXXXX<br> resume</p>
                <p class="multi-green">Our experts<br> XXXXX<br> XXXX<br> Exectation</p>
                <p class="multi-purple">Your resume <br>XXXXX <br>are suggested</p>
                <p class="multi-blue">Once you<br> XXXXX<br> XXXX<br> Prepared</p>
            </div>
        </div>
        <div class="get-pricing">
            <h2>Pricing</h2>
            <p>Great Plan That Fit Any Budget</p>
            <div class="blue-ribbion">
              <img src="{{asset('public/assets/front/images/blue-ribbion.png')}}">
              <h2>Free</h2>
              <p>Resume <br>Building</p>  
            </div>
        </div>
        <div class="prices-plans">
            <p>Pricing Plans</p>
            <div class="price-plan-box">
                <div class="list-box">
                    <div class="price-plan-list">
                        <h2>Do it yourself</h2>
                        <p>Free Resume Building</p>
                        <div class="ribbon ribbon-top-right"><span>Free</span></div>
                    </div>
                    <div class="llist-points">
                        <p>Most builder features included</p>
                        <p>XXXXXX XXXXXXXX XXXXX XX</p>
                        <p>XXXXXX XXXXXXXX XXXXX XX</p>
                        <p>XXXXXX XXXXXXXX XXXXX XX</p>
                        <p>XXXXXX XXXXXXXX XXXXX XX</p>
                        <p>XXXXXX XXXXXXXX XXXXX XX</p>
                        <p>XXXXXX XXXXXXXX XXXXX XX</p>
                        <p>Standard Support</p>
                    </div>
                    <div class="list-share-icon-left">
                        <div class="buy-now">
                            <a href=""><i class="fa fa-shopping-cart" aria-hidden="true"></i> Buy Now</a>
                        </div>
                        <div class="buy-now">
                            <a href=""><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart</a>
                        </div>
                        <div class="buy-now">
                            <a href=""><i class="fa fa-heart-o" aria-hidden="true"></i> Favorite</a>
                        </div>
                    </div>   
                </div>
                <div class="list-box">
                    <div class="price-plan-list">
                        <h2>Formatting</h2>
                        <p class="$price"><sup>$</sup>22<sub>/month</sub></p>
                    </div>
                    <div class="llist-points">
                        <p>Most builder features included</p>
                        <p>XXXXXX XXXXXXXX XXXXX XX</p>
                        <p>XXXXXX XXXXXXXX XXXXX XX</p>
                        <p>XXXXXX XXXXXXXX XXXXX XX</p>
                        <p>XXXXXX XXXXXXXX XXXXX XX</p>
                        <p>XXXXXX XXXXXXXX XXXXX XX</p>
                        <p>XXXXXX XXXXXXXX XXXXX XX</p>
                        <p>Standard Support</p>
                    </div>
                    <div class="list-share-icon">
                        <div class="buy-now">
                            <a href=""><i class="fa fa-shopping-cart" aria-hidden="true"></i> Buy Now</a>
                        </div>
                        <div class="buy-now">
                            <a href=""><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart</a>
                        </div>
                        <div class="buy-now">
                            <a href=""><i class="fa fa-heart-o" aria-hidden="true"></i> Favorite</a>
                        </div>
                    </div>  
                </div>
            </div>
            <div class="price-plan-box">
                <div class="list-box">
                    <div class="price-plan-list">
                        <h2>Formatting</h2>
                        <p class="$price"><sup>$</sup>22<sub>/month</sub></p>
                    </div>
                    <div class="llist-points">
                        <p>Most builder features included</p>
                        <p>XXXXXX XXXXXXXX XXXXX XX</p>
                        <p>XXXXXX XXXXXXXX XXXXX XX</p>
                        <p>XXXXXX XXXXXXXX XXXXX XX</p>
                        <p>XXXXXX XXXXXXXX XXXXX XX</p>
                        <p>XXXXXX XXXXXXXX XXXXX XX</p>
                        <p>XXXXXX XXXXXXXX XXXXX XX</p>
                        <p>Standard Support</p>
                    </div>
                    <div class="list-share-icon">
                        <div class="buy-now">
                            <a href=""><i class="fa fa-shopping-cart" aria-hidden="true"></i> Buy Now</a>
                        </div>
                        <div class="buy-now">
                            <a href=""><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart</a>
                        </div>
                        <div class="buy-now">
                            <a href=""><i class="fa fa-heart-o" aria-hidden="true"></i> Favorite</a>
                        </div>
                    </div>  
                </div>
                <div class="list-box">
                    <div class="price-plan-list">
                        <h2>Formatting</h2>
                        <p class="$price"><sup>$</sup>22<sub>/month</sub></p>
                    </div>
                    <div class="llist-points">
                        <p>Most builder features included</p>
                        <p>XXXXXX XXXXXXXX XXXXX XX</p>
                        <p>XXXXXX XXXXXXXX XXXXX XX</p>
                        <p>XXXXXX XXXXXXXX XXXXX XX</p>
                        <p>XXXXXX XXXXXXXX XXXXX XX</p>
                        <p>XXXXXX XXXXXXXX XXXXX XX</p>
                        <p>XXXXXX XXXXXXXX XXXXX XX</p>
                        <p>Standard Support</p>
                    </div>
                    <div class="list-share-icon">
                        <div class="buy-now">
                            <a href=""><i class="fa fa-shopping-cart" aria-hidden="true"></i> Buy Now</a>
                        </div>
                        <div class="buy-now">
                            <a href=""><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart</a>
                        </div>
                        <div class="buy-now">
                            <a href=""><i class="fa fa-heart-o" aria-hidden="true"></i> Favorite</a>
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
                        <img src="{{asset('public/assets/front/images/rating-img.png">
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
        
    </div>
</section>

@endsection

@section('script')
<script>
    // $(document).ready(function(){       
    //     $('#myModal1').show();
    // }); 
    
    // // Get the modal
    // var modal = document.getElementById("myModal1");
    
    // // Get the button that opens the modal
    // var btn = document.getElementById("myBtn");
    
    // // Get the <span> element that closes the modal
    // var span = document.getElementsByClassName("close")[0];
    
    // // When the user clicks the button, open the modal 
    // btn.onclick = function() {
    //   modal.style.display = "block";
    // }

    // // When the user clicks on <span> (x), close the modal
    // span.onclick = function() {
    //   modal.style.display = "none";
    // }

    // // When the user clicks anywhere outside of the modal, close it
    // window.onclick = function(event) {
    //   if (event.target == modal) {
    //     modal.style.display = "none";
    //   }
    // }
</script>
@endsection