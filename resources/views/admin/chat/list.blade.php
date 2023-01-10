@extends('admin.layouts.master')
@section('title')Chat | Users Chat @endsection
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void();"></a>Users Chat</li>
                </ol>
            </div>
         
            <div class="col-sm-3">
                <div class="btn-group float-sm-right">
                    <!-- <a href="{{route('forum.create')}}" class="btn btn-behance text-white btn-sm waves-effect waves-light add_data"><i class="fa fa-plus mr-1"></i> Add Forum </a> -->
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div id="messages"></div>
                <div class="card">
                    <div class="card-header"><i class="zmdi zmdi-email"></i> Users Chat</div>
                    <div class="card-body">
                        <div class="row"> 
                            <div class="form-group col-md-4">
                                <!-- <label>Select User*</label> -->
                                <select class="form-control select2" name="user_id" required id="user_id">
                                  <option value="">Select User</option>
                                  @foreach($user_list as $user)
                                    <option value="{{$user->id}}">{{ucwords($user->first_name.' '.$user->last_name)}}</option>
                                  @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <!-- <label>Select Another User*</label> -->
                                <select class="form-control select2" name="another_user_id" required id="another_user_id">
                                  <option value="">Select Another User</option>
                                  @foreach($user_list as $user)
                                    <option value="{{$user->id}}">{{ucwords($user->first_name.' '.$user->last_name)}}</option>
                                  @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <!-- <button type="button" class="btn btn-primary" id="getMsg">Get Messages</button> -->
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="card shadow-none">
                                    <div class="card-body" id="msgBox">
                                        <div class="col-sm-4 offset"></div>
                                        <div class="col-md-8" id="chatscreen" style="overflow-y: scroll; height: 40vh;">
                                            <div id="inner">

                                            </div>
                                            <br>
                                            <form method="post" id="sendmsg">
                                                @csrf
                                                <input type="text" class="form-control" placeholder="Enter message..." rows="2" name="message" id="msg">
                                                <input type="hidden" name="room_id" value="" id="room_id">
                                                <input type="hidden" name="user_id" value="" id="userId">
                                                <br>
                                                <button type="submit" class="btn btn-primary btn-sm">Send</button>
                                            </form>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                                                
                    </div>
                </div>
            </div>
        </div><!-- End Row-->
    </div>
    <!-- End container-fluid-->
</div><!--End content-wrapper-->
@endsection
@section('script')
    <script type="text/javascript">        
        $("#chat").addClass("active");
        $("#getMsg").hide();
        $("#msgBox").hide();

        $('#another_user_id').on('change', function(){
            if($('#user_id').val() != '' && $('#another_user_id').val() != ''){
                $("#getMsg").show();
            }
            else{
                $("#getMsg").hide();
                $("#msgBox").hide();
            }
        });

        $('#user_id').on('change', function(){
            if($('#another_user_id').val() != '' && $('#user_id').val() != ''){
                $("#getMsg").show();
            }
            else{
                $("#getMsg").hide();
                $("#msgBox").hide();
            }
        });

        // $('#user_id').on('change', function(){
        //     $("#getMsg").hide();
        //     $("#msgBox").hide();
        //     var user_id = $(this).val();
        //     if(user_id){
        //         $.ajax({
        //             type : "GET",
        //             url : "{{url('admin/chat/get_another_user')}}/"+user_id,
        //             //dataType : "json",
        //             success : function(data){
        //                 console.log(data);
        //                 if(data){
        //                     $("#another_user_id").empty();
        //                     $("#another_user_id").append('<option value="">--Select Another User--</option>');
        //                     $("#another_user_id").append(data);
        //                 }
        //             }
        //         }); 
        //     }else{
        //         $('#another_user_id').html('<option value="">Select User first</option>');
        //         $("#getMsg").hide();
        //     }
        // });


        
        // $('#getMsg').on('click', function(){
        //     let user_id = $('#user_id').val();
        //     let another_user_id = $('#another_user_id').val();
        //     load_messages(user_id, another_user_id);
        //     btnClick = true;
        // });

        var scrolled = false;
        var lastScroll = 0;
        var count = 0;
        $("#chatscreen").on("scroll", function() {
            var nextScroll = $(this).scrollTop();
            if (nextScroll <= lastScroll) {
                scrolled = true;
            }
            lastScroll = nextScroll;
        
            //console.log(nextScroll, $("#inner").height(), lastScroll)
            if ((nextScroll + 100) == $("#inner").height()) {
                scrolled = false;
            }
        });
     
        function updateScroll(){
            if(!scrolled){
                var element = document.getElementById("chatscreen");
                var inner = document.getElementById("inner");
                element.scrollTop = inner.scrollHeight;
            }
        }

        //send msg
        $('#sendmsg').on('submit', function(e){
            e.preventDefault();
            var user_id = $('#user_id').val();
            var form = $(this);
            $.ajax({
                url:"{{url('admin/chat/sendMsg')}}",
                data: form.serialize(),
                method:"post",
                success:function(data){
                    console.log(data);
                    updateScroll();
                    $("#msg").val("");
                }
            });
        });

        // load messages
        function load_messages(user_id, another_user_id){
            $.ajax({
                url:"{{url('admin/chat/getMsgs/')}}/"+user_id+'/'+another_user_id,
                method:"get",
                success:function(data){
                    //console.log(data);
                    if(data != "No Message Found."){
                        $("#msgBox").show();
                        $('#inner').html(data.msgs);
                        $('#room_id').val(data.room_id);
                        $('#userId').val(data.user_id);
                    }
                    // else{
                    //     $("#msgBox").hide();
                    //     $('#inner').html('');
                    // }
                }
            });            
        }

        setInterval(check, 1000);

        function check(){
            let user_id = $('#user_id').val();
            let another_user_id = $('#another_user_id').val();
            if(user_id != '' && another_user_id != ''){
                load_messages(user_id, another_user_id);
                updateScroll();
            }
        }
    </script>
@endsection