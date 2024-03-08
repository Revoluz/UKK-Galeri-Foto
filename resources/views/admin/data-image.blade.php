<!-- layout dashboard -->
@extends('layout.dashboard')
<!-- Content Header (Page header) -->
<!-- content -->
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Image</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Image</li>
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
                        <div class="card-header">
                            <h3 class="card-title">Data Image</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <colgroup>
                                    <col span="1" style="width: 5%;">
                                    <col span="1" style="width: 20%;">
                                    <col span="1" style="width: 20%;">
                                    <col span="1" style="width: 50%;">
                                    <col span="1" style="width: 5%;">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Image Name</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($images as $image)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $image->user->username }}</td>
                                            <td>{{ $image->name }}</td>
                                            <td>
                                                <img class="w-50" src="{{ $image->image() }}" alt="" />
                                            </td>
                                            <td>
                                                @if ($image->status)
                                                    <form action="{{ route('dashboard.image.status',$image) }}" method="POST">
                                                        @csrf
                                                        @method('put')
                                                        <button type="submit" class="btn btn-success">Active</button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('dashboard.image.status',$image) }}" method="POST">
                                                        @csrf
                                                        @method('put')
                                                        <button type="submit" class="btn btn-danger">Banned</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Image Name</th>
                                        <th>Image</th>
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
    <!-- /.content -->
@endsection
<!-- plugins -->
@section('plugins')
@endsection
