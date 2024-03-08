<!-- layout main -->
@extends('layout.main')
<!-- section head -->
@section('head')
@endsection
<!-- section content -->
@section('content')
    <div class="col-12 mt-156 " style="margin-bottom: 128px">
        <div class="container d-flex gap-3">
            @include('component.user.sidebar-setting')
            <form action="{{ route('account.management.update',auth()->user()) }}" class="col-md-8 col-12 px-0" enctype="multipart/form-data" method="POST">
                @csrf
                @method('put')
                <div class="bg-white setting-container rounded-40 px-4">
                    <h3 class="fw-bold">Account Management</h3>
                    <div class="row">
                        <div class="form-group col-md-10">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" rows="3" placeholder="Enter ..." maxlength="300" name="description">{{ @old('description', $user->profile->description) }}</textarea>
                                @error('description')
                                    <div class='invalid-feedback d-block text-red'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-md-10">
                            <label for="formFile" class="form-label">Photo Profile</label>
                            <input class="form-control" type="file" id="formFile" name="photo" />
                            @error('photo')
                                <div class='invalid-feedback d-block text-red'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="bg-white setting-container rounded-40 px-4 mt-4">
                    <h3 class="fw-bold">Link Account</h3>
                    <div class="row">
                        <div class="form-group col-md-12 d-flex flex-row">
                            <div class="d-flex align-items-center col-md-6">
                                <img src="{{ asset('dist/img/social-icon/mdi_instagram.svg') }}" alt="" />
                                <p class="m-0 ms-2 text-gray">Instagram</p>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="ig-account" placeholder="Input account"
                                    name="instagram" value="{{ @old('instagram', $user->profile->instagram) }}" />
                                @error('instagram')
                                    <div class='invalid-feedback d-block text-red'>
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                        </div>
                        <div class="form-group col-md-12 d-flex flex-row">
                            <div class="d-flex align-items-center col-md-6">
                                <img src="{{ asset('dist/img/social-icon/pajamas_twitter.svg') }}" alt="" />
                                <p class="m-0 ms-2 text-gray">X / Twitter</p>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="x-account" placeholder="Input account"
                                    name="twitter" value="{{ @old('twitter', $user->profile->twitter) }}" />
                                @error('twitter')
                                    <div class='invalid-feedback d-block text-red'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-md-12 d-flex flex-row">
                            <div class="d-flex align-items-center col-md-6">
                                <img src="{{ asset('dist/img/social-icon/iconoir_facebook.svg') }}" alt="" />
                                <p class="m-0 ms-2 text-gray">Facebook</p>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="fb-account" placeholder="Input account"
                                    name="facebook" value="{{ @old('facebook', $user->profile->facebook) }}" />
                                @error('facebook')
                                    <div class='invalid-feedback d-block text-red'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="" class="btn btn-secondary px-5 py-2">
                        Back
                    </a>
                    <button class="btn btn-dark px-5 py-2" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
<!-- section plugins -->
@section('plugins')
@endsection
