@extends('app')

@section('content')
    @foreach($stores as $store)

        <div class="thumbnail col-xs-4 col-md-2" style="margin-right: 10px;">
            <h3>
                @if(is_null($store->brand))
                {{ $store->name }}
                @else
                    <p> <a href="{{action('BrandsController@edit', $store->brand->id)}}">{{ $store->brand->name }}</a> </p>
                @endif
            </h3>

            @if(!is_null($store->center))
                <p> <a href="{{action('CentersController@edit', $store->center->id)}}">{{ $store->center->name }}</a> </p>
            @endif

            <p>{{ $store->address }}</p>
            <p>{{ $store->phone }}</p>


            <a href="{{ action('StoresController@edit', $store->id) }}" class="btn btn-primary">Edit store</a>
        </div>
    @endforeach

@endsection