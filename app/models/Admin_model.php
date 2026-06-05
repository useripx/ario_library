<?php

class Admin_model {
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // --- Statistics ---
    public function getStats()
    {
        $stats = [];
        
        $this->db->query('SELECT COUNT(*) as total FROM books');
        $stats['total_books'] = $this->db->single()['total'];

        $this->db->query('SELECT COUNT(*) as total FROM users');
        $stats['total_members'] = $this->db->single()['total'];

        $this->db->query("SELECT COUNT(*) as total FROM loans WHERE status='borrowed'");
        $stats['total_borrowed'] = $this->db->single()['total'];

        $this->db->query('SELECT COUNT(*) as total FROM admin');
        $stats['total_admin'] = $this->db->single()['total'];

        return $stats;
    }

    // --- Category CRUD ---
    public function getAllCategories()
    {
        $this->db->query('SELECT * FROM categories');
        return $this->db->resultSet();
    }

    public function getCategoryById($id)
    {
        $this->db->query('SELECT * FROM categories WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function addCategory($data)
    {
        $this->db->query('INSERT INTO categories (name) VALUES (:name)');
        $this->db->bind('name', $data['name']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateCategory($data)
    {
        $this->db->query('UPDATE categories SET name=:name, updated_at=CURRENT_TIMESTAMP WHERE id=:id');
        $this->db->bind('id', $data['id']);
        $this->db->bind('name', $data['name']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deleteCategory($id)
    {
        $this->db->query('DELETE FROM categories WHERE id=:id');
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    // --- Authors CRUD ---
    public function getAllAuthors()
    {
        $this->db->query('SELECT * FROM authors ORDER BY name ASC');
        return $this->db->resultSet();
    }

    public function addAuthor($data)
    {
        $this->db->query('INSERT INTO authors (name) VALUES (:name)');
        $this->db->bind('name', $data['name']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateAuthor($data)
    {
        $this->db->query('UPDATE authors SET name=:name, updated_at=CURRENT_TIMESTAMP WHERE id=:id');
        $this->db->bind('id', $data['id']);
        $this->db->bind('name', $data['name']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deleteAuthor($id)
    {
        $this->db->query('DELETE FROM authors WHERE id=:id');
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    // --- Publishers CRUD ---
    public function getAllPublishers()
    {
        $this->db->query('SELECT * FROM publishers ORDER BY name ASC');
        return $this->db->resultSet();
    }

    public function addPublisher($data)
    {
        $this->db->query('INSERT INTO publishers (name) VALUES (:name)');
        $this->db->bind('name', $data['name']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updatePublisher($data)
    {
        $this->db->query('UPDATE publishers SET name=:name, updated_at=CURRENT_TIMESTAMP WHERE id=:id');
        $this->db->bind('id', $data['id']);
        $this->db->bind('name', $data['name']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deletePublisher($id)
    {
        $this->db->query('DELETE FROM publishers WHERE id=:id');
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    // --- Books CRUD ---
    public function getAllBooks()
    {
        $this->db->query('SELECT b.*, a.name as author_name, c.name as category_name, p.name as publisher_name 
                          FROM books b
                          LEFT JOIN authors a ON b.author_id = a.id
                          LEFT JOIN categories c ON b.category_id = c.id
                          LEFT JOIN publishers p ON b.publisher_id = p.id
                          ORDER BY b.created_at DESC');
        return $this->db->resultSet();
    }

    public function addBook($data)
    {
        $this->db->query('INSERT INTO books (title, description, author_id, category_id, publisher_id, isbn, published_date, pdf_link, stock) 
                          VALUES (:title, :description, :author_id, :category_id, :publisher_id, :isbn, :published_date, :pdf_link, :stock)');
        $this->db->bind('title', $data['title']);
        $this->db->bind('description', $data['description']);
        $this->db->bind('author_id', $data['author_id']);
        $this->db->bind('category_id', $data['category_id']);
        $this->db->bind('publisher_id', $data['publisher_id']);
        $this->db->bind('isbn', $data['isbn']);
        $this->db->bind('published_date', $data['published_date']);
        $this->db->bind('pdf_link', $data['pdf_link']);
        $this->db->bind('stock', $data['stock']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateBook($data)
    {
        $this->db->query('UPDATE books SET title=:title, description=:description, author_id=:author_id, category_id=:category_id, 
                          publisher_id=:publisher_id, isbn=:isbn, published_date=:published_date, 
                          pdf_link=:pdf_link, stock=:stock, updated_at=CURRENT_TIMESTAMP WHERE id=:id');
        $this->db->bind('id', $data['id']);
        $this->db->bind('title', $data['title']);
        $this->db->bind('description', $data['description']);
        $this->db->bind('author_id', $data['author_id']);
        $this->db->bind('category_id', $data['category_id']);
        $this->db->bind('publisher_id', $data['publisher_id']);
        $this->db->bind('isbn', $data['isbn']);
        $this->db->bind('published_date', $data['published_date']);
        $this->db->bind('pdf_link', $data['pdf_link']);
        $this->db->bind('stock', $data['stock']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deleteBook($id)
    {
        $this->db->query('DELETE FROM books WHERE id=:id');
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    // --- Admin (Staff) Management ---
    public function getAllAdmins()
    {
        $this->db->query('SELECT * FROM admin ORDER BY role ASC, username ASC');
        return $this->db->resultSet();
    }

    public function addAdmin($data)
    {
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $this->db->query('INSERT INTO admin (username, password, role) VALUES (:username, :password, :role)');
        $this->db->bind('username', $data['username']);
        $this->db->bind('password', $password);
        $this->db->bind('role', $data['role']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateAdmin($data)
    {
        if (!empty($data['password'])) {
            $password = password_hash($data['password'], PASSWORD_DEFAULT);
            $this->db->query('UPDATE admin SET username=:username, password=:password, role=:role, updated_at=CURRENT_TIMESTAMP WHERE id=:id');
            $this->db->bind('password', $password);
        } else {
            $this->db->query('UPDATE admin SET username=:username, role=:role, updated_at=CURRENT_TIMESTAMP WHERE id=:id');
        }
        
        $this->db->bind('id', $data['id']);
        $this->db->bind('username', $data['username']);
        $this->db->bind('role', $data['role']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deleteAdmin($id)
    {
        $this->db->query('DELETE FROM admin WHERE id=:id AND role != "super_admin"');
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    // --- Circulation Management ---
    public function getAllLoans()
    {
        $this->db->query('SELECT l.*, b.title, u.username, u.email 
                          FROM loans l
                          JOIN books b ON l.book_id = b.id
                          JOIN users u ON l.user_id = u.id
                          ORDER BY l.loan_date DESC');
        return $this->db->resultSet();
    }

    public function updateLoanStatus($id, $status)
    {
        $returnDate = ($status == 'returned') ? date('Y-m-d') : null;
        
        // Get loan info to find book_id
        $this->db->query('SELECT book_id FROM loans WHERE id = :id');
        $this->db->bind('id', $id);
        $loan = $this->db->single();

        $this->db->query('UPDATE loans SET status=:status, return_date=:return_date, updated_at=CURRENT_TIMESTAMP WHERE id=:id');
        $this->db->bind('id', $id);
        $this->db->bind('status', $status);
        $this->db->bind('return_date', $returnDate);
        $this->db->execute();
        
        $rowCount = $this->db->rowCount();

        if ($rowCount > 0 && $status == 'returned') {
            // Increment Stock
            $this->db->query('UPDATE books SET stock = stock + 1 WHERE id = :id');
            $this->db->bind('id', $loan['book_id']);
            $this->db->execute();
        }

        return $rowCount;
    }

    // --- Member (User) Management ---
    public function getAllUsers()
    {
        $this->db->query('SELECT * FROM users ORDER BY created_at DESC');
        return $this->db->resultSet();
    }

    public function updateUser($data)
    {
        if (!empty(trim($data['password']))) {
            $password = password_hash(trim($data['password']), PASSWORD_DEFAULT);
            $this->db->query('UPDATE users SET username=:username, email=:email, password=:password, updated_at=CURRENT_TIMESTAMP WHERE id=:id');
            $this->db->bind('password', $password);
        } else {
            $this->db->query('UPDATE users SET username=:username, email=:email, updated_at=CURRENT_TIMESTAMP WHERE id=:id');
        }
        
        $this->db->bind('id', $data['id']);
        $this->db->bind('username', $data['username']);
        $this->db->bind('email', $data['email']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deleteUser($id)
    {
        // Check if user has active loans first? 
        // For now, simple delete. (Foreign keys will handle constraints if needed).
        $this->db->query('DELETE FROM users WHERE id=:id');
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }
}
