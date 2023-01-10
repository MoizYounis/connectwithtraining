@extends('admin.layouts.master')
@section('content')
<div class="content p-4">
    <h2 class="mb-4" style="text-transform: uppercase;">Create New Gift
        <a href="{{ route('gifts.index') }}" class="btn btn-primary btn-md float-right">
            <i class="fa fa-list"></i>   View Gifts
        </a>
    </h2>
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{route('gifts.store')}}" method="post">
                @csrf
                <div class="col-md-12  container-fluid">
                    <div class="form-group">
                        <label for="title" style="text-transform: uppercase;"><strong>Title&nbsp;<span class="mark">*</span></strong></label>
                        <input class="form-control form-control-lg mb-3" type="text" name="title"  value="{{old('title')}}" placeholder="Enter Title" id="title">
                    </div>
                </div>
                
                <div class="col-md-12  container-fluid">
                    <div class="form-group">
                        <label for="url" style="text-transform: uppercase;"><strong>Enter URL&nbsp;<span class="mark">*</span></strong></label>
                        <input class="form-control form-control-lg mb-3" type="text" name="url"  value="{{old('url')}}" placeholder="Enter Url" id="url">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="status" style="text-transform: uppercase;"><strong>Status</strong></label>
                        <input type="checkbox" data-onstyle="success" data-offstyle="danger" data-width="100%" data-on="Active" data-off="Inactive" data-toggle="toggle" name="status" checked="">
                    </div>
                </div>

                <br>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-block btn-lg">Create New Popular Gift</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#popular-gifts").addClass("show");
        $("#popular-gifts").addClass("active");
    });
</script>
@endsection
