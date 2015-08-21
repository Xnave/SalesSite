@extends('app')

@section('content')

        <h1 class="create-title">Edit Store</h1>

        {!! Form::model($store, array('action' => array('StoresController@update', $store->id), 'method' => 'PUT'
                                    , 'class' => 'createForm', 'files'=>true)) !!}
        @include('stores.form')
        {!! Form::submit('Update Store', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}

        @include('partials.messages')

@endsection