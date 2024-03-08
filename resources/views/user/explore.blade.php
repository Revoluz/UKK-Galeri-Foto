<!-- layout main -->
@extends('layout.main')
<!-- head -->
@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{ asset('plugins/imagehover.css/css/imagehover.min.css/imagehover.css') }}" />
@endsection
@section('content')
    <!-- section content -->
    <div class="col-12 gallery-rounded h-100">
        <div class="mx-md-4 mx-2">
            <div class="flex-row d-flex align-items-center justify-content-between">
                <h1 class="fw-bold">Explore</h1>
            </div>
            <!-- image continer -->
            <div class="mt-4 gallery" id="gallery">
                @include('user.gallery')
            </div>
            <!-- if image not found -->
            @if (!$images->count())
                <div class="alert alert-danger text-center">No Images Found.</div>
            @else
                @if ($conImg)
                    <!-- status image load else image found-->
                    <div class="loader text-center mb-5">
                        <div class="d-flex justify-content-center">
                            <div class="page-load-status">
                                <div class="spinner-border infinite-scroll-request" role="status"></div>

                                <p class="infinite-scroll-last">End of content</p>
                                <p class="infinite-scroll-error">No more pages to load</p>
                            </div>
                        </div>
                    </div>
                @endif
            @endif

        </div>
    </div>
@endsection
@section('plugins')
    <!-- plugins -->
    <script src="{{ asset('dist/js/macy/dist/macy.js') }}"></script>

    <script src="{{ asset('plugins/infinite-scroll/script.js') }}"></script>
    <!-- route explore -->
    @if (Route::is('explore'))
    <script>
        var endpoint = "{{ route('explore') }}";
        </script>
    @endif
    <!-- route search -->
    @if (Route::is('search'))
    <script>
        var endpoint = "{{ route('search') }}";
        </script>
    @endif
    <!-- massonary image layout -->
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
            waitForImages: false,
            margin: {
                x: 8,
                y: 8,
            },
        });
    </script>
    <!-- jika ada image -->
    @if ($conImg)
        <script>
            //
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
                    // console.log('I only get called when all images are loaded');
                    msnry.recalculate(true);
                }, true);
                // console.log(response);
            });
        </script>
    @endif
@endsection
