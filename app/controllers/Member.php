<?php

class Member extends Controller {
    public function __construct()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL . '/auth');
            exit;
        }
    }

    public function profile()
    {
        $data['judul'] = 'Profil Saya';
        $data['user'] = $this->model('User_model')->getUserById($_SESSION['user_id']);
        $data['loans'] = $this->model('Loan_model')->getLoansByUser($_SESSION['user_id']);
        $data['overdue_count'] = $this->model('Loan_model')->getOverdueCount($_SESSION['user_id']);
        
        $this->view('templates/header', $data);
        $this->view('member/profile', $data);
        $this->view('templates/footer', $data);
    }

    public function updateAccount()
    {
        if ($this->model('User_model')->updateUserAccount($_SESSION['user_id'], $_POST['username'], $_POST['email']) > 0) {
            $_SESSION['username'] = $_POST['username'];
            header('Location: ' . BASEURL . '/member/profile');
            exit;
        } else {
            header('Location: ' . BASEURL . '/member/profile');
            exit;
        }
    }

    public function changePassword()
    {
        $user = $this->model('User_model')->getUserById($_SESSION['user_id']);
        if (password_verify($_POST['current_password'], $user['password'])) {
            if ($this->model('User_model')->updateUserPassword($_SESSION['user_id'], $_POST['new_password']) > 0) {
                header('Location: ' . BASEURL . '/member/profile');
                exit;
            }
        }
        header('Location: ' . BASEURL . '/member/profile');
        exit;
    }
}
