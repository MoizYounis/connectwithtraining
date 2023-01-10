@extends('admin.layouts.master')
@section('title')Contact Messages | Contacts @endsection
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h5>Contact Messages</h5>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Contacts</li>
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
                          <th>User Name</th>
                          <th>Email</th>
                          <th>Phone</th>                      
                          <th>Message</th>
                          <th>Date Time</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach($contact as $row)
                      <tr>
                          <td>{{ ucwords($row->username) }}</td>
                          <td>{{ $row->email }}</td>
                          <td>{{ $row->phone }}</td>
                          <td>{{ ucwords($row->msg) }}</td>
                          <td>{{ $row->dt}}</td>
                          <td>
                            <form method="post" class="delete_form" action="{{ action('Admin\ContactController@destroy', $row->id) }}">
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
        $("#contact").addClass("active");
        //$('#table').DataTable();
    });
</script>
@endsection
