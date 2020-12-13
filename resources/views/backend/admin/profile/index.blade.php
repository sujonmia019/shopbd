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
                        <li class="breadcrumb-item">Profile</li>
                    </ol>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <!--Widget-4 -->
    <div class="row">

        <div class="col-lg-4 col-md-4">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                            <span class="badge badge-success font-weight-normal">{{ $User->role->name }}</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="info text-center">
                            <img style="width: 100px; height: 100px;" class="rounded-circle" src="{{ asset('public/backend/img/profile/'.$User->image) }}" alt="">
                       
                        <h4 class="mb-0 mt-1 font-weight-bold lead">{{ $User->name }}</h4>
                        <span>{{ $User->email }}</span>
                    </div>
                    <table class="table table-borderless table-sm mt-5">
                        <tr class=" d-flex justify-content-between">
                            <td class="font-weight-bold">Phone:</td>
                            <td>
                                @if ($User->phone)
                                    {{ $User->phone }}
                                @else
                                    {{ 'Undefind' }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td colspan="12" class="font-weight-bold">Bio:</td>
                        </tr>
                        <tr>
                            <td colspan="12">
                                @if ($User->about)
                                    {{ $User->about }}
                                @else
                                    <span>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum libero corrupti exercitationem molestias id at similique excepturi obcaecati perspiciatis neque?</span>
                                @endif
                            </td>
                        </tr>
                    </table>

                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-8">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <p class="font-weight-bold lead m-0">Update Profile
                    </p>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.profile.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-lg-4 form-group">
                                <label>Full Name</label>
                                <input type="text" value="{{ $User->name }}" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Full Name" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-4 form-group">
                                <label>Email</label>
                                <input value="{{ $User->email }}" class="form-control" disabled>
                            </div>
                            <div class="col-lg-4 form-group">
                                <label>Phone</label>
                                <input type="text" name="phone" value="{{ $User->phone }}" class="form-control" placeholder="phone">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-7 form-group">
                                <label>Bio</label>
                                <textarea name="your_bio" class="form-control" rows="4">
                                    {{ $User->about }}
                                </textarea>
                                @error('your_bio')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-5 form-group">
                                <label>Profile</label>
                                <input type="file" name="profile_image" ><br>
                                @error('profile_image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                        </div>
                        <!-- /.card-body -->

                    </form>
                </div>
            </div>
        </div>
        
    </div>
@endsection


