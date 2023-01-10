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
  <title>Forbidden error - You Don't Have Permission To Access On This Server</title>
  <!--favicon-->
  <link rel="icon" href="{{asset('public/assets/front/img/logo/')}}/{{$gs->favicon}}" type="image/x-icon">
  <!-- Bootstrap core CSS-->
  <link href="{{asset('public/assets/admin/css/bootstrap.min.css')}}" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="{{asset('public/assets/admin/css/animate.css')}}" rel="stylesheet" type="text/css"/>    
  <!-- Custom Style-->
  <link href="{{asset('public/assets/admin/css/css/app-style.css')}}" rel="stylesheet"/>
  
</head>

<body>

<!-- start loader -->
   <div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner" ><div class="loader"></div></div></div></div>
   <!-- end loader -->

<!-- Start wrapper-->
 <div id="wrapper">

    <div class="container">
            <div class="row my-5">
                <div class="col-md-12">
                    <div class="text-center error-pages">
                        <h1 class="error-title text-danger"> 403</h1>
                        <h2 class="error-sub-title text-dark">Forbidden error</h2>

                        <p class="error-message text-dark text-uppercase">You don't have permission to access on this server</p>
                        
                        <div class="mt-4">
                          <a href="{{route('admin_dashboard')}}" class="btn btn-dark btn-round m-1">Go To Home </a>
                          <a href="{{url()->previous()}}" class="btn btn-warning btn-round m-1">Previous Page </a>
                        </div>

                        <div class="mt-4">
                            <p class="">{{$gs->copyright}}</p>
                        </div>
                           
                    </div>
                </div>
            </div>
        </div>
        

 </div><!--wrapper-->


  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('public/assets/admin/js/jquery.min.js')}}"></script>
  <script src="{{asset('public/assets/admin/js/popper.min.js')}}"></script>
  <script src="{{asset('public/assets/admin/js/bootstrap.min.js')}}"></script>  
  <!-- Custom scripts -->
  <script src="{{asset('public/assets/admin/js/app-script.js')}}"></script>
    
</body>
</html>
