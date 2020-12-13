@extends('backend.layouts.admin_master')

@section('content')
<!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item">
                            <a href="{{url('admin/dashboard')}}" class="text-white">Home</a>
                        </li>
                        <li class="breadcrumb-item">Coupon</li>
                    </ol>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <!--Widget-4 -->
    <div class="row">

        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-dark d-flex justify-content-between m-0">Edit Coupon
                        <a href="{{ route('admin.coupon.index') }}" class="btn btn-primary btn-sm"><i class="mdi mdi-arrow-left-thick"></i> Back</a>
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.coupon.update', $Edit->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Coupon Name</label>
                            <input type="text" value="{{ $Edit->name }}" name="coupon_name" class="form-control @error('coupon_name') is-invalid @enderror" placeholder="coupon name" required>
                            @error('coupon_name')
                                <span class="text-danger font-weight-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Coupon discount</label>
                            <input type="number" value="{{ $Edit->discount }}" name="discount" class="form-control @error('discount') is-invalid @enderror" placeholder="coupon discount %" required>
                            @error('discount')
                                <span class="text-danger font-weight-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" {{ $Edit->status == 1?'checked':'' }} name="publish" value="1" class="form-check-input" id="publish">
                            <label class="form-check-label pl-0" for="publish">Publish</label>
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


