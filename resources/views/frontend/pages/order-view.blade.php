@extends('frontend.layouts.frontend_master')

@section('frontend_content')
    <style>
        .mytable tr td {
            padding: 10px 5px !important;
        }
    </style>
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
                        <h2>My Order Details</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="text-center">
                                <img width="150px" height="150px" class="rounded-circle" src="{{ asset('public/backend/img/profile/default.png') }}" alt="">
                            </div>

                            <ul class="list-group mt-2">
                                <a class="btn btn-sm btn-outline-primary btn-block rounded-0" href="{{ route('customer.dashboard') }}">Dashboard</a>
                                <a class="btn btn-sm btn-primary btn-block rounded-0" href="{{ route('customer.my.order') }}">My Order</a>
                                <a class="btn btn-sm btn-outline-primary btn-block rounded-0" href="">My Profile</a>

                                <a class="btn btn-sm btn-danger btn-block rounded-0" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">Logout</a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>

                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9">
                    <div class="card mt-3">
                        <div class="card-body" id="table">
                            <table class="mytable" width="100%" border="1">
                                <tr>
                                    <td width="30%" class="text-center">
                                        <img src="{{ asset('public/frontend/img/logo.png') }}" alt="">
                                    </td>
                                    <td width="40%" class="text-center">
                                        <h4><strong>ShopMama</strong></h4>
                                        <span><strong>E-mail:</strong> sujonbdjoin@gmail.com</span><br>
                                        <span><strong>Address:</strong> Mirpur-1, Dhaka </span>
                                    </td>
                                    <td width="30%" class="text-center">
                                        <strong>Invoice No:&nbsp; #{{ $Order->invoice_no }}</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Billing info:</strong></td>
                                    <td colspan="2">
                                        <span><strong>Name:</strong> {{ $Shipping->fname }} {{ $Shipping->lname }}</span>&nbsp;&nbsp;&nbsp;&nbsp;

                                        <span><strong>E-mail:</strong> {{ $Shipping->email }}</span>&nbsp;&nbsp;&nbsp;&nbsp;

                                        <span><strong>Mobile:</strong> {{ $Shipping->phone }}</span><br>

                                        <span><strong>Address:</strong> {{ $Shipping->address }}</span>&nbsp;&nbsp;&nbsp;&nbsp;

                                        <span><strong>City:</strong> {{ $Shipping->city }}</span>&nbsp;&nbsp;&nbsp;&nbsp;

                                        <span><strong>State:</strong> {{ $Shipping->state }}</span>&nbsp;&nbsp;&nbsp;&nbsp;

                                        <span><strong>Post-Code:</strong> {{ $Shipping->postcode }}</span>
                                    </td>
                                </tr>
                            </table>

                            <table class="mytable" width="100%" border="1">
                                <tr>
                                    <td class="text-center" colspan="4"><h5><strong>Order Details</strong></h5></td>
                                </tr>
                                <tr>
                                    <td width="40%" class="text-center">Product Name </td>
                                    <td width="20%" class="text-center">Product image</td>
                                    <td width="10%" class="text-center">Quantity</td>
                                    <td width="20%" class="text-center">Product Price</td>
                                </tr>
                                @foreach ($OrderDetails as $item)
                                    <tr>
                                        <td>{{ $item->product->product_name }}</td>
                                        <td class="text-center">
                                            <img width="80px" src="{{ asset('public/backend/img/product/'.$item->product->thumbnail_image) }}" alt="">
                                        </td>
                                        <td class="text-center">{{ $item->product_qty }}</td>
                                        <td class="text-center">
                                            ৳ {{ $item->product->product_price }}
                                        </td>
                                    </tr>
                                @endforeach
                                    @if ($Order->coupon_discount)
                                        <tr>
                                            <td colspan="3" class="text-right">
                                                <strong>Subtotal:</strong>
                                            </td>
                                            <td class="text-center">
                                                <strong>
                                                    ৳ {{ $Order->subtotal }}
                                                </strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-right">
                                                <strong>Discount:</strong>
                                            </td>
                                            <td class="text-center">
                                                <strong>
                                                    ৳ {{ $Order->subtotal * $Order->coupon_discount / 100}}&nbsp;({{ $Order->coupon_discount }}%)
                                                </strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-right">
                                                <strong>Grand Total:</strong>
                                            </td>
                                            <td class="text-center">
                                                <strong>
                                                    ৳ {{ $Order->total }}
                                                </strong>
                                            </td>
                                        </tr>
                                    @else
                                        <td colspan="3" class="text-right">
                                            <strong>Grand Total:</strong>
                                        </td>
                                        <td class="text-center">
                                            <strong>
                                                ৳ {{ $Order->total }}
                                            </strong>
                                        </td>
                                    @endif

                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>




@endsection

