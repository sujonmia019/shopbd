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
                    <h3 class="text-dark d-flex justify-content-between m-0">Coupon List
                    </h3>
                </div>
                <div class="card-body">
                    <table id="brandTable" class="table table-striped table-bordered table-responsive text-dark">
                        <thead>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Discount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($Coupon as $value)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->discount }} %</td>
                                    <td>
                                        @if ($value->status == 1)
                                            <span class="badge badge-primary font-weight-normal">Published</span>
                                        @else
                                            <span class="badge badge-danger font-weight-normal">Pending</span>
                                        @endif
                                    </td>
                                    <td>

                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('admin.coupon.edit',$value->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-sm" title="Edit"></i></a>

                                            <button onclick="deleteCoupon({{ $value->id }})" class="btn btn-danger btn-sm mx-1"><i class="fa fa-trash-alt" title="Delete"></i></button>

                                            <form id="delete-form-{{ $value->id }}" action="{{ route('admin.coupon.destroy',$value->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                            </form>

                                            @if ($value->status == 1)
                                                <a href="{{ route('admin.product-coupon.pending',$value->id) }}" class="btn btn-danger btn-sm" title="Pending"><i class="fa fa-arrow-down"></i></a>
                                            @else
                                                <a href="{{ route('admin.product-coupon.publish',$value->id) }}" class="btn btn-success btn-sm" title="Published"><i class="fa fa-arrow-up"></i></a>
                                            @endif

                                        </div>
                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-dark d-flex justify-content-between m-0">Add Coupon</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.coupon.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Coupon Name</label>
                            <input type="text" name="coupon_name" class="form-control @error('coupon_name') is-invalid @enderror" placeholder="coupon name" required>
                            @error('coupon_name')
                                <span class="text-danger font-weight-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Coupon Discount</label>
                            <input type="number" name="discount" class="form-control @error('discount') is-invalid @enderror" placeholder="coupon discount %" required>
                            @error('discount')
                                <span class="text-danger font-weight-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" name="publish" value="1" class="form-check-input" id="publish">
                            <label class="form-check-label pl-0" for="publish">Publish</label>
                            @error('publish')
                                <span class="text-danger font-weight-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary">Add Coupon</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('swetalertjs')
    <script>
        function deleteCoupon(id){
            swal({
                title: "Are you sure delete?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        event.preventDefault();
                        document.getElementById('delete-form-'+id).submit();
                    }
                    else{
                        swal({
                            title: 'Your data safe !',
                            icon: 'success',
                        });
                    }
            });
        }

    </script>
@endpush
