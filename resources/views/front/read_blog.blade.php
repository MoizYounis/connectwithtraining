@extends('front.layouts.master')
@section('title')Read Blog | {{$blog->blog_title}} @endsection
@section('content')

<section class="breadcrums">
    <div class="container" style="max-width: 1223px;">
        <h2>{{$blog->blog_title}}</h2>
    </div>
</section>

<!--<div class="get_popup">-->
<!--    <div id="myModal1" class="modal fade" role="dialog">-->
<!--      <div class="modal-dialog">-->
        <!-- Modal content-->
<!--        <div class="modal-content" style="background-color: transparent; border: none;">-->
<!--          <div class="modal-header">-->
<!--            <button type="button" class="close" data-dismiss="modal">&times;</button>-->
            <!--         <h4 class="modal-title">Modal Header</h4> -->
<!--          </div>-->
<!--          <div class="modal-body text-center">-->
<!--            <img id="popup-getmore" src="{{asset('public/assets/front/images/get_more_popup.png')}}">-->
<!--          </div>-->
<!--        </div>-->

<!--      </div>-->
<!--    </div>-->
<!--</div>-->
<section class="get_more">
    <div class="row">
        <div class="col-sm-12">
            <p style="font-size: 20px; margin: 20px;">{{strip_tags($blog->blog_content)}}</p>
        </div>
    </div>
</section>

@endsection

@section('script')
<script>
    // $(document).ready(function(){       
    //     $('#myModal1').show();
    // }); 
    
    // // Get the modal
    // var modal = document.getElementById("myModal1");
    
    // // Get the button that opens the modal
    // var btn = document.getElementById("myBtn");
    
    // // Get the <span> element that closes the modal
    // var span = document.getElementsByClassName("close")[0];
    
    // // When the user clicks the button, open the modal 
    // btn.onclick = function() {
    //   modal.style.display = "block";
    // }

    // // When the user clicks on <span> (x), close the modal
    // span.onclick = function() {
    //   modal.style.display = "none";
    // }

    // // When the user clicks anywhere outside of the modal, close it
    // window.onclick = function(event) {
    //   if (event.target == modal) {
    //     modal.style.display = "none";
    //   }
    // }
</script>
@endsection