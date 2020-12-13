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
                        <h2>My Order</h2>
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
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <th>ID</th>
                                    <th>Invoice</th>
                                    <th>Product Name</th>
                                    <th>Payment Method</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($Order as $item)
                                        <tr>
                                            <td># {{ $item->id }}</td>
                                            <td>{{ $item->invoice_no }}</td>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->payment }}</td>
                                            <td>৳ {{ $item->total }}</td>
                                            <td>
                                                <a href="{{ route('customer.order.view',$item->id) }}" class="btn btn-sm btn-primary"><i class=" fa fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>




@endsection

