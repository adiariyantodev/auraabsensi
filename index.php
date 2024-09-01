<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Scanner</title>
    <style>
        #qr-reader {
            width: 100%;
            max-width: 500px;
            margin: auto;
        }
        #qr-reader-results {
            margin-top: 20px;
            text-align: center;
        }
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            justify-content: center;
            align-items: center;
            color: white;
        }
        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
        }

        p{
            color:black;
        }
    </style>
</head>
<body>
    <h1>QR Code Scanner</h1>
    <div id="qr-reader"></div>
    <div id="qr-reader-results"></div>

    <!-- Modal Thanks -->
    <div id="modalThanks" class="modal">
        <div class="modal-content">
            <p id="modalMessage"></p>
            <p>Selamat Bekerja!</p>
        </div>
    </div>

    <script src="js/minified/html5-qrcode.min.js"></script>
    <script>
        function onScanSuccess(qrMessage) {
            // Tampilkan modal dengan pesan yang sesuai
            document.getElementById('modalMessage').textContent = `Thank ${qrMessage},`;
            document.getElementById('modalThanks').style.display = 'flex';

            // Atur waktu untuk mereload halaman setelah 3 detik
            setTimeout(function() {
                location.reload();
            }, 3000);
        }

        function onScanFailure(error) {
            // Handle scan failure, usually better to ignore and keep scanning.
            console.warn(`QR error = ${error}`);
        }

        function startScanning() {
            let html5QrcodeScanner = new Html5QrcodeScanner(
                "qr-reader", { 
                    fps: 10, 
                    qrbox: { width: 250, height: 250 },
                    aspectRatio: 1.0,
                    experimentalFeatures: {
                        useBarCodeDetectorIfSupported: true
                    }
                },
                /* verbose= */ false);

            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        }

        // Mulai scanning ketika halaman dimuat
        startScanning();
    </script>
</body>
</html>
