<?php

class Loan_model {
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function addLoan($userId, $bookId)
    {
        // 1. Check if user already has 3 active loans
        if ($this->getActiveLoanCount($userId) >= 3) {
            return -1; // Limit reached
        }

        // 2. Check if book has stock
        if ($this->getBookStock($bookId) <= 0) {
            return -2; // Out of stock
        }

        $loanDate = date('Y-m-d');
        $dueDate = date('Y-m-d', strtotime('+7 days'));
        
        // Transaction manually or just sequence? Let's do sequence for simplicity if DB class allows.
        $this->db->query('INSERT INTO loans (book_id, user_id, loan_date, due_date, status) 
                          VALUES (:book_id, :user_id, :loan_date, :due_date, :status)');
        $this->db->bind('book_id', $bookId);
        $this->db->bind('user_id', $userId);
        $this->db->bind('loan_date', $loanDate);
        $this->db->bind('due_date', $dueDate);
        $this->db->bind('status', 'borrowed');
        $this->db->execute();
        
        $rowCount = $this->db->rowCount();
        
        if ($rowCount > 0) {
            // Decrement Stock & Increment Borrowed Count
            $this->db->query('UPDATE books SET stock = stock - 1, borrowed_count = borrowed_count + 1 WHERE id = :id');
            $this->db->bind('id', $bookId);
            $this->db->execute();
        }

        return $rowCount;
    }

    public function getActiveLoanCount($userId)
    {
        $this->db->query('SELECT COUNT(*) as total FROM loans WHERE user_id = :user_id AND status != "returned"');
        $this->db->bind('user_id', $userId);
        return $this->db->single()['total'];
    }

    public function getBookStock($bookId)
    {
        $this->db->query('SELECT stock FROM books WHERE id = :id');
        $this->db->bind('id', $bookId);
        return $this->db->single()['stock'];
    }

    public function getLoansByUser($userId)
    {
        $this->db->query('SELECT l.*, b.title, b.pdf_link, a.name as author_name 
                          FROM loans l
                          JOIN books b ON l.book_id = b.id
                          LEFT JOIN authors a ON b.author_id = a.id
                          WHERE l.user_id = :user_id
                          ORDER BY l.created_at DESC');
        $this->db->bind('user_id', $userId);
        return $this->db->resultSet();
    }

    public function isBorrowedByUser($userId, $bookId)
    {
        $this->db->query('SELECT * FROM loans WHERE user_id = :user_id AND book_id = :book_id AND status = "borrowed"');
        $this->db->bind('user_id', $userId);
        $this->db->bind('book_id', $bookId);
        $this->db->single();
        return $this->db->rowCount() > 0;
    }

    public function getLoanById($id)
    {
        $this->db->query('SELECT l.*, b.title, b.pdf_link FROM loans l JOIN books b ON l.book_id = b.id WHERE l.id = :id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function renewLoan($id)
    {
        $loan = $this->getLoanById($id);
        
        // Renewal logic: 3 times limit
        if ($loan['renewal_count'] < 3) {
            $newDueDate = date('Y-m-d', strtotime($loan['due_date'] . ' +7 days'));
            $this->db->query('UPDATE loans SET due_date=:due_date, renewal_count=renewal_count+1, updated_at=CURRENT_TIMESTAMP WHERE id=:id');
            $this->db->bind('id', $id);
            $this->db->bind('due_date', $newDueDate);
            $this->db->execute();
            return $this->db->rowCount();
        }
        return 0;
    }

    // --- Wishlist Management ---
    public function toggleWishlist($userId, $bookId)
    {
        $this->db->query('SELECT * FROM wishlist WHERE user_id=:user_id AND book_id=:book_id');
        $this->db->bind('user_id', $userId);
        $this->db->bind('book_id', $bookId);
        $this->db->single();

        if ($this->db->rowCount() > 0) {
            // Remove
            $this->db->query('DELETE FROM wishlist WHERE user_id=:user_id AND book_id=:book_id');
        } else {
            // Add
            $this->db->query('INSERT INTO wishlist (user_id, book_id) VALUES (:user_id, :book_id)');
        }
        $this->db->bind('user_id', $userId);
        $this->db->bind('book_id', $bookId);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getWishlistByUser($userId)
    {
        $this->db->query('SELECT b.*, a.name as author_name, c.name as category_name 
                          FROM wishlist w
                          JOIN books b ON w.book_id = b.id
                          LEFT JOIN authors a ON b.author_id = a.id
                          LEFT JOIN categories c ON b.category_id = c.id
                          WHERE w.user_id = :user_id');
        $this->db->bind('user_id', $userId);
        return $this->db->resultSet();
    }

    public function isInWishlist($userId, $bookId)
    {
        $this->db->query('SELECT * FROM wishlist WHERE user_id=:user_id AND book_id=:book_id');
        $this->db->bind('user_id', $userId);
        $this->db->bind('book_id', $bookId);
        $this->db->single();
        return $this->db->rowCount() > 0;
    }
    public function getOverdueCount($userId)
    {
        $this->db->query('SELECT COUNT(*) as total FROM loans WHERE user_id = :user_id AND status != "returned" AND due_date < CURDATE()');
        $this->db->bind('user_id', $userId);
        return $this->db->single()['total'];
    }

    public function returnLoan($id)
    {
        $loan = $this->getLoanById($id);
        
        $this->db->query('UPDATE loans SET status = "returned", return_date = CURDATE(), updated_at = CURRENT_TIMESTAMP WHERE id = :id');
        $this->db->bind('id', $id);
        $this->db->execute();
        
        $rowCount = $this->db->rowCount();
        
        if ($rowCount > 0) {
            // Increment Stock
            $this->db->query('UPDATE books SET stock = stock + 1 WHERE id = :id');
            $this->db->bind('id', $loan['book_id']);
            $this->db->execute();
        }
        
        return $rowCount;
    }
}
