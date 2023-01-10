@extends('admin.layouts.master')
@section('title')Update Author | Authors @endsection
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void();"></a>Create Authors</li>
                </ol>
            </div>
         
            <div class="col-sm-3">
                <div class="btn-group float-sm-right">
                    <a href="{{route('author.index')}}" class="btn btn-behance text-white btn-sm waves-effect waves-light add_data"><i class="fa fa-list mr-1"></i> Author List</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div id="messages"></div>
                <div class="card">
                    <div class="card-header"><i class="zmdi zmdi-account"></i> Authors</div>
                    <div class="card-body">
                        <form method="post" action="{{route('author.update',[$author_edit->id])}}" enctype="multipart/form-data">
                          @csrf
                          {{ method_field('PATCH') }}
                          <div class="row">

                            <div class="form-group col-md-12">
                              <label>Author Name*</label>
                              <input type="text" class="form-control input-check" name="author_name" id="author_name" placeholder="Enter Author Name" value="{{$author_edit->author_name}}" required="">
                            </div>

                            <div class="form-group col-md-12">
                              <label>Bio*</label>
                              <textarea class="form-control input-check" name="bio" id="bio" placeholder="Enter Author Bio" required="">{{$author_edit->bio}}</textarea>
                            </div>

                            <div class="form-group col-md-12">
                              <label>Award</label>
                              <input type="text" class="form-control input-check" name="award" id="award" placeholder="Enter Award" value="{{$author_edit->award}}">
                            </div>

                            <div class="form-group col-md-12">
                              <label>Hobbies</label>
                              <textarea class="form-control input-check" name="hobbies" id="hobbies" placeholder="Enter Hobbies">{{$author_edit->hobbies}}</textarea>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label>Image*</label>
                                <input type="file" class="form-control input-check" name="author_image">
                            </div>
                            <div class="form-group col-md-6">
                                <img src="{{asset('public/assets/front/img/author/'. $author_edit->author_image)}}" width="100">
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
        $("#author").addClass("active");
    </script>

    <script type="text/javascript">
    $(document).ready(function(){      
      
    });
  </script>
@endsection