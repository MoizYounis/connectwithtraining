@extends('front.layouts.master')

@section('title')
    Select Payment Plan | {{ $gs->title }}
@endsection

@section('content')





    <section class="breadcrums">

        <div class="container" style="max-width: 1223px;">

            <h2>Paymnet Plan</h2>

        </div>

    </section>



    @if (isset($course))
        <section class="payment-plan">

            <div class="select-plan">

                <h4>Select Your</h4>

                <h2>Payment Plan</h2>

            </div>

            <div class="container">

                <div class="select-plan-text">

                    <div class="select-plan-head">

                        <h3>Select a Plan</h3>

                    </div>

                    <div class="select-plan-body">

                        <div class="deposit-plan">

                            <div class="plan-deposit">

                                <input type="radio" name="payment_type" id="payFull" style="width:auto;" checked>

                                <label for="payFull">Pay Full</label>

                            </div>

                            <div class="plan-deposit">

                                <input type="radio" name="payment_type" id="makeInstallments" style="width:auto;">

                                <label for="makeInstallments">Make Installments</label>

                            </div>

                        </div>



                        <div class="plan-amount">

                            @php $price = 0; @endphp

                            @foreach ($course as $c)
                                <div class="plan-choose">

                                    <p>{{ ucwords($c->course_name) }}:</p>

                                    <h5>{{ Helper::changeCurrency($c->course_price) }}</h5>

                                    @php $price += $c->course_price; @endphp

                                </div>
                            @endforeach

                            <div class="plan-choose">

                                <p>Total Course Amount:</p>

                                <h5>{{ Helper::changeCurrency($price) }}</h5>

                            </div>

                            <div class="plan-choose chooseInstallment" style="display:none;">

                                <p>Select # opf Installmets Payments:</p>

                                <select name="" id="noOfInstallment"
                                    onchange="$('#numberInstallment').html($(this).val()); $('.noi').html($('#noOfInstallment').val());">

                                    <option value="2">2</option>

                                    <option value="3">3</option>

                                    <option value="4">4</option>

                                </select>

                            </div>

                            <div class="calculate-btn calculateBtn" style="display:none;">

                                <button>Calculate Installments</button>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="activity">

                    <div class="select-plan-text">

                        <div class="select-plan-head">

                            <h3>Account Activity</h3>

                        </div>

                        <div class="select-plan-body">

                            <div class="plan-amount">

                                <div class="plan-choose">

                                    <p>Course Total:</p>

                                    <h5>{{ Helper::changeCurrency($price) }}</h5>

                                </div>

                                <div class="plan-choose">

                                    <p>Total Amount:</p>

                                    <h5>{{ Helper::changeCurrency($price) }}</h5>

                                </div>

                                <div class="plan-choose">

                                    <p>Number of Installments:</p>

                                    <h5 id="numberInstallment">0</h5>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>



                <div class="activity installmentTable" style="display:none;">

                    <div class="select-plan-text">

                        <div class="select-plan-head emi">

                            <h3>Installment Schedule</h3>

                        </div>

                        <div class="Emi-head"></div>

                    </div>

                    <!--<div class="activity-text">-->

                    <!--    <p>Currency used is US Dollar.</p>-->

                    <!--    <h4>Important: XXXXXXX XXXXXXXXXXXX XXXXXXXXXXXXXXXX XXXXXXXXXXXX XXXXXXXXXXXX XXXXXXX XXX XXXXXXXXXXXX 25,000.00</h4>-->

                    <!--</div>-->

                </div>



            </div>

        </section>



        <div class="activity-btn">

            <button class="selectPayPlanBtn">Select Payment Plan</button>

        </div>



        <div class="charges-count agreementOne" style="display:none;">



            <div class="container">

                <div class="plan-enroll">

                    <div class="Plan Enrollment">

                        <h2>Plan Enrollment</h2>

                    </div>



                    <div class="method">

                        <div class="agreement-text">

                            <p>Please XXXXXX XXXXXXXX XXXXXXX XXXXXXX XXXXXXXXXXX XXXX.</p>

                            <div class="fine-charges">

                                <h2>Finanace Charges</h2>

                                <p>First Installment Ammount</p>

                                <h3 class="firstInstallment"></h3>

                            </div>

                            <div class="fine-charges" style="border-top: none;">

                                <h2>Finanace Charges</h2>

                                <p>Total Amount</p>

                                <h3>{{ Helper::changeCurrency($price) }}</h3>

                            </div>

                            <div class="fine-papra">

                                <p>You have the right XXXXXX XXXXXXXXXXXXX XXXXXXXXXXXXXX XXXXXXXXXXXXXXXX XXXXXXX
                                    XXXXXXXXXXXXXXXXX XXXXXX XXXXXX XXX XXXXXXXX XXXXXXXXXXXXX itemization.<br><br>

                                    XXXXX XXXXX XXXXXX XXXXXXXXXXXXX XXXXXXXXXXXXXX XXXXXXXXXXXXXXXX XXXXXXX
                                    XXXXXXXXXXXXXXXXX XXXXXX XXXXXX.<br><br>

                                    XXXXX XXXXX XXXXXX XXXXXXXXXXXXX XXXXXXXXXXXXXX XXXXXXXXXXXXXXXX XXXXXXX
                                    XXXXXXXXXXXXXXXXX XXXXXX XXXXXX XXXXXX XXXXX XXXXX XXXXXX XXXXXXXXXXXXX XXXXXXXXXXXXXX
                                    XXXXXXXXXXXXXXXX XXXXXXX XXXXXXXXXXXXXXXXX XXXXXX XXXXXX XXXXXX XXXXX XXXXX XXXXXX
                                    XXXXXXXXXXXXX XXXXXXXXXXXXXX XXXXXXXXXXXXXXXX XXXXXXX XXXXXXXXXXXXXXXXX XXXXXX XXXXXX
                                    XXXXXX XXXXX XXXXX XXXXXX XXXXXXXXXXXXX XXXXXXXXXXXXXX XXXXXXXXXXXXXXXX XXXXXXX
                                    XXXXXXXXXXXXXXXX XXXXXX XXXXXX XXXXXX XXXXX XXXXX XXXXXX XXXXXXXXXXXXX XXXXXXXXXXXXXX
                                    XXXXXXXXXXXXXXXX XXXXXXX XXXXXXXXXXXXXXXXX XXXXXX XXXXXX XXXXXXXXXXX XXXXX XXXXXX
                                    XXXXXXXXXXXXX XXXXXXXXXXXXXX XXXXXXXXXXX.<br><br>

                                    XXXXX XXXXX XXXXXX XXXXXXXXXXXXX XXXXXXXXXXXXXX XXXXXXXXXXXXXXXX XXXXXXX
                                    XXXXXXXXXXXXXXXXX XXXXXX XXXXXX<br><br>

                                    XXXXX XXXXX XXXXXX XXXXXXXXXXXXX XXXXXXXXXXXXXX XXXXXXXXXXXXXXXX XXXXXXX
                                    XXXXXXXXXXXXXXXXX XXXXXX XXXXXX XXXXXX XXXXX XXXXX XXXXXX XXXXXXXXXXXXX XXXXXXXXXXXXXX
                                    XXXXXXXXXXXXXXXX XXXXXXX XXXXXXXXXXXXXXXXX XXXXXX XXXXXX XXXXXX XXXXX XXXXX XXXXXX
                                    XXXXXXXXXXXXX XXXXXXXXXXXXXX XXXXXXXXXXXXXXXX XXXXXXX XXXXXXXXXXXXXXXXX XXXXXX XXXXXX
                                    XXXXXX XXXXX XXXXX XXXXXX XXXXXXXXXXXXX XXXXXXXXXXXXXX XXXXXXXXXXXXXXXX XXXXXXX

                                </p>

                            </div>

                        </div>

                    </div>



                    <div class="tution-fees">

                        <div class="fess-text">

                            <h2>Agreement</h2>

                            <p>XXXXX XXXXXXXXXX XXXXXXXX XXXXXXXXX XXXXXXXX XXXXXXXXX XXXXXX XXXXXXXXX XXXX XXXXXXXX.</p>

                            <h3>Spring 2012 Tution & Fees</h3>

                        </div>

                        <div class="fee-papa">

                            <div class="fees-btn">

                                <p>XXXXXXXXX XXXXXXXX XXXXXXXXX XXXX XXXXXX XXXXX XXXXXXXXX X.</p>

                            </div>

                            <div class="fee-part">

                                <p>XXX XXXXXXX XXXXX XXXX XXXXXX XXXXXXX XXX XXXX XXXXX XXXXXXX XX XXXXX XXXXXX XXXX XX

                                    XXXXXX XXXXXXX XXX XXXX XXXX XXXXX XXXXXXX XXXXXX XXXXX XXXXX XXXXX XXXXX XXXXXXX XXXX
                                    XXXXXXXXX XXXXXX XXXXXX XXXXXXXXXX XXXX XXXXXXXXX XXXXXXX XXXXX XXXXXXX XXXXXX XXXXXX
                                    XXXXXXXXXXXXXXX XXXXX XXXX XXXXX XXXXXX XXXXXX XXXXXX XXXXX XXXX XXXXXXXX XXXXXX XXXX
                                    XXXXXXXXXXXXXXX XXXXXX XXXX XXXXXXXX XXXXXXXX XXXXXX XXXX.</p>

                                <div class="fee-calculation">

                                    <div class="plan-amt">

                                        <h4>Plan Amount</h4>

                                        <h2>{{ Helper::changeCurrency($price) }}</h2>

                                    </div>

                                    <div class="plan-amt">

                                        <h4>Total Plan Amount</h4>

                                        <h2>{{ Helper::changeCurrency($price) }}</h2>

                                    </div>

                                    <div class="plan-amt">

                                        <h4>Number of Installments</h4>

                                        <h2 class="noi"></h2>

                                    </div>

                                </div>

                            </div>

                            <div class="emi-schedule">

                                <h2>Installment Schedule</h2>

                                <div class="Emi-head"></div>



                                <div class="end-para">

                                    <p>Important: XXXXXXX XXXXXXXXXXXX XXXXXXXXXXXXXXXX XXXXXXXXXXXX XXXXXXXXXXXX XXXXXXX
                                        XXXXXXXXXXXXXX

                                        XXXXXXXXXX XXXXXXXXXXXX XXXXXXXXXXXXX XXXXXXXXXXXXXXXX XXXXXXXXXXX XXXXXXXXXXXXXX
                                        XXXXXXXXXX XX

                                        XXXXXXXXXXXXXXX XXXXXXXXXXXX XXXXXXXXXXXXXXXX XXXXXXXXXXXX XXXXXXXXXXXX XXXXXXX
                                        XXXXXXXXXXXXXX

                                        XXXXXXXXXX XXXXXXXXXXXX XXXXXXXXXXXXX XXXXXXXXXXXX</p>

                                </div>

                                <div class="agreement-date">

                                    <p>XXXXXXXXXXXXXX XXXXXXXXXX XXXXX XXXX XXXXXXXXXXX XXXXXXX XXX XXXXXXXX XXXX XXX XXXXX
                                        XXXX XXX

                                        XXXXXXXX XXXXXXXXX XXXXXXXX XXXX XXXXXX XXX XXXXXX XXXXXXXX XXXX XXXXX XXXXXX XXXXX
                                        XXX XXXXXX</p>

                                    <div class="payment-agreement">

                                        <div class="pay-text">

                                            <p><span>The agreement is dated:</span> {{ date('d-m-Y') }}</p>

                                        </div>

                                        <div class="pay-check">

                                            <h3> <input type="checkbox" name="" class="agreementOneAgree"
                                                    style="width:auto;"> Yes, I Agree</h3>

                                        </div>

                                    </div>

                                </div>

                                <div class="recal-due-btn">

                                    <button class="agreementOneContinue">Continue</button>

                                    <button class="agreementOnePrint">Print Agreement</button>

                                </div>

                            </div>





                        </div>

                    </div>



                </div>

            </div>

        </div>

        <div id="editor"></div>



        <section class="cart-page paymentSection" style="display:none;">

            <div class="col-md-9">
                {{-- action="{{ url('pay') }}"  --}}
                <form method="post" role="form" class="require-validation" data-cc-on-file="false"
                    data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">

                    @csrf

                    <div class="biling-details">

                        <div class="billing-head">

                            <h2>Billing Details</h2>

                            <p>Your detail information are secure.<span> Privacy Policy </span></p>

                        </div>

                        <div class="billing-text">

                            <div class="billing-info">

                                <div class="fnames">

                                    <label>First Name</label>

                                    <input type="text" id="fname" name="fname" placeholder="First Name"
                                        value="{{ Auth::user()->first_name }}">

                                </div>

                                <div class="lnames">

                                    <label>Last Name</label>

                                    <input type="text" id="lname" name="lname" placeholder="Last Name"
                                        value="{{ Auth::user()->last_name }}">

                                </div>

                                <div class="address-1">

                                    <label>Email</label>

                                    <input type="text" id="email" name="email" placeholder="Email"
                                        value="{{ Auth::user()->email }}">

                                </div>

                                <div class="address-1">

                                    <label>Address</label>

                                    <textarea name="address" id="address" rows="4" placeholder="Enter Address">{{ isset($address->address) ? $address->address : '' }}</textarea>

                                </div>

                                <div class="state-info">


                                    <div class="country">

                                        <label>Country</label>

                                        <input type="text" id="country" name="country" placeholder="Country">

                                    </div>

                                    <div class="state">

                                        <label>State</label>

                                        <input type="text" id="state" name="state" placeholder="State"
                                            value="{{ isset($address->state) ? $address->state : '' }}">

                                    </div>

                                    <div class="city">

                                        <label>City</label>

                                        <input type="text" id="city" name="city" placeholder="City"
                                            value="{{ isset($address->city) ? $address->city : '' }}">

                                    </div>

                                    <div class="zip">

                                        <label>Zip / Postal Code</label>

                                        <input type="text" id="pincode" name="pincode" placeholder="Pincode"
                                            value="{{ isset($address->pincode) ? $address->pincode : '' }}">

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

            </div>

            <div class="row">

                <div class="col-md-12">

                    <div class="cart-section">

                        <div class="col-md-12">

                            <div class="biling-details">



                                <div class="billing-head">

                                    <h2>Credit Card Details</h2>

                                    <p>We have put in place secure measures for protecting your Details - <span> Privacy
                                            Policy </span></p>

                                </div>

                                <div class="credit-card">
                                    @foreach ($courses_id as $course_id)
                                        <input type="hidden" id="courses_id" name="courses_id[]"
                                            value="{{ $course_id }}">
                                    @endforeach
                                    <input type="hidden" id="total_amount" name="total_amount"
                                        value="{{ $price }}">
                                    <input type="hidden" id="total_courses_price" name="total_courses_price"
                                        value="{{ $price }}">
                                    <input type="hidden" id="number_of_installments" name="number_of_installments"
                                        value="1">
                                    <div class="form-row row">
                                        <div class="col-xs-12 form-group required card-number">
                                            <lable class="control-lable">
                                                Name on Card
                                            </lable>
                                            <input type="text" size="4" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-row row">
                                        <div class="col-xs-12 form-group card required card-number">
                                            <lable class="control-lable">
                                                Card Number
                                            </lable>
                                            <input type="text" size="4" class="form-control card_number"
                                                size="20" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-row row">
                                        <div class="col-xs-12 col-md-4 form-group cvc required card-number">
                                            <lable class="control-lable">
                                                CVC
                                            </lable>
                                            <input type="text" size="4" class="form-control card-cvc"
                                                size="4" placeholder="ex. 311">
                                        </div>

                                        <div class="col-xs-12 col-md-4 form-group expiration required card-number">
                                            <lable class="control-lable">
                                                Expiration Month
                                            </lable>
                                            <input type="text" size="4" class="form-control card-expiry-month"
                                                size="2" placeholder="MM">
                                        </div>

                                        <div class="col-xs-12 col-md-4 form-group expiration required card-number">
                                            <lable class="control-lable">
                                                Expiration Year
                                            </lable>
                                            <input type="text" size="4" class="form-control card-expiry-year"
                                                size="4" placeholder="YYYY">
                                        </div>
                                    </div>

                                    <div class="row form-row">
                                        <div class="col-md-12 error form-group hide">
                                            <div class="alert alert-danger">
                                                Please correct the errors and try again.
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="card-number">

                                        <label>Credit Card Number</label>
                                        <div class="in_bx_cc">
                                            <input type="text" name="card_number" value="{{old('card_number')}}">
                                        </div>
                                    </div>

                                    <div class="card-number">

                                        <label>Expiration (MM / YY)</label>
                                        <div class="in_bx_cc">
                                        <input type="text" name="month" value="{{old('month')}}">

                                        <input type="text" name="year" value="{{old('year')}}">
                                    </div>
                                    </div>

                                    <div class="card-number">

                                        <label>Card Validation Code</label>
                                        <div class="in_bx_cc">
                                        <input type="text" name="cvv" value="{{old('cvv')}}">
                                    </div>
                                    </div> --}}

                                </div>

                                <div class="save-card">

                                    <div class="checkbox">

                                        <input type="checkbox" name="save_card" style="width:auto;">

                                        <label>Save Credit Card Details</label>

                                    </div>

                                </div>

                                <div class="save-card">

                                    <button type="submit">Place order <i class="fa fa-arrow-circle-right"></i></button>

                                </div>

                                </form>

                            </div>



                        </div>

                    </div>

                </div>

            </div>

        </section>
    @endif







