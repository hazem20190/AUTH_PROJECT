@extends('back.master')
@section('title', 'Users')
@section('content')
    <!-- Basic Bootstrap Table -->
    <div class="card">

        <!-- Default Modal -->

        <h5 class="card-header">Users Table</h5>
        <div class="table-responsive text-nowrap">
            <div class="col-lg-4 col-md-6">
                <!-- Button ADD modal -->
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                    <i class="bx bx-plus"></i>Add User
                </button>
                @include('back.users.create')
            </div>

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

            @if ($users->isEmpty())
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
                            <th>Status</th>
                            <th width=auto>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ ($users->currentpage() - 1) * $users->perpage() + $loop->iteration }}</td>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                    <strong>{{ $user->name }}</strong>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    {!! $user->email_verified_at
                                        ? '<span class="badge rounded-pill btn-success">Active</span>'
                                        : '<span class="badge rounded-pill btn-warning">Pending</span>' !!}
                                </td>
                                <td>
                                    <div class="col-lg-4 col-md-6 d-flex">
                                        <!-- Button EDIT modal -->
                                        <button class="btn btn-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editModal-{{ $user->id }}" title="Edit">
                                            <i class="bx  bx-edit"></i>
                                        </button>
                                        <x-delete-button href="{{ route('back.users.destroy', $user->id) }}">
                                        </x-delete-button>
                                        @include('back.users.edit')
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $users->links('pagination::bootstrap-5') }}
            @endif
        </div>
    </div>
    <!--/ Basic Bootstrap Table -->
@endsection
