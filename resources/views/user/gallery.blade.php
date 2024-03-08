@foreach ($images as $image)
<a href="{{ route('images.show',$image->id) }}" class="d-block images">
  <figure class="imghvr-fade">
    <img class="w-100 shadow-sm rounded-sm" src="{{ $image->image() }}" alt="{{ $image->name }}" />
    <figcaption id="cover-title" class="h-100 d-md-flex align-items-end d-none">
      {{ $image->name }}
    </figcaption>
  </figure>
</a>
@endforeach

