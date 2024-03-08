<!-- layout dashboard -->
@extends('layout.dashboard')
<!-- content -->
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Management User</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Management User</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col-md-6 -->
                <div class="col">
                    <!-- /.card -->
                    <div class="card card-primary card-outline">
                        <div class="card-header d-flex">
                            <h3 class="card-title">Management User</h3>
                            <button type="button" class="btn btn-success mb-2 ml-auto" data-toggle="modal"
                                data-target="#modal-add-account-user">
                                Add User Account <i class="ml-1 fas fa-plus"></i>
                            </button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Level</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->level }}</td>
                                            <td>
                                                <a href="{{ route('profile.index', $user) }}" class="btn btn-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Level</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- modal add user -->
    <div class="modal fade" id="modal-add-account-user">
        <form action="{{ route('dashboard.user.store') }}" method="POST">
            @csrf
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add User Account</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Name"
                                value="{{ @old('name') }}" />
                            @error('name')
                                <div class='invalid-feedback d-block text-red'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" id="username" placeholder="Username"
                                value="{{ @old('username') }}" />
                            @error('username')
                                <div class='invalid-feedback d-block text-red'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" class="form-control" id="email"
                                placeholder="example@gmail.com" value="{{ @old('email') }}" />
                            @error('email')
                                <div class='invalid-feedback d-block text-red'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password"
                                placeholder="Password" value="{{ @old('password') }}" />
                            @error('password')
                                <div class='invalid-feedback d-block text-red'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="level">Role</label>
                            <select class="form-control" aria-label="Default select" name="level">
                                <option value="user" selected>User</option>
                                <option value="admin">Admin</option>
                            </select>
                            @error('role')
                                <div class='invalid-feedback d-block text-red'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default btn-outline-dark" data-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.content -->
@endsection
<!-- plugins -->
@section('plugins')
@endsection
