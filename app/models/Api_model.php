<?php

class Api_model {
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function insertCategoryIfNotExists($name)
    {
        $this->db->query("SELECT id FROM categories WHERE name = :name");
        $this->db->bind(':name', $name);
        $result = $this->db->single();

        if ($result) {
            return $result['id'];
        }

        $this->db->query("INSERT IGNORE INTO categories (name) VALUES (:name)");
        $this->db->bind(':name', $name);
        $this->db->execute();

        // Get ID after insert
        $this->db->query("SELECT id FROM categories WHERE name = :name");
        $this->db->bind(':name', $name);
        $result = $this->db->single();

        return $result['id'];
    }

    public function insertBookDraft($title, $categoryId, $driveFileId)
    {
        $this->db->query("SELECT id FROM books WHERE drive_file_id = :drive_file_id");
        $this->db->bind(':drive_file_id', $driveFileId);
        $result = $this->db->single();

        if ($result) {
            return false;
        }

        $pdf_link = "https://drive.google.com/file/d/" . $driveFileId . "/view";

        $this->db->query("INSERT IGNORE INTO books (title, category_id, drive_file_id, pdf_link, status_entri) 
                          VALUES (:title, :category_id, :drive_file_id, :pdf_link, 'draft')");
        $this->db->bind(':title', $title);
        $this->db->bind(':category_id', $categoryId);
        $this->db->bind(':drive_file_id', $driveFileId);
        $this->db->bind(':pdf_link', $pdf_link);
        
        $this->db->execute();
        return $this->db->rowCount();
    }
}
