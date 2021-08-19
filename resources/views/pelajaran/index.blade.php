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
                </tr>
            </thead>
        </table>
    <script src="{!! asset('plugin/jquery/jquery.min.js') !!}"></script>
    <script src="{!! asset('plugin/datatables.min.js') !!}"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="{!! asset('plugin/bootbox/bootbox.all.min.js') !!}"></script>
    <script>
        // $(function() {
        //     datatable = $('#table').DataTable({
        //     serverSide = true,
        //     ajax: '<? route ('Pelajaran.get') ?>',
        //     columns : [
        //         {data:'id' , name: 'pelajaran.id'},
        //         {data: ''}]
        //     })
        // })
        
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
            $.ajax({
                url: '<?= route('pelajaran.store')?>',
                dataType: 'json', 
                type: 'post',
                data: $('#form-create').serialize(),
                success: function(response) {
                    if (response.success) {
                        alert('store berhasil')
                    } else {
                        alert('store gagal')
                    }
                }
            })
        }
    </script>
</body>
</html>