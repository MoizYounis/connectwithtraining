@extends('front.layouts.master')
@section('title')
    Change Password | {{ $gs->title }}
@endsection
@section('content')
    <section class="breadcrums">
        <div class="container" style="max-width: 1223px;">
            <h2>Change Password</h2>
        </div>
    </section>

    <section class="profile">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="profile-head">
                        <h2>Change Password</h2>
                        <p>Do you want to chnage your password?</p>
                        <i class="fa fa-user-circle"></i>
                    </div>
                    <div class="account">
                        <div class="account-profile">
                            <h2>Account</h2>
                            <p>Edit your account settings and change tour password here</p>
                        </div>
                        <div class="edit-email">
                            <h2>Email</h2>
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="edit-col">
                                    <input type="text" name="email"
                                        placeholder="Your email address is {{ Auth::user()->email }}">
                                    <button type="submit" class="fa fa-pencil" aria-hidden="true"></button>
                                </div>
                            </form>
                        </div>
                        <div class="edit-email">
                            <h2>Password</h2>
                            <form action="{{ route('user.change_password') }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="edit-col">
                                    <input type="password" name="oldword" placeholder="Enter Current Password">
                                </div>
                                <div class="edit-col">
                                    <input type="password" name="newword" placeholder="Enter New Password">
                                </div>
                                <div class="edit-col">
                                    <input type="password" name="newword_confirmation" placeholder="Confirm Password">
                                </div>
                                <div class="change-pass">
                                    <button type="submit">Change Password</button>
                                </div>
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
        $(document).ready(function() {
            $('.delete_form').on('submit', function() {
                if (confirm(
                        "If you delete your account, you will be unsubscribed from all your courses, and will lose access forever!"
                        )) {
                    return true;
                } else {
                    return false;
                }
            });
        });

        function upload() {
            $(".selectImage").click();
        }

        $(document).on('change', '#real-file', function() {
            var name = document.getElementById("real-file").files[0].name;
            var form_data = new FormData();
            var ext = name.split('.').pop().toLowerCase();
            if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                alert("Invalid Image File");
            }
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("real-file").files[0]);
            var f = document.getElementById("real-file").files[0];
            var fsize = f.size || f.fileSize;
            if (fsize > 2000000) {
                alert("Image File Size is very big");
            } else {
                var _token = '<?= csrf_token() ?>';
                form_data.append("image", document.getElementById('real-file').files[0]);
                form_data.append("_token", _token);
                $.ajax({
                    url: "{{ url('user/profile/pic/update') }}",
                    method: "POST",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $('.image_upload_response').html(
                            "<label class='text-success'>Image Uploading...</label>");
                    },
                    success: function(response) {
                        if (response !== 'error') {
                            $('.image_upload_response').html('<img src="' + response +
                                '" alt="user avatar" class="customer-img rounded-circle" style="width:40px;">'
                                );
                            round_success_noti('Image Update successfully');
                        } else {
                            $('.image_upload_response').html('Error In Uploading!');
                        }
                    },
                    error: function(response) {
                        round_error_noti('Connection Error...');
                    }
                });
            }
        });
    </script>
@endsection
