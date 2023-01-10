@extends('admin.layouts.master')
@section('content')
<div class="content p-4">
    <h2 class="mb-4" style="text-transform: uppercase;">Create New State
        <a href="{{ route('state_list') }}" class="btn btn-primary btn-md float-right">
            <i class="fa fa-list"></i>   View States
        </a>
    </h2><br>
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{route('create_state')}}" method="post">
                @csrf
                <div class="col-md-12  container-fluid">
                    <div class="form-group">
                        <label for="state_name" style="text-transform: uppercase;"><strong>State name&nbsp;<span class="mark">*</span></strong></label>
                        <input class="form-control form-control-lg mb-3" type="text" name="state_name"  value="" placeholder="Enter State Name" id="state_name">
                    </div>
                </div>

                <div class="col-md-12  container-fluid">
                    <div class="form-group">
                        <label for="state_desc" style="text-transform: uppercase;"><strong>State Description&nbsp;</strong></label>
                        <textarea rows="5" class="form-control form-control-lg mb-3" name="state_desc" placeholder="Enter State Description" id="state_desc"></textarea>
                    </div>
                </div>                

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="state_status" style="text-transform: uppercase;"><strong>Status</strong></label>
                        <input type="checkbox" data-onstyle="success" data-offstyle="danger" data-width="100%" data-on="Active" data-off="Inactive" data-toggle="toggle" name="state_status">
                    </div>
                </div>

                <br>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-block btn-lg">Create New Package</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#state").addClass("show");
        $("#state").addClass("active");
    });
</script>
@endsection
