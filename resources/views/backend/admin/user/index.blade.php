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
                        <li class="breadcrumb-item">User</li>
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
                    <h3 class="text-dark d-flex justify-content-between m-0">User List
                        <a href="{{ route('admin.user.create') }}" class="btn btn-sm btn-primary waves-effect"><i class=" ion ion-md-person-add"></i> Add User</a>
                    </h3>
                </div>
                <div class="card-body">
                    <table id="userTable" class="table text-center table-striped table-bordered table-responsive text-dark">
                        <thead>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>User-Type</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($User as $users)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $users->name }}</td>
                                    <td>{{ $users->email }}</td>
                                    <td>{{ $users->role->name }}</td>
                                    <td>
                                        @if ($users->status == 1)
                                            <span class="badge badge-success font-weight-normal">Actived</span>
                                        @else
                                            <span class="badge badge-danger font-weight-normal">Unactived</span>
                                        @endif
                                    </td>
                                    <td>

                                        <div class="d-flex justify-content-center">
                                            {{-- <a href="{{ route('admin.user.edit',$users->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-user-edit" title="User Edit"></i></a> --}}

                                            <button onclick="deleteBtn({{ $users->id }})" class="btn btn-danger btn-sm mx-1"><i class="fa fa-trash-alt" title="User Delete"></i></button>

                                            <form id="delete-form-{{ $users->id }}" action="{{ route('admin.user.destroy',$users->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                            </form>

                                            @if ($users->status == 1)
                                                <a href="{{ route('admin.user.unactive',$users->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-arrow-down" title="Inactive"></i></a>
                                            @else
                                                <a href="{{ route('admin.user.active',$users->id) }}" class="btn btn-success btn-sm"><i class="fa fa-arrow-up" title="Active"></i></a>
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
        function deleteBtn(id){
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
