@extends('front.layouts.master')
@section('title')User Profile | {{$gs->title}} @endsection
@section('content')

    <section class="breadcrums">
        <div class="container" style="max-width: 1223px;">
            <h2 >Profile</h2>    
        </div>
    </section>
    
    <section class="profile">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="profile-head">
                        <h2>Creating Profile</h2>
                        <p>Add information about yourself to share on your profile</p>
                        <i class="fa fa-user-circle"></i>
                    </div>
                    <div class="profile-form">
                        <form action="{{route('update_user_profile')}}" method="post">
                            @csrf
                            <div class="names">
                                <div class="first_name">
                                    <label>First Name</label>
                                    <input type="text" name="first_name" placeholder="First Name" value="{{Auth::user()->first_name}}">
                                </div>
                                <div class="first_name">
                                    <label>Last Name</label>
                                    <input type="text" name="last_name" placeholder="Last Name" value="{{Auth::user()->last_name}}">
                                </div>
                            </div>
                            
                            <div class="names">
                                <div class="first_name">
                                    <label>Email Address</label>
                                    <input type="text" name="email" placeholder="Email" value="{{Auth::user()->email}}">
                                </div>
                                <div class="first_name">
                                    <label>Phone Number</label>
                                    <input type="text" name="phone" placeholder="Phone" value="{{Auth::user()->phone}}">
                                </div>
                            </div>
                            
                            <div class="names">
                                <div class="first_name">
                                    <label>City</label>
                                    <input type="text" name="city" value="{{isset($address->city)?$address->city:''}}" placeholder="City">
                                </div>
                                <div class="first_name">
                                    <label>State</label>
                                    <input type="text" name="state" value="{{isset($address->state)?$address->state:''}}" placeholder="State">
                                </div>
                                <div class="first_name">
                                    <label>Pincode</label>
                                    <input type="text" name="pincode" value="{{isset($address->pincode)?$address->pincode:''}}" placeholder="Pincode">
                                </div>
                            </div>
                            
                            <div class="names">
                                <div class="first_name">
                                    <label>Address</label>
                                    <textarea name="address" placeholder="Address" style="border: 1px solid #c2c2c2; border-radius: 10px;">{{isset($address->address)?$address->address:''}}</textarea>
                                </div>
                            </div>
                            
                            <p class="profile-p">By clicking below, I acknowledge and agree to your <span> Terms of Use </span>and <span> Privacy Policy </span></p>
                            <div class="profile-btn">
                                <button type="submit">Save</button>
                            </div>
                        </form>
                    </div>
                    
                    <div class="detailed">
                        <h2>Add/ Change Image</h2>
                        <!--<span id="custom-text">No file chosen, yet.</span>-->
                        <input type="file" id="real-file" name="image" hidden="hidden" class="selectImage"/>
                        <button type="button" id="custom-button" onclick="upload();">CHOOSE A FILE</button>
                        <span class="image_upload_response">
                            @if(Auth::user()->image == '')
                                <img src="{{asset('public/assets/front/img/user/avtar.png')}}" alt="user avatar" class="customer-img rounded-circle" style="width:40px;">
                            @else
                                <img src="{{asset('public/assets/front/img/user').'/'.Auth::user()->image}}" alt="user avatar" class="customer-img rounded-circle" style="width:40px;">
                            @endif
                        </span>
                    </div>
                    <div class="account">
                        <div class="account-profile">
                            <h2>Account</h2>
                            <p>Edit your account settings and chamge tour password here</p>
                        </div>
                        <div class="edit-email">
                            <h2>Email</h2>
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="edit-col">
                                    <input type="text" name="email" placeholder="Your email address is {{Auth::user()->email}}">
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
                                    <button type=="submit">Change Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--<div class="account">-->
                    <!--    <div class="account-profile">-->
                    <!--        <h2>Privacy</h2>-->
                    <!--        <p>Modify your privacy settings here.</p>-->
                    <!--    </div>-->
                    <!--    <div class="edit-email">-->
                    <!--        <h2>Profile Page Setting</h2>-->
                    <!--        <div class="edit-privacy">-->
                    <!--            <input type="checkbox" name="">-->
                    <!--            <p>Show my profile on search engines.</p>-->
                    <!--        </div>-->
                    <!--        <div class="edit-privacy">-->
                    <!--            <input type="checkbox" name="">-->
                    <!--            <p>Show courses I am taking on my profile page.</p>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <!--<div class="notification">-->
                    <!--    <div class="notification-head">-->
                    <!--        <h2>Notifications</h2>-->
                    <!--        <p>Edit notifications here, Individual course notifications can be edited on the course day</p>-->
                    <!--    </div>-->
                    <!--    <div class="not-text">-->
                    <!--        <h4>Send me an email when/about:</h4>-->
                    <!--        <div class="not-button">-->
                    <!--            <label class="switch">-->
                    <!--              <input type="checkbox" checked>-->
                    <!--              <span class="slider round"></span>-->
                    <!--            </label>-->
                    <!--            <p>Connect With Training makes an announcement</p>-->
                    <!--        </div>-->
                    <!--        <div class="not-button">-->
                    <!--            <label class="switch">-->
                    <!--              <input type="checkbox" checked>-->
                    <!--              <span class="slider round"></span>-->
                    <!--            </label>-->
                    <!--            <p>Connect With Training makes an announcement</p>-->
                    <!--        </div>-->
                    <!--        <div class="not-button">-->
                    <!--            <label class="switch">-->
                    <!--              <input type="checkbox" checked>-->
                    <!--              <span class="slider round"></span>-->
                    <!--            </label>-->
                    <!--            <p>Connect With Training makes an announcement</p>-->
                    <!--        </div>-->
                    <!--        <div class="not-button">-->
                    <!--            <label class="switch">-->
                    <!--              <input type="checkbox" checked>-->
                    <!--              <span class="slider round"></span>-->
                    <!--            </label>-->
                    <!--            <p>Connect With Training makes an announcement</p>-->
                    <!--        </div>-->
                    <!--        <div class="not-button">-->
                    <!--            <label class="switch">-->
                    <!--              <input type="checkbox" checked>-->
                    <!--              <span class="slider round"></span>-->
                    <!--            </label>-->
                    <!--            <p>Send me any emails</p>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
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