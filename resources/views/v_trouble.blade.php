@extends('v_index')


@section('konten')

<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

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
                        <th>ID PERBAIKAN</th>
                        <th>Tanggal</th>
                        <th>Nama User</th>
                        <th>Nama Mesin</th>
                        <th>Judul</th>
                        <th>Gambar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                        <th>Aksi</th>

                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>ID PERBAIKAN</th>
                        <th>Tanggal</th>
                        <th>Nama User</th>
                        <th>Nama Mesin</th>
                        <th>Judul</th>
                        <th>Gambar</th>
                        <th>Status</th>
                        <th>Aksi</th>
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
                <div id="message-container"></div>

                <form method="post" role="form" id="form-add" enctype="multipart/form-data">
                    @csrf
                    <input type="text" id="id" hidden>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nama_trouble">ID TROUBLE</label>
                            <input type="text" class="form-control" name="id_trouble" id="id_trouble" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="requester">NAMA REQUESTER</label>
                            <input type="text" class="form-control" name="requester" id="requester" value="{{Session::get('nama_user')}}" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="username">TANGGAL MASALAH <span style="color: red;">*</span></label>
                            <input class="form-control" name="dateTrouble" id="dateTrouble" placeholder="Tanggal Terjadi Masalah">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="judul">JUDUL</label>
                            <input type="text" class="form-control" name="judul" id="judul" placeholder="Judul Masalah">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="divisi">DIVISI</label>
                            <select name="divisi" id="divisi" class="form-control">
                                <option value="#" selected>Choose...</option>
                                @foreach($divisi as $divisi)
                                <option value="{{$divisi->id_divisi}}">{{$divisi->nama_divisi}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="mesin">MESIN</label>
                            <select name="mesin" id="mesin" class="form-control">
                                <option selected>Choose...</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row mb-2">
                        <label for="image">Gambar / Sketch</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                    <div class="form-row">
                        <textarea class="form-control" name="uraianMasalah" id="uraianMasalah" style="height:150px;border:1px solid #d1d3e2; border-radius: 5px; padding: 5px"></textarea>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button id="close" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="in" type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>



<script src="/assets/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<script>
    $('#dateTrouble').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'dd/mm/yyyy',
    });


    // $('#datepicker').on('change', function() {
    //     console.log($('#datepicker').val())
    // });
