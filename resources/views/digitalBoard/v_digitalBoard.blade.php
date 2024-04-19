<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
        }


        header {
            background-color: #d6d6d6;
            color: white;
            padding: 1%;
            text-align: center;
        }

        .container {
            flex: 1;
            justify-content: center;
            padding: 20px;
        }

        main {
            display: flex;
            justify-content: space-around;
            padding: 5vh;
        }

        .card {
            background-color: #f2f2f2;
            border-radius: 5px;
            border-color: #ff8200 !important;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            padding: 20px;
            width: 16rem;
            min-height: 8rem;
            margin: 1rem auto;

        }

        h2 {
            text-align: center;
            font-size: 2vw !important;
        }

        h3 {
            font-size: 1.5vw !important;
        }

        h4 {
            font-size: 1.2vw !important;
        }

        p {
            margin-bottom: 0 !important;
        }

        table {
            width: 100%;
        }

        .text-center {
            text-align: center;
        }

        .background {
            border: 1px solid black;
            background-color: #4782d6;
            padding: 0.5em;
            border-radius: 10px;
            margin: 0 auto;
        }

        /* modals */
        ul {
            list-style-type: none;
            padding: 0;
        }

        ul li {
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
        }

        /* Style untuk mengubah setiap elemen list menjadi tautan */
        ul li a {
            text-decoration: none;
            color: blue;
            /* Warna tautan */
            cursor: pointer;
        }

        ul li label {
            display: inline-block;
            width: 150px;
        }

        ul li span {
            display: inline-block;
            /* Warna tautan */
            cursor: pointer;
            margin-left: 1rem;
        }



        @media (min-width: 768px) {

            .container,
            .container-md,
            .container-sm {
                max-width: 799px !important;
            }

            .col-xl-4 {
                flex: 0 0 33.33333%;
                max-width: 33.33333%;
            }

            .col-xl-2 {
                flex: 0 0 16.66667%;
                max-width: 16.66667%;
            }

            .f-rpa {
                font-size: 0.7rem;
                margin-bottom: 0px;
            }

            .f-detail {
                font-size: 0.45rem;
                margin-bottom: 0px;
            }
        }

        @media (min-width: 1200px) {
            .f-rpa {
                font-size: 13pt;
                margin-bottom: 0px;
            }

            .f-detail {
                font-size: 8pt;
                margin-bottom: 0px;
            }
        }
    </style>
    <script src="/assets/vendor/jquery/jquery.min.js"></script>
    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <link href="/assets/css/sb-admin-2.min.css" rel="stylesheet">
    <script src="/assets/js/clock.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="/assets/js/sb-admin-2.min.js"></script>
    <title>PT RACHMAT PERDANA ADHIMETAL</title>
</head>

<body onload="countdowntimes()">
    <header>
        <div>
            <div class="row mb-3">
                <div class="col-md-4 logo">
                    <img src="/assets/img/RPA.png" alt="Logo PT Rachmat Perdana Adhimetal" width="70">
                    <div style="text-align: left;display:inline-block;vertical-align: middle;color:blue">
                        <p class="f-rpa">PT RACHMAT PERDANA ADHIMETAL</p>
                        <p class="f-detail">manufacturing of metal stamping and welding products</p>
                    </div>
                </div>
                <div class="col-md-4" style="display: flex; align-items: center;">
                    <div class="background">
                        <h2>Digital Board Production</h2>
                    </div>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-2" style="display: flex; align-items: center;color:black">
                    <div class="date-time" style="margin: 0 auto;">
                        <h4>{{date('l, d F Y')}}</h4>
                        <h3 style="font-weight: bold;" id="preview"></h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="background">
                        <h3>MESIN {{strtoupper($mesin->jenisMesin->jenis_mesin . " " . $mesin->mesin)}}</h3>
                    </div>
                </div>
                <div class="col-md-5">
                </div>
                <div class="col-md-2">
                    <div class="background">
                        <h2>{{$mesin->kode_mesin}}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <i>
                        <h6 class="mt-2 mb-0 text-right" style="color: #737373;">Copyright from Budiwhy © 2024</h6>
                    </i>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <main>
            <table>
                <tbody>
                    <tr>
                        <td>
                            <button class="card" id="listContent" data-content="SOP PRODUCTION">
                                <h2>SOP PRODUCTION</h2>
                            </button>
                        </td>
                        <td></td>
                        <td>
                            <button class="card" id="listContent" data-content="WI SETTING DIES">
                                <h2>WI SETTING DIES</h2>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button class="card" id="listContent" data-content="QUALITY">
                                <h2>QUALITY</h2>
                            </button>
                        </td>
                        <td class="text-center p-5">
                            <span onclick="toggleFullScreen()">
                                <img src="/assets/img/icon-home.png" alt="icon home">
                            </span>
                        </td>
                        <td>
                            <button class="card" id="listContent" data-content="OPL">
                                <h2>OPL</h2>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button class="card" id="listContent" data-content="DAILY CHECKSHEET">
                                <h2>DAILY CHECKSHEET</h2>
                            </button>
                        </td>
                        <td></td>
                        <td>
                            <button class="card" id="listContent" data-content="SOP">
                                <h2>SOP</h2>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

        </main>
    </div>



    <!-- modals -->
    <div id="myModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><a href="#" id="modalTitleLink">Modal title</a>.</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 2rem;">
                    <ul id="contentFill">

                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</body>


<script>
    // Fungsi untuk mengubah mode layar penuh
    function toggleFullScreen() {
        var elem = document.documentElement;
        if (!document.fullscreenElement) {
            if (elem.requestFullscreen) {
                elem.requestFullscreen();
            } else if (elem.mozRequestFullScreen) {
                /* Firefox */
                elem.mozRequestFullScreen();
            } else if (elem.webkitRequestFullscreen) {
                /* Chrome, Safari and Opera */
                elem.webkitRequestFullscreen();
            } else if (elem.msRequestFullscreen) {
                /* IE/Edge */
                elem.msRequestFullscreen();
            }
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.mozCancelFullScreen) {
                /* Firefox */
                document.mozCancelFullScreen();
            } else if (document.webkitExitFullscreen) {
                /* Chrome, Safari and Opera */
                document.webkitExitFullscreen();
            } else if (document.msExitFullscreen) {
                /* IE/Edge */
                document.msExitFullscreen();
            }
        }
    }
</script>
<script>
    $(function() {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $(document).on('click', '#listContent', function(e) {
            e.preventDefault();
            var uid = $(this).data('content');

            $.ajax({
                type: 'POST',
                url: '/get_contentBoard',
                data: {
                    _token: csrfToken,
                    category: uid,
                    mesinId: '{{$mesin->id_mesin}}',
                },
                success: function(data) {
                    if (data.content.length > 0) {
                        $("#contentFill").empty();
                        dataa = data.content;
                        $.each(dataa, function(i) {
                            if (dataa[i].machine.length > 0) {
                                $('#contentFill').append(
                                    '<li>' +
                                    '<a href="/showContentBoard/search?mesin={{$mesin->kode_mesin}}&content=' + dataa[i].id + '"">' + dataa[i].directory + '</a>' +
                                    '</li>'
                                );
                            }
                        })

                        $('.modal-title').text('CONTENT ' + uid);
                        $('#myModal').modal('show');
                    } else {
                        alert('Data Tidak Ditemukan');
                    }
                },
                error: function(data) {
                    alert('Data Tidak Ditemukan');
                }
            });

            // console.log(uid);
        });
    })
</script>

</html>