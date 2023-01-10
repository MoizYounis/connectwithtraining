@extends('admin.layouts.master')
@section('content')
<div class="content p-4">
    <h2 class="mb-4" style="text-transform: uppercase;">About us Setting</h2>
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{route('aboutus_update')}}" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="aboutus_title" style="text-transform: uppercase;"><strong>About us Title</strong></label>
                            <input type="text" class="form-control" name="aboutus_title" value="{{ $setting->aboutus_title ?? old('aboutus_title') }}" placeholder="Title">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="aboutus_details" style="text-transform: uppercase;"><strong>About us Details 1</strong></label>
                            <textarea id="summernote1" class="form-control" rows="5" name="aboutus_details">{{ $setting->aboutus_details ?? old('aboutus_details') }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="aboutus_details2" style="text-transform: uppercase;"><strong>About us Details 2</strong></label>
                            <textarea id="summernote2" class="form-control" rows="5" name="aboutus_details2">{{ $setting->aboutus_details2 ?? old('aboutus_details2') }}</textarea>
                        </div>
                    </div>                    
                

                         
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
        $('#summernote2').summernote();
    });
    $("#frontend").addClass("show");
    $("#frontend li:nth-child(7)").addClass("active");
    bkLib.onDomLoaded(function () {
        new nicEditor({iconsPath: '../../assets/admin/img/nicEditorIcons.gif'}).panelInstance('aboutus_details');
    });
</script>
@endsection