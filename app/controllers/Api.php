<?php

class Api extends Controller {
    public function bot_sync()
    {
        // 1. Verifikasi Token Keamanan
        $headers = apache_request_headers();
        $secret_token = "ARIO_SECRET_TOKEN_2026";

        if (!isset($headers['Authorization']) || $headers['Authorization'] !== 'Bearer ' . $secret_token) {
            http_response_code(403);
            echo json_encode(["status" => "error", "message" => "Akses Ditolak! Token tidak valid."]);
            exit;
        }

        // 2. Tangkap Payload JSON dari GAS
        $input = file_get_contents("php://input");
        $data = json_decode($input, true);

        if (empty($data)) {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "Data payload kosong."]);
            exit;
        }

        $apiModel = $this->model('Api_model');
        $total_masuk = 0;

        // 4. Looping data yang dikirim oleh GAS
        foreach ($data as $item) {
            $kategori = $item['kategori'];
            $judul = $item['judul'];
            $file_id = $item['file_id'];

            // Insert kategori jika belum ada
            $id_kategori = $apiModel->insertCategoryIfNotExists($kategori);

            // Insert buku ke dalam draft
            if ($id_kategori) {
                $inserted = $apiModel->insertBookDraft($judul, $id_kategori, $file_id);
                if ($inserted) {
                    $total_masuk++;
                }
            }
        }

        echo json_encode(["status" => "success", "buku_baru_ditambahkan" => $total_masuk]);
    }
}
