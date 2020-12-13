@extends('backend.layouts.admin_master')

@section('content')

<div class="container">
	<div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item p-0">Product</li>
                    </ol>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class=" col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="m-0 text-dark d-flex justify-content-between">Product List
                        <a href="{{ route('admin.product.create') }}" class="btn btn-sm btn-primary waves-effect"><i class="mdi mdi-plus"></i> Add Product</a>
                    </h3>
                </div>

                <div class="card-body">

                    <table id="productTable" class="table table-responsive table-bordered text-center ">
                        <thead>
                            <tr>
                                <th class="text-center">SL</th>
                                <th class="text-center">Product Name</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Category</th>
                                <th class="text-center">Image</th>
                                <th class="text-center">is_approved</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach($Product as $value)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ Str::of($value->product_name)->limit(30)  }}</td>
                                <td>{{ $value->product_qty }}</td>
                                <td>{{ $value->category->name }}</td>
                                <td><img src="{{asset('public/backend/img/product//'.$value->thumbnail_image)}}" width="60px" height="40px" class="rounded" alt=""></td>
                                <td>
                                    @if($value->status == 1)
                                    <span class="badge badge-primary font-weight-normal">Publish</span>
                                    @else
                                    <span class="badge badge-danger font-weight-normal">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center">

                                        <a style="margin: 0 2px;" href="{{ route('admin.product.edit',$value->id)}}" title="Edit" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>

                                        <button onclick="deleteProduct({{ $value->id }})" style="margin: 0 2px;" title="Delete" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>

                                        <form id="delete-form-{{ $value->id }}" action="{{ route('admin.product.destroy',$value->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                        @if($value->status==1)
                                            <a style="margin: 0 2px;" href="{{route('admin.product.pending',$value->id)}}" title="Pending" class="btn btn-danger btn-sm"><i class="fa fa-arrow-down"></i></a>
                                        @else
                                            <a style="margin: 0 2px;" href="{{route('admin.product.publish',$value->id)}}" title="Publish" class="btn btn-success btn-sm"><i class="fa fa-arrow-up"></i></a>
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
    </div>

</div>
@endsection
@push('swetalertjs')
    <script>
        function deleteProduct(id){
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

        $('#productTable').dataTable();
    </script>
@endpush
