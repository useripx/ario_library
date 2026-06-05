<?php

class Book_model {
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllBooks()
    {
        $this->db->query('SELECT b.*, a.name as author_name, c.name as category_name 
                          FROM books b
                          LEFT JOIN authors a ON b.author_id = a.id
                          LEFT JOIN categories c ON b.category_id = c.id
                          WHERE b.is_available = 1
                          ORDER BY b.created_at DESC');
        return $this->db->resultSet();
    }

    public function getLatestBooks($limit = 6)
    {
        $this->db->query('SELECT b.*, a.name as author_name, c.name as category_name 
                          FROM books b
                          LEFT JOIN authors a ON b.author_id = a.id
                          LEFT JOIN categories c ON b.category_id = c.id
                          WHERE b.is_available = 1
                          ORDER BY b.created_at DESC LIMIT :limit');
        $this->db->bind('limit', $limit);
        return $this->db->resultSet();
    }

    public function getBookById($id)
    {
        $this->db->query('SELECT b.*, a.name as author_name, c.name as category_name, p.name as publisher_name 
                          FROM books b
                          LEFT JOIN authors a ON b.author_id = a.id
                          LEFT JOIN categories c ON b.category_id = c.id
                          LEFT JOIN publishers p ON b.publisher_id = p.id
                          WHERE b.id = :id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function searchBooks($keyword)
    {
        $this->db->query('SELECT b.*, a.name as author_name, c.name as category_name 
                          FROM books b
                          LEFT JOIN authors a ON b.author_id = a.id
                          LEFT JOIN categories c ON b.category_id = c.id
                          WHERE b.title LIKE :keyword OR a.name LIKE :keyword OR c.name LIKE :keyword');
        $this->db->bind('keyword', "%$keyword%");
        return $this->db->resultSet();
    }

    public function getCategories()
    {
        $this->db->query('SELECT * FROM categories');
        return $this->db->resultSet();
    }

    public function incrementViewsCount($id)
    {
        $this->db->query('UPDATE books SET views_count = views_count + 1 WHERE id = :id');
        $this->db->bind('id', $id);
        $this->db->execute();
    }
}
