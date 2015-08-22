<?php
    if(isset($store) and !is_null($store->brand)){
        $brand = $store->brand;
    }
    else{
        $brand = null;
    }

    if(isset($store) and !is_null($store->center)){
        $center = $store->center;
    }
    else{
        $center = null;
    }
?>

<div class="form-group">
    <input type="radio" id="nameRadio" name="hasBrand" {!! is_null($brand)? 'checked' : '' !!} onchange="toggle(this.id)">
        {!! Form::label('name', 'Store Name:', ['class' => 'control-label']) !!}
        {!! Form::text('name', null, ['id' => 'nameInput', 'class' => 'form-control']) !!}
    <input type="radio" id="brandRadio" name="hasBrand" {!! is_null($brand)? '' : 'checked' !!} onchange="toggle(this.id)">
        {!! Form::label('brand_id', 'Owning Brand Name:', ['class' => 'control-label']) !!}
        {!! Form::select('brand_id', \App\Models\Brand::lists('name', 'id'), is_null($brand)? null : $brand->id ,['id' => 'brandSelect', 'class' => 'form-control']) !!}
</div>
    <input type="checkbox" id="centerCheckbox" {!! is_null($center)? '' : 'checked' !!} onchange="toggleCenter()">
        {!! Form::label('center_id', 'Center:', ['class' => 'control-label']) !!}
        {!! Form::select('center_id', \App\Models\Center::lists('name', 'id'), is_null($center)? null : $center->id ,[ 'class' => 'form-control']) !!}
<div class="form-group">

</div>

<div class="form-group">
    {!! Form::label('address', 'Address:', ['class' => 'control-label']) !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('phone', 'Phone:', ['class' => 'control-label']) !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
</div>

<script type="text/javascript">
    function toggle(radBtnId)
    {
        switch(radBtnId)
        {
            case 'brandRadio':
                document.getElementById('nameInput').setAttribute('disabled','disabled');
                document.getElementById('brandSelect').removeAttribute('disabled');
                break;
            case 'nameRadio':
                document.getElementById('brandSelect').setAttribute('disabled','disabled');
                document.getElementById('nameInput').removeAttribute('disabled');
                break;
        }
    }

    function toggleCenter(){
        if(document.getElementById('centerCheckbox').checked){
            document.getElementById('center_id').removeAttribute('disabled');
        }else{
            document.getElementById('center_id').setAttribute('disabled','disabled');
        }
    }
    toggleCenter();

    if(document.getElementById("brandRadio").checked){
        toggle('brandRadio');
    }
    else{
        toggle('nameRadio');
    }

</script>