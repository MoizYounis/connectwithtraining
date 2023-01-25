@extends('front.layouts.master')
@section('title')Welcome to {{$gs->title}} @endsection
@section('content')
<?php $data = json_decode($gs->homepage); ?>

<!--Body Content-->
<main id="maincontent" class="page-main">
    
    <!-- The Modal -->
    <div id="myModal1" class="modal" style="z-index: 10244;">
        <!-- Modal content -->
        <div class="modal-content modal-home-popup">
            <div class="modal-popup-bg">
               <div class="home-popup-heading">
                  <span></span>
                  <div class="myModalClosehome-resize1">
                     <span class="myModalClosehome1">&times;</span>
                  </div>
               </div>         
               <div class="popup-padd-top-bot">
                  <!--<form action="" method="post">	-->
                     <div class=""><br>
                        <h2>Get Exclusive Offers!</h2><br>
                        <div class="form-group home-popup-design">
                        <div>
                           <input type="email" class="form-field subEmail" name="email" placeholder="Email" value="" required=""> 
                        </div>                       	
                           <div>
                              <input type="submit" class="btn" value="Sign Up" onclick="doSubscribe1('{{csrf_token()}}')">
                           </div>
                        </div>
                     </div>
                     <p style="color: #fff; margin-top: 7px;"><a href="{{url('terms-conditions')}}" style="text-decoration: none; color: white;">Terms and Conditions</a> <span style="margin-left: 9px;">|</span> <a href="{{url('privacy-policy')}}" style="text-decoration: none; color: white; margin-left: 10px;">Privacy Policy</a></p>
                  <!--</form>-->
               </div>
            </div>
        </div>
    </div>
    <!--End The Modal -->


    <!-- The Modal2 -->
    <div id="myModal2" class="modal" style="z-index: 10243;">
        <!-- Modal content -->
        <div class="modal-content modal-home-popup2 referel-modal">
         <div class="ref_mod">
            <a href="https://www.connectwithtraining.com/refer-a-friend"><img class="home-popup-img2" src="{{asset('public/assets/front/images/home-popup1.png')}}">
            </a>
            <div class="myModalClosehome-resize-ref1">
               <span class="myModalClosehome-refer">&times;</span>
            </div>
         </div>
           
            
         </div>
    </div>
    <!--End The Modal -->
    
    
   <div class="columns">
      <div class="column main">
         <div class="fixed-live-chart">
            <ul>
               <li class="fxd-live-cht"><a href="{{url('coming-soon')}}">Live Chat</a></li>
               <li class="fxd-contact-cht"><a href="{{url('coming-soon')}}">Contact With Us</a></li>
            </ul>
         </div>
         <div class="fiexd-an-ins">
            <a href="{{url('become-an-instructor')}}">Become An Instructor</a>
         </div>
         @if($data->banner_img != '')
         <div class="banner-outer">
            <ul>
               <li>
                  <img src="{{asset('public/assets/front/img/banner/'.$data->banner_img)}}" alt=""/>
                  <div class="ban-con">
                  <h2 class="wel">{{isset($data->text_on_banner)?$data->text_on_banner : ""}}</h2>
                  </div>
               </li>
            </ul>
         </div>
         
         <div class="disnt-outer">
            <div class="disnt-inr">
               <div class="dis-con">
                <span class="disnt-price">{{isset($data->banner_footer_text)?$data->banner_footer_text : ""}}
                  <span class="counter1" id="days"></span>
                  <span  class="counter1" id="hours"></span>
                  <span  class="counter1" id="mins"></span>
                  <span  class="counter1" id="secs"></span>
                  <span id="end">
                    <a href="#" class="myModalGrab myModalOpenHome">CONNECT NOW</a>
                  </span>    
                </span>
              </div>
            </div>
         </div>
         @endif
         <div class="container">
            <div class="toolbar toolbar-products top homepage">
               <div class="left">
                  <div class="brows-drop">
                     <!-- 30-06-2022 -->
                     <select id="category" style="width:175px;" onfocus='this.size=25;' onblur='this.size=0;' onchange='this.size=1; this.blur();' class="select-category border" >
                        <!--style="border-style: solid; border-width: 5px; border-color: black;" -->
                        <option value="" >Select Category</option>
                        @foreach($category_data as $cat)
                        <option value="{{$cat->id}}">{{ucwords($cat->category_name)}}</option>
                        @endforeach
                     </select>
                  </div>
               </div>
               <div class="right">
                  <div class="list-search" style="width:200px;margin-left:-44px;">
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
                     <!-- 30-06-2022 -->
                     <select class="selected-1 select-pops" style=" z-index: 10242 !important;width: 230px;" id="change-cat" name="2" onfocus='this.size=5;' onblur='this.size=0;' onChange="this.size=1; this.blur(); myFunction(this); filterCourse({courseStatus: this.options[this.selectedIndex].value}, null, '.traning-outer ul');">
                        <option style="text-align: center;" value=""> &nbsp;&nbsp;&nbsp;Popular Today</option>
                        <option value="Trending"> &nbsp;&nbsp;&nbsp;Trending Courses</option>
                        <option value="lowtohigh"> &nbsp;&nbsp;&nbsp;Price: Low to High</option>
                        <option value="hightolow"> &nbsp;&nbsp;&nbsp;Price: High to Low </option>
                        <option value="Featured"> &nbsp;&nbsp;&nbsp;Newly Featured Courses</option>
                     </select>
                  </div>
               </div>
            </div>
            <div class="ctg-title-outer" id="ctg-title-outer">
               <h2 id="ctg-title"></h2>
            </div>
         </div>
      </div>
      <div class="container">
         <div class="traning-outer">
            <ul class="popular-course-resize"></ul>
            <div class="brws-more">
               <a href="{{url('courses')}}">BROWSE <br>MORE COURSES</a>
            </div>
         </div>
      </div>
      
      @if($data->homepage_middle_img != '')
      <div class="expo-outer" style="background: url({{asset('public/assets/front/img/banner/'.$data->homepage_middle_img)}}) no-repeat 0 0;">
         <div class="container">
            <h2>{{isset($data->minddle_img_title)?$data->minddle_img_title : ""}}</h2>
            <p class="get-eposer">{{isset($data->minddle_img_subtitle)?$data->minddle_img_subtitle : ""}}</p>
         </div>
      </div>
      @endif
      
      <div class="exprience-outer">
         <div class="container">
            <h2>
                <?php
                    if(isset($data->review_section_heading) && $data->review_section_heading != ""){
                        $heading = explode(" ", $data->review_section_heading);
                        $i = 0;
                        while($i < count($heading)){
                            if($i == 5){ echo "<br>"; }
                            if($i == 3 or $i == 8){ echo "<span>".$heading[$i]."</span> "; }
                            else{ echo $heading[$i]." "; }
                            $i++;
                        }
                    }
                ?>
            </h2>
            <div class="teacher-outer">
               <ul>
                  <?php
                     $i = 0;
                     $userReview = array(
                     	"review1" => array("img"=>$data->review_images[0], "title"=>$data->review_title1, "comment"=>$data->review_comment1, "rate"=>$data->review_rating1),
                     	"review2" => array("img"=>$data->review_images[1], "title"=>$data->review_title2, "comment"=>$data->review_comment2, "rate"=>$data->review_rating2),
                     	"review3" => array("img"=>$data->review_images[2], "title"=>$data->review_title3, "comment"=>$data->review_comment3, "rate"=>$data->review_rating3),
                     	"review4" => array("img"=>$data->review_images[3], "title"=>$data->review_title4, "comment"=>$data->review_comment4, "rate"=>$data->review_rating4)
                     );
                     ?>
                  @foreach($userReview as $review)
                  <li>
                     <div class="pro-img">
                        <img src="{{asset('public/assets/front/img/publicReviews/').'/'.$review['img']}}" alt="{{$review['title']}}">
                        <p class="name">{{ucwords($review['title'])}}</p>
                     </div>
                     <div class="rating-outer">
                         <div class="rating-star" style="text-align:center;">
                            <span class="fa fa-star @if($review['rate'] >= 1) {{ "checked" }} @endif"></span>
                            <span class="fa fa-star @if($review['rate'] >= 2) {{ "checked" }} @endif"></span>
                            <span class="fa fa-star @if($review['rate'] >= 3) {{ "checked" }} @endif"></span>
                            <span class="fa fa-star @if($review['rate'] >= 4) {{ "checked" }} @endif"></span>
                            <span class="fa fa-star @if($review['rate'] >= 5) {{ "checked" }} @endif"></span>
                         </div>
                     </div>
                     <div class="des">
                        <p>{{$review['comment']}}</p>
                     </div>
                  </li>
                  @endforeach
               </ul>
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
    $('.price-range li').click(function(){
        var priceRange = {priceRange: $(this).attr('data-amount')};
        filterCourse(priceRange, null, '.traning-outer ul');
    });
    $('#category').change(function(){
        var category = {category: $(this).val()};
        filterCourse(category, null, '.traning-outer ul');
    });
    $('#search').keyup(function(){
        var search = {search: $(this).val()};
        filterCourse(search, null, '.traning-outer ul');
    });
    filterCourse(null, null, '.traning-outer ul');
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
    var modal1 = document.getElementById("myModal1");
    
   //  window.onload = function(){modal1.style.display = "block";};
    
    $(document).on("click", ".myModalClosehome1", function(event) { 
        modal1.style.display = "none";
    });
    $(document).on("click", ".myModalGrab", function(event) { 
       event.preventDefault();
        modal1.style.display = "block";
    });
    
    window.onclick = function(event) {
      if (event.target == modal1) {
        modal1.style.display = "none";
      }
    }


    var timer;
    timer = setInterval(function() {
      modal2.style.display = "block";
   }, 900000);

    var modal2 = document.getElementById("myModal2");
    
    window.onload = function(){
       modal1.style.display = "block";
       modal2.style.display = "block";
   };
    
    $(document).on("click", ".myModalClosehome-refer", function(event) { 
        modal2.style.display = "none";
    });
    $(document).on("click", ".myModalOpenHome", function(event) { 
       event.preventDefault();
        modal2.style.display = "block";
    });
    
    window.onclick = function(event) {
      if (event.target == modal2) {
        modal2.style.display = "none";
      }
    }
