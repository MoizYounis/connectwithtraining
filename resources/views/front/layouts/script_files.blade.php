    

     <!--notification js -->

<script src="{{asset('public/assets/front/notifications/js/lobibox.min.js')}}"></script>

<script src="{{asset('public/assets/front/notifications/js/notifications.min.js')}}"></script>
<script src="{{asset('public/assets/front/notifications/js/notification-custom-script.js')}}"></script>

<script src="{{asset('public/assets/front/js/stripe.js')}}"></script>
<!--<script src="{{asset('public/assets/front/js/main.js')}}"></script>-->
{{-- newly added by --}}
{{-- <script src="{{asset('public/assets/front/js/bootstrap.min.js')}}"></script>
<script src="{{asset('public/assets/front/js/popper.min.js')}}"></script> --}}
{{-- <script src="{{asset('public/assets/front/js/vendor/modernizr-3.6.0.min.js')}}"></script>
<script src="{{asset('public/assets/front/js/vendor/wow.min.js')}}"></script> --}}
{{-- <script src="{{asset('public/assets/front/js/plugins.js')}}"></script>
<script src="{{asset('public/assets/front/js/lazysizes.js')}}"></script>
<script src="{{asset('public/assets/front/js/main.js')}}"></script> --}}





<script type="text/javascript">

function googleTranslateElementInit() {

  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');

}

</script>



<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>


<script>

    const baseUrl = '<?= url('/'); ?>';

    @if(Session::has('success'))

        round_success_noti("{{ Session::get('success') }}");

    @endif

    

    @if(Session::has('error'))

        round_error_noti("{{ Session::get('error') }}");

    @endif

    

    @if (count($errors) > 0)

        @foreach($errors->all() as $error)

            round_error_noti("{{ $error }}");

        @endforeach

    @endif

</script>

<script>

	jQuery("body").on("click","input[type='radio']",function(){

		jQuery('.area-active').removeClass('area-active')

		jQuery(this).parents('li').addClass('area-active');

	});

	

// 	jQuery("body").on("click",".mob-menu", function(){

// 		jQuery(".navbar-nav").toggle();

	

// 	});

	

	$('.mob-menu').click(function(){

	    $(".mobile-nav-wrapper").toggle();

	});

	

</script>

<script type="text/javascript">

// Use the conventional $ prefix for variables that hold jQuery objects.

var $slider1;



// If the only purpose of the windowWidth() function is to set the slide variables,

// it can be renamed and rewritten to supply the full configuration object instead.

function buildSliderConfiguration1() {

  // When possible, you should cache calls to jQuery functions to improve performance.

  var windowWidth = $(window).width();

  var numberOfVisibleSlides;



  if (windowWidth < 420) {

    numberOfVisibleSlides = 1;

  }

  else if (windowWidth < 768) {

    numberOfVisibleSlides = 1;

  }

  else if (windowWidth < 1200) {

    numberOfVisibleSlides = 1;

  }

  else {

    numberOfVisibleSlides = 1;

  }



  return {

    pager: false,

    controls: true,

    auto: false,

    slideWidth: 5000,

    startSlide: 0,

    nextText: ' ',

    prevText: ' ',

    adaptiveHeight: true,

    moveSlides: 1,

    slideMargin: 20,

    minSlides: numberOfVisibleSlides,

    maxSlides: numberOfVisibleSlides

  };

}



// This function can be called either to initialize the slider for the first time

// or to reload the slider when its size changes.

function configureSlider1() {

  var config = buildSliderConfiguration1();



  if ($slider1 && $slider1.reloadSlider) {

    // If the slider has already been initialized, reload it.

    $slider1.reloadSlider(config);

  }

  else {

    // Otherwise, initialize the slider.

    $slider1 = $('.pmp-slider-outer').bxSlider(config);

  }

}



$('.slider-prev').click(function () {

  var current = $slider1.getCurrentSlide();

  $slider1.goToPrevSlide(current) - 1;

});

$('.slider-next').click(function () {

  var current = $slider1.getCurrentSlide();

  $slider1.goToNextSlide(current) + 1;

});



// Configure the slider every time its size changes.

$(window).on("orientationchange resize", configureSlider1);

// Configure the slider once on page load.

configureSlider1();

 

</script>



<script>

	jQuery("body").on("click",".menu-tap-outer ul > li",function(){

		jQuery(".menu-tap-outer ul li").removeClass("active");

		jQuery(this).addClass("active");

	})

	jQuery("body").on("click","input[type='radio']",function(){

		jQuery('.area-active').removeClass('area-active')

		jQuery(this).parents('li').addClass('area-active');

	})

	jQuery("body").on("click",".mob-menu", function(){



		jQuery(".navbar-nav").toggle();

	

	})
	
	$(".top-arrow").on("click", function() {
	    $("html").animate({ scrollTop: 0 }, "slow");
    });

    var c_code = $('.currencyList :selected').text().substring(0,2);
    $('.flags_img').addClass("iso_"+c_code);
</script>

