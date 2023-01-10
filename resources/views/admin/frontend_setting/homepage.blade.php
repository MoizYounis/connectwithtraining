@extends('admin.layouts.master')
@section('title')Edit Homepage | Homepage @endsection
@section('content')
<?php $data = json_decode($gs->homepage); ?>
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void();">Edit Homepage</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div id="messages"></div>
                <div class="card">
                    <div class="card-header"><i class="zmdi zmdi-view-dashboard"></i> Update Homepage</div>
                    <div class="card-body">
                        <form method="post" action="{{url('admin/homepage/banner/update')}}"  enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                              <div class="form-group col-md-6">
                                <img src="{{asset('public/assets/front/img/banner/'.$data->banner_img)}}" width="400">
                              </div>  
                              
                              <div class="form-group col-md-4">
                                <label>Add Banner Timer</label>
                                <input type="text" class="form-control input-check" name="banner_timer" value="{{isset($data->banner_timer)?$data->banner_timer:""}}">
                              </div>
                              
                                
                              <div class="form-group col-md-4">
                                <label>Text On Banner*</label>
                                <input type="text" class="form-control input-check" name="text_on_banner" value="{{$data->text_on_banner}}" required="">
                              </div>
                              
                              <div class="form-group col-md-4">
                                <label>Banner Footer Text*</label>
                                <input type="text" class="form-control input-check" name="banner_footer_text" value="{{$data->banner_footer_text}}" required="">
                              </div>
                              
                              <div class="form-group col-md-4">
                                <div class="">
                                  <label for="exampleInputFile">Banner Image*</label>
                                    <div class="input-group">
                                      <div class="custom-file">
                                        <input type="file" name="banner_img" class="custom-file-input form-control" id="file">
                                        <label class="custom-file-label" for="file">Choose Image</label>
                                      </div>
                                    </div>
                                </div>
                                <div style="margin-top: 10px;" id="image_file">
                                  <img src="" style="width: 100px; width: 100px;" id="img">
                                </div>
                              </div>
                              
                              
                              <div class="form-group col-md-4">
                                <label>HomePage Middle Image Title*</label>
                                <input type="text" class="form-control input-check" name="minddle_img_title" value="{{$data->minddle_img_title}}" required="">
                              </div>
                              
                              <div class="form-group col-md-4">
                                <label>HomePage Middle Image SubTitle*</label>
                                <input type="text" class="form-control input-check" name="minddle_img_subtitle" value="{{$data->minddle_img_subtitle}}" required="">
                              </div>
                              
                              <div class="form-group col-md-4">
                                <label>HomePage Middle Image*</label>
                                <div class="input-group">
                                  <div class="custom-file">
                                    <input type="file" name="homepage_middle_img" class="custom-file-input form-control" id="file">
                                    <label class="custom-file-label" for="file">Choose Image</label>
                                  </div>
                                </div>
                              </div>
                              
                              <div class="form-group col-md-12">
                                <img src="{{asset('public/assets/front/img/banner/'.$data->homepage_middle_img)}}" width="400">
                              </div> 
                             </div>
                             
                             <hr>
                             <h5 class="text-center">Reviews Section</h5>
                             <div class="row">
                                 <div class="form-group col-md-12">
                                    <label>Reviews Section Heading*</label>
                                    <input type="text" class="form-control input-check" name="review_section_heading" value="{{$data->review_section_heading}}" required="">
                                 </div>
                             </div>
                             
                             <div class="row">
                                 <div class="form-group col-md-6">
                                    <label>Reviews Title 1*</label>
                                    <input type="text" class="form-control input-check" name="review_title1" value="{{$data->review_title1}}" required="">
                                 </div>
                                 <div class="form-group col-md-6">
                                    <label>Reviews Rating 1*</label>
                                    <input type="text" class="form-control input-check" name="review_rating1" value="{{$data->review_rating1}}" required="">
                                 </div>
                             </div>
                             
                             <div class="row">
                                 <div class="form-group col-md-12">
                                    <label>Reviews Comment 1*</label>
                                    <textarea class="form-control input-check" name="review_comment1" required="">{{$data->review_comment1}}</textarea>
                                 </div>
                             </div>
                             
                             <br><br>
                    
                             <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Reviews Title 2*</label>
                                    <input type="text" class="form-control input-check" name="review_title2" value="{{$data->review_title2}}" required="">
                                 </div>
                                 <div class="form-group col-md-6">
                                    <label>Reviews Rating 2*</label>
                                    <input type="text" class="form-control input-check" name="review_rating2" value="{{$data->review_rating2}}" required="">
                                 </div>
                             </div>
                             
                             <div class="row">
                                 <div class="form-group col-md-12">
                                    <label>Reviews Comment 2*</label>
                                    <textarea class="form-control input-check" name="review_comment2" required="">{{$data->review_comment2}}</textarea>
                                 </div>
                             </div>
                             
                             <br><br>
                             
                             <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Reviews Title 3*</label>
                                    <input type="text" class="form-control input-check" name="review_title3" value="{{$data->review_title3}}" required="">
                                 </div>
                                 <div class="form-group col-md-6">
                                    <label>Reviews Rating 3*</label>
                                    <input type="text" class="form-control input-check" name="review_rating3" value="{{$data->review_rating3}}" required="">
                                 </div>
                             </div>
                             
                             <div class="row">
                                 <div class="form-group col-md-12">
                                    <label>Reviews Comment 3*</label>
                                    <textarea class="form-control input-check" name="review_comment3" required="">{{$data->review_comment3}}</textarea>
                                 </div>
                             </div>
                             
                             <br><br>
                             
                             <div class="row">
                                 <div class="form-group col-md-6">
                                    <label>Reviews Title 4*</label>
                                    <input type="text" class="form-control input-check" name="review_title4" value="{{$data->review_title4}}" required="">
                                 </div>
                                 <div class="form-group col-md-6">
                                    <label>Reviews Rating 4*</label>
                                    <input type="text" class="form-control input-check" name="review_rating4" value="{{$data->review_rating4}}" required="">
                                 </div>
                             </div>
                             
                             <div class="row">
                                 <div class="form-group col-md-12">
                                    <label>Reviews Comment 4*</label>
                                    <textarea class="form-control input-check" name="review_comment4" required="">{{$data->review_comment4}}</textarea>
                                 </div>
                             </div>
                             <hr>
                             
                             <div class="row">
                                 <div class="form-group col-md-4">
                                    <label>Review Images*</label><br>
                                    <label>Review Image 1</label>
                                    <div class="input-group">
                                      <div class="custom-file">
                                        <input type="file" name="review_image_1" class="custom-file-input form-control" id="file">
                                        <label class="custom-file-label" for="file">Choose Reviews Image 1</label>
                                      </div>
                                    </div>
                                  </div>
                              </div>
                              
                              <div class="row">
                                 <div class="form-group col-md-4">
                                    <label>Review Image 2</label>
                                    <div class="input-group">
                                      <div class="custom-file">
                                        <input type="file" name="review_image_2" class="custom-file-input form-control" id="file">
                                        <label class="custom-file-label" for="file">Choose Reviews Image 2</label>
                                      </div>
                                    </div>
                                  </div>
                              </div>
                              
                              <div class="row">
                                 <div class="form-group col-md-4">
                                    <label>Review Image 3</label>
                                    <div class="input-group">
                                      <div class="custom-file">
                                        <input type="file" name="review_image_3" class="custom-file-input form-control" id="file">
                                        <label class="custom-file-label" for="file">Choose Reviews Image 3</label>
                                      </div>
                                    </div>
                                  </div>
                              </div>
                              
                              <div class="row">
                                 <div class="form-group col-md-4">
                                    <label>Review Image 4</label>
                                    <div class="input-group">
                                      <div class="custom-file">
                                        <input type="file" name="review_image_4" class="custom-file-input form-control" id="file">
                                        <label class="custom-file-label" for="file">Choose Reviews Image 4</label>
                                      </div>
                                    </div>
                                  </div>
                              </div>
                              
                              <div class="row">
                                  <div class="form-group col-md-3">
                                    <img src="{{asset('public/assets/front/img/publicReviews/'.$data->review_images[0])}}" width="80">
                                  </div> 
                                  
                                  <div class="form-group col-md-3">
                                    <img src="{{asset('public/assets/front/img/publicReviews/'.$data->review_images[1])}}" width="80">
                                  </div> 
                                  
                                  <div class="form-group col-md-3">
                                    <img src="{{asset('public/assets/front/img/publicReviews/'.$data->review_images[2])}}" width="80">
                                  </div> 
                                  
                                  <div class="form-group col-md-3">
                                    <img src="{{asset('public/assets/front/img/publicReviews/'.$data->review_images[3])}}" width="80">
                                  </div> 
                              </div>
                             
                              <div class="form-group col-md-12">
                                <button type="submit" id="submit_btn" class="btn btn-sm btn-success px-3"><i class="fa fa-arrow-circle-right"></i> Update</button>
                              </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- End Row-->
    </div>
    <!-- End container-fluid-->
</div><!--End content-wrapper-->
@endsection
@section('script')
    <script type="text/javascript">
    $(document).ready(function(){
      $("#homepage").addClass("active");
    });
  </script>
@endsection