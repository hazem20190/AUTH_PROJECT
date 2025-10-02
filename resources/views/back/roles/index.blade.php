@extends('back.master')
@section('title', 'Roles')
@section('active-roles', 'active')
@section('content')
    <!-- Basic Bootstrap Table -->
    <div class="card">
        <!-- Default Modal -->
        <h5 class="card-header">Roles Table</h5>
        <div class="table-responsive text-nowrap">
            <div class="col-lg-4 col-md-6">
                <!-- Button ADD modal -->
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                    <i class="bx bx-plus"></i>Add Role
                </button>
                @include('back.roles.create')
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

            @if ($roles->isEmpty())
                <div class="alert alert-danger alert-dismissible" role="alert">
                    No Data Found
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @else
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Role_Name</th>
                            <th>Permissions</th>
                            <th width=auto>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ ($roles->currentpage() - 1) * $roles->perpage() + $loop->iteration }}</td>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                    <strong>{{ $role->name }}</strong>
                                </td>
                                <td>
                                    @foreach ($role->permissions as $Permission)
                                        {{ str_replace('_User', ' ', $Permission->name) }}
                                    @endforeach
                                </td>
                                <td>
                                    <div class="col-lg-4 col-md-6 d-flex">
                                        <!-- Button EDIT modal -->
                                        <button class="btn btn-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editModal-{{ $role->id }}" title="Edit">
                                            <i class="bx  bx-edit"></i>
                                        </button>
                                        <x-delete-button href="{{ route('back.roles.destroy', $role->id) }}">
                                        </x-delete-button>
                                        @include('back.roles.edit')
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $roles->links('pagination::bootstrap-5') }}
            @endif
        </div>
    </div>
    <!--/ Basic Bootstrap Table -->
@endsection
