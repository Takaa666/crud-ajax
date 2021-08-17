<div class="form-group">
    <label>Nama Mahasiswa</label>
    {!! Form::text('nama_mahasiswa', null, ['class' => 'form-control', 'id' => 'nama_mahasiswa']) !!}
</div>
<div class="form-group">
    <label>Jurusan</label>
    {!! Form::select('jurusan', ['' => 'select'] + $jurusan->toArray(), isset($model->id_jurusan) ? $model->id_jurusan : null, ['class' => 'form-control', 'id', 'jurusan']) !!}
</div>
<div class="form-group">
    <label>Semester</label>
    {!! Form::select('semester', ['' => 'select'] + $semester->toArray(), isset($model->id_jurusan) ? $model->id_jurusan : null, ['class' => 'form-control', 'id', 'semester']) !!}
</div>
<div class="form-group">
    <label>Alamat</label>
    {!! Form::textarea('alamat', null, ['class' => 'form-control', 'id' => 'alamat']) !!}
</div>
<div class="form-group">
    <label>Umur</label>
    {!! Form::number('umur', null, ['class' => 'form-control', 'id' => 'umur']) !!}
</div>
<div class="form-group">
    <label>Email</label>
    {!! Form::email('email', null, ['class' => 'form-control', 'id' => 'email']) !!}
</div>