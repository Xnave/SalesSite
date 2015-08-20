@extends('app')

@section('content')

        <h1 class="create-title">Create new Brand</h1>

        {!! Form::open(array('action' => array('BrandsController@store'), 'class' => 'createForm', 'files'=>true)) !!}
        @include('brands.form')
        {!! Form::close() !!}

        @include('partials.messages')

@endsection