<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nota</title>

    {{-- @dd($_COOKIE['innerHeight']) --}}
    <?php
    $style = '
        <style>
            * {
                font-family: "consolas", sans-serif;
            }
            p {
                display: block;
                margin: 3px;
                font-size: 9pt;
            }
            table td {
                font-size: 8pt;
            }
            .text-center {
                text-align: center;
            }
            .text-right {
                text-align: right;
            }
    
            .left-align {
                        float: left;
                    }
            
                    .right-align {
                        float: right;
                    }
            
                    /* Clearfix untuk membersihkan float */
                    .clearfix::after {
                        content: "";
                        clear: both;
                        display: table;
                    }
    
    
            @media print {
                @page {
                    margin: 0;
                    size: 75mm 
        ';
    ?>
    <?php
    $style .= !empty($_COOKIE['innerHeight']) ? $_COOKIE['innerHeight'] . 'mm; }' : '}';
    ?>
    <?php
    $style .= '
                html, body {
                    width: 70mm;
                }
                .btn-print {
                    display: none;
                }
            }
        </style>
        ';
    ?>

    {!! $style !!}
</head>

<body onload="window.print()">
    <button class="btn-print" style="position: absolute; right: 1rem; top: 1rem; margin-bottom: 0px" onclick="window.print()">Print</button>
    <div class="text-center">
        <h3 style="font-weight: 800">KOMOBOX</h3>
        <p class="responsive-paragraph" style="font-size: 10px; margin-top:0px">Jl. Rajawali 02, RT.03/RW.02, Pasopati, Jakarta Utara</p>
    </div>
    <br>
    <div class="clearfix"> <!-- Tambahkan class clearfix untuk membersihkan float -->
        <p class="left-align">{{ $penjualan->tanggal_penjualan }}</p>
        <p class="right-align">{{ $penjualan->role }} : {{ $penjualan->name }}</p>
    </div>
    <p class="left-align" style="margin-bottom: 0px; margin-top: 0px">Nota: {{ $penjualan->nota }}</p>
    {{-- <p class="text-center">=================================</p> --}}
    <br>
    <hr>
    <table width="100%" style="border: 0">
        @foreach ($detail as $item)
            <tr>
                <td colspan="5">{{ $item->product_name }}</td>

            </tr>
            <tr>
                <td width="20%">{{ $item->jumlah }} x</td>
                <td>{{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                <td width="50%"></td>
                <td width="15%">{{ $item->diskon }}%</td>
                <td class="text-right">{{ number_format($item->sub_total, 0, ',', '.') }}</td>
            </tr>
        @endforeach
    </table>
    <p class="text-center" style="margin-top: 0px; margin-bottom: 0px">=======================================</p>
    <table width="100%">
        <tr>
            <td width="25%"></td>
            <td>Total Harga + ppn</td>
            <td class="text-right">{{ number_format($penjualan->harga_akhir, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td width="25%"></td>
            <td>Total Item</td>
            <td class="text-right">{{ number_format($penjualan->total_item, 0, ',', '.') }}</td>
        </tr>
        <tr>

        </tr>
    </table>
    <p class="text-right" style="margin-top: 0px; margin-bottom: 0px">------------------------------</p>
    <table width="100%">
        <tr>
            <td width="25%"></td>
            <td>Tunai</td>
            <td class="text-right">{{ number_format($penjualan->bayar, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td width="25%"></td>
            <td>Kembalian</td>
            <td class="text-right">{{ number_format($penjualan->kembalian, 0, ',', '.') }}</td>
        </tr>
    </table>

    <p class="text-center" style="margin-top: 30px"> ===== Terima Kasih :) =====</p>

    <script>
        let body = document.body;
        let html = document.documentElement;
        let height = Math.max(
                body.scrollHeight, body.offsetHeight,
                html.clientHeight, html.scrollHeight, html.offsetHeight
            );

        document.cookie = "innerHeight=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "innerHeight="+ ((height + 50) * 0.264583);
    </script>
</body>

</html>