</script>
<script>
    $(document).ready(function() {
        var oTable = $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            "columnDefs": [{
                    "className": "text-center",
                    "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, ], // table ke 1
                },
                {
                    targets: 2,
                    render: function(oTable) {
                        return moment(oTable).format('DD-MM-YYYY');
                    }
                },
            ],
            order: [
                [2, 'dsc']
            ],
            ajax: {
                url: '{{ url("json_trouble") }}'
            },
            "fnCreatedRow": function(row, data, index) {
                $('td', row).eq(0).html(index + 1);
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'id_trouble',
                    name: 'id_trouble'
                },
                {
                    data: 'tgl_perbaikan',
                    name: 'tgl_perbaikan'
                },
                {
                    data: 'requester',
                    name: 'requester'
                },
                {
                    data: 'mesin.mesin',
                    name: 'mesin.mesin'
                },
                {
                    data: 'judul',
                    name: 'judul'
                },
                {
                    data: 'images',
                    name: 'images'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'aksi',
                    name: 'aksi'
                },
                {
                    data: 'aksi_petugas',
                    name: 'aksi_petugas'
                }
            ],
        })
        if ("{{Session::get('hak_akses')}}" == "Admin") {
            oTable.columns(7).visible(false);
            oTable.columns(9).visible(false);
        };
        if ("{{Session::get('hak_akses')}}" == "User") {
            oTable.columns(8).visible(false);
            oTable.columns(9).visible(false);
        };
        if ("{{Session::get('hak_akses')}}" == "Petugas") {
            oTable.columns(7).visible(false);
            oTable.columns(8).visible(false);
        };

        //add data
        $(document).on('click', '#add', function() {
            $('.modal-title').text('Tambah Data');
            $("#in").removeClass("btn btn-primary update");
            $("#in").addClass("btn btn-primary add");
            $('#in').text('Save');
            document.getElementById("form-add").reset();
            $('#update_pass').hide();
            $('#password').show();
            $('#in').attr('disabled', false);
            $('#myModal').modal('show');
        });
        $(document).on('click', '#close', function() {
            $('#p_check').remove();
            document.getElementById("form-add").reset();
        });

        $('.modal-footer').on('click', '.add', function() {
            var form = document.getElementById("form-add");
            var fd = new FormData(form);
            $.ajax({
                type: 'POST',
                url: '/store_trouble',
                data: fd,
                processData: false,
                contentType: false,
                success: function(data) {
                    document.getElementById("form-add").reset();
                    $('#myModal').modal('hide');
                    $('#users-table').DataTable().ajax.reload();

                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors || {
                        message: 'Something went wrong.'
                    };
                    let errorMessage = '';
                    $.each(errors, function(key, value) {
                        errorMessage += '<div class="alert alert-danger">' + value[0] + '</div>';
                    });
                    $("#message-container").html(errorMessage);
                }
            });
        });
        //end add data
        $(document).on('click', '#detail', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            $.ajax({
                type: 'GET',
                url: '/detail_trouble/' + id,
                success: function(data) {
                    $('#id_trouble').val(data.id_trouble);
                    $('#requester').val(data.requester);
                    $('#dateTrouble').val(moment(data.tgl_perbaikan).format('DD/MM/YYYY'));
                    $('#judul').val(data.judul);
                    $('#divisi').val(data.id_divisi).trigger('change');
                    $(document).ajaxComplete(function(event, xhr, settings) {
                        if ($('#mesin option').length > 1) {
                            $('#mesin').val(data.id_mesin).trigger('change');
                        }
                    });
                    $('#uraianMasalah').val(data.keterangan);
                    $('#myModal').modal('show');
                    $('#in').attr('disabled', true);
                },
                error: function(xhr) {
                    alert('Gagal memuat data');
                }
            });
        });
        //edit progress
        $(document).on('change', '#hak_akses', function(e) {
            e.preventDefault();
            let str = $(this).val();
            const myArr = str.split("-");
            //console.log(myArr[1])
            $.ajax({
                type: 'PUT',
                url: 'update_trouble/' + myArr[0],
                data: {
                    '_token': "{{ csrf_token() }}",
                    'id': myArr[0],
                    'status': myArr[1],

                },
                success: function(data) {
                    $('#users-table').DataTable().ajax.reload();

                },
            });
        });
        //delete data
        $(document).on('click', '#delete', function(e) {
            e.preventDefault();
            if (confirm('Yakin akan menghapus data ini?')) {
                // alert("Thank you for subscribing!" + $(this).data('id') );

                $.ajax({
                    type: 'PUT',
                    url: 'delete_trouble/' + $(this).data('id'),
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
        //tampilin mesin
        $('#divisi').on('change', function() {
            $.ajax({
                type: 'POST',
                url: '/select_mesin',
                data: {
                    '_token': "{{ csrf_token() }}",
                    'id_divisi': $('#divisi').val(),

                },
                success: function(data) {
                    $('#mesin').empty();
                    $('#mesin').append('<option value="">Choose...</option>');
                    $.each(data, function(i) {
                        $('#mesin').append('<option value="' + data[i].id_mesin + '">' + data[i].mesin + '-' + data[i].jenis_mesin + '</option>');
                    })

                },
            });
        });
        // $(document).on('change', '#id_mesin', function() {
        //     $.ajax({
        //         type: 'POST',
        //         url: 'search_pcheck',
        //         data: {
        //             '_token': "{{ csrf_token() }}",
        //             'id_mesin': $('#id_mesin').val(),

        //         },
        //         success: function(data) {
        //             $('#p_check').remove();
        //             $('#t_check').append('<table id="p_check"></table>')
        //             $.each(data, function(i) {
        //                 $('#p_check').append(
        //                     '<tr><td>' +
        //                     '<input type="checkbox" name="p_check[]" value="' + data[i].id_check + '"> &nbsp ' + data[i].point_check +
        //                     '</td></tr>'
        //                 );

        //             })

        //         },
        //     });
        // });
    });
</script>

@endsection