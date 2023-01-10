@extends('front.layouts.master')
@section('title')Welcome to {{$gs->title}} @endsection
@section('content')
<?php $data = json_decode($gs->homepage); ?>
<!--Body Content-->
<main id="maincontent" class="page-main">
   <div class="columns">
      <div class="column main">
         <div class="fixed-live-chart">
            <ul>
               <li class="fxd-live-cht"><a href="#">Live Chat</a></li>
               <li class="fxd-contact-cht"><a href="#">Contact With Us</a></li>
            </ul>
         </div>
         <div class="fiexd-an-ins">
            <a href="#">Become An Instructor</a>
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
               <div class="dis-con"><span class="disnt-price">{{isset($data->banner_footer_text)?$data->banner_footer_text : ""}}</span></div>
            </div>
         </div>
         @endif
         <div class="container">
            <div class="toolbar toolbar-products top homepage">
               <div class="left">
                  <div class="brows-drop">
                     <select id="category" onfocus='this.size=8;' onblur='this.size=0;' onchange='this.size=1; this.blur();' class="select-category border" >
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
                        <li data-amount="0,{{$priceDiv}}">< ${{$priceDiv}} </li>
                        <li data-amount="{{$priceDiv+1}},{{$priceDiv*2}}">${{$priceDiv+1}} - ${{$priceDiv*2}}</li>
                        <li data-amount="{{$priceDiv*2+1}},{{$priceDiv*3}}">${{$priceDiv*2+1}} - ${{$priceDiv*3}}</li>
                        <li data-amount="{{$priceDiv*3+1}},{{$price->max_price}}">${{$priceDiv*3+1}} +</li>
                     </ul>
                  </div>
                  <div class="brows-drop pops-drop">
                     <!--<span id="con-selected" class="select-box">Popular Today</span>-->
                     <select class="selected-1 select-pops" style="border: 1px solid grey !important; z-index: 10242 !important;" id="change-cat" name="2" onfocus='this.size=5;' onblur='this.size=0;' onChange="this.size=1; this.blur(); filterCourse({courseStatus: this.options[this.selectedIndex].value}, null, '.traning-outer ul');">
                        <option style="text-align: center;" value=""> &nbsp;&nbsp;&nbsp;Popular Today</option>
                        <option value="Trending"> &nbsp;&nbsp;&nbsp;Trending Courses</option>
                        <option value="lowtohigh"> &nbsp;&nbsp;&nbsp;Price: Low to High</option>
                        <option value="hightolow"> &nbsp;&nbsp;&nbsp;Price: High to Low </option>
                        <option value="Featured"> &nbsp;&nbsp;&nbsp;Newly Featured Courses</option>
                     </select>
                  </div>
               </div>
            </div>
            <div class="ctg-title-outer">
               <h2>Popular New Courses</h2>
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
            <p>{{isset($data->minddle_img_subtitle)?$data->minddle_img_subtitle : ""}}</p>
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
@endsection