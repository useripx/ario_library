<?php

class Book extends Controller {
    public function index()
    {
        $data['judul'] = 'Koleksi Buku';
        $data['books'] = $this->model('Book_model')->getAllBooks();
        if (isset($_POST['keyword'])) {
            $data['books'] = $this->model('Book_model')->searchBooks($_POST['keyword']);
        }
        
        $this->view('templates/header', $data);
        $this->view('book/index', $data);
        $this->view('templates/footer', $data);
    }

    public function liveSearch()
    {
        $keyword = isset($_GET['q']) ? $_GET['q'] : '';
        if($keyword != '') {
            $books = $this->model('Book_model')->searchBooks($keyword);
            echo json_encode(['status' => 'success', 'data' => $books]);
        } else {
            echo json_encode(['status' => 'empty']);
        }
    }

    public function detail($id)
    {
        $this->model('Book_model')->incrementViewsCount($id);
        
        $data['judul'] = 'Detail Buku';
        $data['book'] = $this->model('Book_model')->getBookById($id);
        
        // Check if user has already borrowed this book
        $data['is_borrowed'] = false;
        $data['is_wishlist'] = false;
        if (isset($_SESSION['user_id'])) {
            $data['is_borrowed'] = $this->model('Loan_model')->isBorrowedByUser($_SESSION['user_id'], $id);
            $data['is_wishlist'] = $this->model('Loan_model')->isInWishlist($_SESSION['user_id'], $id);
        }

        $this->view('templates/header', $data);
        $this->view('book/detail', $data);
        $this->view('templates/footer', $data);
    }

    public function read($loan_id)
    {
        // Security: must be logged in
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL . '/auth');
            exit;
        }

        $loan = $this->model('Loan_model')->getLoanById($loan_id);
        
        // Security: must belong to the user
        if ($loan['user_id'] != $_SESSION['user_id']) {
            header('Location: ' . BASEURL . '/home');
            exit;
        }

        $data['judul'] = 'Membaca: ' . $loan['title'];
        $data['loan'] = $loan;

        // Extract Google Drive ID if possible for the viewer
        // Link format: https://drive.google.com/file/d/FILE_ID/view?usp=sharing
        $data['pdf_id'] = '';
        if (preg_match('/\/d\/(.+?)\//', $loan['pdf_link'], $matches)) {
            $data['pdf_id'] = $matches[1];
        }

        $this->view('templates/header', $data);
        $this->view('book/read', $data);
        $this->view('templates/footer', $data);
    }

    // --- Wishlist Management ---
    public function wishlist()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL . '/auth');
            exit;
        }

        $data['judul'] = 'Daftar Favorit';
        $data['wishlist'] = $this->model('Loan_model')->getWishlistByUser($_SESSION['user_id']);
        
        $this->view('templates/header', $data);
        $this->view('book/wishlist', $data);
        $this->view('templates/footer', $data);
    }

    public function toggleWishlist($book_id)
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL . '/auth');
            exit;
        }

        if ($this->model('Loan_model')->toggleWishlist($_SESSION['user_id'], $book_id) > 0) {
            header('Location: ' . BASEURL . '/book/detail/' . $book_id);
            exit;
        }
    }
}
