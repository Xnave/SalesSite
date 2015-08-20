

<div class="form-group">
    {!! Form::label('name', 'Brand Name:', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('image', 'load image:', ['class' => 'control-label']) !!}
    {!! Form::file('image', ['accept' => "image/*"]) !!}
</div>

