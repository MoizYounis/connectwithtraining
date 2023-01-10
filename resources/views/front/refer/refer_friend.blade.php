@extends('front.layouts.master')
@section('title')Latest Courses | {{$gs->title}} @endsection
@section('content')

<section class="breadcrums">
        <div class="container" style="max-width: 1223px;">
            <h2>Refer</h2>    
        </div>
    </section>

    <section class="refer">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form method="post">
                        <div class="refer-invite">
                            <div class="class-head">
                                <h2>Invite Your Friends Now</h2>
                            </div>
                            <div class="refer-input">
                                <label>To:</label>
                                <input type="email" name="email" placeholder="enter your email">
                            </div>
                            <div class="refer-input">
                                <label>Subject:</label>
                                <input type="text" name="subject" placeholder="Join me at yes!">
                            </div>
                            <div class="refer-input">
                                <label>Message:</label>
                                <textarea cols="5" style="height: 200px;" name="msg">Hey, I’m going to this event and definitely think you should too! It’s gonna awesome, lets go!</textarea>
                            </div>
                            <div class="refer-btn">
                                <div class="refer-preview">
                                    <button type="submit">Send</button>
                                </div>
                                <div class="refer-cancel">
                                    <button type="reset">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    
                    
                    <!--<div class="preview-option">-->
                    <!--    <div class="option-head">-->
                    <!--        <h2>preview</h2>-->
                    <!--        <a href=""><i class="fa fa-refresh" aria-hidden="true"></i> Refresh</a>-->
                    <!--    </div>-->
                    <!--    <div class="preview-letter">-->
                    <!--        <div class="letter-head">-->
                    <!--            <h2>INVITE YOUR FRIENDS NOW!</h2>-->
                    <!--        </div>-->
                    <!--        <div class="letter-body">-->
                    <!--            <p>Events are way more fun with your peeps! Invite your friends, family,-->
                    <!--            co-workers, anyone you want to share this experience with!</p>-->
                    <!--            <div class="letter-email">-->
                    <!--                <div class="email-icon">-->
                    <!--                    <i class="fa fa-envelope-o" aria-hidden="true"></i>-->
                    <!--                    <h3>SHARE WITH EMAIL</h3>-->
                    <!--                </div>-->
                    <!--                <div class="email-option">-->
                    <!--                    <p><i class="fa fa-smile-o" aria-hidden="true"></i> Don’t worry, you’ll stay in this page!</p>-->
                    <!--                    <p><i class="fa fa-smile-o" aria-hidden="true"></i> We promise not to spam your friends.</p>-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--    <div class="letter-btn">-->
                    <!--        <div class="refer-preview">-->
                    <!--            <a href="">Send</a>-->
                    <!--        </div>-->
                    <!--        <div class="refer-cancel">-->
                    <!--            <a href="">Cancel</a>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                </div>
            </div>
        </div>
    </section>
    
    <!--<div id="myModal" class="modal fade" role="dialog" style="display:none;">-->
    <!--  <div class="modal-dialog">-->
        <!-- Modal content-->
    <!--    <div class="modal-content">-->
    <!--      <div class="modal-header">-->
    <!--        <button type="button" class="close" data-dismiss="modal">&times;</button>-->
            <!--         <h4 class="modal-title">Modal Header</h4> -->
    <!--      </div>-->
    <!--      <div class="modal-body text-center">-->
    <!--        <div class="refer-text">-->
    <!--            <p>Invitation Sent!</p>-->
    <!--            <a href="">Keep Browsing</a>-->
    <!--        </div>-->
    <!--        <div class="share-btn">-->
    <!--            <a class="pre-order-btn" href="#">refer someone-->
    <!--            <h2><i class="fa fa-share-alt" aria-hidden="true"></i> Share More</h2>-->
    <!--            </a>-->
                
    <!--        </div>-->
            
    <!--      </div>-->
    <!--      <div class="modal-footer">-->
            <!--         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
    <!--      </div>-->
    <!--    </div>-->

    <!--  </div>-->
    <!--</div>-->
@endsection

@section('script')
<script >
    $(document).ready(function(){       
        $('form').on('submit', function(event){
            event.preventDefault();
            var form = $(this);
            $.ajaxSetup({
       		    headers: {
       		        'X-CSRF-TOKEN': "{{csrf_token()}}"
       		    }
       		});
            $.ajax({
                url: "referSendMail",
                type: form.attr('method'),
                data: form.serialize(),
                dataType: 'json',
                beforeSend:function(){
                    $('#waitDiv').show();
                },
                success:function(response) {
                    if(response.error == "false"){ round_success_noti(response.msg); }
                    else{ round_error_noti(response.msg);}
                    document.getElementsByTagName("form")[0].reset();
                }
            });
        });
    }); 
</script>
@endsection