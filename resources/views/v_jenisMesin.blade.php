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
                        <th>Jenis Mesin</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Jenis Mesin</th>
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
                    <div class="form-row">
                        <label for="jenis_mesin">Jenis MESIN</label>
                        <input type="text" class="form-control" id="jenis_mesin" placeholder="Jenis Mesin">
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
                "targets": [0, 1, 2, ], // table ke 1
            }],
            ajax: {
                url: '{{ url("json_jenisMesin") }}'
            },
            "fnCreatedRow": function(row, data, index) {
                $('td', row).eq(0).html(index + 1);
            },
            columns: [{
                    data: 'id_jenisMesin',
                    name: 'id_jenisMesin'
                },
                {
                    data: 'jenis_mesin',
                    name: 'jenis_mesin'
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
        $('#myModal').modal('show');
    });
    $('.modal-footer').on('click', '.add', function() {
        $.ajax({
            type: 'POST',
            url: '{{ url("store_jenisMesin") }}',
            data: {
                '_token': "{{ csrf_token() }}",
                'jenis_mesin': $('#jenis_mesin').val(),
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
            url: 'edit_jenisMesin',
            data: {
                '_token': "{{ csrf_token() }}",
                'id': uid,
            },
            success: function(data) {
                //console.log(data);

                //isi form
                $('#id').val(data.id_jenisMesin);
                $('#jenis_mesin').val(data.jenis_mesin);

                id = $('#id').val();

                $('.modal-title').text('Edit Data');
                $("#in").removeClass("btn btn-primary add");
                $("#in").addClass("btn btn-primary update");
                $('#in').text('Update');
                $('#myModal').modal('show');

            },
        });

    });
    //end edit
    //update
    $('.modal-footer').on('click', '.update', function() {
        $.ajax({
            type: 'PUT',
            url: 'update_jenisMesin/' + id,
            data: {
                '_token': "{{ csrf_token() }}",
                'jenis_mesin': $('#jenis_mesin').val(),

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
                url: 'delete_jenisMesin/' + $(this).data('id'),
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