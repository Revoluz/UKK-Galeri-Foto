<!-- layout main -->
@extends('layout.main')
<!-- head -->
@section('head')
@endsection
<!-- content  -->
@section('content')
    <div class="col-12 mt-156" style="min-height: 800px">
        <div class="container d-flex gap-3">
            <!-- include sidebar setting -->
            @include('component.user.sidebar-setting')
            <form action="{{ route('user.update' , $user) }}" class="col-md-8 col-12 px-0" method="POST">
                @csrf
                @method('put')
                <div class="bg-white setting-container rounded-40 px-4">
                    <h3 class="fw-bold">Edit Profile</h3>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="Name">Name</label>
                            <input type="text" class="form-control border-dark" id="Name" name="name"
                                placeholder="Enter name" value="{{ @old('name',$user->name) }}" />
                            @error('name')
                                <div class='invalid-feedback d-block text-red'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Username">Username</label>
                            <input type="text" class="form-control border-dark" id="Username" name="username"
                                placeholder="Enter username"  value="{{ @old('username',$user->username) }}"/>
                            @error('username')
                                <div class='invalid-feedback d-block text-red'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control border-dark" id="email" name="email"
                                placeholder="Enter email" value="{{ @old('email',$user->email) }}" />
                            @error('email')
                                <div class='invalid-feedback d-block text-red'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password">Password</label>
                            <input type="password" class="form-control border-dark" name="password" id="password"
                                placeholder="Enter email" value="{{ @old('password') }}"/>
                            @error('password')
                                <div class='invalid-feedback d-block text-red'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- button -->
                <div class="mt-3">
                    <a href="" class="text-decoration-none btn btn-secondary btn px-5 py-2">
                        Back
                    </a>
                    <button class="btn btn-dark px-5 py-2" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('plugins')
@endsection
