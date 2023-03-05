@extends('front.layouts.master')

@section('title')
    Update Payment Info | {{ $gs->title }}
@endsection

@section('content')
    <section class="breadcrums">

        <div class="container" style="max-width: 1223px;">

            <h2>Update Payment Info</h2>

        </div>

    </section>
    {{-- <section>
    <div class="col-sm-3"><p>{{ auth()->user()->card_name }}</p></div>
    <div class="col-sm-3"><p>{{ auth()->user()->card_number }}</p></div>
    <div class="col-sm-3"><p>{{ auth()->user()->expiry_month }}</p></div>
    <div class="col-sm-3"><p>{{ auth()->user()->expiry_year }}</p></div>
    </section> --}}
    <section class="cart-page infoShow">

        <div class="row">

            <div class="col-md-12">

                <div class="cart-section">

                    <div class="col-md-12">

                        <div class="biling-details">

                            <form>
                                <div class="billing-head">

                                    <h2>Credit Card Details</h2>

                                </div>

                                <div class="credit-card">
                                    <div class="form-row row">
                                        <div class="col-xs-12 form-group required card-number">
                                            <lable class="control-lable">
                                                Name on Card : {{ auth()->user()->card_name }}
                                            </lable>
                                        </div>
                                    </div>

                                    <div class="form-row row">
                                        <div class="col-xs-12 form-group card required card-number">
                                            <lable class="control-lable">
                                                Card Number : {{ auth()->user()->card_number }}
                                            </lable>
                                        </div>
                                    </div>

                                    <div class="form-row row">
                                        <div class="col-xs-12 col-md-4 form-group expiration required card-number">
                                            <lable class="control-lable">
                                                Expiration Month : {{ auth()->user()->expiry_month }}
                                            </lable>
                                        </div>

                                        <div class="col-xs-12 col-md-4 form-group expiration required card-number">
                                            <lable class="control-lable">
                                                Expiration Year : {{ auth()->user()->expiry_year }}
                                            </lable>
                                        </div>
                                    </div>
                                </div>
                                <div class="save-card">

                                    <button type="button" id="update_info">Edit <i
                                            class="fa fa-arrow-circle-right"></i></button>

                                </div>

                            </form>

                        </div>



                    </div>

                </div>

            </div>

        </div>

    </section>
    <section class="cart-page paymentSection" style="display:none;">

        <div class="row">

            <div class="col-md-12">

                <div class="cart-section">

                    <div class="col-md-12">

                        <div class="biling-details">

                            <form action="{{ route('save.payment.info') }}" method="post">
                                @csrf
                                <div class="billing-head">

                                    <h2>Credit Card Details</h2>

                                    <p>We have put in place secure measures for protecting your Details - <span> Privacy
                                            Policy </span></p>

                                </div>

                                <div class="credit-card">
                                    <div class="form-row row">
                                        <div class="col-xs-12 form-group required card-number">
                                            <lable class="control-lable">
                                                Name on Card
                                            </lable>
                                            <input type="text" name="card_name" value="{{ auth()->user()->card_name }}"
                                                size="4" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-row row">
                                        <div class="col-xs-12 form-group card required card-number">
                                            <lable class="control-lable">
                                                Card Number
                                            </lable>
                                            <input type="text" name="card_number"
                                                value="{{ auth()->user()->card_number }}" class="form-control card_number"
                                                size="20" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-row row">
                                        <div class="col-xs-12 col-md-4 form-group expiration required card-number">
                                            <lable class="control-lable">
                                                Expiration Month
                                            </lable>
                                            <input type="text" name="expiry_month"
                                                value="{{ auth()->user()->expiry_month }}" size="4"
                                                class="form-control card-expiry-month" size="2" placeholder="MM">
                                        </div>

                                        <div class="col-xs-12 col-md-4 form-group expiration required card-number">
                                            <lable class="control-lable">
                                                Expiration Year
                                            </lable>
                                            <input type="text" name="expiry_year"
                                                value="{{ auth()->user()->expiry_year }}" size="4"
                                                class="form-control card-expiry-year" size="4" placeholder="YYYY">
                                        </div>
                                    </div>
                                </div>
                                <div class="save-card">

                                    <button type="submit">Save Info <i class="fa fa-arrow-circle-right"></i></button>

                                </div>

                            </form>

                        </div>



                    </div>

                </div>

            </div>

        </div>

    </section>
@endsection

@section('script')
    <script type="text/javascript">
        $("#update_info").click(function(e) {
            e.preventDefault();
            $(".paymentSection").css('display', 'block');
            $(".infoShow").css('display', 'none');
        });
    </script>
@endsection
