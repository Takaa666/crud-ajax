<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="{!! asset('plugin/datatables.min.css') !!}">

    <title>Hello, world!</title>
  </head>
  <body>
      <div class="form-group my-5">
          <button type="button" class="btn btn-success" onclick="create()">create</button>
        </div>
        <div class="container my-5">
          @if(session('success'))
            <div class="alert alert-success">
                {!! session('success') !!}
            </div>
          @endif
          @if(session('error'))
            <div class="alert alert-danger">
                {!! session('error') !!}
            </div>
          @endif
          <table width="100%" class="table table-consoned table-bordered" id="table">
          <thead>
              <tr>
                  <th>No</th>
                  <th>Nama Mahasiswa</th>
                  <th>Jurusan</th>
                  <th>Semester</th>
                  <th>alamat</th>
                  <th>umur</th>
                  <th>email</th>
                  <th></th>
              </tr>
          </thead>
          <tbody>
             
          </tbody>
      </table>
      </div>

      
    <script src="{!! asset('plugin/jquery/jquery.min.js') !!}"></script>
    <script src="{!! asset('plugin/datatables.min.js') !!}"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="{!! asset('plugin/bootbox/bootbox.all.min.js') !!}"></script>
    <script>
        let dataTable;
        $(function() {
            dataTable = $('#table').DataTable({
                serverSide: true,
                ajax: '<?= route('mahasiswa.get') ?>',
                columns: [
                    {data: 'id', name: 'mahasiswa.id'},
                    {data: 'nama_mahasiswa', name: 'mahasiswa.nama_mahasiswa'},
                    {data: 'jurusan', name: 'mahasiswa.jurusan'},
                    {data: 'semester', name: 'mahasiswa.semester'},
                    {data: 'alamat', name: 'mahasiswa.alamat'},
                    {data: 'umur', name: 'mahasiswa.umur'},
                    {data: 'email', name: 'mahasiswa.email'},
                    {data: 'id', name: 'mahasiswa.id', seachable: false, render: function(data) {
                        return '<button id="btn-view" type="button" class="btn btn-info btn-sm" onclick="view('+data+')">view</button> \n\
                            <button id="btn-edit" type="button" class="btn btn-warning btn-sm" onclick="edit('+data+')">edit</button>\n\
                            <button type="button" class="btn btn-danger btn-sm" onclick="destroy('+data+')">delete</button>';
                    }},
                ]
            })
        })
        function create() {
            $.ajax({
                url: '<?= route('mahasiswa.create') ?>',
                success: function(response) {
                    bootbox.dialog({
                        title: 'Create Mahasiswa',
                        message: response
                    })
                }
            })
        }

        function edit(id) {
            $.ajax({
                url: '<?= route('mahasiswa.edit') ?>/' + id,
                success: function(response) {
                    bootbox.dialog({
                        title: 'Edit Mahasiswa',
                        message: response
                    })
                }
            })
        }

        function view(id) {
            $.ajax({
                url: '<?= route('mahasiswa.view') ?>/' + id,
                success: function(response) {
                    bootbox.dialog({
                        title: 'Edit Mahasiswa',
                        message: response
                    })
                }
            })
        }

        function update(id) {
            $.ajax({
                url: '<?= route('mahasiswa.update') ?>/' + id,
                type: 'post',
                dataType: 'json',
                data: $('#form-edit').serialize(),
                success: function(response) {
                    if(response.success) {
                        alert('update berhasil')
                        bootbox.hideAll()
                        dataTable.ajax.reload()
                    } else {
                        alert('update gagal')
                    }
                }
            })
        }

        function store() {
            $.ajax({
                url: '<?= route('mahasiswa.store') ?>/',
                type: 'post',
                dataType: 'json',
                data: $('#form-create').serialize(),
                success: function(response) {
                    if(response.success) {
                        alert('store berhasil')
                        bootbox.hideAll()
                        dataTable.ajax.reload()
                    } else {
                        alert('store gagal')
                    }
                }
            })
        }

        function destroy(id) {
            $.ajax({
                url: '<?= route('mahasiswa.delete') ?>/'+id,
                success: function(response) {
                    if(response.success) {
                        alert('Data Berhasil Di Hapus')
                        dataTable.ajax.reload()
                    } else {
                        alert('Data Gagal Di Hapus')
                    }
                }
            })
        }
    </script>
  </body>
</html>