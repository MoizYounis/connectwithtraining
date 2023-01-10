@extends('admin.layouts.master')
@section('title')Blog Category List | Blog Categories @endsection
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void();"></a>Blog Categories</li>
                </ol>
            </div>
         
            <div class="col-sm-3">
                <div class="btn-group float-sm-right">
                    <button type="button" class="btn btn-behance text-white btn-sm waves-effect waves-light add_data" data-toggle="modal" data-target="#addcategory"><i class="fa fa-plus mr-1"></i> Add Category </button>
                </div>
            </div>
        </div>

        <div class="modal fade" id="addcategory" data-backdrop="static">
          <div class="modal-dialog modal-dialog-scrollable modal-md">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title modal_title_creat_update">Insert Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                  <form method="post" action="{{route('blogcategory.store')}}">
                    @csrf
                    <div class="row">

                      <div class="form-group col-md-12">
                        <label>Category Name*</label>
                        <input type="text" class="form-control input-check" name="blog_cat_name" id="blog_cat_name" placeholder="Enter Category Name" value="{{old('blog_cat_name')}}" required="">
                      </div>

                      <div class="form-group col-md-12">
                        <button type="submit" id="submit_btn" class="btn btn-sm btn-success px-3"><i class="fa fa-arrow-circle-right"></i> Insert</button>
                      </div>
                    </div>
                  </form>
                </div>
            </div>
          </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div id="messages"></div>
                <div class="card">
                    <div class="card-header"><i class="zmdi zmdi-reader"></i> Blog Category</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table style="zoom:90%;" id="datatable" class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>Sno.</th>
                                        <th>Category Name</th>                                        
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($blog_cat_list as $row)
                                        <tr>
                                            <td>{{$row->id}}</td>
                                            <td>{{ucwords($row->blog_cat_name)}}</td>
                                            <td>
                                                <div class="btn-group m-1" role="group">
                                                    <button type="button" class="btn btn-behance btn-sm text-white waves-effect waves-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Action
                                                    </button>
                                                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 37px, 0px);">
                                                        <a href="javascript:void();" class="dropdown-item edit_data" data-toggle="modal" data-target="#editcategory{{$row->id}}"><i class="fa fa-edit mr-1"></i> Edit Data</a>
                                                        <div class="dropdown-divider"></div>

                                                        <form method="post" class="delete_form" action="{{ action('Admin\BlogCatController@destroy', $row->id) }}">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="_method" value="Delete">
                                                            <button type="submit" class="dropdown-item delete_data"><i class="fa fa-trash mr-1"></i> Delete</button>
                                                        </form>    
                                                    </div>
                                                </div>
                                            </td>                                            
                                        </tr>


                                        <!-- edit -->
                                        <div class="modal fade" id="editcategory{{$row->id}}" data-backdrop="static">
                                          <div class="modal-dialog modal-dialog-scrollable modal-md">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title modal_title_creat_update">Update Category</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                  <form method="post" action="{{route('blogcategory.update',[$row->id])}}">
                                                    @csrf
                                                    {{ method_field('PATCH') }}
                                                    <div class="row">

                                                      <div class="form-group col-md-12">
                                                        <label>Category Name*</label>
                                                        <input type="text" class="form-control input-check" name="blog_cat_name" id="blog_cat_name" placeholder="Enter Category Name" value="{{$row->blog_cat_name}}" required="">
                                                      </div>

                                                      <div class="form-group col-md-12">
                                                        <button type="submit" id="submit_btn" class="btn btn-sm btn-success px-3"><i class="fa fa-arrow-circle-right"></i> Update</button>
                                                      </div>
                                                    </div>
                                                  </form>
                                                </div>

                                            </div>
                                          </div>
                                      </div>
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
        $("#blog").addClass("active");
        $(document).ready(function () {
            $('#datatable').DataTable({ order: [[0, 'desc']] });

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