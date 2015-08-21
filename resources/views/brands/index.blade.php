@extends('app')

@section('content')
    @foreach($brands as $brand)

        <div class="thumbnail col-xs-4 col-md-2" style="margin-right: 10px;">
            <h3>{{ $brand->name }}</h3>

            {{-- Get image by brand name (without spaces) --}}
            @foreach(glob($brandImagePath. str_replace(' ', '', $brand->name) . '.*') as $imageFile)
                <img style="max-height:180px; margin-bottom: 10px" src="{{ str_replace($brandImagePath, $brandImagePublicPath, $imageFile) }}" alt="brand image">
            @endforeach
            {{--<a href="{{ action('BrandsController@show', $brand->id) }}" class="btn btn-primary">Show Brand</a>--}}
            <a href="{{ action('BrandsController@edit', $brand->id) }}" class="btn btn-primary">Edit Brand</a>
        </div>
    @endforeach

@endsection