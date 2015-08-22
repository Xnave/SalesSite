<h3>
    @if(is_null($model->brand))
        {{ $model->name }}
    @else
        <p> <a href="{{action('BrandsController@edit', $model->brand->id)}}">{{ $model->brand->name }}</a> </p>
    @endif
</h3>

@if(!is_null($model->center))
    <p> <a href="{{action('CentersController@edit', $model->center->id)}}">{{ $model->center->name }}</a> </p>
@endif

<p>{{ $model->address }}</p>
<p>{{ $model->phone }}</p>