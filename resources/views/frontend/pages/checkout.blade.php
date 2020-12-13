@extends('frontend.layouts.frontend_master')

@section('frontend_content')

    <!-- Hero Section Begin -->
    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span class="font-weight-normal">All Category</span>
                        </div>
                        <ul>
                            @foreach ($Cart as $item)
                                <li><a href="#">{{ $item->category->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="#">
                                <input type="text" placeholder="What do yo u need?">
                                <button type="submit" class="site-btn">SEARCH</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+65 11.188.888</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('public/frontend') }}/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ url('/') }}">Home</a>
                            <span>Shopping Cart</span>
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
                    @if (Session::has('coupon'))

                    @else
                        <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="{{ route('product.cart') }}">Click here</a> to enter your code
                    </h6>
                    @endif

                </div>
            </div>
            <div class="checkout__form">
                <h4>Billing Details</h4>
                <form action="{{ route('customer.order.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>First Name<span>*</span></p>
                                        <input type="text" name="first_name">
                                        @error('first_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input type="text" name="last_name">
                                        @error('last_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" name="address" placeholder="Street Address" class="checkout__input__add">
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Town/City<span>*</span></p>
                                        <input type="text" name="city">
                                        @error('city')
                                            <span class="text-danger">{{ $message }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Country/State<span>*</span></p>
                                        <input type="text" name="state">
                                        @error('state')
                                            <span class="text-danger">{{ $message }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="checkout__input">
                                <p>Postcode / ZIP<span>*</span></p>
                                <input type="text" name="postcode">
                                @error('postcode')
                                    <span class="text-danger">{{ $message }}</span>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text" name="phone" >
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text" name="email" value="{{ Auth::user()->email }}">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Order notes<span>*</span></p>
                                <input type="text" name="order_note" placeholder="Notes about your order, e.g. special notes for delivery.">
                                @error('order_note')
                                    <span class="text-danger">{{ $message }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order" style="background: #ccc6;">
                                <h4 class="font-weight-normal">Your Order</h4>

                                @foreach ($cartProduct as $item)
                                    <ul>
                                        <li>{{ Str::of($item->product->product_name)->limit(15) }} <span>৳ {{ $item->price }} x {{ $item->qty }}</span></li>
                                    </ul>
                                @endforeach

                                @if (Session::has('coupon'))
                                    <ul>
                                        <li class=" font-weight-bold text-dark">Subtotal <span>৳ {{ $subTotal }}</span></li>
                                        <li class=" font-weight-bold text-dark">Coupon <span>{{ session::get('coupon')['name'] }}</span></li>
                                        <li class=" font-weight-bold text-dark">Discount <span>{{ session::get('coupon')['discount'] }} % ({{ $discount = $subTotal * session::get('coupon')['discount'] / 100 }} ৳)</span></li>
                                        <li class=" font-weight-bold text-dark">Total <span>৳ {{ $subTotal - session::get('coupon')['discount_amount'] }}</span></li>
                                    </ul>
                                @else
                                    <ul>
                                        <li>Subtotal <span>৳ {{ $subTotal }}</span></li>
                                        <li>Total <span>৳ {{ $subTotal }}</span></li>
                                    </ul>
                                @endif

                                @if (Session::has('coupon'))
                                    <input type="hidden" name="subtotal" value="{{ $subTotal }}">
                                    <input type="hidden" name="coupon_discount" value="{{ session::get('coupon')['discount'] }}">
                                    <input type="hidden" name="total" value="{{ $subTotal - session::get('coupon')['discount_amount'] }}">
                                @else
                                    <input type="hidden" name="subtotal" value="{{ $subTotal }}">
                                    <input type="hidden" name="total" value="{{ $subTotal }}">
                                @endif
                                <ul>
                                    <li class="font-weight-bold text-dark"> Select payment method <span></span></li>
                                </ul>
                                <div class="checkout__input__checkbox">
                                    <label for="payment">
                                        Cash on Dalivery
                                        <input type="checkbox" name="payment_type" id="payment" value="Cash on Delivery">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="paypal">
                                        Paypal
                                        <input type="checkbox" name="payment_type" value="Paypal" value="Paypal" id="paypal">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-md rounded-0 btn-success">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->



@endsection

