@extends('admin.layouts.master')
@section('title')User Permissions | Roles And Permissions @endsection
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void();"></a>Permissions</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div id="messages"></div>
                <div class="card">
                    <div class="card-header"><i class="zmdi zmdi-key"></i> 
                        User Permissions
                    </div>
                    <div class="card-body"> 
                        <p><strong>User Type : {{ ucwords($result['type_name'])}}</strong></p>
                        <form action="{{url('admin/updatePermission')}}" method="post">
                            @csrf
                            <input type="hidden" name="user_type_id" value="{{$result['type_id']}}">
                            <div class="row">
                                @foreach($result['data'] as $datas)
                                    <div class="col-md-6">
                                        <hr><h5>{{$datas['link_name']}}</h5><hr>
                                        @foreach($datas['permissions'] as $data)
                                            <div class="row">
                                                <div class="col-sm-6" style="padding-top: 5px;">
                                                    <strong>{{ucwords(str_replace("_", " ", $data['name']))}}</strong>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="icheck-material-primary icheck-inline">
                                                        <input type="radio" name="{{$data['name']}}" value="1" id="{{$data['name']}}1" checked="" @if($data['value']==1) checked @endif >
                                                        <label for="{{$data['name']}}1">YES</label>                                   
                                                    </div>
                                                    <div class="icheck-material-primary icheck-inline">
                                                        <input type="radio" name="{{$data['name']}}" value="0" id="{{$data['name']}}0" @if($data['value']==0) checked @endif >
                                                        <label for="{{$data['name']}}0">No</label>                                    
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach        
                                    </div>
                                @endforeach
                            </div>
                            <br>
                            <input type="submit" value="Update" class="btn btn-primary btn-sm">
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
        $("#role").addClass("active");
        $(document).ready(function () {
            $('#datatable').DataTable();

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