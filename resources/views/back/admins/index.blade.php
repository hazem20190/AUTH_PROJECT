@extends('back.master')
@section('title', 'Admins')
@section('active-admins', 'active')
@section('content')
    <!-- Basic Bootstrap Table -->
    <div class="card mt-3">
        <!-- Default Modal -->
        <h5 class="card-header">Admins Table</h5>
        <div class="table-responsive text-nowrap">
            @if (permission('Add_User'))
                <div class="col-lg-4 col-md-6">
                    <!-- Button ADD modal -->
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                        <i class="bx bx-plus"></i>Add Admin
                    </button>
                    @include('back.admins.create')
                </div>
            @endif
            @if (session('status'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($admins->isEmpty())
                <div class="alert alert-danger alert-dismissible" role="alert">
                    No Data Found
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @else
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            @if (permission(['Delete_User', 'Edit_User']))
                                <th width=auto>Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($admins as $admin)
                            <tr>
                                <td>{{ ($admins->currentpage() - 1) * $admins->perpage() + $loop->iteration }}</td>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                    <strong>{{ $admin->name }}</strong>
                                </td>
                                <td>{{ $admin->email }}</td>
                                <td>
                                    @forelse ($admin->roles as $role)
                                        <span class="badge bg-primary">{{ $role->name }}</span>
                                    @empty
                                        <span class="text-muted">No Role</span>
                                    @endforelse
                                </td>
                                <td>
                                    {!! $admin->email_verified_at
                                        ? '<span class="badge rounded-pill btn-success">Active</span>'
                                        : '<span class="badge rounded-pill btn-warning">Pending</span>' !!}
                                </td>
                                <td>
                                    <div class="col-lg-4 col-md-6 d-flex">
                                        @if (permission('Edit_User'))
                                            <!-- Button EDIT modal -->
                                            <button class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#editModal-{{ $admin->id }}" title="Edit">
                                                <i class="bx  bx-edit"></i>
                                            </button>
                                            @include('back.admins.edit')
                                        @endif
                                        @if (permission('Delete_User'))
                                            <x-delete-button href="{{ route('back.admins.destroy', $admin->id) }}">
                                            </x-delete-button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $admins->links('pagination::bootstrap-5') }}
            @endif
        </div>
    </div>
    <!--/ Basic Bootstrap Table -->
@endsection
