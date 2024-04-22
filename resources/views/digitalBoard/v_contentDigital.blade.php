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
            max-width: 100% !important;
        }

        main {
            display: flex;
            justify-content: space-around;
            /* padding: 5vh; */
            text-align: center;
            height: 100%;
        }

        .card {
            background-color: #f2f2f2;
            border-radius: 5px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            padding: 20px;
            width: 60%;
            margin: 1rem auto;

        }

        h2 {
            text-align: center;
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
    </style>
    <script src="/assets/vendor/jquery/jquery.min.js"></script>
    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <link href="/assets/css/sb-admin-2.min.css" rel="stylesheet">
    <script src="/assets/js/clock.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="/assets/js/sb-admin-2.min.js"></script>
    <script src="/assets/js/fullscreen.js"></script>
    <script>
        window.addEventListener("load", function() {
            // Jalankan fungsi di sini
            toggleFullScreen();
        });
    </script>
    <title>PT RACHMAT PERDANA ADHIMETAL</title>
</head>

<body onload="countdowntimes()">
    <header>
        <div>
            <div class="row mb-3">
                <div class="col-xl-4 logo">
                    <img src="/assets/img/RPA.png" alt="Logo PT Rachmat Perdana Adhimetal" width="70">
                    <div style="text-align: left;display:inline-block;vertical-align: middle;color:blue">
                        <p style="font-size: 13pt;margin-bottom:0px;">PT RACHMAT PERDANA ADHIMETAL</p>
                        <p style="font-size: 8pt;margin-bottom:0px;">manufacturing of metal stamping and welding products</p>
                    </div>
                </div>
                <div class="col-xl-4" style="display: flex; align-items: center;">
                    <div class="background">
                        <h2>Digital Board Production</h2>
                    </div>
                </div>
                <div class="col-xl-2"></div>
                <div class="col-xl-2" style="display: flex; align-items: center;color:black">
                    <div class="date-time" style="margin: 0 auto;">
                        <p>{{date('l, d F Y')}}</p>
                        <h3 style="font-weight: bold;" id="preview"></h3>
                    </div>
                    <div style="margin-left:0.5rem;padding: 10px;border:1px solid #fd7e14;border-radius: 50%">
                        <a href="/digitalProduction/{{$mesin->kode_mesin}}"><img src="/assets/img/icon-home.png" width="30" alt="icon home"></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-5">
                    <div class="background">
                        <h3>MESIN {{strtoupper($mesin->jenisMesin->jenis_mesin . " " . $mesin->mesin)}}</h3>
                    </div>
                </div>
                <div class="col-xl-5">
                </div>
                <div class="col-xl-2">
                    <div class="background">
                        <h2>{{$mesin->kode_mesin}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <main>
            <img src="/{{$content}}" style="width: 100%" alt="content">
        </main>
    </div>



</body>



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
                },
                success: function(data) {
                    if (data.content.length > 0) {
                        $("#contentFill").empty();
                        dataa = data.content;
                        $.each(dataa, function(i) {
                            $('#contentFill').append(
                                '<li>' +
                                '<a href="/showContentBoard/' + dataa[i].id + '"">' + dataa[i].directory + '</a>' +
                                '</li>'
                            );
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