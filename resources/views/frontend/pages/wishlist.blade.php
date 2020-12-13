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
                            @foreach ($Category as $item)
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
                        <h2>Wishlist Page</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ url('/') }}">Home</a>
                            <span>Wishlist</span>
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
                        <table class="table table-borderless text-left">
                            <thead>
                                <tr>
                                    <th class="text-left">Products</th>
                                    <th class="text-left">Price</th>
                                    <th class="text-left">Add to Cart</th>
                                    <th class="text-left">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($Wishlists->count() == 0)
                                    <tr>
                                        <td class="text-center" colspan='6'><h5 class="m-0">Your wishlist is currently empty</h5></td>
                                    </tr>
                                @else
                                    @foreach ($Wishlists as $item)
                                    <tr>
                                        <td class="shoping__cart__item">
                                            <img style="width: 80px; height: 80px;" src="{{ asset('public/backend/img/product/'. $item->productInfo->thumbnail_image ) }}" alt="">
                                            <h5>{{ Str::of($item->productInfo->product_name)->limit(50) }}</h5>
                                        </td>
                                        <td>
                                            ৳ {{ $item->productInfo->product_price }}
                                        </td>
                                        <td>
                                            <div class="quantity">
                                                <form action="{{ route('add.to.cart',$item->productInfo->id) }}" method="POST">
                                                    @csrf
                                                    <button id="addCart" type="submit" class="btn btn-sm btn-danger">Add to Cart</button></li>
                                                    <input type="hidden" name="price" value="{{ $item->productInfo->product_price }}">
                                                </form>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('wishlist.destroy',$item->id) }}" class="text-dark"><i class=" fa fa-trash"></i></a>
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
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->



@endsection