@endsection



@section('script')
    <script>
        //payment

        $(function() {
            var $form = $(".require-validation");
            $('form.require-validation').bind('submit', function(e) {
                e.preventDefault();
                var $form = $('.require-validation'),
                    inputSelector = ['input[type=email]', 'input[type=password]', 'input[type=text]',
                        'input[type=file]', 'textarea'
                    ].join(', '),
                    $inputs = $form.find('.required').find(inputSelector);
                $errorMessage = $form.find('div.error'),
                    valid = true;
                $errorMessage.addClass('hide');

                $('.has-error').removeClass('has-error');
                $inputs.each(function(i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorMessage.removeClass('hide');
                        e.preventDefault();
                    }
                })

                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card_number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val(),
                    }, stripeResponseHandler);
                }

                $.ajax({
                    type: "POST",
                    url: baseUrl + "/pay",
                    dataType: "json",
                    data: $("#payment-form").serialize(),
                    success: function(response) {
                        if (response.error == 'false') {
                            loadCart();
                            round_success_noti(response.msg);
                        }
                    },
                    error: function(response) {
                        round_error_noti('Connection Error...');
                    }
                })
            });

            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error').removeClass('hide').find('.alert').text(response.error.message)
                } else {
                    // token contains id, last4, and card type
                    var token = response['id'];
                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
                }
            }
        })

        const tabs = document.querySelectorAll('.tab');



        tabs.forEach(tab => {

            tab.addEventListener('click', event => {

                console.log(event.currentTarget); // show what element was clicked in the console

                console.log(event.currentTarget.dataset); // get .dataset Object key from HTML element 



                // Remove 'active' class style from previously selected tab

                document.querySelector('.tab.active')?.classList.remove('active'); // optional chaining



                // Add 'active' class style to selected tab

                event.currentTarget.classList.add('active');



                // Hide previously selected tab's content

                document.querySelector('.content.show').classList.remove('show');



                // Show selected tab's respective content

                const selectedContent = event.currentTarget.dataset
                    .content; // see .dataset console.log() above

                document.querySelector(selectedContent).classList.add('show');

            })

        });
    </script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <script>
        $(document).ready(function() {

            $("#payFull").change(function() {

                if ($("#payFull").prop("checked")) {

                    $('#numberInstallment').html('0');

                    $('.chooseInstallment').hide();

                    $('.installmentTable').hide();

                    $('.calculateBtn').hide();

                    $('.agreementOne').hide();

                    $('.paymentSection').hide();

                }

            });





            $("#makeInstallments").change(function() {

                if ($("#makeInstallments").prop("checked")) {

                    $('#numberInstallment').html($('#noOfInstallment').val());

                    $('.noi').html($('#noOfInstallment').val());

                    $('.chooseInstallment').show();

                    $('.calculateBtn').show();

                    $('.paymentSection').hide();

                }

            });



            $('.calculateBtn').click(function() {

                if ($("#makeInstallments").prop("checked")) {

                    $('.installmentTable').show();



                    var totalPrice =
                        '@if (isset($price)){{ $price }}@endif';

                    var totalInstallment = $('#noOfInstallment').val();

                    var perInstallment = totalPrice / totalInstallment;

                    $('.firstInstallment').html('$' + perInstallment);

                    const d = new Date();

                    var htmlTable =
                        '<table><tr class="tr-head"><th>Due Date</th><th>Installment</th><th>Adminstrative Fee</th><th>Total Installment</th></tr>';


                    let number_of_installment = 0;
                    for (var i = 1; i <= totalInstallment; i++) {

                        htmlTable += '<tr>';

                        htmlTable += '<td>' + d.getDate() + '-' + d.getMonth() + '-' + d.getFullYear() +
                            '</td>';

                        htmlTable += '<td>' + (perInstallment).toFixed(2) + '</td>';

                        htmlTable += '<td>{{ Helper::changeCurrency(00.0) }}</td>';

                        htmlTable += '<td>' + (perInstallment).toFixed(2) + '</td>';

                        htmlTable += '</tr>';
                        $("#total_amount").val((perInstallment).toFixed(2))
                        number_of_installment = i + 1
                    }

                    $("#number_of_installments").val(number_of_installment - 1);
                    $("#total_courses_price").val(totalPrice)
                    htmlTable += '<tr class="tr-bottom"><td>Total</td><td>$' + totalPrice +
                        '</td><td>00.00</td><td>$' + totalPrice + '</td></tr></table>';

                    $('.Emi-head').html(htmlTable);

                }

            });



            $('.selectPayPlanBtn').click(function() {

                if ($("#makeInstallments").prop("checked")) {

                    var totalPrice =
                        '@if (isset($price)){{ $price }}@endif';

                    var totalInstallment = $('#noOfInstallment').val();

                    var perInstallment = totalPrice / totalInstallment;

                    $('.firstInstallment').html('$' + perInstallment);

                    $('.agreementOne').show();



                } else {

                    $('.paymentSection').show();

                }

            });



            $('.agreementOneContinue').click(function() {

                if ($(".agreementOneAgree").prop("checked") == true) {

                    $('.paymentSection').show();

                } else {

                    round_error_noti('Pleact Accept Agreement!');

                }

            });





            $('.agreementOnePrint').click(function() {

                if ($(".agreementOneAgree").prop("checked") == true) {

                    // window.jsPDF = window.jspdf.jsPDF;

                    const doc = new jsPDF();

                    var specialElementHandlers = {

                        '#editor': function(element, renderer) {

                            return true;

                        }

                    };

                    doc.fromHTML($('.agreementOne').html(), 15, 15, {

                        'width': 170,

                        'elementHandlers': specialElementHandlers

                    });

                    doc.save('Agreement.pdf');

                } else {

                    round_error_noti('Pleact Accept Agreement!');

                }



            });



        });
    </script>
    <script>
        var modal1 = document.getElementById("Modal_pamet");

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
    </script>
@endsection
