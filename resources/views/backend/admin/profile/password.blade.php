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
                        <li class="breadcrumb-item">Password</li>
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
                    <p class="font-weight-bold lead m-0">Password
                    </p>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.password.store') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="col-lg-4 form-group">
                                <label>Old Password</label>
                                <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" placeholder="old password">
                                @error('old_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-4 form-group">
                                <label>New Password</label>
                                <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" placeholder="new password">
                                @error('new_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-4 form-group">
                                <label>Confirm Password</label>
                                <input type="password" name="confirm_password"  class="form-control @error('new_password') is-invalid @enderror" placeholder="confirm password">
                                @error('confirm_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        </div>
                        <!-- /.card-body -->

                    </form>
                </div>
            </div>
        </div>
        
    </div>
@endsection


