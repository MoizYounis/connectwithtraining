@extends('front.layouts.master')
@section('title')Refer Program {{$gs->title}} @endsection
@section('content')

<section class="breadcrums">
    <div class="container" style="max-width: 1223px;">
        <h2 >Referral Program</h2>    
    </div>
</section>

<section class="refer_program">
    <div class="container">
       <div class="referprg-prg">
       <a href="{{ url('refer-program-invitation') }}">
           <div class="refer-circle">
               <h2>$500</h2>
               <p>Referral Bonus</p>
           </div>
       </a>
            <div class="refer-prg-text">
                <div class="refer-img">
                    <img src="{{ asset('public/assets/front/images/pen-hand.png') }}">
                    <h2>
                        <span>1x5</span>
                            EVERY<br>
                            SUCCESSFUL<br>
                            MATCHED<br>
                            REFERRAL
                    </h2>
                </div>
                <div class="referral-prgm">
                    <div class="prgm-heading">
                        <h2>referral</h2>
                        <p>Program</p>
                    </div>
                    <div class="prgm-body">
                        <div class="prgm-text-above">
                           <h3>We want to reward you<br>
                            XXXXXXXXXXX XXXXXXXXX XX<br>
                            XXXXXXXXXXX XXXXXXXXX XX</h3>
                            <p>XXXXXXXX XXXXXXXXXX XXXXXXXXXX XXXXXX<br>
                            XXXXXXXXXXX XXXXXXXXX XXXXXXXXXXXXXX X<br>
                            XXXXXXXX XXXXXXXXXXXX XXXXXXXXX XXXXXX<br>
                            XXXXXXXX XXXXXXXXX XXXXXXXX</p> 
                        </div>
                        <div class="prgm-text-mid">
                           <h3>How it works</h3>
                            <p>XXXXXXXX XXXXXXXXXX XXXXXXXXXX XXXXXX<br>
                            XXXXXXXXXXX XXXXXXXXX XXXXXXXXXXXXXX X<br>
                            XXXXXXXX XXXXXXXXXXXX XXXXXXXXX XXXXXX<br>
                            XXXXXXXX XXXXXXXXX XXXXXXXX</p> 
                        </div>
                        <div class="prgm-footer">
                            <h3>We send you</h3>
                            <div class="prgm-price">
                               <h3>$500</h3>
                               <p>cash</p> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-image">
                <img src="assets/images/wave.png">
            </div>
        </div> 
    </div>
    
</section>

@endsection