@extends('admin.layouts.master')
@section('title')User List | Users @endsection
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void();">Users</a></li>
                </ol>
            </div>
         
            <div class="col-sm-3">
                <div class="btn-group float-sm-right">
                    <a href="{{url('admin/add_user')}}" class="btn btn-behance text-white btn-sm waves-effect waves-light add_data"><i class="fa fa-plus mr-1"></i> Add User </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div id="messages"></div>
                <div class="card">
                    <div class="card-header"><i class="zmdi zmdi-accounts-alt"></i> Users </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table style="zoom:90%;" id="datatable" class="table table-bordered text-center table-sm">
                              <thead>
                                  <tr>
                                      <th>Sr.No.</th>
                                      <th>Name</th>
                                      <th>Email</th>
                                      <th>Phone</th>
                                      <th>Image</th>
                                      <th>Type</th>
                                      <th>Status</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach($user_iist as $row)
                                  <tr>                                      
                                      <td>{{ $row->id }}</td>                      
                                      <td>{{ucwords($row->first_name).' '.ucwords($row->last_name)}}</td>
                                      <td>{{ $row->email }}</td>
                                      <td>{{ $row->phone }}</td>
                                      <td>
                                        @if(!empty($row->image) and file_exists(public_path('/assets/front/img/user/').$row->image))
                                          <img src="{{asset('public/assets/front/img/user').'/'.$row->image}}" height="40" width="40" class="rounded-circle">
                                        @else
                                          -
                                        @endif
                                      </td>
                                      <td>{{ $row->type_name }}</td>
                                      <td>
                                          @if($row->status  == 'Active')
                                            <a href="{{ route('user_status_update', [$row->id,$value='Inactive']) }}"><button class="btn btn-success btn-sm">  Active</button></a>
                                          
                                          @elseif($row->status  == 'Inactive')
                                            <a href="{{ route('user_status_update', [$row->id,$value='Active']) }}"><button class="btn btn-danger btn-sm">  INACTIVE</button></a>
                                          
                                          @elseif($row->status  == 'Block')
                                            <a href="{{ route('user_status_update', [$row->id,$value='Unblock']) }}"><button class="btn btn-success btn-sm">  UNBLOCK</button></a>
                
                                          @elseif($row->status  == 'Unblock')
                                            <a href="{{ route('user_status_update', [$row->id,$value='Active']) }}"><button class="btn btn-danger btn-sm">  INACTIVE</button></a>
                                          @endif
                                      </td>
                                      <td>
                                        @if($row->status  == 'Block')
                                            <a href="{{ route('user_status_update', [$row->id,$value='UNBLOCK']) }}"><button class="btn btn-success btn-sm">  UNBLOCK</button></a>
                                        @else
                                            <a href="{{ route('user_status_update', [$row->id,$value='BLOCK']) }}"><button class="btn btn-danger btn-sm">  BLOCK</button></a>
                                        @endif
                                          
                                          <a href="{{ url('admin/user/edit', [$row->id]) }}">
                                            <button class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i> EDIT</button>
                                          </a>
                                                                
                                          <form method="post" class="delete_form" action="{{ action('Admin\UserController@destroy', $row->id) }}">
                                              {{ csrf_field() }}
                                              <input type="hidden" name="_method" value="Delete">
                                              <button type="submit" class="btn btn-danger btn-sm" style="margin-top: 2px;"><i class="fa fa-trash-alt"></i> Delete</button>
                                          </form>
                                      </td>
                                  </tr>
                                  @endforeach
                              </tbody>
                            </table>
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

    $(document).ready(function () {
        $('.delete_form').on('submit', function(){
            if(confirm("Are you sure you want to delete it..?")){
                return true;
            }
            else{
                return false;
            }
        });
        $('#user').addClass('active');
        $('#datatable').DataTable({ order: [[0, 'desc']] });
    });
</script>
@endsection
