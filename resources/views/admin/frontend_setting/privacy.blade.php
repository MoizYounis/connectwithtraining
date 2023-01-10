@extends('admin.layouts.master')
@section('content')
<div class="content p-4">
    <h2 class="mb-4" style="text-transform: uppercase;">Privacy Policy Setting</h2>
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{route('privacy_update')}}" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="privacy_title1" style="text-transform: uppercase;"><strong>Privacy Title 1</strong></label>
                            <input type="text" class="form-control" name="privacy_title1" value="{{ $setting->privacy_title1 ?? old('privacy_title1') }}" placeholder="Title">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="privacy_desc1" style="text-transform: uppercase;"><strong>Privacy Details 1</strong></label>
                            <textarea id="summernote1" class="form-control" rows="5" name="privacy_desc1">{{ $setting->privacy_desc1 ?? old('privacy_desc1') }}</textarea>
                        </div>
                    </div>

                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="privacy_title2" style="text-transform: uppercase;"><strong>Privacy Title 2</strong></label>
                            <input type="text" class="form-control" name="privacy_title2" value="{{ $setting->privacy_title2 ?? old('privacy_title2') }}" placeholder="Title">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="privacy_desc2" style="text-transform: uppercase;"><strong>Privacy Details 2</strong></label>
                            <textarea id="summernote2" class="form-control" rows="5" name="privacy_desc2">{{ $setting->privacy_desc2 ?? old('privacy_desc2') }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="privacy_title3" style="text-transform: uppercase;"><strong>Privacy Title 3</strong></label>
                            <input type="text" class="form-control" name="privacy_title3" value="{{ $setting->privacy_title3 ?? old('privacy_title3') }}" placeholder="Title">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="privacy_desc3" style="text-transform: uppercase;"><strong>Privacy Details 3</strong></label>
                            <textarea id="summernote3" class="form-control" rows="5" name="privacy_desc3">{{ $setting->privacy_desc3 ?? old('privacy_desc3') }}</textarea>
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
        $('#summernote3').summernote();
    });
    $("#frontend").addClass("show");
    $("#frontend li:nth-child(7)").addClass("active");
    bkLib.onDomLoaded(function () {
        new nicEditor({iconsPath: '../../assets/admin/img/nicEditorIcons.gif'}).panelInstance('aboutus_details');
    });
</script>
@endsection