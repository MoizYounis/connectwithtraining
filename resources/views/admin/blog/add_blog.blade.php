@extends('admin.layouts.master')
@section('title')Create Blog | Blogs @endsection
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void();">Create Blog</a></li>
                </ol>
            </div>
         
            <div class="col-sm-3">
                <div class="btn-group float-sm-right">
                    <a href="{{route('blog.index')}}" class="btn btn-behance text-white btn-sm"> <i class="waves-effect waves-light add_data"></i> Blogs </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div id="messages"></div>
                <div class="card">
                    <div class="card-header"><i class="zmdi zmdi-reader"></i> Create Blog</div>
                    <div class="card-body">
                        <form method="post" action="{{route('blog.store')}}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Main Category*</label>
                                    <select name="blog_cat_id" class="form-control input-check select2" id="blog_cat_id" required="">
                                        @if(!old('blog_cat_id'))
                                            <option value="">--Select Blog Category--</option>
                                        @endif
                                        @foreach($blog_cat_list as $cat)
                                            @if(old('blog_cat_id') == $cat->id)
                                                <option selected="" value="{{$cat->id}}">{{ucwords($cat->blog_cat_name)}}</option>
                                            @else
                                                <option value="{{$cat->id}}">{{ucwords($cat->blog_cat_name)}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                @if(Auth::user()->userType == "superadmin")
                                <div class="form-group col-md-6">
                                    <label>Select User*</label>
                                    <select name="user_id" class="form-control input-check select2" id="user_id" required="">
                                        @if(!old('user_id'))
                                            <option value="">--Select User--</option>
                                        @endif
                                        @foreach($user_list as $users)
                                            @if(old('user_id') == $users->id)
                                                <option selected="" value="{{$users->id}}">{{ucwords($users->first_name.' '.$users->last_name)}}</option>
                                            @else
                                                <option value="{{$users->id}}">{{ucwords($users->first_name.' '.$users->last_name)}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                @endif
                            </div>

                            <div class="row">
                              <div class="form-group col-md-12">
                                <label>Blog Title*</label>
                                <input type="text" class="form-control input-check" name="blog_title" id="blog_title" placeholder="Enter Blog Title" value="{{old('blog_title')}}" required="">
                              </div>

                              <div class="form-group col-md-12">
                                <label>Blog Content*</label>
                                <textarea id="summernoteEditor" name="blog_content" required="">{{old('blog_content')}}</textarea>
                              </div>
                            </div>

                            <div class="row">
                              <div class="form-group col-md-12">
                                <!-- <label>Blog Status*</label> -->
                                <div class="icheck-material-primary">
                                    <input type="checkbox" name="blog_status" id="user-checkbox5" 
                                    @if(old('blog_status')) checked="" @else @endif
                                    />
                                    <label for="user-checkbox5">Publish The Blog ?</label>
                                </div>
                              </div>
                            </div>

                            <div class="row" id="inputFormRow">
                              <div class="form-group col-md-6">
                                <label>Blog Meta Key</label>
                                <textarea class="form-control input-check" name="blog_meta_key[]" id="blog_meta_key" placeholder="Enter Blog Meta Key">{{old('blog_meta_key')}}</textarea>
                              </div>

                              <div class="form-group col-md-6">
                                <label>Blog Meta Value</label>
                                <textarea class="form-control input-check" name="blog_meta_value[]" id="blog_meta_value" placeholder="Enter Blog Meta Value">{{old('blog_meta_value')}}</textarea>
                              </div>
                            </div>

                            <div id="newRow" style="flex: 0 0 100%;max-width: 100%;"></div>

                            <div class="row">
                              <div class="form-group col-md-12">
                                <button type="button" id="addRow" class="btn btn-sm btn-primary px-3"><i class="fa fa-plus"></i> Add New Key & Value Field</button>
                              </div>

                              <div class="form-group col-md-12">
                                <button type="submit" id="submit_btn" class="btn btn-sm btn-success px-3"><i class="fa fa-arrow-circle-right"></i> Create</button>
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
        $(".removeRow").hide();
        if($("#newRow").html() == ''){
            $(".removeRow").hide();
        }
        $('.select2').select2();
        $("#blog").addClass("active");
        $('#summernoteEditor').summernote({
            height: 300,
            tabsize: 1
        });

        $("#addRow").on('click', function(){
            let html = '';
            html += '<div class="row" id="inputFormRow">';
            html += '<div class="form-group col-md-6">';
            html += '<label>Blog Meta Key</label>';
            html += '<textarea class="form-control input-check" name="blog_meta_key[]" id="blog_meta_key" placeholder="Enter Blog Meta Key">{{old('blog_meta_key')}}</textarea>';
            html += '</div>';

            html += '<div class="form-group col-md-6">';
            html += '<label>Blog Meta Value</label>';
            html += '<textarea class="form-control input-check" name="blog_meta_value[]" id="blog_meta_value" placeholder="Enter Blog Meta Value">{{old('blog_meta_value')}}</textarea>';
            html += '<br><button type="button" class="btn btn-sm btn-danger px-3 removeRow"><i class="fa fa-minus"></i> Remove Field</button>';
            html += '</div></div>';

            $("#newRow").append(html);
            if($("#newRow").html() != ''){
                $(".removeRow").show();                
            }
        });

        $(document).on('click', '.removeRow', function(){
            $(this).closest("#inputFormRow").remove();
        });
    });
    
  </script>
@endsection