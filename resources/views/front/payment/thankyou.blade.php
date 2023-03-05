@extends('front.layouts.master')
@section('title')
    Thankyou For Placing Order | {{ $gs->title }}
@endsection
@section('content')
    <section class="breadcrums">
        <div class="container" style="max-width: 1223px;">
            <h2>Training Checkout Thank You</h2>
        </div>
    </section>
    <div class="checkout-thankyou">
        <div class="container container_pmtThnk">
            <div class="checkout-bg">
                <div class="con-img">
                    <img src="{{ asset('public/assets/front/images/thread.png') }}">
                </div>
                <div class="con-text">
                    <h2>Thank You</h2>
                    <p>For subscribing to Connect With Training</p>
                    <div class="con-form">
                        <div class="checkout-info">
                            <h2>Order Details Sent to</h2>
                            <h3>{{ Auth::user()->email }}</h3>
                        </div>
                        <div class="thnakyou-btn">
                            <a href="{{ url('courses') }}">Keep Shopping</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <main id="maincontent" class="page-main">
        <div class="columns">
            <div class="container">
                <div class="popular-course also-like">
                    <h2 class="course-title">You May Also Like</h2>
                    <div class="trendingCourse"></div>
                </div>
            </div>
        </div>
    </main>
    
    <main id="maincontent" class="page-main">
        <div class="columns">
            <div class="container">
                <div class="popular-course also-like">
                    <h2 class="course-title">Popular Courses</h2>
                    <div class="popularCourse"></div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')
    <script src="{{ asset('public/assets/front/js/custom.js') }}"></script>
    <script>
        $(document).ready(function() {
            getRelatedCourse({
                courseStatus: "Trending"
            }, '.trendingCourse', '6', '2', '{{ csrf_token() }}');
            getRelatedCourse({
                courseStatus: ""
            }, '.popularCourse', '6', '2', '{{ csrf_token() }}');
        });

        $('.price-range li').click(function() {
            var priceRange = {
                priceRange: $(this).attr('data-amount')
            };
            filterCourse(priceRange, null, '.traning-outer ul');
        });
        $('#category').change(function() {
            var category = {
                category: $(this).val()
            };
            filterCourse(category, null, '.traning-outer ul');
        });
        $('#search').keyup(function() {
            var search = {
                search: $(this).val()
            };
            filterCourse(search, null, '.traning-outer ul');
        });
        filterCourse(null, null, '.traning-outer ul');
    </script>

    <script>
        // Get the modal
        var modal = document.getElementById("insModal");

        $(document).on("click", ".openInsModal", function(event) {
            $('.emailError').html("");
            $('.phoneError').html("");
            $('.successMsg p').html("");
            $('.inscid').val($(this).attr("data-modalid"));
            modal.style.display = "block";
        });

        $(document).on("click", ".closeInsModal", function(event) {
            modal.style.display = "none";
        });

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

    <script>
        var modal1 = document.getElementById("myModal1");

        //  window.onload = function(){modal1.style.display = "block";};

        $(document).on("click", ".myModalClosehome1", function(event) {
            modal1.style.display = "none";
        });
        $(document).on("click", ".myModalGrab", function(event) {
            event.preventDefault();
            modal1.style.display = "block";
        });

        window.onclick = function(event) {
            if (event.target == modal1) {
                modal1.style.display = "none";
            }
        }


        var timer;
        timer = setInterval(function() {
            modal2.style.display = "block";
        }, 900000);

        var modal2 = document.getElementById("myModal2");

        window.onload = function() {
            var loggedIn = {{ auth()->check() ? 'true' : 'false' }};
            if (loggedIn) {
                modal2.style.display = "block";
            } else {
                modal1.style.display = "block";
                modal2.style.display = "block";
            }

        };

        $(document).on("click", ".myModalClosehome-refer", function(event) {
            modal2.style.display = "none";
        });
        $(document).on("click", ".myModalOpenHome", function(event) {
            event.preventDefault();
            modal2.style.display = "block";
        });

        window.onclick = function(event) {
            if (event.target == modal2) {
                modal2.style.display = "none";
            }
        }
    </script>

    <script>
        document.getElementById("ctg-title").innerHTML = 'Popular Today';

        function myFunction(category) {
            var categoryId = document.getElementById("change-cat");
            var categoryName = categoryId.options[categoryId.selectedIndex].text;
            document.getElementById("ctg-title").innerHTML = categoryName;
        }
    </script>
@endsection
