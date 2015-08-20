@extends('app')

@section('content')

        <h1 class="create-title">Create new Brand</h1>

        {!! Form::open(array('action' => array('BrandsController@store'), 'class' => 'createForm', 'files'=>true)) !!}
        @include('brands.form')
        {!! Form::submit('Create New Brand', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}

        @include('partials.messages')

@endsection