@extends('v_index')


@section('konten')

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a id="add" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-plus-circle"></i>
            </span>
            <span class="text">Tambah Data</span>
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama User</th>
                        <th>Divisi</th>
                        <th>Hak Akses</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama User</th>
                        <th>Divisi</th>
                        <th>Hak Akses</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <!-- <tbody>
                    <tr>
                        <td>Tiger Nixon</td>
                        <td>System Architect</td>
                        <td>Edinburgh</td>
                        <td>61</td>
                        <td>2011/04/25</td>
                        <td>$320,800</td>
                    </tr>
                </tbody> -->
            </table>
        </div>
    </div>
</div>
<!-- Modal -->
<div id="myModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-add">
                    <input type="text" id="id" hidden>
                    <div class="form-group">
                        <label for="nama_user">NAMA USER</label>
                        <input type="text" class="form-control" id="nama_user" placeholder="Nama User">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="username">USERNAME</label>
                            <input type="text" class="form-control" id="username" placeholder="Username">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password">PASSWORD</label>
                            <input type="password" class="form-control" id="password" placeholder="Password">
                            <button id="update_pass" type="button" class="btn btn-warning form-control">Update Password</button>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="id_divisi">Divisi</label>
                            <select id="id_divisi" class="form-control">
                                <option selected>Choose...</option>
                                @foreach($divisi as $divisi)
                                <option value="{{$divisi->id_divisi}}">{{$divisi->nama_divisi}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="hak_akses">Status user</label>
                            <select id="hak_akses" class="form-control">
                                <option selected>Choose...</option>
                                <option value="Admin">Admin</option>
                                <option value="Petugas">Petugas</option>
                                <option value="User">User</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="document.getElementById('form-add').reset();">Close</button>
                <button id="in" type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script src="/assets/jquery-3.5.1.js"></script>
<script>
    $(function() {
        var oTable = $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            "columnDefs": [{
                "className": "text-center",
                "targets": [0, 1, 2, 3, 4], // table ke 1
            }],
            ajax: {
                url: '/json_user'
            },
            "fnCreatedRow": function(row, data, index) {
                $('td', row).eq(0).html(index + 1);
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'nama_user',
                    name: 'nama_user'
                },
                {
                    data: 'nama_divisi',
                    name: 'nama_divisi'
                },
                {
                    data: 'hak_akses',
                    name: 'hak_akses'
                },
                {
                    data: 'aksi',
                    name: 'aksi'
                }
            ],
        });
    });
    //add data
    $(document).on('click', '#add', function() {
        $('.modal-title').text('Tambah Data');
        $("#in").removeClass("btn btn-primary update");
        $("#in").addClass("btn btn-primary add");
        $('#in').text('Save');
        document.getElementById("form-add").reset();
        $('#update_pass').hide();
        $('#password').show();
        $('#myModal').modal('show');
    });
    $('.modal-footer').on('click', '.add', function() {
        $.ajax({
            type: 'POST',
            url: '/store_user',
            data: {
                '_token': "{{ csrf_token() }}",
                'nama_user': $('#nama_user').val(),
                'username': $('#username').val(),
                'password': $('#password').val(),
                'id_divisi': $('#id_divisi').val(),
                'hak_akses': $('#hak_akses').val(),

            },
            success: function(data) {
                document.getElementById("form-add").reset();
                $('#myModal').modal('hide');
                $('#users-table').DataTable().ajax.reload();

            },
        });
    });
    //end add data
    //edit data
    $(document).on('click', '#edit', function(e) {
        e.preventDefault();
        var uid = $(this).data('id');

        $.ajax({
            type: 'POST',
            url: '/edit_user',
            data: {
                '_token': "{{ csrf_token() }}",
                'id': uid,
            },
            success: function(data) {
                //console.log(data);

                //isi form
                $('#id').val(data.id);
                $('#nama_user').val(data.nama_user);
                $('#username').val(data.name);
                $('#id_divisi').val(data.id_divisi).attr('selected', 'selected');
                $('#hak_akses').val(data.hak_akses).attr('selected', 'selected');

                id = $('#id').val();
                $('#update_pass').show();
                $('#password').hide();
                $('.modal-title').text('Edit Data');
                $("#in").removeClass("btn btn-primary add");
                $("#in").addClass("btn btn-primary update");
                $('#in').text('Update');
                $('#myModal').modal('show');

            },
        });

    });
    //end edit
    //update password
    $(document).on('click', '#update_pass', function() {
        $('#update_pass').hide();
        $('#password').show();
    });
    //update
    $('.modal-footer').on('click', '.update', function() {
        $.ajax({
            type: 'PUT',
            url: '/update_user/' + id,
            data: {
                '_token': "{{ csrf_token() }}",
                'nama_user': $('#nama_user').val(),
                'username': $('#username').val(),
                'password': $('#password').val(),
                'id_divisi': $('#id_divisi').val(),
                'hak_akses': $('#hak_akses').val(),

            },
            success: function(data) {
                document.getElementById("form-add").reset();
                $('#myModal').modal('hide');
                $('#users-table').DataTable().ajax.reload();
            }
        });
    });
    //end update
    //delete

    $(document).on('click', '#delete', function(e) {
        e.preventDefault();
        if (confirm('Yakin akan menghapus data ini?')) {
            // alert("Thank you for subscribing!" + $(this).data('id') );

            $.ajax({
                type: 'DELETE',
                url: '/delete_user/' + $(this).data('id'),
                data: {
                    '_token': "{{ csrf_token() }}",
                },
                success: function(data) {
                    alert("Data Berhasil Dihapus");
                    $('#users-table').DataTable().ajax.reload();
                }
            });

        } else {
            return false;
        }
    });
</script>

@endsection