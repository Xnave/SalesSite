@extends('app')

@section('navbar-items')
    <li><a href="./">View all</a></li>
@endsection


@section('content')

    <h1 class="create-title">Create new {{ substr($modelName, 0, -1)}}</h1>

    {!! Form::open(array('action' => array(ucfirst($modelName).'Controller@store'), 'class' => 'createForm', 'files'=>true)) !!}
    @include($modelName.'.form')
    {!! Form::submit('Create New '.ucfirst($modelName), ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}

    @include('partials.messages')

@endsection