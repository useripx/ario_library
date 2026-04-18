# Database

> Database : mysql
> User : root
> Password :
> Host : localhost
> Port : 3306
> Database Name : ario_library


# Tabel

0. admin
    - id
    - username
    - password
    - created_at
    - updated_at

1. users
    - id
    - username
    - password
    - created_at
    - updated_at

2. books
    - id
    - title
    - author_id
    - category_id
    - publisher_id
    - isbn
    - published_date
    - created_at
    - updated_at

3. categories
    - id
    - name
    - created_at
    - updated_at

4. authors
    - id
    - name
    - created_at
    - updated_at

5. publishers
    - id
    - name
    - created_at
    - updated_at

6. borrowers
    - id
    - name
    - created_at
    - updated_at

7. loans
    - id
    - book_id
    - borrower_id
    - loan_date
    - due_date
    - return_date
    - created_at
    - updated_at
8. returns
    - id
    - loan_id
    - return_date
    - created_at
    - updated_at