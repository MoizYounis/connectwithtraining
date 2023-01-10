@extends('admin.layouts.master')
@section('title')Subscribers Emails | Subscribers @endsection
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h5>Subscribers Emails</h5>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Subscribers Emails</li>
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
                
            <form action="{{url('admin/subscribers/update/discount')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Enter Subscribe Discount</label>
                            <input type="text" class="form-control" name="subscribe_discount" value="{{$gs->subscribe_discount}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Enter Refer Discount</label>
                            <input type="text" class="form-control" name="refer_discount" value="{{$gs->refer_discount}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-sm btn-primary my-4">Update</button>
                    </div>
                </div>
            </form>
                
              <div class="table-responsive">
                <table id="example1" class="table table-hover table-bordered" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                          <th>Id</th>
                          <th>Email</th>
                          <th>Discount</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach($subscribe as $row)
                      <tr>
                          <td>{{$row->id}}</td>
                          <td>{{ $row->email }}</td>
                          <td>{{ !empty($row->discount)?$row->discount."%":"-" }}</td>
                          <td>
                            <form method="post" class="delete_form" action="{{ action('Admin\SubscriberController@destroy', $row->id) }}">
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
        $("#subscriber").addClass("active");
        //$('#table').DataTable();
    });
</script>
@endsection
