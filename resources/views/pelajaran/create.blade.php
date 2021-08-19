{!! Form::open(['id' => 'form-create']) !!}
@include('pelajaran.form')
<button type='button' class="btn btn-primary" onclick='store()'>store</button>
<button type='button' class="btn btn-secondary " onclick='bootbox.hideAll()'>close</button>
{!! Form::close() !!}