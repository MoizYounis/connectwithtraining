@php
  $gs = App\Model\General_setting::first();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>{{ $gs->title}} Sign In</title>
  <!--favicon-->
  <link rel="icon" href="{{asset('public/assets/admin/images/')}}/{{$gs->favicon}}" type="image/x-icon">
  <!-- Bootstrap core CSS-->
  <link href="{{asset('public/assets/admin/css/bootstrap.min.css')}}" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="{{asset('public/assets/admin/css/animate.css')}}" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="{{asset('public/assets/admin/css/icons.css')}}" rel="stylesheet" type="text/css"/>
  <!-- notifications css -->
  <link rel="stylesheet" href="{{asset('public/assets/admin/plugins/notifications/css/lobibox.min.css')}}"/>
  <!-- Custom Style-->
  <link href="{{asset('public/assets/admin/css/app-style.css')}}" rel="stylesheet"/>
</head>

<body>
<!-- Start wrapper-->
 <div id="wrapper">
    <div class="loader-wrapper"><div class="lds-ring"><div></div><div></div><div></div><div></div></div></div>
        <div class="card card-authentication1 mx-auto my-5">
            <div class="card-body">
                <div class="card-content p-2">
                    <div class="text-center">
                        <img style="width:auto; object-fit: contain;" src="{{asset('public/assets/front/img/logo')}}/{{$gs->logo}}" alt="logo icon">
                    </div>
                    <hr>
                    <div class="card-title text-uppercase text-center">Sign In</div>
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="form-group">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <label for="email">Email Address</label>
                            <div class="position-relative has-icon-right">
                                <input type="email" name="email" class="form-control input-shadow input-check" placeholder="Email" value="{{ old('email') }}" autofocus="" required="">
                                <div class="form-control-position">
                                    <i class="icon-user"></i>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <label for="passwrdinput" class="">Password</label>
                            <div class="position-relative has-icon-right">
                                <input type="password" name="password" class="form-control input-shadow input-check" placeholder="Password" required="">
                                <div class="form-control-position">
                                    <i class="icon-lock"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                           <div class="form-group col-6">
                             <div class="icheck-material-primary">
                                    <input type="checkbox" id="user-checkbox" checked="" />
                                    <label style="color:#1769ff" for="user-checkbox">Remember me</label>
                            </div>
                           </div>
                           <!--div class="form-group col-6 text-right">
                            <a style="color:#1769ff" href="authentication-reset-password.html">Reset Password</a>
                           </div-->
                          </div>
                        <button type="submit" id="submit_btn" class="btn btn-behance btn-block text-white"><i class="fa fa-arrow-circle-right fa-lg"></i>  Sign In</button>                       
                    </form>
                </div>
            </div>
        </div>
    </div><!--wrapper-->
  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('public/assets/admin/js/jquery.min.js')}}"></script>
  <script src="{{asset('public/assets/admin/js/popper.min.js')}}"></script>
  <script src="{{asset('public/assets/admin/js/bootstrap.min.js')}}"></script>
  <!--notification js -->
   <script src="{{asset('public/assets/admin/plugins/notifications/js/lobibox.min.js')}}"></script>
  <script src="{{asset('public/assets/admin/plugins/notifications/js/notifications.min.js')}}"></script>
  <script src="{{asset('public/assets/admin/plugins/notifications/js/notification-custom-script.js')}}"></script>
  <!-- sidebar-menu js -->
  <script src="{{asset('public/assets/admin/js/sidebar-menu.js')}}"></script>
  <!-- Custom scripts -->
  <script src="{{asset('public/assets/admin/js/app-script.js')}}"></script>
  <script src="{{asset('public/assets/admin/js/formValidation.js')}}"></script>
  <script type="text/javascript">
    @if(Session::has('success'))
        success_noti("{{ Session::get('success') }}");
    @endif

    @if(Session::has('error'))
        error_noti("{{ Session::get('error') }}");
    @endif

    @if (count($errors) > 0)
        @foreach($errors->all() as $error)
            error_noti("{{ $error }}");
        @endforeach
    @endif
</script>
   
</body>
</html>