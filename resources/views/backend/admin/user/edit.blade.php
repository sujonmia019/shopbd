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
                        <li class="breadcrumb-item">User Edit</li>
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
                    <h3 class="d-flex justify-content-between m-0">Update User
                        <a href="{{ route('admin.user.index') }}" class="btn btn-sm btn-primary waves-effect"><i class="  mdi mdi-arrow-left-thick"></i> Back</a>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.user.update', $Edit->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Full Name</label>
                                <input type="text" name="name" value="{{ $Edit->name }}" class="form-control @error('name') is-invalid @enderror" required>
                                @error('name')
                                    <span class="text-danger font-weight-bold">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label>E-mail</label>
                                <input type="email" name="email" value="{{ $Edit->email }}" class="form-control @error('email') is-invalid @enderror" required>
                                @error('email')
                                    <span class="text-danger font-weight-bold">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label>UserType</label>
                                <select name="user_type" class="form-control @error('user_type') is-invalid @enderror" required>
                                    <option value="">--Select One--</option>
                                    <option {{ $Edit->role->name=='Admin'?'selected':'' }} value="Admin">Admin</option>
                                    <option {{ $Edit->role->name=='Author'?'selected':'' }} value="Author">Author</option>
                                </select>
                                @error('user_type')
                                    <span class="text-danger font-weight-bold">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
@endsection
