<!-- layout main -->
@extends('layout.main')
@section('head')
    <!-- section head -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" href="{{ asset('plugins/imagehover.css/css/imagehover.min.css/imagehover.css') }}">
@endsection
<!-- section content -->
@section('content')
    <div class="setting-container mt-156 col-md-6  col-lg-4 rounded-4 container  mx-md-0 row flex-column align-items-center">
        <img src="{{ $user->avatar() }}" class="profile-img border-1 border-black border-width-2 border p-0"
            style="border-radius: 50%; width: 100px; height: 100px" alt="User Image" />
        <h3 class="text-center mt-1">
            {{ $user->username }}
        </h3>
        <p class="fs-6 text-secondary text-center mb-0">
            {{ $user->profile->description }}
        </p>
        <div class="d-flex my-2 justify-content-center gap-1">
            @if ($user->profile->instagram)
                <a href="{{ $user->profile->instagram }}" target="_blank">
                    <img src="{{ asset('/dist/img/social-icon-color/instagram.svg') }}" alt="instagram icon"
                        class="" />
                </a>
            @endif
            @if ($user->profile->twitter)
                <a href="{{ $user->profile->twitter }}" target="_blank">
                    <img src="{{ asset('/dist/img/social-icon-color/twitter.svg') }}" alt="twitter icon" class="" />
                </a>
            @endif
            @if ($user->profile->facebook)
                <a href="{{ $user->profile->facebook }}" target="_blank">
                    <img src="{{ asset('/dist/img/social-icon-color/facebook.svg') }}" alt="facebook icon"
                        class="" />
                </a>
            @endif
        </div>
        <!-- guard user auth -->
        <div class="d-flex flex-column flex-wrap">
            @can('auth.user', $user)
                <div class="d-flex gap-2 flex-column flex-md-row w-100">
                    <a href="{{ route('user.show', auth()->user()) }}"
                        class="btn btn-lg btn-outline-dark bg-secondary-subtle col">
                        Settings
                    </a>
                    <!-- guard admin -->
                    @can('auth.admin', $user)
                        <a href="{{ route('dashboard.traffic', $year) }}" class="btn btn-lg btn-dark col"> Dashboard </a>
                    @endcan
                </div>
                <form action="{{ route('logout') }}" method="POST" class="d-flex">
                    @csrf
                    <button type="submit" class="btn btn-lg btn-danger col-12 mt-2"> Logout </button>
                </form>
            @endcan
        </div>
    </div>
    <!-- gallery container -->
    <div class="container col-12 gallery-rounded h-100 mt-5">
        <div class="mx-md-4 mx-2">
            <div class="flex-row d-flex align-items-center justify-content-between">
                <h1 class="fw-bold">Explore</h1>
                <div class="d-flex gap-4">
                    <!-- guard auth user -->
                    @can('auth.user', $user)
                        <button type="button" class="btn btn-lg bg-secondary-subtle rounded-5 fw-bold" data-toggle="modal"
                            data-target="#modal-lg">
                            <i class="fas fa-plus"></i>
                            Add Image
                        </button>
                    @endcan
                </div>
            </div>
            <!-- gallery user upload -->
            <div class="mt-4 gallery">
                @foreach ($images as $image)
                    <a href="{{ route('profile.image', ['user' => $user, 'image' => $image->id]) }}"
                        class="d-block images">
                        <figure class="imghvr-fade">
                            <img class="w-100 shadow-sm rounded-sm" src="{{ $image->image() }}"
                                alt="{{ $image->name }}" />
                            <figcaption id="cover-title" class="h-100 d-md-flex align-items-end d-none">
                                {{ $image->name }}
                            </figcaption>
                        </figure>
                    </a>
                @endforeach
            </div>
            <!-- if image not found -->
            @if (!$images->count())
                <div class="alert alert-danger text-center">
                    No Images Found.
                </div>
            @else
                <!-- else image found -->
                <!-- if condition true -->
                @if ($conImg)
                    <div class="loader text-center mb-5">
                        <div class="d-flex justify-content-center">
                            <div class="page-load-status">
                                <div class="spinner-border infinite-scroll-request" role="status"></div>
                                {{-- <p class="infinite-scroll-request">Loading...</p> --}}
                                <p class="infinite-scroll-last">End of content</p>
                                <p class="infinite-scroll-error">No more pages to load</p>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
            <!-- endif -->
            <!-- endif -->
        </div>
    </div>
    <!-- auth user modal edit -->
    <!-- /.modal-dialog -->
    @can('auth.user', $user)
        <div class="modal fade" id="modal-lg">
            <form action="{{ route('images.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Image</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                                    placeholder="Image Name" value="{{ @old('name') }}" />
                                @error('name')
                                    <div class='invalid-feedback d-block text-red'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" rows="3" placeholder="Enter ..." name="description">{{ @old('description') }}</textarea>
                                    @error('description')
                                        <div class='invalid-feedback d-block text-red'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="formFile" class="form-label">Image </label>
                                <input class="form-control" name="image" type="file" id="formFile" />
                                @error('image')
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
    @endcan
@endsection
@section('plugins')
    <!-- plugins --> <!-- Bootstrap 4 -->
    <script src="{{ asset('dist/js/macy/dist/macy.js') }}"></script>
    <script src="{{ asset('plugins/infinite-scroll/script.js') }}"></script>
    <!-- digunakan untuk mengatur layout gallery -->
    <script>
        const msnry = new Macy({
            container: ".gallery",
            mobileFirst: true,
            columns: 1,
            breakAt: {
                200: 2,
                700: 4,
                1100: 4,
            },
            margin: {
                x: 8,
                y: 8,
            },
        });
    </script>
    <!-- if image condition true -->
    <!-- infinite scrool -->
    @if ($conImg)
        <script>
            //
            var elem = document.querySelector(".gallery");
            var endpoint = '{{ route('profile.index', $user) }}'
            var elem = document.querySelector(".gallery");
            var infiniteScroll = new InfiniteScroll(elem, {
                path: endpoint + "?page=@{{#}}",
                status: ".page-load-status",
                history: false,
                append: ".images",
                scrollThreshold: 100,
                // debug: true, // Optional: Enable debugging messages
            });

            infiniteScroll.on("append", function(body, path, items, response) {
                msnry.runOnImageLoad(function() {
                    msnry.recalculate(true);
                }, true);
            });
        </script>
    @endif
    <!-- endif -->
@endsection
