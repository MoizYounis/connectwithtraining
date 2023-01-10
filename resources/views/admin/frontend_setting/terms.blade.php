@extends('admin.layouts.master')
@section('content')
<div class="content p-4">
    <h2 class="mb-4" style="text-transform: uppercase;">Terms Setting</h2>
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('terms_update') }}" method="post">
                @csrf
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="terms" style="text-transform: uppercase;"><strong>Terms</strong></label>
                        <textarea id="summernote1" class="form-control" rows="5" name="terms">{{ $setting->terms ?? old('terms') }}</textarea>
                    </div>
                </div>
                <br>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-block btn-lg">UPDATE</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#summernote1').summernote();
        $("#frontend").addClass("show");
        $("#frontend li:nth-child(7)").addClass("active");
    });
</script>
@endsection