<div class="left-side-menu">

    <div class="slimscroll-menu">

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <div class="user-box">

                <div class="float-left">
                    <img src="{{ asset('public/backend/images/users/avatar-1.jpg') }}"
                        alt="" class="avatar-md rounded-circle">
                </div>
                <div class="user-info">
                    <div class="dropdown">
                        <a href="javascript:void()" class="dropdown-toggle">
                            {{ ucwords(Auth::user()->name) }} 
                        </a>
                    </div>
                    <p class="font-13 text-muted m-0">Administrator</p>
                </div>
            </div>

            <ul class="metismenu" id="side-menu">

                {{-- Admin Request  --}}
                @if (Request::is('admin*'))

                    <li>
                        <a href="{{ url('/home') }}" class="waves-effect {{ Request::is('/home')?'active':'' }}">
                            <i class="mdi mdi-home"></i>
                            <span> Dashboard </span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/') }}" target="_blank" class="waves-effect">
                            <i class="ion ion-ios-globe"></i>
                            <span> Visit Site </span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.user.index') }}" class="waves-effect {{ Request::is('admin/user*')?'active':'' }}">
                            <i class="mdi mdi-account"></i>
                            <span> User </span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.category.index') }}" class="waves-effect {{ Request::is('admin/category*')?'active':'' }}">
                            <i class="ion ion-ios-pricetag"></i>
                            <span> Category </span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.brand.index') }}" class="waves-effect {{ Request::is('admin/brand*')?'active':'' }}">
                            <i class="ion ion-ios-pricetags"></i>
                            <span> Brand </span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.product.index') }}" class="waves-effect {{ Request::is('admin/product*')?'active':'' }}">
                            <i class=" mdi mdi-cart"></i>
                            <span> Product </span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.coupon.index') }}" class="waves-effect {{ Request::is('admin/product-coupon*')?'active':'' }}">
                            <i class="mdi mdi-home"></i>
                            <span> Coupon </span>
                        </a>
                    </li>
                    


                @endif
                


                {{-- Author Request --}}
                @if (Request::is('author*'))
                    
                    <li>
                        <a href="{{ url('author/dashboard') }}" class="waves-effect {{ Request::is('author/dashboard')?'active':'' }}">
                            <i class="mdi mdi-home"></i>
                            <span> Dashboard </span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/') }}" target="_blank" class="waves-effect">
                            <i class="ion ion-ios-globe"></i>
                            <span> Visit Site </span>
                        </a>
                    </li>

                    
                @endif
                
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>