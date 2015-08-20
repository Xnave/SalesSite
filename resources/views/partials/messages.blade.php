
<?php $success = Session::get('success'); ?>
@if(isset($success))
    <span class="success">{!!$success !!}</span>
@endif
<span class="failed"> {!! Html::ul($errors->all()) !!} </span>