</script>

<script>
    // The data/time we want to countdown to
    var countDownDate = new Date("{{$data->banner_timer}}").getTime();

    // Run myfunc every second
    var myfunc = setInterval(function() {

    var now = new Date().getTime();
    var timeleft = countDownDate - now;
        
    // Calculating the days, hours, minutes and seconds left
    var days = Math.floor(timeleft / (1000 * 60 * 60 * 24));
    var hours = Math.floor((timeleft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((timeleft % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((timeleft % (1000 * 60)) / 1000);
        
    // Result is output to the specific element
    document.getElementById("days").innerHTML = days + "d "
    document.getElementById("hours").innerHTML = hours + "h " 
    document.getElementById("mins").innerHTML = minutes + "m " 
    document.getElementById("secs").innerHTML = seconds + "s " 
        
    // Display the message when countdown is over
    if (timeleft < 0) {
        clearInterval(myfunc);
        document.getElementById("days").innerHTML = ""
        document.getElementById("hours").innerHTML = "" 
        document.getElementById("mins").innerHTML = ""
        document.getElementById("secs").innerHTML = ""
        document.getElementById("end").innerHTML = "TIME UP!!";
    }
    }, 1000);
</script>
<script>
    document.getElementById("ctg-title").innerHTML = 'Popular Today';
    function myFunction(category) {
        var categoryId = document.getElementById("change-cat");
        var categoryName = categoryId.options[categoryId.selectedIndex].text;
        document.getElementById("ctg-title").innerHTML = categoryName;
    }
</script>
@endsection