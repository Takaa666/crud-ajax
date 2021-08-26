{!! Form::model($model, ['id'=>'form-edit', 'route' => ['pelajaran.edit']]) !!}
@include ('pelajaran.form')
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" onclick="bootbox.hideAll()">Close</button>
    <button type="button" class="btn btn-primary" onclick="update('<?=$model->id?>')">update</button>
</div>
{!! Form::close() !!}