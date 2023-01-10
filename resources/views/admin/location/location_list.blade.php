@extends('admin.layouts.master')
@section('content')
<div class="content p-4">
    <h2 class="mb-4" style="text-transform: uppercase;"> Location List
        <a href="{{route('add_location')}}" class="btn btn-primary btn-md float-right">
            <i class="fa fa-plus"></i>  Add Location
        </a>
    </h2><br>
    <div class="card mb-4">
        <div class="card-body">
          <div class="table-responsive">
              <table id="dataTableExample" class="table table-hover table-bordered" cellspacing="0" width="100%">
              <thead>
                  <tr>
                      <th>Sr.No.</th>
                      <th>location Name</th>
                      <th>City Name</th>
                      <th>location Description</th>
                      <th>Status</th>
                      <th>Created At</th>
                      <th>Updated At</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach($location_list as $row)
                  <tr>
                      <td>{{ $row->location_id }}</td>
                      <td>{{ $row->location_name }}</td>
                      <td>{{ $row->city_name }}</td>
                      <td>{{ $row->location_desc }}</td>
                      <td>
                          @if($row->location_status  == 'Active')
                          <span class="badge badge-success">Active</span>
                          @else
                          <span class="badge badge-danger">Inactive</span>
                          @endif
                      </td>
                      <td>{{$row->created_at}}</td>
                      <td>{{$row->updated_at}}</td>
                      <td>
                          <a href="{{route('edit_location', [$row->location_id])}}"><button class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i> EDIT</button></a>
                                               
                          <form method="post" class="delete_form" action="{{ action('Admin\LocationController@destroy', $row->location_id) }}">
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

        $("#location").addClass("show");
        $("#location").addClass("active");
        //$('#table').DataTable();
    });
</script>
@endsection
