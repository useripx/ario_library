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
        } else {
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

    // --- Authors Management ---
    public function authors()
    {
        $data['judul'] = 'Penulis';
        $data['authors'] = $this->model('Admin_model')->getAllAuthors();
        
        $this->view('templates/admin_header', $data);
        $this->view('admin/authors', $data);
        $this->view('templates/admin_footer', $data);
    }

    public function addAuthor()
    {
        if ($this->model('Admin_model')->addAuthor($_POST) > 0) {
            header('Location: ' . BASEURL . '/admin/authors');
            exit;
        }
    }

    public function editAuthor()
    {
        if ($this->model('Admin_model')->updateAuthor($_POST) > 0) {
            header('Location: ' . BASEURL . '/admin/authors');
            exit;
        } else {
            header('Location: ' . BASEURL . '/admin/authors');
            exit;
        }
    }

    public function deleteAuthor($id)
    {
        if ($this->model('Admin_model')->deleteAuthor($id) > 0) {
            header('Location: ' . BASEURL . '/admin/authors');
            exit;
        }
    }

    // --- Publishers Management ---
    public function publishers()
    {
        $data['judul'] = 'Penerbit';
        $data['publishers'] = $this->model('Admin_model')->getAllPublishers();
        
        $this->view('templates/admin_header', $data);
        $this->view('admin/publishers', $data);
        $this->view('templates/admin_footer', $data);
    }

    public function addPublisher()
    {
        if ($this->model('Admin_model')->addPublisher($_POST) > 0) {
            header('Location: ' . BASEURL . '/admin/publishers');
            exit;
        }
    }

    public function editPublisher()
    {
        if ($this->model('Admin_model')->updatePublisher($_POST) > 0) {
            header('Location: ' . BASEURL . '/admin/publishers');
            exit;
        } else {
            header('Location: ' . BASEURL . '/admin/publishers');
            exit;
        }
    }

    public function deletePublisher($id)
    {
        if ($this->model('Admin_model')->deletePublisher($id) > 0) {
            header('Location: ' . BASEURL . '/admin/publishers');
            exit;
        }
    }

    // --- Books Management ---
    public function books()
    {
        $data['judul'] = 'Kelola Buku';
        $data['books'] = $this->model('Admin_model')->getAllBooks();
        $data['categories'] = $this->model('Admin_model')->getAllCategories();
        $data['authors'] = $this->model('Admin_model')->getAllAuthors();
        $data['publishers'] = $this->model('Admin_model')->getAllPublishers();
        
        $this->view('templates/admin_header', $data);
        $this->view('admin/books', $data);
        $this->view('templates/admin_footer', $data);
    }

    public function addBook()
    {
        if ($this->model('Admin_model')->addBook($_POST) > 0) {
            header('Location: ' . BASEURL . '/admin/books');
            exit;
        }
    }

    public function editBook()
    {
        if ($this->model('Admin_model')->updateBook($_POST) > 0) {
            header('Location: ' . BASEURL . '/admin/books');
            exit;
        } else {
            header('Location: ' . BASEURL . '/admin/books');
            exit;
        }
    }

    public function deleteBook($id)
    {
        if ($this->model('Admin_model')->deleteBook($id) > 0) {
            header('Location: ' . BASEURL . '/admin/books');
            exit;
        }
    }

    // --- Staff (Admin) Management ---
    public function staff()
    {
        // Only Super Admin can access this
        if ($_SESSION['role'] !== 'super_admin') {
            header('Location: ' . BASEURL . '/admin');
            exit;
        }

        $data['judul'] = 'Admin Cabang';
        $data['staff'] = $this->model('Admin_model')->getAllAdmins();
        
        $this->view('templates/admin_header', $data);
        $this->view('admin/staff', $data);
        $this->view('templates/admin_footer', $data);
    }

    public function addStaff()
    {
        if ($_SESSION['role'] !== 'super_admin') exit;
        
        if ($this->model('Admin_model')->addAdmin($_POST) > 0) {
            header('Location: ' . BASEURL . '/admin/staff');
            exit;
        }
    }

    public function editStaff()
    {
        if ($_SESSION['role'] !== 'super_admin') exit;

        if ($this->model('Admin_model')->updateAdmin($_POST) > 0) {
            header('Location: ' . BASEURL . '/admin/staff');
            exit;
        }
    }

    public function deleteStaff($id)
    {
        if ($_SESSION['role'] !== 'super_admin') exit;

        if ($this->model('Admin_model')->deleteAdmin($id) > 0) {
            header('Location: ' . BASEURL . '/admin/staff');
            exit;
        }
    }

    // --- Circulation (Sirkulasi) ---
    public function sirkulasi()
    {
        $data['judul'] = 'Sirkulasi';
        $data['loans'] = $this->model('Admin_model')->getAllLoans();
        
        $this->view('templates/admin_header', $data);
        $this->view('admin/sirkulasi', $data);
        $this->view('templates/admin_footer', $data);
    }

    public function returnBook($id)
    {
        if ($this->model('Admin_model')->updateLoanStatus($id, 'returned') > 0) {
            header('Location: ' . BASEURL . '/admin/sirkulasi');
            exit;
        }
    }

    // --- Layanan Masukan (Customer Service) ---
    public function masukan()
    {
        $data['judul'] = 'Daftar Masukan Pengguna';
        $data['messages'] = $this->model('Message_model')->getAllMessages();
        
        $this->view('templates/admin_header', $data);
        $this->view('admin/masukan', $data);
        $this->view('templates/admin_footer', $data);
    }

    public function replyMasukan()
    {
        if (isset($_POST['id']) && isset($_POST['reply'])) {
            $this->model('Message_model')->replyMessage($_POST['id'], $_POST['reply']);
        }
        header('Location: ' . BASEURL . '/admin/masukan');
        exit;
    }

    public function markMessageRead($id)
    {
        $this->model('Message_model')->markAsRead($id);
        header('Location: ' . BASEURL . '/admin/masukan');
        exit;
    }

    // --- Member (User) Management ---
    public function members()
    {
        $data['judul'] = 'Data Anggota';
        $data['members'] = $this->model('Admin_model')->getAllUsers();
        
        $this->view('templates/admin_header', $data);
        $this->view('admin/members', $data);
        $this->view('templates/admin_footer', $data);
    }

    public function updateMember()
    {
        if ($this->model('Admin_model')->updateUser($_POST) > 0) {
            header('Location: ' . BASEURL . '/admin/members');
            exit;
        } else {
            header('Location: ' . BASEURL . '/admin/members');
            exit;
        }
    }

    public function deleteMember($id)
    {
        if ($this->model('Admin_model')->deleteUser($id) > 0) {
            header('Location: ' . BASEURL . '/admin/members');
            exit;
        }
    }

    // --- Profile Management ---
    public function profile()
    {
        $data['judul'] = 'Profil Saya';
        $data['admin'] = $this->model('User_model')->getAdminById($_SESSION['admin_id']);
        
        $this->view('templates/admin_header', $data);
        $this->view('admin/profile', $data);
        $this->view('templates/admin_footer', $data);
    }

    public function updateAccount()
    {
        if ($this->model('User_model')->updateAdminAccount($_SESSION['admin_id'], $_POST['username']) > 0) {
            $_SESSION['username'] = $_POST['username'];
            header('Location: ' . BASEURL . '/admin/profile');
            exit;
        } else {
            header('Location: ' . BASEURL . '/admin/profile');
            exit;
        }
    }

    public function changePassword()
    {
        $admin = $this->model('User_model')->getAdminById($_SESSION['admin_id']);
        if (password_verify($_POST['current_password'], $admin['password'])) {
            if ($this->model('User_model')->updateAdminPassword($_SESSION['admin_id'], $_POST['new_password']) > 0) {
                header('Location: ' . BASEURL . '/admin/profile');
                exit;
            }
        }
        header('Location: ' . BASEURL . '/admin/profile');
        exit;
    }
}
