@extends('admin.layouts.master')
@section('title')Social Links | Social @endsection
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Social Links</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Social</li>
            <li class="breadcrumb-item"><a data-toggle="modal" data-target="#addNew" class="btn btn-primary btn-sm float-right">Add New</a></li>
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
                        <th>Id</th>
                        <th>Name</th>
                        <th>Icon</th>
                        <th>Link</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($socialList as $social)
                    <tr>
                        <td>{{ $social->social_id }}</td>
                        <td>{{ $social->social_name }}</td>
                        <td><i class="{{ $social->social_code }}"></i></td>
                        <td>{{ $social->social_link }}</td>
                        <td>
                            
                            <div class="modal fade" id="" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-share-square"></i> Edit Social</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        </div>
                                        <form method="POST" action="">
                                            @csrf
                                            
                                            <div class="modal-body">
                                                <div class="form-group error">
                                                    <label for="name" class="col-sm-3 control-label bold uppercase"><strong>Name :</strong> </label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control has-error bold " value="" id="name" name="name" placeholder="Social Name">
                                                    </div>
                                                </div>
                                                <div class="form-group error">
                                                    <label for="code" class="col-sm-3 control-label bold uppercase"><strong>Icon Code :</strong> </label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control has-error bold demo" id="code" value="" name="code" placeholder="Social Fontawesome Code">
                                                        <small class="text-danger"><strong>For Fontawesome code visit : http://fontawesome.io/icons/</strong></small>
                                                    </div>
                                                </div>
                                                <div class="form-group error">
                                                    <label for="link" class="col-sm-3 control-label bold uppercase"><strong>Link :</strong> </label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control has-error bold " value="" id="link" name="link" placeholder="Social Link">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                                                <button type="submit" class="btn btn-primary bold uppercase"><i class="fas fa-arrow-alt-circle-up"></i> Save Social</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-danger btn-sm delete_button" data-toggle="modal" data-target="#delete">
                                <i class="fa fa-times"></i>  DELETE
                            </button>
                            <div class="modal fade" id="delete" role="dialog" aria-labelledby="#delete" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <form method="POST" action="{{ action('Admin\FrontendSettingController@socialDestroy', $social->social_id) }}">
                                            @csrf
                                           
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="delete"><i class="fa fa-trash"></i>&nbsp;Delete !</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Are you sure, you want to delete ?</strong></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </td>                 
                    </tr>
                    @endforeach
                </tbody>
                <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-share-square"></i> Manage Social</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                            <form action="{{route('socialAdd')}}">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group error">
                                        <label for="name" class="col-sm-3 control-label bold uppercase"><strong>Name :</strong> </label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control has-error bold " id="name" name="social_name" placeholder="Social Name">
                                        </div>
                                    </div>
                                    <div class="form-group error">
                                        <label for="code" class="col-sm-3 control-label bold uppercase"><strong>Icon Code :</strong> </label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control has-error bold demo" id="code" name="social_code" placeholder="Social Fontawesome Code <i class='fa fa-facebook'></i>">
                                            <small class="text-danger"><strong>For Fontawesome code visit : http://fontawesome.io/icons/</strong></small>
                                        </div>
                                    </div>
                                    <div class="form-group error">
                                        <label for="link" class="col-sm-3 control-label bold uppercase"><strong>Link :</strong> </label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control has-error bold " id="link" name="social_link" placeholder="Social Link">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                                    <button type="submit" class="btn btn-primary bold uppercase"><i class="fas fa-arrow-alt-circle-up"></i> Save Social</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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
        $("#setting").addClass("active");
        $("#social").addClass("active");
    });
</script>
@endsection