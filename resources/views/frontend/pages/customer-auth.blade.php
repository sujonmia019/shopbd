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


    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="m-0 text-center">Registration</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('customer.reg.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Your Name</label>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control rounded-0 @error('name') is-invalid @enderror" placeholder="Enter your name">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input type="text" name="email" value="{{ old('emails') }}" class="form-control rounded-0 @error('email') is-invalid @enderror" placeholder="Enter your email">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control rounded-0 @error('password') is-invalid @enderror" placeholder="Enter your password">
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-success btn-sm rounded-0" value="Registration">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->



@endsection

