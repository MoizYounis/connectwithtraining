@extends('admin.layouts.master')
@section('title')Create Product | Products @endsection
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void();">Create Products</a></li>
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
                                    <!-- <div class="card mb-2">
                                        <div class="card-header">
                                            <button class="btn btn-link shadow-none collapsed" data-toggle="collapse" data-target="#collapse-2" aria-expanded="false" aria-controls="collapse-2">
                                                ad
                                            </button>
                                        </div>
                                        <div id="collapse-2" class="collapse" data-parent="#accordion1">
                                            <div class="card-body">
                                                <div class="card-title text-uppercase">Some title example here</div>
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>

                            <div class="col-lg-9 col-md-8">
                                <form method="post" action="{{route('product.store')}}">
                                    @csrf
                                    <div class="tab-content">
                                        <div id="General" class="container tab-pane active">
                                            <h4>General</h4><hr>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label>Name*</label>
                                                    <input type="text" class="form-control input-check" name="product_name" id="product_name" placeholder="Enter Product Name" value="{{old('product_name')}}" required="">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Description*</label>
                                                    <textarea id="summernoteEditor" name="product_desc" required="">{{old('product_desc')}}</textarea>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Brand*</label>
                                                    <select name="brand_id" class="form-control input-check" required="">
                                                        <option value="">Select Brand</option>
                                                        @foreach($brand_list as $brand)
                                                            @if(old('brand_id') == $brand->id)
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
                                                        @if(!old('category_id'))
                                                            <option value="">--Select Category--</option>
                                                        @endif
                                                        @foreach($cat_list as $cat)
                                                            @if(old('category_id') == $cat->id)
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
                                                        @if(!old('sub_id'))
                                                            <option value="">--Select Sub Category--</option>
                                                        @else
                                                            @foreach($sub_cat_list as $subcat)
                                                                @if(old('sub_id') == $subcat->id)
                                                                    <option selected="" value="{{$subcat->id}}">{{ucwords($subcat->sub_name)}}</option>
                                                                @else
                                                                    @if($subcat->category_id == old('category_id'))
                                                                        <option value="{{$subcat->id}}">{{ucwords($subcat->sub_name)}}</option>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label>Child Category</label>
                                                    <select name="child_id" class="form-control input-check select2" id="child_id">
                                                        @if(!old('child_id'))
                                                            <option value="">--Select Child Category--</option>
                                                        @else
                                                            @foreach($child_list as $childcat)
                                                                @if(old('child_id') == $childcat->id)
                                                                    <option selected="" value="{{$childcat->id}}">{{ucwords($childcat->child_name)}}</option>
                                                                @else
                                                                    @if($childcat->sub_id == old('sub_id'))
                                                                        <option value="{{$childcat->id}}">{{ucwords($childcat->child_name)}}</option>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label>Tags</label>
                                                    <select name="tag_id[]" class="form-control input-check select2" multiple="">
                                                        @php $i=0 @endphp
                                                        @foreach($tag_list as $tag)
                                                            @if(isset(old('tag_id')[$i]) && old('tag_id')[$i] == $tag->id)
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
                                                        @if(old('product_enable')) checked="" @else @endif
                                                        />
                                                        <label for="user-checkbox5">Eneble The Product</label>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <input type="submit" name="submit" value="Save" class="btn btn-primary">
                                                </div>
                                            </div>
                                        </div>
                                        <div id="Price" class="container tab-pane">
                                            <h4>Price</h4><hr>                                        
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label>Price*</label>
                                                    <input type="number" class="form-control input-check" name="product_price" id="product_price" placeholder="Enter Price" value="{{old('product_price')}}" required="">
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label>Special Price</label>
                                                    <input type="number" class="form-control" name="special_price" id="special_price" placeholder="Enter Special Price" value="{{old('special_price')}}">
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
                                                    <input type="text" class="form-control input-check" name="sku" id="sku" value="{{old('sku')}}">
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label>Inventory Management</label>
                                                    <select class="form-control" name="inventory_management" id="inventory_management">
                                                        <option value="0">Don't Track Inventory</option>
                                                        <option value="1">Track Inventory</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-12" id="qty_div">
                                                    <label>Qty</label>
                                                    <input type="number" class="form-control input-check" name="qty" id="qty" value="{{old('qty')}}" id="qty">
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label>Stock Availability</label>
                                                    <select class="form-control" name="product_status">
                                                        <option value="InStock">In Stock</option>
                                                        <option value="OutofStock">Out Of Stock</option>
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
                                                            <input type="file" class="custom-file-input form-control" id="file" required="">
                                                            <label class="custom-file-label" for="file">Base Image</label>
                                                        </div>
                                                    </div>
                                                    <div style="margin-top: 10px;" id="image_file">
                                                        @if(old('product_base_img'))
                                                        <img src="{{asset('public/assets/front/img/product')}}/{{old('product_base_img')}}" id="img" width="100" height="100">
                                                        @endif
                                                        <input type="hidden" name="product_base_img" id="product_base_img" value="
                                                        @if(old('product_base_img')){{old('product_base_img')}} @endif" />
                                                    </div>                                                
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label for="file2">Additional Images</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input form-control" id="file2"  multiple="" required="">
                                                            <label class="custom-file-label" for="file">Additional Images</label>
                                                        </div>
                                                    </div>
                                                    <div style="margin-top: 10px;" id="image_file2">
                                                        <!-- <img src="" id="img2" width="100" height="100"> -->
                                                        <select multiple="" name="additional_images[]" id="additional_images" style="display: none;">
                                                            
                                                        </select>
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
                                                    <input type="text" class="form-control input-check" name="meta_title" id="meta_title" value="{{old('meta_title')}}">
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label>Meta Description</label>
                                                    <input type="text" class="form-control input-check" name="meta_desc" id="meta_desc" value="{{old('meta_desc')}}">
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
                            $('#image_file2').append(data.img);
                            $("#additional_images").append(data.image_name);
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