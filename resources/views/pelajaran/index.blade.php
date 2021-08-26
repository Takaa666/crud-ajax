<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="{!! asset('plugin/datatables.min.css') !!}">

</head>
<body>
    <div class="form-group my-5"></div>
    <button type="button" class="btn btn-success btn-sm" onclick="create()">create</button>
<div>
    <div class="container my-5">
        <table width="100%" class="table table-consoned table-bordered" id="table">
            <thead>
                <tr>
                    <th>MataPelajaran</th>
                    <th>NamaGuru</th>
                    <th>Jam Pelajaran</th>
                    <th>Hari</th>  
                    <th></th>  
                </tr>
            </thead>
        </table>
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
                ajax: '<?= route ('pelajaran.get') ?>',
                columns : [
                    {data:'mata_pelajaran' , name: 'mata.pelajaran'},
                    {data: 'nama_guru' , name: 'nama.guru'},
                    {data: 'jam_pelajaran' , name: 'jam.pelajaran'},
                    {data: 'hari' , name: 'hari'},
                    {data: 'id' , name: 'id', class: 'text-center', render: function(data) {
                        return '<button type="button" class="btn btn-info btn-sm" onclick="view('+data+')">view</button>\n\
                            <button type="button" class="btn btn-warning btn-sm" onclick="edit('+data+')">edit</button>\n\
                            <button type="button" class="btn btn-danger btn-sm" onclick="destroy('+data+')">delete</button>'
                    }},
                ]
            })
        })
        
        function create() {
            $.ajax({
                url: '<?= route('pelajaran.create') ?>',
                success:function(response){
                    bootbox.dialog({
                        title: 'create pelajaran',
                        message:response
                    })
                }
            })
        }

        function store() {
            $('#form-create .alert').remove()
            $.ajax({
                url: '<?= route('pelajaran.store')?>',
                dataType: 'json', 
                type: 'post',
                data: $('#form-create').serialize(),
                success: function(response) {
                    if (response.success) {
                        alert('store berhasil')
                        bootbox.hideAll()
                        dataTable.ajax.reload()
                    } else {
                        alert('store gagal')
                    }
                }, error: function(xhr) {
                    let response = JSON.parse(xhr.responseText);
                    $('#form-create').prepend(error_message(response));
                }
            })
        }

        function view(id) {
            $.ajax({
                url: '<?= route('pelajaran.view')?>/'+id,
                success: function(response) {
                    bootbox.dialog({
                        title: 'Edit Pelajaran',
                        message : response
                    })                    
                }
            })
        }

        function destroy(id) {
            alert('Apakah Anda Yakin Ingin Menghapus Data Ini ? ')
            $.ajax({
                url: '<?=route('pelajaran.delete') ?>/'+id,
                success: function(response) {
                    if(response.success) {
                        alert ('Data Berhasil di Hapus')
                        dataTable.ajax.reload()
                    } else { 
                        alert ()
                    }
                }                   
            })
        }

        function  update(id) {
            $('#form-edit .alert').remove()
            $.ajax({
                url: '<?=route('pelajaran.update')?>/'+id,
                type: 'post',
                dataType: 'json',
                data: $('#form-edit'). serialize(),
                success: function(response) {
                    if(response.success) {
                        alert('update berhasil')
                        bootbox.hideAll()
                        DataTable.ajax.reload()
                    } else {
                        alert('store gagal')
                    }
                }, error: function(xhr) {
                    let response = JSON.parse(xhr.responseText);
                    $('#form-edit').prepend(error_message(response));
                }
            })
        }

        function edit(id) {
            $.ajax({
                url: '<?=route('pelajaran.edit')?>/'+id,
                success: function(response) {
                    bootbox.dialog({
                        title: 'Edit Mahasiswa',
                        message: response
                    })
                }
            })
        }       
        
        function error_message(errors) {
            let validation = '<div class="alert alert-danger">';
            validation += '<p>'+errors.message+'</p>';
            $.each(errors.errors, function(i, error) {
                validation += error[0] + '<br>'
            })
            validation += '<div>'
            return validation;
        }
    </script>
</body>
</html>