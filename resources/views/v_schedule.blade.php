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
                        <th>ID Jadwal</th>
                        <th>Tanggal</th>
                        <th>Nama Divisi</th>
                        <th>Nama Mesin</th>
                        <th>Tanggal Jadwal</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>ID Jadwal</th>
                        <th>Tanggal</th>
                        <th>Nama Divisi</th>
                        <th>Nama Mesin</th>
                        <th>Tanggal Jadwal</th>
                        <th>Keterangan</th>
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
                <form method="post" role="form" id="form-add" enctype="multipart/form-data">
                    @csrf
                    <input type="text" id="id" hidden>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nama_schedule">ID JADWAL</label>
                            <input type="text" class="form-control" name="id_jadwal" id="id_jadwal" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="requester">NAMA REQUESTER</label>
                            <input type="text" class="form-control" name="requester" id="requester" value="{{Session::get('name')}}" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="username">TANGGAL SCHEDULE</label>
                            <input class="form-control" name="datepicker1" id="datepicker1" placeholder="Tanggal pembuatan schedule">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password">TANGGAL EKSEKUSI</label>
                            <input class="form-control" name="datepicker2" id="datepicker2" placeholder="Tanggal pengerjaan">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="id_divisi">Divisi</label>
                            <select name="id_divisi" id="id_divisi" class="form-control">
                                <option selected>Choose...</option>
                                @foreach($divisi as $divisi)
                                <option value="{{$divisi->id_divisi}}">{{$divisi->nama_divisi}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="id_mesin">MESIN</label>
                            <select name="id_mesin" id="id_mesin" class="form-control">
                                <option selected>Choose...</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <label for="p_check"> POINT CHECK </label>
                    </div>
                    <input type="button" class="btn btn-warning" onclick='selects()' value="Select All" />
                    <input type="button" class="btn btn-danger" onclick='deSelect()' value="Deselect All" />
                    <div id="t_check" class="form-row" style="height:150px;overflow-y:auto; border:1px solid #d1d3e2; border-radius: 5px; padding: 5px;margin-top:10px">
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
<div id="myModall" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" role="form" id="form-ket" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="stat_update" id="stat_update" hidden>
                    <input type="text" name="id" id="id-schedule" hidden>
                    <div class="form-row">
                        <label for="keterangan">KETERANGAN</label>
                        <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Masukan Status">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="close" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="in" type="button" class="btn btn-primary add-update">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script src="/assets/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<script>
    $('#datepicker1').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'dd/mm/yyyy',
    });
    $('#datepicker2').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'dd/mm/yyyy',
    });


    // $('#datepicker').on('change', function() {
    //     console.log($('#datepicker').val())
    // });
</script>
<script>
    $(function() {
        var oTable = $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            "columnDefs": [{
                    "className": "text-center",
                    "targets": [0, 1, 2, 3, 4, 5, 6, 7], // table ke 1
                },
                {
                    targets: 2,
                    render: function(oTable) {
                        return moment(oTable).format('DD-MM-YYYY');
                    }
                },
                {
                    targets: 5,
                    render: function(oTable) {
                        return moment(oTable).format('DD-MM-YYYY');
                    }
                }
            ],
            ajax: {
                url: '{{ url("json_schedule") }}'
            },
            "fnCreatedRow": function(row, data, index) {
                $('td', row).eq(0).html(index + 1);
            },
            columns: [{
                    data: 'id_schedule',
                    name: 'id_schedule'
                },
                {
                    data: 'id_jadwal1',
                    name: 'id_jadwal1'
                },
                {
                    data: 'tanggal',
                    name: 'tanggal'
                },
                {
                    data: 'nama_divisi',
                    name: 'nama_divisi'
                },
                {
                    data: 'mesin',
                    name: 'mesin'
                },
                {
                    data: 'tanggal_jadwal',
                    name: 'tanggal_jadwal'
                },
                {
                    data: 'keterangan',
                    name: 'keterangan'
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
            oTable.columns(8).visible(false);
        };
        if ("{{Session::get('hak_akses')}}" == "Petugas") {
            oTable.columns(7).visible(false);
        };

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
    $(document).on('click', '#close', function() {
        $('#p_check').remove();
        document.getElementById("form-add").reset();
    });

    $('.modal-footer').on('click', '.add', function() {
        var form = document.getElementById("form-add");
        var fd = new FormData(form);
        $.ajax({
            type: 'POST',
            url: '{{ url("store_schedule") }}',
            data: fd,
            processData: false,
            contentType: false,
            success: function(data) {
                document.getElementById("form-add").reset();
                $('#myModal').modal('hide');
                $('#users-table').DataTable().ajax.reload();

            },
        });
    });
    //end add data
    //edit progress
    $(document).on('change', '#hak_akses', function(e) {
        e.preventDefault();
        let str = $(this).val();
        const myArr = str.split("-");
        //console.log(myArr[1]);
        document.getElementById("form-ket").reset();
        $('#id-schedule').val(myArr[0]);
        $('#stat_update').val(myArr[1]);
        $('#myModall').modal('show');
    });
    //store status
    $('.modal-footer').on('click', '.add-update', function() {
        var form = document.getElementById("form-ket");
        var fd = new FormData(form);
        $.ajax({
            type: 'POST',
            url: '{{ url("update_schedule") }}',
            data: fd,
            processData: false,
            contentType: false,
            success: function(data) {
                document.getElementById("form-ket").reset();
                $('#myModall').modal('hide');
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
                url: 'delete_schedule/' + $(this).data('id'),
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
    $(document).on('change', '#id_divisi', function() {
        $.ajax({
            type: 'POST',
            url: 'select_mesin',
            data: {
                '_token': "{{ csrf_token() }}",
                'id_divisi': $('#id_divisi').val(),

            },
            success: function(data) {
                $('#id_mesin').empty();
                $('#id_mesin').append('<option value="">Choose...</option>');
                $.each(data, function(i) {
                    $('#id_mesin').append('<option value="' + data[i].id_mesin + '">' + data[i].mesin + '-' + data[i].jenis_mesin + '</option>');
                })

            },
        });
    });
    $(document).on('change', '#id_mesin', function() {
        $.ajax({
            type: 'POST',
            url: 'search_pcheck',
            data: {
                '_token': "{{ csrf_token() }}",
                'id_mesin': $('#id_mesin').val(),

            },
            success: function(data) {
                $('#p_check').remove();
                $('#t_check').append('<table id="p_check"></table>')
                $.each(data, function(i) {
                    $('#p_check').append(
                        '<tr><td>' +
                        '<input type="checkbox" name="p_check[]" value="' + data[i].id_check + '"> &nbsp ' + data[i].point_check +
                        '&nbsp ~ &nbsp' + data[i].jadwal +
                        '</td></tr>'
                    );

                })

            },
        });
    });
    //select & deselect all
    function selects() {
        var ele = document.getElementsByName('p_check[]');
        for (var i = 0; i < ele.length; i++) {
            if (ele[i].type == 'checkbox')
                ele[i].checked = true;
        }
    }

    function deSelect() {
        var ele = document.getElementsByName('p_check[]');
        for (var i = 0; i < ele.length; i++) {
            if (ele[i].type == 'checkbox')
                ele[i].checked = false;

        }
    }
</script>

@endsection