@extends('admin.layouts.master')
@section('title')Create Email Templates | Email Templates @endsection
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void();"></a> Email Template</li>
                </ol>
            </div>
         
            <div class="col-sm-3">
                <div class="btn-group float-sm-right">
                    <a href="{{route('emailTemplate.index')}}" class="btn btn-behance text-white btn-sm waves-effect waves-light add_data"><i class="fa fa-plus mr-1"></i> Template List</a>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <div id="messages"></div>
                <div class="card">
                    <div class="card-header"><i class="zmdi zmdi-email"></i> Create Email Template</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th>Sr.No.</th>
                                        <th>Code</th>
                                        <th>Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1.</td>
                                        <td>&#123;&#123;message&#125;&#125;</td>
                                        <td>Details Text From Script.</td>
                                    </tr>
                                    <tr>
                                        <td>2.</td>
                                        <td>&#123;&#123;name&#125;&#125;</td>
                                        <td>Users Name. Will Pull From Database and Use in EMAIL text.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        

                        <form class="my-5" method="post" action="{{route('emailTemplate.store')}}">
                            @csrf
                            <div class="row">
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
                            
                                <div class="form-group col-md-6">
                                    <label>Email Template Title*</label>
                                    <input type="text" class="form-control input-check" name="title" id="title" placeholder="Enter Email Template Title" value="{{old('title')}}" required="">
                                </div>
                            </div>

                            <div class="row">
                              <div class="form-group col-md-12">
                                <label>Email Template*</label>
                                <textarea id="summernoteEditor" name="details" required="">{{old('details')}}</textarea>
                              </div>
                            </div>                            

                            <div class="row">
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
        $("#setting").addClass("active");
        $('#summernoteEditor').summernote({
            height: 300,
            tabsize: 1
        });
    </script>
@endsection