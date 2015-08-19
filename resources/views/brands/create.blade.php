@extends('app')

<link rel="stylesheet" href="/css/create-objects.css">
@section('content')

    {!! Form::open(array('action' => array('BrandsController@store'), 'class' => 'createForm', 'files'=>true)) !!}

    <div class="form-group">
        {!! Form::label('brandName', 'Brand Name:', ['class' => 'control-label']) !!}
        {!! Form::text('brandName', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('image', 'load image:', ['class' => 'control-label']) !!}
        {!! Form::file('image', ['accept' => "image/*"]) !!}
    </div>

    {!! Form::submit('Create New Brand', ['class' => 'btn btn-primary']) !!}

    {!! Form::close() !!}

    <?php $success = Session::get('success'); ?>
    @if(isset($success))
        <span class="success">{!!$success !!}</span>
    @endif
    <span class="failed"> {!! Html::ul($errors->all()) !!} </span>

@endsection