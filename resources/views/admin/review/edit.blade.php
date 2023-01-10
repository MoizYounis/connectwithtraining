@extends('admin.layouts.master')
@section('title')Update Review | Review @endsection
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void();"></a>Update Review</li>
                </ol>
            </div>
         
            <div class="col-sm-3">
                <div class="btn-group float-sm-right">
                    <a href="{{route('review.index')}}" class="btn btn-behance text-white btn-sm waves-effect waves-light add_data"><i class="fa fa-plus mr-1"></i> Review List</a>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <div id="messages"></div>
                <div class="card">
                    <div class="card-header"><i class="zmdi zmdi-comment"></i> Update Review</div>
                    <div class="card-body">
                        <form method="post" action="{{route('review.update', $edit_review->id)}}">
                            @csrf {{method_field('PATCH')}}
                            <div class="row">

                              <div class="form-group col-md-6">
                                <label>Select Course*</label>
                                <select style="width: 100%;" name="course_id" class="form-control input-check select2" id="course_id" required="">
                                    <option value="">--Select Course--</option>                                    
                                    @foreach($course_list as $course)
                                        @if($edit_review->course_id == $course->id)
                                            <option selected="" value="{{$course->id}}">{{ucwords($course->course_name)}}</option>
                                        @else
                                            <option value="{{$course->id}}">{{ucwords($course->course_name)}}</option>
                                        @endif
                                    @endforeach
                                </select>
                              </div>

                                @if(Auth::user()->userType == "superadmin")
                                <div class="form-group col-md-6">
                                    <label>Select User*</label>
                                    <select name="user_id" class="form-control input-check select2" id="user_id" required="">
                                        <option value="">--Select User--</option>
                                        @foreach($user_list as $users)
                                            @if($edit_review->user_id == $users->id)
                                                <option selected="" value="{{$users->id}}">{{ucwords($users->first_name.' '.$users->last_name)}}</option>
                                            @else
                                                <option value="{{$users->id}}">{{ucwords($users->first_name.' '.$users->last_name)}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                @endif

                              <div class="form-group col-md-12">
                                <label>Select Rating*</label>
                                <select class="form-control input-check" name="rating" id="rating" required="">
                                    <option>Select Rating</option>
                                    <option value="1" {{($edit_review->rating == 1) ? 'selected': ''}}>1 Rating</option>
                                    <option value="2" {{($edit_review->rating == 2) ? 'selected': ''}}>2 Rating</option>
                                    <option value="3" {{($edit_review->rating == 3) ? 'selected': ''}}>3 Rating</option>
                                    <option value="4" {{($edit_review->rating == 4) ? 'selected': ''}}>4 Rating</option>
                                    <option value="5" {{($edit_review->rating == 5) ? 'selected': ''}}>5 Rating</option>
                                </select>
                              </div>

                              <div class="form-group col-md-12">
                                <label>Comment*</label>
                                <textarea class="form-control input-check" name="comment" id="comment" placeholder="Enter Comment" required="" rows="5">{{$edit_review->comment}}</textarea>
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
        $("#course").addClass("active");
        $(document).ready(function () {
            $('.select2').select2();
            $('.delete_form').on('submit', function(){
                if(confirm("Are you sure you want to delete it..?")){
                    return true;
                }
                else{
                  return false;
                }
            });
        });
    </script>

    <script type="text/javascript">
    $(document).ready(function(){      
      
    });
  </script>
@endsection