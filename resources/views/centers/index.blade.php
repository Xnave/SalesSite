@extends('app')

@section('content')
    @foreach($centers as $center)

        <div href="#" class="thumbnail col-xs-4 col-md-2" style="margin-right: 10px;">
            <h3>{{ $center->name }}</h3>
            <p>{{ $center->address }}</p>
            <p>{{ $center->phone_number }}</p>
            <a href="{{ action('CentersController@edit', $center->id) }}" class="btn btn-primary">Edit Center</a>
        </div>
    @endforeach

@endsection