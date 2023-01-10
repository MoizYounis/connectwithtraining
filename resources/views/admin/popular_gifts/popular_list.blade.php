@extends('admin.layouts.master')
@section('content')
<div class="content p-4">
    <h2 class="mb-4" style="text-transform: uppercase;"> Popular Gifts
        <a href="{{route('gifts.create')}}" class="btn btn-primary btn-md float-right">
            <i class="fa fa-plus"></i>  Add Gift
        </a>
    </h2>
    <br>
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive">
              <table id="dataTableExample" class="table table-hover table-bordered">
                  <thead>
                      <tr>
                          <th>Sr.No.</th>
                          <th>Title</th>
                          <th>Url</th>
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($gifts as $row)
                      <tr>
                          <td>{{ $row->popular_id }}</td>
                          <td>{{ $row->title }}</td>
                          <td>{{ $row->url }}</td>
                          <td>
                              @if($row->status  == 'Active')
                              <span class="badge badge-success">Active</span>
                              @else
                              <span class="badge badge-danger">Inactive</span>
                              @endif
                          </td>
                          <td>
                              <a href="{{route('gifts.edit', [$row->popular_id])}}"><button class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i> EDIT</button></a>
                                                   
                              <form method="post" class="delete_form" action="{{ action('Admin\PopularGiftsController@destroy', $row->popular_id) }}">
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

        $("#popular-gifts").addClass("show");
        $("#popular-gifts").addClass("active");
        // $('#table').DataTable();
    });
</script>
@endsection
