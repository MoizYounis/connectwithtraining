@extends('admin.layouts.master')
@section('content')
<div class="content p-4">
    <h2 class="mb-4" style="text-transform: uppercase;"> States List
        <a href="{{route('add_state')}}" class="btn btn-primary btn-md float-right">
            <i class="fa fa-plus"></i>  Add State
        </a>
    </h2>
    <div class="card mb-4">
        <div class="card-body">
          <div class="table-responsive">
              <table id="dataTableExample" class="table table-hover table-bordered" cellspacing="0" width="100%">
              <thead>
                  <tr>
                      <th>Sr.No.</th>
                      <th>State Name</th>
                      <th>State Description</th>
                      <th>Status</th>
                      
                      <th>Created At</th>
                      <th>Updated At</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach($state_list as $row)
                  <tr>
                      <td>{{ $row->state_id }}</td>
                      <td>{{ $row->state_name }}</td>
                      <td>{{ $row->state_desc }}</td>
                      <td>
                          @if($row->state_status  == 'Active')
                          <span class="badge badge-success">Active</span>
                          @else
                          <span class="badge badge-danger">Inactive</span>
                          @endif
                      </td>
                      <td>{{$row->created_at}}</td>
                      <td>{{$row->updated_at}}</td>
                      <td>
                          <a href="{{route('edit_state',[$row->state_id])}}"><button class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i> EDIT</button></a>
                          <form method="post" class="delete_form" action="{{ action('Admin\StateController@destroy', $row->state_id) }}">
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

        $("#state").addClass("show");
        $("#state").addClass("active");
        //$('#table').DataTable();
    });
</script>
@endsection
