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

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                @if ($cartProduct->count() == 0)
                                    <tr>
                                        <td colspan='6'><h5 class="m-0">Your cart is currently empty</h5></td>
                                    </tr>
                                @else
                                    @foreach ($cartProduct as $item)
                                    <tr>
                                        <td class="shoping__cart__item">
                                            <img style="width: 80px; height: 80px;" src="{{ asset('public/backend/img/product/'. $item->product->thumbnail_image ) }}" alt="">
                                            <h5>{{ Str::of($item->product->product_name)->limit(50) }}</h5>
                                        </td>
                                        <td class="shoping__cart__price">
                                            ৳ {{ $item->price }}
                                        </td>
                                        <td class="shoping__cart__quantity">
                                            <div class="quantity">
                                                <form action="{{ route('cart.update',$item->id) }}" method="POST">
                                                    @csrf
                                                    <div class="pro-qty">
                                                        <input type="text" name="qty" value="{{ $item->qty }}" min="1">
                                                    </div>
                                                    <button type="submit" class="btn btn-sm btn-outline-info">Update</button>
                                                </form>
                                            </div>
                                        </td>
                                        <td class="shoping__cart__total">
                                            ৳ {{ $item->price * $item->qty }}
                                        </td>
                                        <td class="shoping__cart__item__close">
                                            <a href="{{ route('cart.destroy',$item->id) }}" class="text-dark"><i class=" fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="#" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        @if (Session::has('coupon'))

                        @else
                        <div class="shoping__discount">
                            <h5>Coupon Code</h5>
                            <form action="{{ route('cart.coupon') }}" method="POST">
                                @csrf
                                <input type="text" name="coupon" placeholder="Enter your coupon code">
                                <button type="submit" class="btn text-light rounded-0">APPLY COUPON</button>
                            </form>
                        </div>
                        @endif

                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            @if (Session::has('coupon'))
                                <li>Subtotal <span class="text-dark">৳ {{ $subTotal }}</span></li>

                                <li>Coupon <span class="text-dark">{{ session::get('coupon')['name'] }} <a href="{{ route('coupon.destroy') }}" class="text-danger"><i class="fa fa-trash"></i></span></a></li>

                                <li>Discount <span class="text-dark">৳ {{ session::get('coupon')['discount'] }} % ({{ $discount = $subTotal * session::get('coupon')['discount'] / 100 }} ৳)</span></li>

                                <li>Total <span class="text-dark">৳ {{ $subTotal - session::get('coupon')['discount_amount'] }}</span></li>
                            @else
                                <li>Subtotal <span class="text-dark">৳ {{ $subTotal }}</span></li>
                                <li>Total <span class="text-dark">৳ {{ $subTotal }}</span></li>
                            @endif

                        </ul>

                        @if (Auth::check() && Auth::user()->role->name == 'Customer')
                            <a href="{{ route('customer.checkout.index') }}" class="primary-btn">PROCEED TO CHECKOUT</a>
                        @else
                            <a href="{{ route('customer.login') }}" class="primary-btn">PROCEED TO CHECKOUT</a>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->



@endsection

