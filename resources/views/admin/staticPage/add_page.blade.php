@extends('admin.layouts.master')
@section('title')Create Static Page | Static Pages @endsection
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void();">Create Static Page</a></li>
                </ol>
            </div>
         
            <div class="col-sm-3">
                <div class="btn-group float-sm-right">
                    <a href="{{route('staticPage.index')}}" class="btn btn-behance text-white btn-sm"> <i class="waves-effect waves-light add_data"></i> Static Pages </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div id="messages"></div>
                <div class="card">
                    <div class="card-header"><i class="zmdi zmdi-receipt"></i> Create Static Page</div>
                    <div class="card-body">
                        <form method="post" action="{{route('staticPage.store')}}">
                            @csrf
                            <div class="row">                            
                                <div class="form-group col-md-4">
                                    <label>Page Title*</label>
                                    <input type="text" class="form-control input-check" name="page_title" id="page_title" placeholder="Enter Page Title" value="{{old('page_title')}}" required="">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Page Name*</label>
                                    <input type="text" class="form-control input-check" name="page_name" id="page_name" placeholder="Ex: about, contact, privacy-policy" value="{{old('page_name')}}" required="">
                                </div>
                                @if(Auth::user()->userType == "superadmin")
                                <div class="form-group col-md-4">
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
                                <label>Page Content*</label>
                                <textarea id="summernoteEditor" name="page_content" required="">{{old('page_content')}}</textarea>
                              </div>
                            </div>

                            <div class="row">
                              <div class="form-group col-md-12">
                                <!-- <label>Page Status*</label> -->
                                <div class="icheck-material-primary">
                                    <input type="checkbox" name="page_status" id="user-checkbox5" 
                                    @if(old('page_status')) checked="" @else @endif
                                    />
                                    <label for="user-checkbox5">Publish The Page ?</label>
                                </div>
                              </div>
                            </div>

                            <div class="row" id="inputFormRow">
                              <div class="form-group col-md-6">
                                <label>Page Meta Key</label>
                                <textarea class="form-control input-check" name="page_meta_key[]" id="page_meta_key" placeholder="Enter Page Meta Key">{{old('page_meta_key')}}</textarea>
                              </div>

                              <div class="form-group col-md-6">
                                <label>Page Meta Value</label>
                                <textarea class="form-control input-check" name="page_meta_value[]" id="page_meta_value" placeholder="Enter Page Meta Value">{{old('page_meta_value')}}</textarea>
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
        $("#staticPage").addClass("active");
        $('.select2').select2();
        $('#summernoteEditor').summernote({
            height: 300,
            tabsize: 1
        });

        $("#addRow").on('click', function(){
            let html = '';
            html += '<div class="row" id="inputFormRow">';
            html += '<div class="form-group col-md-6">';
            html += '<label>Page Meta Key</label>';
            html += '<textarea class="form-control input-check" name="page_meta_key[]" id="page_meta_key" placeholder="Enter Page Meta Key">{{old('page_meta_key')}}</textarea>';
            html += '</div>';

            html += '<div class="form-group col-md-6">';
            html += '<label>Page Meta Value</label>';
            html += '<textarea class="form-control input-check" name="page_meta_value[]" id="page_meta_value" placeholder="Enter Page Meta Value">{{old('page_meta_value')}}</textarea>';
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