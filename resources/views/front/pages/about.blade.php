@extends('front.layouts.master')
@section('title'){{$pageData->page_title}} | {{$gs->title}} @endsection
@section('content')
<?php 
    $page = json_decode($pageData->page_content);;
?>
<section class="breadcrums">
    <div class="container" style="max-width: 1223px;">
        <h2>{{$pageData->page_title}}</h2>    
    </div>
</section>

<section class="about-content">
        <div class="container">
            <div class="row">
                 <div class="col-md-12">
                    <h2 class="section-heading">Getting to know Us</h2>
                     <div class="content-section">
                         <div class="col-md-2">
                             <div class="left-section">
                                 <img src="{{asset('public/assets/front/img/about/'.$page->left_img1)}}" align="">
                                 <p>{{$page->left_first_img_title1}}</p>
                             </div>
                             <div class="left-section">
                                 <img src="{{asset('public/assets/front/img/about/'.$page->left_img2)}}" align="">
                                 <p>{{$page->left_second_img_title2}}</p>
                             </div>
                             <div class="left-section">
                                 <img src="{{asset('public/assets/front/img/about/'.$page->left_img3)}}" align="">
                                 <p>{{$page->left_thired_img_title3}}</p>
                             </div>
                         </div>
                         <div class="col-md-8">
                             <div class="center-section">
                                 <img src="{{asset('public/assets/front/img/about/'.$page->center_img)}}" align="">
                                 <h2>{{$page->center_img_title}}</h2>
                             </div>
                             <div class="middle-content">
                                 <h4>{{$page->middle_title}}</h4>
                                 <p>{{$page->middle_desc}}/p>
                             </div>
                             <div class="middle-image">
                                <div class="middle_image">
                                     <img src="{{asset('public/assets/front/img/about/'.$page->below_img1)}}">
                                     <p>{{isset($page->below_first_img_title1)?$page->below_first_img_title1:""}}</p>
                                 </div>
                                 <div class="middle_image">
                                     <img src="{{asset('public/assets/front/img/about/'.$page->below_img2)}}">
                                     <p>{{isset($page->below_second_img_title2)?$page->below_second_img_title2:""}}</p>
                                 </div>
                                 <div class="middle_image">
                                     <img src="{{asset('public/assets/front/img/about/'.$page->below_img3)}}">
                                     <p>{{isset($page->below_thired_img_title3)?$page->below_thired_img_title3:""}}</p>
                                 </div>
                                 <div class="middle_image">
                                     <img src="{{asset('public/assets/front/img/about/'.$page->below_img4)}}">
                                     <p>{{$page->below_fourth_img_title4}}</p>
                                 </div>
                             </div>
                         </div>
                         <div class="col-md-2">
                             <div class="left-section">
                                 <img src="{{asset('public/assets/front/img/about/'.$page->right_img1)}}" align="">
                                 <p>{{$page->right_first_img_title1}}</p>
                             </div>
                             <div class="left-section">
                                 <img src="{{asset('public/assets/front/img/about/'.$page->right_img2)}}" align="">
                                 <p>{{$page->right_second_img_title2}}</p>
                             </div>
                             <div class="left-section">
                                 <img src="{{asset('public/assets/front/img/about/'.$page->right_img3)}}" align="">
                                 <p>{{$page->right_thired_img_title3}}</p>
                             </div>
                         </div>
                     </div>
                 </div>
            </div>
        </div>
    </section>
    <section class="rating-section">
        <h2 class="section-heading">Spiceworks Help Desk</h2>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="rating-heading">
                        <div class="col-md-3">
                            <div class="rating-content">
                                <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                <p>XXXXXXXX XXXX XXXXXXXXXX XXXXX X XXX XXXX X XXXXXXX XXXXXX  XXXXXXXXX XX XXXX XXXX XX
                                    XXX XXXXXXXX X XXXXX XX XX XX XXXXXXX XX XX XXXXX XXXXX  XXX XX XXXXXXX XXXXXXX XXXX X
                                    X XXXXX XXXXXXXXXXXXXXX XXXXXXXXX X XXXXX XXXXXXX XXXXXXX XXX X XXXXXX XXXXXX XXXXX
                                    XXX XXXXXXXXXXX XXXXXX XXX X</p>

                                    <div class="rating-img">
                                        <img src="{{asset('public/assets/front/images/teacher-img.png')}}" alt="">
                                        <p class="rating-name">Samuel Jackson</p>
                                    </div>
                            </div>
                            
                        </div>
                        <div class="col-md-3">
                            <div class="rating-content">
                                <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                <p>XXXXXXXX XXXX XXXXXXXXXX XXXXX X XXX XXXX X XXXXXXX XXXXXX  XXXXXXXXX XX XXXX XXXX XX
                                    XXX XXXXXXXX X XXXXX XX XX XX XXXXXXX XX XX XXXXX XXXXX  XXX XX XXXXXXX XXXXXXX XXXX X
                                    X XXXXX XXXXXXXXXXXXXXX XXXXXXXXX X XXXXX XXXXXXX XXXXXXX XXX X XXXXXX XXXXXX XXXXX
                                    XXX XXXXXXXXXXX XXXXXX XXX X</p>

                                    <div class="rating-img">
                                        <img src="{{asset('public/assets/front/images/teacher-img.png')}}" alt="">
                                        <p class="rating-name">Samuel Jackson</p>
                                    </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="rating-content">
                                <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                <p>XXXXXXXX XXXX XXXXXXXXXX XXXXX X XXX XXXX X XXXXXXX XXXXXX  XXXXXXXXX XX XXXX XXXX XX
                                    XXX XXXXXXXX X XXXXX XX XX XX XXXXXXX XX XX XXXXX XXXXX  XXX XX XXXXXXX XXXXXXX XXXX X
                                    X XXXXX XXXXXXXXXXXXXXX XXXXXXXXX X XXXXX XXXXXXX XXXXXXX XXX X XXXXXX XXXXXX XXXXX
                                    XXX XXXXXXXXXXX XXXXXX XXX X</p>

                                    <div class="rating-img">
                                        <img src="{{asset('public/assets/front/images/teacher-img.png')}}" alt="">
                                        <p class="rating-name">Samuel Jackson</p>
                                    </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="rating-content">
                                <img src="{{asset('public/assets/front/images/rating-img.png')}}">
                                <p>XXXXXXXX XXXX XXXXXXXXXX XXXXX X XXX XXXX X XXXXXXX XXXXXX  XXXXXXXXX XX XXXX XXXX XX
                                    XXX XXXXXXXX X XXXXX XX XX XX XXXXXXX XX XX XXXXX XXXXX  XXX XX XXXXXXX XXXXXXX XXXX X
                                    X XXXXX XXXXXXXXXXXXXXX XXXXXXXXX X XXXXX XXXXXXX XXXXXXX XXX X XXXXXX XXXXXX XXXXX
                                    XXX XXXXXXXXXXX XXXXXX XXX X</p>

                                    <div class="rating-img">
                                        <img src="{{asset('public/assets/front/images/teacher-img.png')}}" alt="">
                                        <p class="rating-name">Samuel Jackson</p>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection