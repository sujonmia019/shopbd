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
                    <h3 class="text-dark d-flex justify-content-between m-0">Category List
                        <a href="{{ route('admin.category.create') }}" class="btn btn-sm btn-primary waves-effect"><i class="mdi mdi-plus"></i> Add Category</a>
                    </h3>
                </div>
                <div class="card-body">
                    <table id="categoryTable" class="table table-striped table-bordered table-responsive text-dark">
                        <thead>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($Category as $categories)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $categories->name }}</td>
                                    <td>{{ $categories->slug }}</td>
                                    <td>
                                        @if ($categories->status == 1)
                                            <span class="badge badge-primary font-weight-normal">Published</span>
                                        @else
                                            <span class="badge badge-danger font-weight-normal">Pending</span>
                                        @endif
                                    </td>
                                    <td>

                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('admin.category.edit',$categories->id) }}" class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-edit fa-sm"></i></a>

                                            <button onclick="deleteCate({{ $categories->id }})" class="btn btn-danger btn-sm mx-1" title="Delete"><i class="fa fa-trash-alt"></i></button>

                                            <form id="delete-form-{{ $categories->id }}" action="{{ route('admin.category.destroy',$categories->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                            </form>

                                            @if ($categories->status == 1)
                                                <a href="{{ route('admin.category.unactive',$categories->id) }}" class="btn btn-danger btn-sm" title="Pending"><i class="fa fa-arrow-down"></i></a>
                                            @else
                                                <a href="{{ route('admin.category.active',$categories->id) }}" class="btn btn-success btn-sm" title="Published"><i class="fa fa-arrow-up"></i></a>
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
        function deleteCate(id){
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

        $('#categoryTable').dataTable();
    </script>
@endpush
