@extends('app')

@section('content')

        <h1 class="create-title">Create new Store</h1>

        {!! Form::open(array('action' => array('StoresController@store'), 'class' => 'createForm', 'files'=>true)) !!}
        @include('stores.form')
        {!! Form::submit('Create New Store', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}

        @include('partials.messages')

@endsection