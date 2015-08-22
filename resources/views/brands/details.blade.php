<h3>{{ $model->name }}</h3>

{{-- Get image by brand name (without spaces) --}}
@foreach(glob($brandImagePath. str_replace(' ', '', $model->name) . '.*') as $imageFile)
    <img class="admin-image" src="{{ str_replace($brandImagePath, $brandImagePublicPath, $imageFile) }}" alt="brand image">
@endforeach
{{--<a href="{{ action('BrandsController@show', $model->id) }}" class="btn btn-primary">Show Brand</a>--}}
