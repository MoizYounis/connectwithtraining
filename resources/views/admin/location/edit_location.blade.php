@extends('admin.layouts.master')
@section('content')
<div class="content p-4">
    <h2 class="mb-4" style="text-transform: uppercase;">Update location
        <a href="{{ route('location_list') }}" class="btn btn-primary btn-md float-right">
            <i class="fa fa-list"></i>   View Locations
        </a>
    </h2><br>
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{route('update_location', [$location_edit[0]->location_id])}}" method="post">
                @csrf
                <div class="col-md-12  container-fluid">
                    <div class="form-group">
                        <label for="location_name" style="text-transform: uppercase;"><strong>location name&nbsp;<span class="mark">*</span></strong></label>
                        <input class="form-control form-control-lg mb-3" type="text" name="location_name"  value="{{$location_edit[0]->location_name}}" placeholder="Enter location Name" id="location_name">
                    </div>
                </div>

                <div class="col-md-12  container-fluid">
                    <div class="form-group">
                        <label for="city_id" style="text-transform: uppercase;"><strong>Select City&nbsp;<span class="mark">*</span></strong></label>
                        <select class="form-control form-control-lg mb-3" name="city_id">
                            @if(!empty($location_edit))
                                <option value="{{$location_edit[0]->city_id}}">{{$location_edit[0]->city_name}}</option>
                            @endif

                            @if(!empty($city_list))
                                @foreach($city_list as $row)
                                    <option value="{{$row->city_id}}">{{$row->city_name}}</option>
                                @endforeach
                            @else
                                <option value="">No City Found</option>
                            @endif
                        </select>
                    </div>
                </div>

                <div class="col-md-12  container-fluid">
                    <div class="form-group">
                        <label for="location_desc" style="text-transform: uppercase;"><strong>location Description</strong></label>
                        <textarea rows="5" class="form-control form-control-lg mb-3" name="location_desc" placeholder="Enter location Description" id="location_desc">{{$location_edit[0]->location_desc}}</textarea>
                    </div>
                </div>                

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="location_status" style="text-transform: uppercase;"><strong>Status</strong></label>
                        @if($location_edit[0]->location_status == 'Active')
                            <input type="checkbox" data-onstyle="success" data-offstyle="danger" data-width="100%" data-on="Active" data-off="Inactive" data-toggle="toggle" name="location_status" checked="">
                        @else
                            <input type="checkbox" data-onstyle="success" data-offstyle="danger" data-width="100%" data-on="Active" data-off="Inactive" data-toggle="toggle" name="location_status">
                        @endif
                    </div>
                </div>

                <br>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-block btn-lg">Update location</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#location").addClass("show");
        $("#location").addClass("active");
    });
</script>
@endsection
