@extends('admin.layouts.master')
@section('title')Update Menu | Menus @endsection
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void();"></a>Update Menus</li>
                </ol>
            </div>
         
            <div class="col-sm-3">
                <div class="btn-group float-sm-right">
                    <a href="{{route('menu.index')}}" class="btn btn-behance text-white btn-sm waves-effect waves-light add_data"><i class="fa fa-plus mr-1"></i> Menu List</a>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <div id="messages"></div>
                <div class="card">
                    <div class="card-header"><i class="zmdi zmdi-menu"></i> Update Menu</div>
                    <div class="card-body">
                        <form method="post" action="{{route('menu.update', $menu_edit->id)}}">
                            @csrf {{method_field('PATCH')}}
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Menu Name*</label>
                                    <input type="text" class="form-control input-check" name="menu_name" id="menu_name" placeholder="Menu Name" required="" value="{{$menu_edit->menu_name}}">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Menu Url*</label>
                                    <input type="text" class="form-control input-check" name="menu_url" id="menu_url" placeholder="Menu Url" required="" value="{{$menu_edit->menu_url}}">
                                </div>

                                <div class="form-group col-md-12">
                                    <!-- <label>Page Status*</label> -->
                                    <div class="icheck-material-primary">
                                        <input type="checkbox" name="menu_status" id="user-checkbox5" 
                                        @if($menu_edit->menu_status == "Publish") checked="" @else @endif
                                        />
                                        <label for="user-checkbox5">Publish The Blog ?</label>
                                    </div>
                                  </div>

                                <div class="form-group col-md-12">
                                    <button type="submit" id="submit_btn" class="btn btn-sm btn-success px-3"><i class="fa fa-arrow-circle-right"></i> Update</button>
                                </div>
                            </div>
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
        $("#menu").addClass("active");
        $(document).ready(function () {
            
        });
    </script>

    <script type="text/javascript">
    $(document).ready(function(){      
      
    });
  </script>
@endsection