<?php

class Message_model {
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getMessagesByUser($userId)
    {
        $this->db->query('SELECT * FROM messages WHERE user_id = :user_id ORDER BY created_at DESC');
        $this->db->bind('user_id', $userId);
        return $this->db->resultSet();
    }

    public function getAllMessages()
    {
        $this->db->query('SELECT m.*, u.username, u.email 
                          FROM messages m 
                          JOIN users u ON m.user_id = u.id 
                          ORDER BY m.created_at DESC');
        return $this->db->resultSet();
    }

    public function sendMessage($data, $userId)
    {
        $this->db->query('INSERT INTO messages (user_id, subject, message) VALUES (:user_id, :subject, :message)');
        $this->db->bind('user_id', $userId);
        $this->db->bind('subject', $data['subject']);
        $this->db->bind('message', $data['message']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function replyMessage($id, $reply)
    {
        $this->db->query('UPDATE messages SET reply = :reply, status = "replied", updated_at = CURRENT_TIMESTAMP WHERE id = :id');
        $this->db->bind('id', $id);
        $this->db->bind('reply', $reply);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function markAsRead($id)
    {
        // Get current status
        $this->db->query('SELECT status FROM messages WHERE id = :id');
        $this->db->bind('id', $id);
        $msg = $this->db->single();

        if ($msg && $msg['status'] == 'unread') {
            $this->db->query('UPDATE messages SET status = "read" WHERE id = :id');
            $this->db->bind('id', $id);
            $this->db->execute();
        }
    }

    public function getUnreadCount()
    {
        $this->db->query('SELECT COUNT(*) as total FROM messages WHERE status = "unread"');
        return $this->db->single()['total'];
    }
}
