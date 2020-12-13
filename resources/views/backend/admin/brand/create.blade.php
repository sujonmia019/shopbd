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
                        <li class="breadcrumb-item">Category</li>
                    </ol>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <!--Widget-4 -->
    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="d-flex justify-content-between m-0">Add Brand
                        <a href="{{ route('admin.brand.index') }}" class="btn btn-sm btn-primary waves-effect"><i class="  mdi mdi-arrow-left-thick"></i> Back</a>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.brand.store') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Brand Name</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="brand name" required>
                                @error('name')
                                    <span class="text-danger font-weight-bold">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" name="publish" value="1" class="form-check-input" id="publish">
                            <label class="form-check-label pl-0" for="publish">Publish</label>
                            @error('publish')
                                <span class="text-danger font-weight-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-sm mt-4">Add Brand</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
@endsection
