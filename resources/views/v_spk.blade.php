<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: sans-serif;
        }

        table {
            border: 1pt solid black !important;
            border-collapse: collapse;
        }

        tr,
        td {
            border: 1pt solid black !important;
            height: 25pt;
            padding-left: 3px;
            padding-right: 3px;

        }


        h1,
        h2,
        h3,
        h4,
        h5 {
            margin: 0px;
        }

        .border-bottom {
            border-bottom: hidden !important;
        }

        .border-top {
            border-top: hidden !important;
        }

        .border-right {
            border-right: hidden !important;
        }

        .border-left {
            border-left: hidden !important;
        }


        .center {
            text-align: center;
        }

        .top-border {
            border-left: hidden !important;
            border-top: hidden !important;
            border-right: hidden !important;
        }

        @media print {
            table {
                width: 95% !important;
            }
        }
    </style>
</head>

<body>
    <table style="width: 80%;" align="center">
        <tr>
            <td class="top-border" style="width: 4% ;">1</td>
            <td class="top-border" style="width: 2% ;">2</td>
            <td class="top-border" style="width: 20% ;">3</td>
            <td class="top-border" style="width: 4% ;">4</td>
            <td class="top-border" style="width: 9% ;">5</td>
            <td class="top-border" style="width: 4% ;">6</td>
            <td class="top-border" style="width: 3% ;">7</td>
            <td class="top-border" style="width: 7% ;">8</td>
            <td class="top-border" style="width: 9% ;">9</td>
            <td class="top-border" style="width: 9% ;">10</td>
            <td class="top-border" style="width: 9% ;">11</td>
        </tr>
        <tr>
            <td rowspan="4" colspan="2" class="center"><img src="/assets/img/rpa.png" width="100">
                <h3 style="color: blue;">PT. RPA</h3>
            </td>
            <td colspan="6"></td>
            <td class="center">SPV PROD</td>
            <td class="center">SPV MTC</td>
            <td class="center">ADM MTC</td>
        </tr>
        <td colspan="6" class="center border-bottom border-top">
            <h2>CHECKSHEET PREVENTIVE MAINTENANCE</h2>
        </td>
        <td rowspan="3"></td>
        <td rowspan="3"></td>
        <td rowspan="3"></td>
        <tr>
            <td colspan="6" class="center border-bottom">
                <h2>MESIN {{strtoupper($data->jenis_mesin)}}</h2>
            </td>
        </tr>
        <tr>
            <td colspan="6" class="center" style="font-weight: bold;">(BULANAN)</td>
        </tr>
        <tr>
            <td colspan="2" class="border-right">MESIN</td>
            <td>: {{$data->mesin}}</td>
            <td colspan="2" class="center">PLAN</td>
            <td colspan="3" class="center">ACTUAL</td>
            <td colspan="3" class="center" style="background-color:gray">KETERANGAN PENGISIAN</td>
        </tr>
        <tr>
            <td colspan="2" class="border-right">NO MESIN</td>
            <td>: {{$data->kode_mesin}}</td>
            <td class="border-right border-bottom">TGL :</td>
            <td class="border-bottom">{{date("d-m-Y",strtotime($data->tanggal_jadwal))}}</td>
            <td class="border-right border-bottom">TGL :</td>
            <td colspan="2" class="border-bottom"></td>
            <td class="center border-right border-bottom">v = OK</td>
            <td colspan="2" rowspan="2">* Apabila standar angka, hasil pengecekan ditulis angka</td>
        </tr>
        <tr>
            <td colspan="2" class="border-right">AREA</td>
            <td>: {{$data->nama_divisi}}</td>
            <td class="border-right">JAM :</td>
            <td></td>
            <td class="border-right">JAM :</td>
            <td colspan="2"></td>
            <td class=" center border-right">x = NG</td>
        </tr>
        <tr>
            <td rowspan="2" class="center">NO</td>
            <td colspan="2" rowspan="2" class="center">BAGIAN YANG DI CHECK</td>
            <td colspan="2" rowspan="2" class="center">STANDAR</td>
            <td colspan="3" class="center">HASIL CHECK</td>
            <td colspan="3" rowspan="2" class="center">KETERANGAN</td>
        </tr>
        <tr>
            <td colspan="2" class="center">OK</td>
            <td class="center">NG</td>
        </tr>
        <!-- <tr>
            <td class="center">1</td>
            <td colspan="2" class="center">OLI GEARBOX TRANSMISI CRANK</td>
            <td colspan="2" class="center">1/2 ~ FULL</td>
            <td colspan="2"></td>
            <td></td>
            <td colspan="3"></td>
        </tr> -->
        @foreach($p_check as $key => $check)
        <tr>
            <td class="center">{{++$key}}</td>
            <td colspan="2" class="center">{{$check->point_check}}</td>
            <td colspan="2" class="center">{{$check->standard}}</td>
            <td colspan="2"></td>
            <td></td>
            <td colspan="3"></td>
        </tr>
        @endforeach
        <tr>
            <td colspan="2" class="border-right border-bottom">Catatan :</td>
            <td colspan="7" class="border-bottom"></td>
            <td colspan="2" class="center">SERAH TERIMA</td>
        </tr>
        <tr>
            <td colspan="9" rowspan="2"></td>
            <td class="center">USER</td>
            <td class="center">MTC</td>
        </tr>
        <tr>
            <td style="height: 100px;"></td>
            <td></td>
        </tr>

    </table>

</body>

</html>