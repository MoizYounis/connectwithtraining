@extends('front.layouts.master')
@section('title')Delete Account | {{$gs->title}} @endsection
@section('content')

    <section class="breadcrums">
        <div class="container" style="max-width: 1223px;">
            <h2 >Delete Account</h2>    
        </div>
    </section>
    
    <section class="profile">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="profile-head">
                        <h2>Delete Account</h2>
                        <p>Do you want to delete your account?</p>
                        <i class="fa fa-user-circle"></i>
                    </div>
                    <div class="danger">
                        <div class="danger-head">
                            <h2>Danger Zone</h2>
                            <p>Delete your account permanently</p>
                        </div>
                        <div class="delete-info">
                            <h2>Delete Your Account</h2>
                            <p><span>Warning:</span>  If you delete your account, you will be unsubscribed from all your courses, and will lose access forever</p>
                        </div>
                        <div class="delete-btn">
                            <form method="post" class="delete_form" action="{{ url('user/account/delete')}}">
                                {{ csrf_field() }}
                                <input type="password" name="password" placeholder="Password...">
                                <button type="submit">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        $('.delete_form').on('submit', function(){
            if(confirm("If you delete your account, you will be unsubscribed from all your courses, and will lose access forever!")){
                return true;
            }
            else{
              return false;
            }
        });
    });
    function upload() {
        $(".selectImage").click();
    }
    
    $(document).on('change', '#real-file', function(){
        var name = document.getElementById("real-file").files[0].name;
        var form_data = new FormData();
        var ext = name.split('.').pop().toLowerCase();
        if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
        {
           alert("Invalid Image File");
        }
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("real-file").files[0]);
        var f = document.getElementById("real-file").files[0];
        var fsize = f.size||f.fileSize;
        if(fsize > 2000000)
        {
            alert("Image File Size is very big");
        }
        else
        {
            var _token = '<?= csrf_token(); ?>';
            form_data.append("image", document.getElementById('real-file').files[0]);
            form_data.append("_token", _token);
            $.ajax({
                url:"{{ url('user/profile/pic/update') }}",
                method:"POST",
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend:function(){
                    $('.image_upload_response').html("<label class='text-success'>Image Uploading...</label>");
                },
                success:function(response)
                {
                    if(response !== 'error'){
                        $('.image_upload_response').html('<img src="'+ response +'" alt="user avatar" class="customer-img rounded-circle" style="width:40px;">');
                        round_success_noti('Image Update successfully');
                    }
                    else{
                        $('.image_upload_response').html('Error In Uploading!');
                    }
                },
                error: function(response){
                    round_error_noti('Connection Error...');
                }
            });
        }
    });
</script>
@endsection