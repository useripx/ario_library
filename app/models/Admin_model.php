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
}
