<!DOCTYPE html>
<html lang="en">
@php
  $gs = App\Model\General_setting::first();
@endphp

<!-- Mirrored from codervent.com/bulona/demo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 08 May 2019 23:59:35 GMT -->
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>@yield('title')</title>
  <!--favicon-->
  <link rel="icon" href="{{asset('public/assets/admin/images/favicon.ico')}}" type="image/x-icon"/>

  <link rel="stylesheet" href="{{asset('public/assets/admin/plugins/notifications/css/lobibox.min.css')}}"/>
  <!-- Vector CSS -->
  <link href="{{asset('public/assets/admin/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet"/>
  <!-- simplebar CSS-->
  <link href="{{asset('public/assets/admin/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet"/>
  <!-- Bootstrap core CSS-->
  <link href="{{asset('public/assets/admin/css/bootstrap.min.css')}}" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="{{asset('public/assets/admin/css/animate.css')}}" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="{{asset('public/assets/admin/css/icons.css')}}" rel="stylesheet" type="text/css"/>
  <!-- Sidebar CSS-->
  <link href="{{asset('public/assets/admin/css/sidebar-menu.css')}}" rel="stylesheet"/>
  <!-- Custom Style-->
  <link href="{{asset('public/assets/admin/css/app-style.css')}}" rel="stylesheet"/>

  <link href="{{asset('public/assets/admin/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('public/assets/admin/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{asset('public/assets/admin/plugins/summernote/dist/summernote-bs4.css')}}"/>
  <link href="{{asset('public/assets/admin/plugins/dropzone/dropzone.css')}}" rel="stylesheet" type="text/css">
  <style type="text/css">
        .right-msg{
          margin-top: 18px;
          /*float: right;*/
          width: 100%;
          text-align: end;
        }
        .left-msg{
          margin-top: 18px;
          /*float: left;*/
        }
        .right-msg span{
          background-color: #14abef;
          border-radius: 10px;
          padding: 10px;
          color: #fff;
        }
        .left-msg span{
          border-radius: 10px;
          padding: 10px;
          /*margin-top: 20px;*/
          background-color: #f1f1f1;
        }
  </style>
</head>

<body>

   <!-- start loader -->
   <!--<div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner"><div class="loader"></div></div></div></div>-->