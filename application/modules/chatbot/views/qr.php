<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SBE Bot - QR Code</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background: #f0f0f0;
        }
        #qr-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        #status {
            margin-top: 20px;
            font-size: 16px;
            color: #333;
        }
    </style>
</head>
<body>
    <h2>🤖 SBE Bot — Scan QR</h2>
    <div id="qr-container"></div>
    <p id="status">Mengambil QR...</p>

    <script>
        let qrInstance = null;

        async function loadQR() {
            const res = await fetch('http://localhost:3005/qr');
            const data = await res.json();

            if (data.status === 'connected') {
                document.getElementById('qr-container').innerHTML = '<h3>✅ Bot sudah terhubung ke WhatsApp!</h3>';
                document.getElementById('status').textContent = 'Tidak perlu scan QR';
            } else if (data.qr) {
                document.getElementById('status').textContent = 'Scan QR ini dengan WhatsApp';
                document.getElementById('qr-container').innerHTML = '';
                new QRCode(document.getElementById('qr-container'), {
                    text: data.qr,
                    width: 256,
                    height: 256,
                });
            }
            else{
                document.getElementById('qr-container').innerHTML = '<h3>Error</h3>';
                document.getElementById('status').textContent = 'Tidak perlu scan QR';

            }
        }

        loadQR();
        setInterval(loadQR, 5000); // refresh tiap 5 detik
    </script>
</body>
</html>