<?php

class Auth extends Controller {
    public function index()
    {
        $data['judul'] = 'Login';
        $this->view('auth/login', $data);
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Check Admin first
            $admin = $this->model('User_model')->getAdminByUsername($username);
            if ($admin && password_verify($password, $admin['password'])) {
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['role'] = $admin['role'];
                $_SESSION['username'] = $admin['username'];
                header('Location: ' . BASEURL . '/admin');
                exit;
            }

            // Check User (Member)
            $user = $this->model('User_model')->getUserByEmail($username);
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header('Location: ' . BASEURL . '/home');
                exit;
            }

            // If login fails
            header('Location: ' . BASEURL . '/auth');
            exit;
        }
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->model('User_model')->registerUser($_POST) > 0) {
                header('Location: ' . BASEURL . '/auth');
                exit;
            } else {
                header('Location: ' . BASEURL . '/auth');
                exit;
            }
        }
    }

    public function logout()
    {
        session_destroy();
        header('Location: ' . BASEURL . '/auth');
        exit;
    }
}
