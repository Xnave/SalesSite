@extends('app')

@section('content')

        <h1 class="create-title">Create new Center</h1>

        {!! Form::open(array('action' => array('CentersController@store'), 'class' => 'createForm', 'files'=>true)) !!}
        @include('centers.form')
        {!! Form::submit('Create New Center', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}

        @include('partials.messages')

@endsection