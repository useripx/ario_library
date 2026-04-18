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

    public function getUserByUsernameOrEmail($value)
    {
        $this->db->query('SELECT * FROM ' . $this->table_user . ' WHERE email=:val OR username=:val');
        $this->db->bind('val', $value);
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

    public function getAdminById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table_admin . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function getUserById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table_user . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function updateAdminAccount($id, $username)
    {
        $this->db->query('UPDATE ' . $this->table_admin . ' SET username=:username WHERE id=:id');
        $this->db->bind('username', $username);
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateUserAccount($id, $username, $email)
    {
        $this->db->query('UPDATE ' . $this->table_user . ' SET username=:username, email=:email WHERE id=:id');
        $this->db->bind('username', $username);
        $this->db->bind('email', $email);
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateAdminPassword($id, $password)
    {
        $this->db->query('UPDATE ' . $this->table_admin . ' SET password=:password WHERE id=:id');
        $this->db->bind('password', password_hash($password, PASSWORD_DEFAULT));
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateUserPassword($id, $password)
    {
        $this->db->query('UPDATE ' . $this->table_user . ' SET password=:password WHERE id=:id');
        $this->db->bind('password', password_hash($password, PASSWORD_DEFAULT));
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }
}
