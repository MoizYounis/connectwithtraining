@extends('admin.layouts.master')
@section('title')Update Forum | Forums @endsection
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void();"></a>Update Forum</li>
                </ol>
            </div>
         
            <div class="col-sm-3">
                <div class="btn-group float-sm-right">
                    <a href="{{route('forum.index')}}" class="btn btn-behance text-white btn-sm waves-effect waves-light add_data" data-toggle="modal" data-target="#addForum"><i class="fa fa-List mr-1"></i> Forum List</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div id="messages"></div>
                <div class="card">
                    <div class="card-header"><i class="zmdi zmdi-receipt"></i> Update Forum</div>
                    <div class="card-body">
                        <form method="post" action="{{route('forum.update', $forum_edit->id)}}">
                            @csrf {{method_field('PATCH')}}
                            <div class="row">
                              <div class="form-group col-md-6">
                                <label>Forum Title*</label>
                                <input type="text" class="form-control input-check" name="forum_title" id="forum_title" placeholder="Enter Forum Title" value="{{$forum_edit->forum_title}}" required="">
                              </div>

                              <div class="form-group col-md-6">
                                <label>Select User*</label>
                                <select style="width: 100%;" name="user_id" class="form-control input-check select2" id="user_id" required="">
                                    <option value="">--Select User--</option>
                                    @foreach($user_list as $user)
                                        @if($forum_edit->user_id == $user->id)
                                            <option selected="" value="{{$user->id}}">{{ucwords($user->first_name.' '.$user->last_name)}}</option>
                                        @else
                                            <option value="{{$user->id}}">{{ucwords($user->first_name.' '.$user->last_name)}}</option>
                                        @endif
                                    @endforeach
                                </select>
                              </div>

                              <div class="form-group col-md-12">
                                <label>Forum Details*</label>
                                <textarea class="summernoteEditor" name="forum_detail" required="">{{$forum_edit->forum_detail}}</textarea>
                              </div> 

                              <div class="form-group col-md-12">
                                <!-- <label>Blog Status*</label> -->
                                <div class="icheck-material-primary">
                                    <input type="checkbox" name="forum_status" id="user-checkbox5" 
                                    @if($forum_edit->forum_status == 'Publish') checked="" @else @endif
                                    />
                                    <label for="user-checkbox5">Publish The Forum ?</label>
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
        $("#forum").addClass("active");
        $(document).ready(function () {
            $('.summernoteEditor').summernote({
                height: 300,
                tabsize: 1
            });
            $('.select2').select2();
        });        
        
    </script>

    <script type="text/javascript">
    $(document).ready(function(){      
      
    });
  </script>
@endsection