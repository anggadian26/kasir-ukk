<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Berhasil</title>
    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
    <style>
        .success-container {
            text-align: center;
            background-color: #ffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            animation: fadeIn 1s ease-out;
        }

        @media (min-width: 768px) {
            .lottie-animation {
                width: 20%;
                /* Sesuaikan dengan ukuran yang diinginkan untuk tampilan desktop */
            }

            .container-lottie {
                width: 50%;
            }
        }

        .lottie-animation {
            width: 100%;
            max-width: 300px;
            /* Sesuaikan dengan ukuran yang diinginkan */
            height: auto;
            margin: 0 auto;
            animation: scaleUp 0.5s ease-out;
        }

        .success-text {
            font-size: 18px;
            margin-top: 20px;
            /* Sesuaikan dengan kebutuhan Anda */
            color: #333;
        }
    </style>
    @include('link-asset.head')
</head>

<body>
    <div class="container-xxl container-p-y">
        <div class="row">
            <div class="d-flex justify-content-start">

            </div>
            <div class="d-flex justify-content-center container-lottie mt-3">
                <dotlottie-player class="lottie-animation"
                    src="https://lottie.host/6c93670b-fece-41b1-96b1-cdba3aadbe5c/jZkvLLOlJk.json"
                    background="transparent" speed="1" autoplay></dotlottie-player>
            </div>
            <div class="row">
                <div class="d-flex justify-content-center mt-5">
                    <div class="">
                        <h3 class="fw-semibold">Transaksi Berhasil disimpan</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="d-flex justify-content-center mt-5">
                    <div class="col-12 text-center">
                        <a href="{{ route('index.penjualan') }}" class="btn-lg btn btn-outline-secondary me-2">Kembali
                            ke halaman utama</a>
                        <a href="{{ route('transactionCreate.penjualan') }}"
                            class="btn-lg btn btn-primary me-2">Transaksi Baru</a>
                        <button class="btn-lg btn-warning"
                            onclick="cetakNota('{{ route('nota.penjualan') }}', 'cetak nota')">[enter] Cetak
                            Nota</button>
                    </div>
                    {{-- <div class="col-3"> --}}
                </div>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
    @include('link-asset.script')
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.cookie = "innerHeight=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";

        function cetakNota(url, title) {
            popupCenter(url, title, 625, 500);
        }

        function popupCenter(url, title, w, h) {
            const dualScreenLeft = window.screenLeft !== undefined ? window.screenLeft : window.screenX;
            const dualScreenTop = window.screenTop !== undefined ? window.screenTop : window.screenY;

            const width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document
                .documentElement.clientWidth : screen.width;
            const height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document
                .documentElement.clientHeight : screen.height;

            const systemZoom = width / window.screen.availWidth;
            const left = (width - w) / 2 / systemZoom + dualScreenLeft
            const top = (height - h) / 2 / systemZoom + dualScreenTop
            const newWindow = window.open(url, title,
                `
            scrollbars=yes,
            width  = ${w / systemZoom}, 
            height = ${h / systemZoom}, 
            top    = ${top}, 
            left   = ${left}
        `
            );

            if (window.focus) newWindow.focus();
        }

        function handleKeyPress(event) {
            // Cek apakah tombol yang ditekan adalah tombol enter (kode 13)
            if (event.keyCode === 13) {
                // Panggil fungsi untuk mencetak nota
                cetakNota('{{ route('nota.penjualan') }}', 'cetak nota');
            }
        }

        // Menambahkan event listener untuk keypress di level dokumen
        document.addEventListener('keypress', handleKeyPress);
    </script>
</body>

</html>
