{!! Form::open(['id' => 'form-create']) !!}
@include('pelajaran.form')
<div class="float-right">
    <button type='button' class="btn btn-secondary " onclick='bootbox.hideAll()'>close</button>
    <button type='button' class="btn btn-primary" onclick='store()'>store</button>
</div>
{!! Form::close() !!}