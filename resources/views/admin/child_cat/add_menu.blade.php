@extends('admin.layouts.master')
@section('content')
<div class="content p-4">
    <h2 class="mb-4" style="text-transform: uppercase;">Create New Sub Category
        <a href="{{ url('admin/submenu/list') }}" class="btn btn-primary btn-md float-right">
            <i class="fa fa-list"></i>   View Categories
        </a>
    </h2><br>
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{url('/admin/submenu/create')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="col-md-12 container-fluid">
                    <div class="form-group">
                        <label for="category_id" style="text-transform: uppercase;"><strong>Select Category Name&nbsp;<span class="mark">*</span></strong></label>
                        <select class="form-control form-control-lg mb-3" name="category_id" id="category_id">
                            <option value="">--Select Category--</option>
                            @foreach($category_list as $row)
                                <option value="{{$row->category_id}}">{{ucwords($row->category_name)}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-12 container-fluid">
                    <div class="form-group">
                        <label for="sub_id" style="text-transform: uppercase;"><strong>Select Sub Category Name&nbsp;<span class="mark">*</span></strong></label>
                        <select class="form-control form-control-lg mb-3" name="sub_id" id="sub_id">
                            <option value="">--Select Sub Category--</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-12  container-fluid">
                    <div class="form-group">
                        <label for="menu_name" style="text-transform: uppercase;"><strong>Sub Menu Name&nbsp;<span class="mark">*</span></strong></label>
                        <input class="form-control form-control-lg mb-3" type="text" name="menu_name"  value="{{old('menu_name')}}" placeholder="Enter Sub Menu Name" id="menu_name">
                        <p style="color: red;"><strong>Notice: </strong>Special characters not allowed</p>
                    </div>
                </div>

                <div class="col-md-12 container-fluid">
                    <div class="form-group">
                        <label for="icon" style="text-transform: uppercase;"><strong>Icon</strong></label>
                        <input class="form-control form-control-lg mb-3" type="file" name="menu_icon">
                        <p style="color: red;"><strong>Notice: </strong>image format must be JPG,JPEG,PNG</p>
                    </div>
                </div>

                <div class="col-md-12  container-fluid">
                    <div class="form-group">
                        <label for="menu_desc" style="text-transform: uppercase;"><strong>category Description&nbsp;</strong></label>
                        <textarea rows="5" class="form-control form-control-lg mb-3" name="menu_desc" placeholder="Enter Sub Menu Description" id="menu_desc">{{old('menu_desc')}}</textarea>
                    </div>
                </div>                

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="menu_status" style="text-transform: uppercase;"><strong>Status</strong></label>
                        <input type="checkbox" data-onstyle="success" data-offstyle="danger" data-width="100%" data-on="Active" data-off="Inactive" data-toggle="toggle" name="menu_status" checked="">
                    </div>
                </div>

                <br>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-block btn-lg">Create New Sub Menu</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#category_id').on('change', function(){
            var category_id = $(this).val();
            if(category_id){
                $.ajax({
                    type : "GET",
                    url : "{{url('/get_sub_cat')}}/"+category_id,
                        dataType : "json",
                    success : function(data){
                        if(data){
                            $("#sub_id").empty();
                            $("#sub_id").append('<option>--Select Sub Category--</option>');
                            $.each(data, function(key, value){
                                $("#sub_id").append('<option value="'+key+'">'+value+'</option>');    
                            });                            
                        }
                    }
                }); 
            }else{
                $('#sub_id').html('<option value="">Select Category first</option>');
            }
        });

        $("#sub-menu").addClass("show");
        $("#sub-menu").addClass("active");
    });
</script>
@endsection
