@extends('admin.layouts.master')
@section('content')
<div class="content p-4">
    <h2 class="mb-4" style="text-transform: uppercase;">Update City
        <a href="{{ route('city_list') }}" class="btn btn-primary btn-md float-right">
            <i class="fa fa-list"></i>   View Cities
        </a>
    </h2>
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{route('update_city', [$city_edit[0]->city_id])}}" method="post">
                @csrf
                <div class="col-md-12  container-fluid">
                    <div class="form-group">
                        <label for="city_name" style="text-transform: uppercase;"><strong>City name&nbsp;<span class="mark">*</span></strong></label>
                        <input class="form-control form-control-lg mb-3" type="text" name="city_name"  value="{{$city_edit[0]->city_name}}" placeholder="Enter City Name" id="city_name">
                    </div>
                </div>

                <div class="col-md-12  container-fluid">
                    <div class="form-group">
                        <label for="state_id" style="text-transform: uppercase;"><strong>Select State&nbsp;<span class="mark">*</span></strong></label>
                        <select class="form-control form-control-lg mb-3" name="state_id">
                            @if(!empty($city_edit))
                                <option value="{{$city_edit[0]->state_id}}">{{$city_edit[0]->state_name}}</option>
                            @endif

                            @if(!empty($state_list))
                                @foreach($state_list as $row)
                                    <option value="{{$row->state_id}}">{{$row->state_name}}</option>
                                @endforeach
                            @else
                                <option value="">No State Found</option>
                            @endif
                        </select>
                    </div>
                </div>

                <div class="col-md-12  container-fluid">
                    <div class="form-group">
                        <label for="city_desc" style="text-transform: uppercase;"><strong>City Description</strong></label>
                        <textarea rows="5" class="form-control form-control-lg mb-3" name="city_desc" placeholder="Enter City Description" id="city_desc">{{$city_edit[0]->city_desc}}</textarea>
                    </div>
                </div>                

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="city_status" style="text-transform: uppercase;"><strong>Status</strong></label>
                        @if($city_edit[0]->city_status == 'Active')
                            <input type="checkbox" data-onstyle="success" data-offstyle="danger" data-width="100%" data-on="Active" data-off="Inactive" data-toggle="toggle" name="city_status" checked="">
                        @else
                            <input type="checkbox" data-onstyle="success" data-offstyle="danger" data-width="100%" data-on="Active" data-off="Inactive" data-toggle="toggle" name="city_status">
                        @endif
                    </div>
                </div>

                <br>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-block btn-lg">Update City</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#city").addClass("show");
        $("#city").addClass("active");
    });
</script>
@endsection
