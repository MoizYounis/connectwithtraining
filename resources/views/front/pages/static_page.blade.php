@extends('front.layouts.master')
@section('title')
    {{ $pageData->page_title }} | {{ $gs->title }}
@endsection
@section('content')
    <section class="breadcrums">
        <div class="container" style="max-width: 1223px;">
            <h2>{{ $pageData->page_title }}</h2>
            <input type="hidden" value="{{ $pageData->page_title }}" id="payment_modal">
        </div>
    </section>

    <?= $pageData->page_content ?>

    <!-- The Modal -->
    <div id="myModal1" class="modal" style="z-index: 10244;">
        <!-- Modal content -->
        <div class="modal-content modal-content-paymet-pla">
            <div class="popup-paymet-plan">
                <div class="myModalClosehome-resize1">
                    <span class="myModalClosehome1">&times;</span>
                </div>
                <div class="paymet-plan-hed">
                    <a href="#" class="pay_btn">Pay Online</a>
                    <img src="{{asset('public/assets/front/images/card.png')}}">
                </div>
               <h4>Installment</h4>
               <h3>PAYMENT MADE EASY</h3>
               <div class="enroll_bt">
                   <a href="#" class="pay_btn">Enroll Now</a>
               </div>
            </div>
        </div>
    </div>
    <!--End The Modal -->
@endsection

@section('script')
    <script src="{{ asset('public/assets/front/js/custom.js') }}"></script>
    <script>
        var modal1 = document.getElementById("myModal1");

        //  window.onload = function(){modal1.style.display = "block";};

        $(document).on("click", ".myModalClosehome1", function(event) {
            modal1.style.display = "none";
        });

        window.onclick = function(event) {
            if (event.target == modal1) {
                modal1.style.display = "none";
            }
        }
        let payment_modal = document.getElementById("payment_modal").value;
        if (payment_modal == "Our Payment Plan") {
            window.onload = function() {
                modal1.style.display = "block";
            };
        }
    </script>
@endsection
