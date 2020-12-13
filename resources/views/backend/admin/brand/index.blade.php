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
                        <li class="breadcrumb-item">Brand</li>
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
                    <h3 class="text-dark d-flex justify-content-between m-0">Brand List
                        <a href="{{ route('admin.brand.create') }}" class="btn btn-sm btn-primary waves-effect"><i class="mdi mdi-plus"></i> Add Brand</a>
                    </h3>
                </div>
                <div class="card-body">
                    <table id="brandTable" class="table table-striped table-bordered table-responsive text-dark">
                        <thead>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($Brand as $brands)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $brands->name }}</td>
                                    <td>
                                        @if ($brands->status == 1)
                                            <span class="badge badge-primary font-weight-normal">Published</span>
                                        @else
                                            <span class="badge badge-danger font-weight-normal">Pending</span>
                                        @endif
                                    </td>
                                    <td>

                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('admin.brand.edit',$brands->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-sm" title="Edit"></i></a>

                                            <button onclick="deleteBrand({{ $brands->id }})" class="btn btn-danger btn-sm mx-1"><i class="fa fa-trash-alt" title="Delete"></i></button>

                                            <form id="delete-form-{{ $brands->id }}" action="{{ route('admin.brand.destroy',$brands->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                            </form>

                                            @if ($brands->status == 1)
                                                <a href="{{ route('admin.brand.pending',$brands->id) }}" class="btn btn-danger btn-sm" title="Pending"><i class="fa fa-arrow-down"></i></a>
                                            @else
                                                <a href="{{ route('admin.brand.publish',$brands->id) }}" class="btn btn-success btn-sm" title="Published"><i class="fa fa-arrow-up"></i></a>
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
@endsection

@push('swetalertjs')
    <script>
        function deleteBrand(id){
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

        $('#brandTable').dataTable();
    </script>
@endpush
