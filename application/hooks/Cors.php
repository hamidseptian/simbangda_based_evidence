<?php
class Cors {

    public function handle() {

        // 1. Daftar domain yang diizinkan
        $allowed_origins = [
            'https://domain-utama.com',
            'https://app.domain-utama.com'
        ];

        // 2. Ambil origin dari request
        $origin = $_SERVER['HTTP_ORIGIN'] ?? '';

        // 3. Validasi origin
        if (in_array($origin, $allowed_origins)) {
            header("Access-Control-Allow-Origin: $origin");
        }

        // 4. Atur method yang diizinkan
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

        // 5. Atur header yang diizinkan
        header("Access-Control-Allow-Headers: Content-Type, Authorization");

        // 6. Handle preflight request (OPTIONS)
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            http_response_code(200);
            exit();
        }
    }
}