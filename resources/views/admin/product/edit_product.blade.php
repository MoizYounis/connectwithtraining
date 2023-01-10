@extends('admin.layouts.master')
@section('title')Update Product | Products @endsection
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void();">Update Product</a></li>
                </ol>
            </div>
         
            <div class="col-sm-3">
                <div class="btn-group float-sm-right">
                    <a type="button" href="{{route('product.index')}}" class="btn btn-behance text-white btn-sm waves-effect waves-light add_data"><i class="fa fa-plus mr-1"></i>Product List </a>
                </div>
            </div>
        </div>        

        <div class="row">
            <div class="col-lg-12">
                <div id="messages"></div>
                <div class="card">
                    <div class="card-header"><i class="zmdi zmdi-view-dashboard"></i> Products</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3 col-md-4">
                                <div id="accordion1">
                                    <div class="card mb-2">
                                        <div class="card-header" style="padding: 1px; text-align: center;">
                                            <button class="btn btn-link shadow-none" data-toggle="collapse" data-target="#collapse-1" aria-expanded="true" aria-controls="collapse-1">
                                              Basic Info
                                            </button>
                                        </div>

                                        <div id="collapse-1" class="collapse show" data-parent="#accordion1">
                                            <div class="card-body">
                                                <div class="tabs-vertical tabs-vertical-warning">
                                                    <ul class="nav nav-tabs flex-column">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" data-toggle="tab" href="#General">General</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-toggle="tab" href="#Price">Price</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-toggle="tab" href="#Inventory">Inventory</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-toggle="tab" href="#Images">Images</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-toggle="tab" href="#Seo"> Seo</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-9 col-md-8">
                                <form method="post" action="{{route('product.update', [$product_edit->id])}}">
                                    @csrf
                                    {{ method_field('PATCH') }}
                                    <div class="tab-content">
                                        <div id="General" class="container tab-pane active">
                                            <h4>General</h4><hr>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label>Name*</label>
                                                    <input type="text" class="form-control input-check" name="product_name" id="product_name" placeholder="Enter Product Name" value="{{$product_edit->product_name}}" required="">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Description*</label>
                                                    <textarea id="summernoteEditor" name="product_desc" required="">{{$product_edit->product_desc}}</textarea>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Brand*</label>
                                                    <select name="brand_id" class="form-control input-check" required="">
                                                        <option value="">Select Brand</option>
                                                        @foreach($brand_list as $brand)
                                                            @if($product_edit->brand_id == $brand->id)
                                                                <option selected="" value="{{$brand->id}}">{{ucwords($brand->brand_name)}}</option>
                                                            @else
                                                                <option value="{{$brand->id}}">{{ucwords($brand->brand_name)}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>

                                                
                                                <div class="form-group col-md-4">
                                                    <label>Category*</label>
                                                    <select name="category_id" class="form-control input-check select2" id="category_id" required="">
                                                        <option value="">--Select Category--</option>
                                                        @foreach($cat_list as $cat)
                                                            @if($product_edit->category_id == $cat->id)
                                                                <option selected="" value="{{$cat->id}}">{{ucwords($cat->category_name)}}</option>
                                                            @else
                                                                <option value="{{$cat->id}}">{{ucwords($cat->category_name)}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label>Sub Category*</label>
                                                    <select name="sub_id" class="form-control input-check select2" id="sub_id" required="">
                                                        <option value="">--Select Sub Category--</option>
                                                        @foreach($sub_cat_list as $subcat)
                                                            @if($product_edit->sub_id == $subcat->id)
                                                                <option selected="" value="{{$subcat->id}}">{{ucwords($subcat->sub_name)}}</option>
                                                            @else
                                                                <option value="{{$subcat->id}}">{{ucwords($subcat->sub_name)}}</option>
                                                            @endif
                                                        @endforeach                                                        
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label>Child Category</label>
                                                    <select name="child_id" class="form-control input-check select2" id="child_id">
                                                        <option value="">--Select Child Category--</option>
                                                        @foreach($child_list as $childcat)
                                                            @if($product_edit->child_id == $childcat->id)
                                                                <option selected="" value="{{$childcat->id}}">{{ucwords($childcat->child_name)}}</option>
                                                            @else
                                                                <option value="{{$childcat->id}}">{{ucwords($childcat->child_name)}}</option>                                                                
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label>Tags</label>
                                                    <select name="tag_id[]" class="form-control input-check select2" multiple="">
                                                        @php 
                                                            $i=0;
                                                            $old_tag_list = explode(',', $product_edit->tag_id);
                                                        @endphp

                                                        @foreach($tag_list as $tag)
                                                            @if(isset($old_tag_list[$i]) && $old_tag_list[$i] == $tag->id)
                                                                <option selected="" value="{{$tag->id}}">{{ucwords($tag->tag_name)}}</option>
                                                            @else
                                                                <option value="{{$tag->id}}">{{ucwords($tag->tag_name)}}</option>
                                                            @endif
                                                            @php $i++ @endphp
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label>Status</label>
                                                    <div class="icheck-material-primary">
                                                        <input type="checkbox" name="product_enable" id="user-checkbox5" 
                                                        @if($product_edit->product_enable == "Active") checked="" @else @endif
                                                        />
                                                        <label for="user-checkbox5">Eneble The Product</label>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <input type="submit" value="Save" class="btn btn-primary">
                                                </div>
                                            </div>
                                        </div>
                                        <div id="Price" class="container tab-pane">
                                            <h4>Price</h4><hr>                                        
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label>Price*</label>
                                                    <input type="number" class="form-control input-check" name="product_price" id="product_price" placeholder="Enter Price" value="{{$product_edit->product_price}}" required="">
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label>Special Price</label>
                                                    <input type="number" class="form-control" name="special_price" id="special_price" placeholder="Enter Special Price" value="{{$product_edit->special_price}}">
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <input type="submit" value="Save" class="btn btn-primary">
                                                </div>
                                            </div>
                                        </div>
                                        <div id="Inventory" class="container tab-pane">
                                            <h4>Inventory</h4><hr>                                        
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label>SKU</label>
                                                    <input type="text" class="form-control input-check" name="sku" id="sku" value="{{$product_edit->sku}}">
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label>Inventory Management</label>
                                                    <select class="form-control" name="inventory_management" id="inventory_management">
                                                        @if($product_edit->inventory_management == '0')
                                                            <option value="0">Don't Track Inventory</option>
                                                            <option value="1">Track Inventory</option>
                                                        @else
                                                            <option value="1">Track Inventory</option>
                                                            <option value="0">Don't Track Inventory</option>           
                                                        @endif
                                                        
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-12" id="qty_div">
                                                    <label>Qty</label>
                                                    <input type="number" class="form-control input-check" name="qty" id="qty" value="{{$product_edit->qty}}" id="qty">
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label>Stock Availability</label>
                                                    <select class="form-control" name="product_status">
                                                        @if($product_edit->product_status == "InStock")
                                                            <option value="InStock">In Stock</option>
                                                            <option value="OutofStock">Out Of Stock</option>
                                                        @else
                                                            <option value="OutofStock">Out Of Stock</option>
                                                            <option value="InStock">In Stock</option>
                                                        @endif
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <input type="submit" value="Save" class="btn btn-primary">
                                                </div>
                                            </div>
                                        </div>
                                        <div id="Images" class="container tab-pane">
                                            <h4>Images</h4><hr>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label for="file">Base Image*</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input form-control" id="file">
                                                            <label class="custom-file-label" for="file">Base Image</label>
                                                        </div>
                                                    </div>
                                                    <div style="margin-top: 10px;" id="image_file">
                                                        @if($product_edit->product_base_img)
                                                        <img src="{{asset('public/assets/front/img/product')}}/{{$product_edit->product_base_img}}" style="width: 100px; width: 100px;" id="img">
                                                        @endif
                                                    </div>                                                
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label for="file2">Additional Images</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input form-control" id="file2"  multiple="">
                                                            <label class="custom-file-label" for="file">Additional Images</label>
                                                        </div>
                                                    </div>

                                                    @php
                                                        $images = explode(',', $product_edit->additional_images);
                                                        $i = 0;
                                                    @endphp
                                                    <select multiple="" name="additional_images[]" id="additional_images" style="display: none;">
                                                        <?php
                                                            while($i < count($images)){
                                                                echo '<option selected="" value="'.$images[$i].'">'.$images[$i].'</option>';
                                                                $i++;
                                                            }
                                                        ?>
                                                    </select>
                                                    <div style="margin-top: 10px;" id="image_file2">
                                                        @php
                                                            $i = 0;
                                                            while($i < count($images)){
                                                                echo '<img src="'.asset('public/assets/front/img/product').'/'.$images[$i].'" style="width:100px; height:100px; object-fit:contain; display: inline-block; "/>';
                                                                $i++;
                                                            }
                                                        @endphp
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <input type="submit" value="Save" class="btn btn-primary">
                                                </div>
                                            </div>
                                        </div>
                                        <div id="Seo" class="container tab-pane">
                                            <h4>Seo</h4><hr>                                        
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label>Meta Title</label>
                                                    <input type="text" class="form-control input-check" name="meta_title" id="meta_title" value="{{$product_edit->meta_title}}">
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label>Meta Description</label>
                                                    <input type="text" class="form-control input-check" name="meta_desc" id="meta_desc" value="{{$product_edit->meta_desc}}">
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <input type="submit" value="Save" class="btn btn-primary">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
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
        $("#product").addClass("active");
        $("#qty_div").hide();
        
        $(document).ready(function () {
            $('.select2').select2();
            $('#summernoteEditor').summernote({
                height: 300,
                tabsize: 2
            });
            $("#inventory_management").change(function(){
                if($(this).val() == 1){
                    $("#qty_div").show();
                }
                else{
                    $("#qty_div").hide();
                }
            });

            if($("#inventory_management").val() == "1"){
                $("#qty_div").show();
            }
        });
    </script>
    <script type="text/javascript">
        $(document).on('change', '#file', function(){
            var name = document.getElementById("file").files[0].name;
            var form_data = new FormData();
            var ext = name.split('.').pop().toLowerCase();
            if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
            {
                alert("Invalid Image File");
            }
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("file").files[0]);
            var f = document.getElementById("file").files[0];
            var fsize = f.size||f.fileSize;
            if(fsize > 2000000)
            {
                alert("Image File Size is very big");
            }
            else
            {
                var _token = '<?= csrf_token(); ?>';
                form_data.append("file", document.getElementById('file').files[0]);
                form_data.append("_token", _token);
                $.ajax({
                    url:"{{ url('admin/product/upload/image') }}",
                    method:"POST",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend:function(){
                        $('#image_file').html("<label class='text-success'>Image Uploading...</label>");
                    },   
                    success:function(data)
                    {
                        $('#image_file').html(data);
                    }
                });
            }
        });

        //multiple images upload
        $(document).on('change', '#file2', function(){
            $("#additional_images").empty();
            $("#image_file2").empty();
            var count = document.getElementById("file2").files.length;
            var i = 0;
            while(i < count){
                var name = document.getElementById("file2").files[i].name;
                var form_data = new FormData();
                var ext = name.split('.').pop().toLowerCase();
                if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
                {
                    alert("Invalid Image File");
                }
                var oFReader = new FileReader();
                oFReader.readAsDataURL(document.getElementById("file2").files[i]);
                var f = document.getElementById("file2").files[i];
                var fsize = f.size||f.fileSize;
                if(fsize > 2000000)
                {
                    alert("Image File Size is very big");
                }
                else
                {
                    var _token = '<?= csrf_token(); ?>';
                    form_data.append("file2", document.getElementById('file2').files[i]);
                    form_data.append("_token", _token);
                    $.ajax({
                        url:"{{ url('admin/product/upload/image') }}",
                        method:"POST",
                        data: form_data,
                        contentType: false,
                        cache: false,
                        processData: false,
                        beforeSend:function(){
                            //$('#image_file2').html("<label class='text-success'>Image Uploading...</label>");
                        },   
                        success:function(data)
                        {
                            $("#additional_images").append(data.image_name);
                            $('#image_file2').append(data.img);
                        }
                    });
                }
                i++;
            }
        });        

    </script>
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

            $('#sub_id').on('change', function(){
                var sub_id = $(this).val();
                if(sub_id){
                    $.ajax({
                        type : "GET",
                        url : "{{url('/get_child')}}/"+sub_id,
                            dataType : "json",
                        success : function(data){
                            if(data){
                                $("#child_id").empty();
                                $("#child_id").append('<option>--Select Child Category--</option>');
                                $.each(data, function(key, value){
                                    $("#child_id").append('<option value="'+key+'">'+value+'</option>');
                                });                            
                            }
                        }
                    }); 
                }else{
                    $('#child_id').html('<option value="">Select Sub Category first</option>');
                }
            });
        });
    </script>
    <script>
        // $(document).ready(function () {
        //     Dropzone.options.dropzoneform = {
        //         autoProcessQueue: false,
        //         parallelUploads: 10,
        //         //uploadMultiple: true,
        //         acceptedFiles: '.png,.jpg,.jpeg',


        //         init:function(){
        //             var submitButton = document.querySelector("#submit-all");
        //             myDropzone = this;

        //             submitButton.addEventListener('click', function(){
        //                 myDropzone.processQueue();
        //             });

        //             this.on("complete", function(){
        //                 if(this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0){
        //                     var _this = this;
        //                     _this.removeAllFiles();
        //                 }
        //             });
        //         }
        //     }
        // });
    </script>
@endsection