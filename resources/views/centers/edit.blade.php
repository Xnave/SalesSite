@extends('app')

@section('content')

        <h1 class="create-title">Edit Brand</h1>

        {!! Form::model($center, array('action' => array('CentersController@update', $center->id), 'method' => 'PUT'
                                    , 'class' => 'createForm', 'files'=>true)) !!}
        @include('centers.form')
        {!! Form::submit('Update Center', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}

        @include('partials.messages')

@endsection