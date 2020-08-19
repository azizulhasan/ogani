@extends('layouts.front.app')
@section('content')
<x-hero/>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Checkout</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your code
                    </h6>
                </div>
            </div>
            <div class="checkout__form">
                <h4>Billing Details</h4>
                <form action="{{url('placeOrder')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Fist Name<span>*</span></p>
                                        <input type="text" id="first_name" name="first_name">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input type="text" id="last_name" name="last_name">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Country<span>*</span></p>
                                
                                <select name="country_id" class="form-control" id="country_id">
                                    <option value="0">Select Your Country</option>
                                    @if(isset($countries) && count($countries)> 0)
                                    @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{$country->country_name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="checkout__input">
                                <p>Town/City<span>*</span></p>
                                <select name="city_id" id="city_id">
                                    <option value="0">Select Your city</option>
                                    @if(isset($cities) && count($cities)> 0)
                                    @foreach($cities as $city)
                                    <option value="{{$city->id}}">{{$city->city_name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" name="address" id="address" placeholder="Street Address" class="checkout__input__add">
                                <!-- <input type="text" placeholder="Apartment, suite, unite ect (optinal)"> -->
                            </div>
                            <!-- <div class="checkout__input">
                                <p>Country/State/Division<span>*</span></p>
                                <select name="city" id="city">
                                    <option value="0">Select Your city</option>
                                    <option value="1">Bangladesh</option>
                                </select>
                            </div> -->
                            
                            
                            <div class="checkout__input">
                                <p>Postcode / ZIP<span>*</span></p>
                                <input type="text" name="zip_code" id="zip_code">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input name="contact" id="contact" type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input name="email" id="email" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="acc">
                                    Create an account?
                                    <input type="checkbox" name="account" id="acc">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <p id="acc_content" style="display:none;">Create an account by entering the information below. If you are a returning customer
                                please login at the top of the page</p>
                            <div style="display:none;" id="acc_pass" class="checkout__input">
                                <p>Account Password<span>*</span></p>
                                <input type="text" name="password" id="password" >
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="diff-acc">
                                    Ship to a different address?
                                    <input type="checkbox" name="defferent_place" id="diff-acc">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="checkout__input">
                                <p>Order notes<span>*</span></p>
                                <input name="notes" id="notes" type="text"
                                    placeholder="Notes about your order, e.g. special notes for delivery.">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Your Order</h4>
                                <div class="checkout__order__products">Products <span>Total</span></div>
                                <ul>

                                @if(isset($items) && count($items)>0)
                               @foreach($items as  $item)
                                    <li>{{$item->name}} <span> TK {{$item->price}}</span></li>
                                    
                                @endforeach
                               @else
                               <li><h5>Your Cart Is Empty</h5></li>
                               @endif
                                </ul>
                                <div class="checkout__order__subtotal">Subtotal <span>TK {{$subtotal}}</span></div>
                                <div class="checkout__order__total">Total <span>TK {{$total}}</span></div>
                                <div class="checkout__input__checkbox">
                                    <label for="acc-or">
                                        Create an account?
                                        <input type="checkbox" id="acc-or" name="account_or">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <p style="display:none;" id="acc_content_or">Lorem ipsum dolor sit amet, consectetur adip elit, sed do eiusmod tempor incididunt
                                    ut labore et dolore magna aliqua.</p>
                                <div class="checkout__input__checkbox">
                                    <label for="payment">
                                        Check Payment
                                        <input type="checkbox" id="payment">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="paypal">
                                        Paypal
                                        <input type="checkbox" id="paypal">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

@endsection('content')