<?php

class Admin extends Controller {
    public function __construct()
    {
        // Simple session security check
        if (!isset($_SESSION['admin_id'])) {
            header('Location: ' . BASEURL . '/auth');
            exit;
        }
    }

    public function index()
    {
        $data['judul'] = 'Dashboard';
        $data['stats'] = $this->model('Admin_model')->getStats();
        
        $this->view('templates/admin_header', $data);
        $this->view('admin/index', $data);
        $this->view('templates/admin_footer', $data);
    }

    // --- Category Management ---
    public function categories()
    {
        $data['judul'] = 'Kategori';
        $data['categories'] = $this->model('Admin_model')->getAllCategories();
        
        $this->view('templates/admin_header', $data);
        $this->view('admin/categories', $data);
        $this->view('templates/admin_footer', $data);
    }

    public function addCategory()
    {
        if ($this->model('Admin_model')->addCategory($_POST) > 0) {
            header('Location: ' . BASEURL . '/admin/categories');
            exit;
        }
    }

    public function editCategory()
    {
        if ($this->model('Admin_model')->updateCategory($_POST) > 0) {
            header('Location: ' . BASEURL . '/admin/categories');
            exit;
        }
    }

    public function deleteCategory($id)
    {
        if ($this->model('Admin_model')->deleteCategory($id) > 0) {
            header('Location: ' . BASEURL . '/admin/categories');
            exit;
        }
    }
}
