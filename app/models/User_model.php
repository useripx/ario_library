<?php

class User_model {
    private $table_admin = 'admin';
    private $table_user = 'users';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAdminByUsername($username)
    {
        $this->db->query('SELECT * FROM ' . $this->table_admin . ' WHERE username=:username');
        $this->db->bind('username', $username);
        return $this->db->single();
    }

    public function getUserByEmail($email)
    {
        $this->db->query('SELECT * FROM ' . $this->table_user . ' WHERE email=:email');
        $this->db->bind('email', $email);
        return $this->db->single();
    }

    public function registerUser($data)
    {
        $query = "INSERT INTO " . $this->table_user . " (username, email, password) VALUES (:username, :email, :password)";
        $this->db->query($query);
        $this->db->bind('username', $data['username']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('password', password_hash($data['password'], PASSWORD_DEFAULT));
        
        $this->db->execute();
        return $this->db->rowCount();
    }
}
