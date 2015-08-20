@extends('app')

@section('content')

        <h1 class="create-title">Edit Brand</h1>

        {!! Form::model($brand, array('action' => array('BrandsController@update', $brand->id), 'method' => 'PUT'
                                    , 'class' => 'createForm', 'files'=>true)) !!}
        @include('brands.form')
        {!! Form::close() !!}

        @include('partials.messages')

@endsection