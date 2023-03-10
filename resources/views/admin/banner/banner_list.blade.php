@extends('admin.layouts.master')
@section('title')Banners List | Banners @endsection
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Banner List</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Banners</li>
            <li class="breadcrumb-item"><a href="{{route('add_banner')}}" class="btn btn-primary btn-sm float-right">Add Banner</a></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                  <table id="example1" class="table table-hover table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sr.No.</th>
                            <th>Name</th>
                            <th>Title</th>
                            <th>Url</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($banner_list as $row)
                        <tr>
                            <td>{{ $row->banner_id }}</td>
                            <td>{{ ucwords($row->banner_name) }}</td>
                            <td>{{ ucwords($row->banner_title) }}</td>
                            <td>{{ $row->banner_url }}</td>
                            
                            <div class="modal fade" id="addNew{{ $row->banner_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-lg">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-share-square"></i> {{ ucwords($row->banner_name) }}</h4>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">??</span></button>
                                      </div>
                                      
                                      <div class="modal-body">
                                          {{ ucwords($row->banner_desc) }}
                                      </div>

                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                                      </div>
                                  </div>
                              </div>
                            </div>

                            <td>
                              <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addNew{{ $row->banner_id }}">
                                </i>Read...
                              </a></td>
                            <td><a href="{{ asset('public/assets/banner/')}}/{{$row->banner_img }}"><img src="{{ asset('public/assets/banner/')}}/{{$row->banner_img }}" height="40" width="40"></a></td>
                            <td>
                                @if($row->banner_status  == 'Active')
                                <span class="badge badge-success">Active</span>
                                @else
                                <span class="badge badge-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('edit_banner',[$row->banner_id])}}"><button class="btn btn-primary btn-xs" style="display: inline-block;"> <i class="fa fa-edit"></i> EDIT</button></a>
                                <form method="post" class="delete_form" action="{{ action('Admin\BannerController@destroy', $row->banner_id) }}"  style="display: inline-block;">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="Delete">
                                    <button type="submit" class="btn btn-danger btn-xs" style="margin-top: 2px;"><i class="fa fa-trash-alt"></i> Delete</button>
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
        </div>
      </div>
    </section>
</div>
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
        $("#banner").addClass("active");
    });
</script>
@endsection
