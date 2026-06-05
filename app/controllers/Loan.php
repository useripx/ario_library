<?php

class Loan extends Controller {
    public function __construct()
    {
        // Must be logged in as user for all loan actions
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL . '/auth');
            exit;
        }
    }

    public function index()
    {
        $data['judul'] = 'Pinjaman Saya';
        $data['loans'] = $this->model('Loan_model')->getLoansByUser($_SESSION['user_id']);
        
        $this->view('templates/header', $data);
        $this->view('loan/index', $data);
        $this->view('templates/footer', $data);
    }

    public function borrow($book_id)
    {
        // Prevent double borrowing
        if ($this->model('Loan_model')->isBorrowedByUser($_SESSION['user_id'], $book_id)) {
            Flasher::setFlash('Buku sedang dipinjam', 'Gagal', 'warning');
            header('Location: ' . BASEURL . '/book/detail/' . $book_id);
            exit;
        }

        $result = $this->model('Loan_model')->addLoan($_SESSION['user_id'], $book_id);

        if ($result > 0) {
            Flasher::setFlash('Buku berhasil dipinjam', 'Berhasil', 'success');
            header('Location: ' . BASEURL . '/loan');
            exit;
        } elseif ($result == -1) {
            Flasher::setFlash('Maksimal pinjam 3 buku!', 'Limit Tercapai', 'error');
            header('Location: ' . BASEURL . '/loan');
            exit;
        } elseif ($result == -2) {
            Flasher::setFlash('Stok buku habis!', 'Gagal', 'error');
            header('Location: ' . BASEURL . '/book/detail/' . $book_id);
            exit;
        } else {
            Flasher::setFlash('Terjadi kesalahan saat meminjam buku', 'Gagal', 'error');
            header('Location: ' . BASEURL . '/book/detail/' . $book_id);
            exit;
        }
    }

    public function renew($id)
    {
        if ($this->model('Loan_model')->renewLoan($id) > 0) {
            header('Location: ' . BASEURL . '/loan');
            exit;
        } else {
            header('Location: ' . BASEURL . '/loan');
            exit;
        }
    }

    public function return($id)
    {
        if ($this->model('Loan_model')->returnLoan($id) > 0) {
            header('Location: ' . BASEURL . '/loan');
            exit;
        } else {
            header('Location: ' . BASEURL . '/loan');
            exit;
        }
    }
}
