@extends('admin.layouts.master')
@section('title')Update Business | Business @endsection
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void();">Business</a></li>
                </ol>
            </div>
         
            <div class="col-sm-3">
                <div class="btn-group float-sm-right">
                    <a href="{{route('business.index')}}" class="btn btn-behance text-white btn-sm"> <i class="waves-effect waves-light add_data"></i> Business </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div id="messages"></div>
                <div class="card">
                    <div class="card-header"><i class="zmdi zmdi-money"></i> Update Business</div>
                    <div class="card-body">
                        <form method="post" action="{{route('business.update', [$business_edit->id])}}">
                            @csrf
                            {{ method_field('PATCH') }}

                            <div class="row">
                              <div class="form-group col-md-6">
                                <label>Business Name*</label>
                                <input type="text" class="form-control input-check" name="business_name" id="business_name" placeholder="Enter Business Name" value="{{$business_edit->business_name}}" required="">
                              </div>

                              <div class="form-group col-md-6">
                                <label>Business Category*</label>
                                <input type="text" class="form-control input-check" name="business_category" id="business_category" placeholder="Enter Business Category" value="{{$business_edit->business_category}}" required="">
                              </div>
                            </div>

                            <div class="row">
                              <div class="form-group col-md-6">
                                <label>Business Details*</label>
                                <textarea class="form-control" rows="5"  name="business_details" required="" placeholder="business Details" required="">{{$business_edit->business_details}}</textarea>
                              </div>

                              <div class="form-group col-md-6">
                                <label>Business Address*</label>
                                <textarea class="form-control" rows="5"  name="business_address" required="" placeholder="business Address" required="">{{$business_edit->business_address}}</textarea>
                              </div>
                            </div>

                            <div class="row">
                              <div class="form-group col-md-6">
                                <label>Business Email*</label>
                                <input type="text" class="form-control input-check" name="business_email" id="business_email" placeholder="Enter Business Email" value="{{$business_edit->business_email}}" required="">
                              </div>

                              <div class="form-group col-md-6">
                                <label>Business Phone*</label>
                                <input type="text" class="form-control input-check" name="business_phone" id="business_phone" placeholder="Enter Business Phone" value="{{$business_edit->business_phone}}" required="">
                              </div>
                            </div>

                            <div class="row">
                              <div class="form-group col-md-12">
                                <!-- <label>Page Status*</label> -->
                                <div class="icheck-material-primary">
                                    <input type="checkbox" name="business_status" id="user-checkbox5" 
                                    @if($business_edit->business_status == "Publish") checked="" @else @endif
                                    />
                                    <label for="user-checkbox5">Publish The Business ?</label>
                                </div>
                              </div>
                            </div>

                            <?php
                               $business_meta_key = explode(',', $business_edit->business_meta_key);
                               $business_meta_value = explode(',', $business_edit->business_meta_value);
                               $i=0;
                            ?>

                            @while($i < count($business_meta_key))
                                <div class="row" id="inputFormRow">
                                    <div class="form-group col-md-6">
                                        <label>Business Meta Key</label>
                                        <textarea class="form-control input-check" name="business_meta_key[]" id="business_meta_key" placeholder="Enter Business Meta Key">{{$business_meta_key[$i]}}</textarea>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Business Meta Value</label>
                                        <textarea class="form-control input-check" name="business_meta_value[]" id="business_meta_value" placeholder="Enter Business Meta Value">{{$business_meta_value[$i]}}</textarea>
                                        @if($i > 0)
                                            <br><button type="button" class="btn btn-sm btn-danger px-3 removeRow"><i class="fa fa-minus"></i> Remove Field</button>
                                        @endif
                                    </div>
                                </div>
                                @php $i++; @endphp
                            @endwhile

                            <div id="newRow" style="flex: 0 0 100%;max-width: 100%;"></div>

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <button type="button" id="addRow" class="btn btn-sm btn-primary px-3"><i class="fa fa-plus"></i> Add New Key & Value Field</button>
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
            html += '<label>Business Meta Key</label>';
            html += '<textarea class="form-control input-check" name="business_meta_key[]" id="business_meta_key" placeholder="Enter Business Meta Key"></textarea>';
            html += '</div>';

            html += '<div class="form-group col-md-6">';
            html += '<label>Business Meta Value</label>';
            html += '<textarea class="form-control input-check" name="business_meta_value[]" id="business_meta_value" placeholder="Enter Business Meta Value"></textarea>';
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