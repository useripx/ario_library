<?php

class CustomerService extends Controller {

    public function __construct()
    {
        // Require login for Customer Service
        if (!isset($_SESSION['user_id'])) {
            Flasher::setFlash('Harap login terlebih dahulu untuk mengakses layanan pelanggan.', 'Akses Ditolak', 'warning');
            header('Location: ' . BASEURL . '/auth');
            exit;
        }
    }

    public function index()
    {
        $data['judul'] = 'Customer Service';
        $data['messages'] = $this->model('Message_model')->getMessagesByUser($_SESSION['user_id']);
        
        $this->view('templates/header', $data);
        $this->view('customerservice/index', $data);
        $this->view('templates/footer', $data);
    }

    public function send()
    {
        if ($this->model('Message_model')->sendMessage($_POST, $_SESSION['user_id']) > 0) {
            Flasher::setFlash('Masukan Anda berhasil dikirim! Tim kami akan segera merespons.', 'Berhasil', 'success');
        } else {
            Flasher::setFlash('Gagal mengirim masukan, coba lagi.', 'Gagal', 'error');
        }
        
        header('Location: ' . BASEURL . '/customerservice');
        exit;
    }
}
