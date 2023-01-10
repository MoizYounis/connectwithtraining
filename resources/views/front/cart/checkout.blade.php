@extends('front.layouts.master')
@section('title')Checkout | {{$gs->title}} @endsection
@section('content')

<section class="breadcrums">
        <div class="container" style="max-width: 1223px;">
            <h2 >Checkout</h2>    
        </div>
    </section>
    <section class="cart-page">
        <div class="row">
            <div class="col-md-12">
                <div class="shopping-cart">
                    <div class="shopping-head">
                        <h4>Continue Shopping</h4>
                        <p class="pro-item"></p>
                        <div class="cart-icon emptyCart" style="cursor:pointer;">
                            <i class="fa fa-shopping-cart">Empty Cart</i>
                        </div>
                    </div>
                    <div class="fliter">
                        <div class="filter-section">
                            <div class="filter-cart">
                                <input type="checkbox" id="checkAll" style="width:auto;">
                                <i class="fa fa-minus" aria-hidden="true"></i>
                                <h2>ALL</h2>
                            </div>
                            <div class="filter-cart">
                                <h2>Add Checked Items to Favorites</h2>
                            </div>
                            <div class="filter-cart">
                                <h2>Remove Checked Items</h2>
                            </div>
                        </div>
                    </div>
                    
                    <div class="cartData"></div>
                    
                    <!--<div class="total-cart">-->
                    <!--    <div class="sum">-->
                    <!--        <p class="cartTotalPrice"></p>-->
                    <!--    </div>-->
                    <!--</div>-->
                </div>                        
            </div>
            <!--<div class="col-md-3">-->
            <!--    <div class="cart-summary">-->
            <!--        <div class="live-chat-icon">-->
            <!--            <img src="{{asset('public/assets/front/images/live-chat.png')}}">-->
            <!--            <h2>Live Chat</h2>-->
            <!--        </div>-->
            <!--        <div class="cart-summary-text">-->
            <!--            <div class="cart-head">-->
            <!--                <h3>Order Details</h3>-->
            <!--            </div>-->
            <!--            <div class="cart-body">-->
            <!--                <div class="cart-subtotal">-->
            <!--                    <h4>Subtotal</h4>-->
            <!--                    <p class="subTotal"></p>-->
            <!--                </div>-->
            <!--                <div class="cart-subtotal">-->
            <!--                    <h4>Shipping</h4>-->
            <!--                    <p>${{$gs->shipping_charges}}</p>-->
            <!--                </div>-->
            <!--                <div class="cart-subtotal">-->
            <!--                    <h4>Promo Code</h4>-->
            <!--                    <input type="text" name="" placeholder="Promo Code">-->
            <!--                </div>-->
            <!--                <div class="cart-subtotal">-->
            <!--                    <h4>Tax</h4>-->
            <!--                    <p>-----</p>-->
            <!--                </div>-->
            <!--                <div class="cart-dis">-->
            <!--                    <h4>Discount</h4>-->
            <!--                    <p>$00.00</p>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--            <div class="cart-total">-->
            <!--                <h4>Total</h4>-->
            <!--                <p class="cartTotalPrice"></p>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--        <div class="checkout-btn">-->
            <!--            <a href="{{url('order-summary')}}">View Order Summary</a>-->
            <!--        </div>-->
            <!--        <p class="bottom-cart"><< Continue Shopping</p>-->
            <!--    </div>-->
            <!--</div>-->
        </div>
    </section>
     <section class="cart-page">
        <div class="row">
            <div class="col-md-12">
                <div class="cart-section">
                    <!--<div class="col-md-9">-->
                        
                    <!--    <div class="biling-details">-->
                    <!--        <div class="billing-head">-->
                    <!--            <h2>Billing Details</h2>-->
                    <!--            <p>Your detail information are secure.<span> Privacy Policy </span></p>-->
                    <!--        </div>-->
                    <!--        <div class="billing-text">-->
                    <!--             <div class="billing-info">-->
                    <!--                <div class="fnames">-->
                    <!--                    <label>First Name</label>-->
                    <!--                    <input type="text" id="fname" name="fname" placeholder="First Name" value="{{Auth::user()->first_name}}">-->
                    <!--                </div>-->
                    <!--                <div class="lnames">-->
                    <!--                    <label>Last Name</label>-->
                    <!--                    <input type="text" id="lname" name="lname" placeholder="Last Name" value="{{Auth::user()->last_name}}">-->
                    <!--                </div>-->
                    <!--                <div class="address-1">-->
                    <!--                    <label>Email</label>-->
                    <!--                    <input type="text" id="email" name="email" placeholder="Email" value="{{Auth::user()->email}}">-->
                    <!--                </div>-->
                    <!--                <div class="address-1">-->
                    <!--                    <label>Address</label>-->
                    <!--                    <textarea name="address" id="address" rows="4" placeholder="Enter Address">{{isset($address->address)?$address->address:''}}</textarea>-->
                    <!--                </div>-->
                    <!--                <div class="state-info">-->
                    <!--                    <div class="city">-->
                    <!--                        <label>City</label>-->
                    <!--                        <input type="text" id="city" name="city" placeholder="City" value="{{isset($address->city)?$address->city:''}}">-->
                    <!--                    </div>-->
                    <!--                    <div class="state">-->
                    <!--                        <label>State</label>-->
                    <!--                        <input type="text" id="state" name="state" placeholder="State" value="{{isset($address->state)?$address->state:''}}">-->
                    <!--                    </div>-->
                    <!--                    <div class="zip">-->
                    <!--                        <label>Zip / Postal Code</label>-->
                    <!--                        <input type="text" id="pincode" name="pincode" placeholder="Pincode" value="{{isset($address->pincode)?$address->pincode:''}}">-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--             </div>-->
                    <!--        </div>-->
                    <!--    </div>            -->
                    <!--</div>-->
                    <div class="col-md-3">
                        <div class="cart-summary">
                            <div class="live-chat-icon">
                                <img src="{{asset('public/assets/front/images/live-chat.png')}}">
                                <h2>Live Chat</h2>
                            </div>
                            <div class="cart-summary-text">
                                <div class="cart-head">
                                    <h3>Order Details</h3>
                                </div>
                                <div class="cart-body">
                                    <div class="cart-subtotal">
                                        <h4>Subtotal</h4>
                                        <p class="subTotal"></p>
                                    </div>
                                    <div class="cart-subtotal">
                                        <h4>Shipping</h4>
                                        <p class="shippingCharges"></p>
                                    </div>
                                    <!--<div class="cart-subtotal">-->
                                    <!--    <h4>Promo Code</h4>-->
                                    <!--    <input type="text" name="" placeholder="Promo Code">-->
                                    <!--</div>-->
                                    <!--<div class="cart-subtotal">-->
                                    <!--    <h4>Tax</h4>-->
                                    <!--    <p>-----</p>-->
                                    <!--</div>-->
                                    <!--<div class="cart-dis">-->
                                    <!--    <h4>Discount</h4>-->
                                    <!--    <p>$00.00</p>-->
                                    <!--</div>-->
                                </div>
                                <div class="cart-total">
                                    <h4>Total</h4>
                                    <p class="cartTotalPrice"></p>
                                </div>
                            </div>
                            <div class="checkout-btn">
                                <a href="javascript:void();" class="orderSummary">View Order Summary</a>
                            </div>
                            <p class="bottom-cart"><< Continue Shopping</p>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    

@endsection
@section('script')
<script src="{{asset('public/assets/front/js/custom.js')}}"></script>
<script>
    $(document).ready(function(){
        loadCart();
        
        $('.orderSummary').click(function(){
            checkShippingAddress();
        });
        
        $('.emptyCart').click(function(){
            emptyCart('{{csrf_token()}}');
        });
        
        $("#checkAll").change(function() {
            if (this.checked) {
                $(".checkSingle").each(function() {
                    this.checked=true;
                });
            } else {
                $(".checkSingle").each(function() {
                    this.checked=false;
                });
            }
        });
    });
</script>
@endsection
        