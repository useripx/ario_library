<?php

class Home extends Controller {
    public function index()
    {
        if (isset($_SESSION['user_id'])) {
            $autoReturned = $this->model('Loan_model')->processAutoReturn($_SESSION['user_id']);
            if (!empty($autoReturned)) {
                $_SESSION['auto_return_alert'] = $autoReturned;
            }
        }

        $data['judul'] = 'Home';
        $data['latest_books'] = $this->model('Book_model')->getLatestBooks(4);
        
        $data['overdue_count'] = 0;
        if (isset($_SESSION['user_id'])) {
            $data['overdue_count'] = $this->model('Loan_model')->getOverdueCount($_SESSION['user_id']);
        }
        
        $this->view('templates/header', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer', $data);
    }
}
