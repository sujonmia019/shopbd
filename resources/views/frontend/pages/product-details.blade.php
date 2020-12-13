@extends('frontend.layouts.frontend_master')

@section('frontend_content')
<style>
    .featured__item__pic__hover form {
        margin-right: 0;
        list-style: none;
        display: inline-block;
        margin-right: 6px;
    }

    .featured__item__pic__hover form li button#addCart {
        font-size: 16px;
        color: #1c1c1c;
        height: 40px;
        width: 40px;
        line-height: 40px;
        text-align: center;
        border: 1px solid #ebebeb;
        background: #ffffff;
        display: block;
        border-radius: 50%;
        -webkit-transition: all, 0.5s;
        -moz-transition: all, 0.5s;
        -ms-transition: all, 0.5s;
        -o-transition: all, 0.5s;
        transition: all, 0.5s;

    }

    .featured__item__pic__hover li a i {
        position: relative;
        transform: rotate(0);
        -webkit-transition: all, 0.3s;
        -moz-transition: all, 0.3s;
        -ms-transition: all, 0.3s;
        -o-transition: all, 0.3s;
        transition: all, 0.3s;
    }

    .featured__item__pic__hover form li:hover button#addCart {
        background: #7fad39;
        border-color: #7fad39;
    }

    .featured__item__pic__hover form li:hover button#addCart {
        color: #ffffff;
        transform: rotate(360deg);
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
                        <span class="font-weight-normal">All departments</span>
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
<section class="breadcrumb-section set-bg"
    data-setbg="{{ asset('public/frontend') }}/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Product Details</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Home</a>
                        <span>Product</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Product Details Section Begin -->
<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large" src="{{ asset('public/backend/img/product/'.$Product->thumbnail_image) }}" alt="">
                    </div>
                    <div class="product__details__pic__slider owl-carousel">

                        <img data-imgbigurl="{{ asset('public/backend/img/product/'.$Product->image_one) }}"
                            src="{{ asset('public/backend/img/product/'.$Product->image_one) }}" alt="">
                        <img data-imgbigurl="{{ asset('public/backend/img/product/'.$Product->image_two) }}"
                            src="{{ asset('public/backend/img/product/'.$Product->image_two) }}" alt="">
                        <img data-imgbigurl="{{ asset('public/backend/img/product/'.$Product->thumbnail_image) }}"
                            src="{{ asset('public/backend/img/product/'.$Product->image_two) }}" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product__details__text">
                    <h4 style="font-weight: 600; font-size: 25px;line-height: 35px;" class="mb-3">{{ $Product->product_name }}</h4>
                    {{-- review  --}}
                    {{-- <div class="product__details__rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                        <span>(18 reviews)</span>
                    </div> --}}
                    <div class="product__details__price">৳ {{ $Product->product_price }}</div>
                    <p>{!! $Product->short_description !!}</p>
                    <div class="product__details__quantity">
                        
                        <form action="{{ route('product.add.to.cart', $Product->id) }}" method="POST">
                            @csrf
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input name="qty" type="text" value="1" min="1">
                                </div>
                            </div>
                            <input type="hidden" name="price" value="{{ $Product->product_price }}">
                            <button type="submit" class="btn btn-md btn-success">ADD TO CARD</button>
                        </form>
                    </div>
                    <a title="Add on Wishlist" href="{{ route('add.to.wishlist',$Product->id) }}" class=" btn-danger btn rounded-circle"><i class="fa fa-heart"></i></span></a>
                    <ul>
                        <li><b>Availability</b> <span>In Stock</span></li>
                        <li><b>Category</b> <span>{{ $Product->category->name }}</span></li>
                        <li><b>Brand</b> <span>{{ $Product->brand->name }}</span></li>
                        <li><b>Share on</b>
                            <div class="share">
                                
                                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                                <div class="addthis_inline_share_toolbox"></div>
            
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="product__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                aria-selected="true">Description</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <h6>Description</h6>
                                <p>{!! $Product->long_description !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Details Section End -->

<!-- Related Product Section Begin -->
<section class="related-product">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related__product__title">
                    <h2>Related Product</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($Releted_Product as $Product)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="{{ asset('public/backend/img/product/'.$Product->thumbnail_image) }}">
                        <ul class="product__item__pic__hover featured__item__pic__hover">
                            <li><a href="{{ route('add.to.wishlist', $Product->id) }}"><i class="fa fa-heart"></i></a></li>
                            <form action="{{ route('add.to.cart',$Product->id) }}"
                                method="POST">
                                @csrf
                                <li><button id="addCart" type="submit"><i class="fa fa-shopping-cart"></i></button></li>
                                <input type="hidden" name="price" value="{{ $Product->product_price }}">
                            </form>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="{{ route('product.details.show',$Product->product_slug) }}" style="font-size: 18px;"
                            title="{{ $Product->product_name }}">{{ Str::of($Product->product_name)->limit(45) }}</a></h6>
                        <h5>${{ $Product->product_price }}</h5>
                    </div>
                </div>
            </div>
            @endforeach
           
        </div>
    </div>
</section>
<!-- Related Product Section End -->



@endsection
