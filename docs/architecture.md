# Architecture Overview - Ario Library

Ario Library follows a custom **PHP Native MVC (Model-View-Controller)** pattern to ensure clean separation of concerns and maintainability.

## Directory Structure

```text
├── app/
│   ├── controllers/    # Request handling logic
│   ├── models/         # Database interactions
│   └── views/          # HTML templates and UI components
├── core/               # Framework core components
│   ├── App.php         # Router and URL Parser
│   ├── Controller.php  # Base Controller class
│   └── Database.php    # Database connection (PDO)
├── public/             # Web entry point
│   ├── index.php       # The bootstrap file
│   └── assets/         # CSS, JS, and Images
└── config/             # System configuration
```

## Core Components

### 1. The Router (`App.php`)
The `App` class parses the URL from the request (e.g., `/book/detail/1`). It splits the URL into:
- **Controller**: Determines which class to instantiate (e.g., `BookController`).
- **Method**: Determines which function to call (e.g., `detail`).
- **Parameters**: Passes remaining URL segments as arguments to the method.

### 2. Base Controller (`Controller.php`)
Provides utility methods for all controllers, such as:
- `view($view, $data)`: Loads a view file and passes data to it.
- `model($model)`: Instantiates a model class.

### 3. Database Handler (`Database.php`)
Uses **PDO** for secure database connections and queries. It handles the connection string and provides a standard interface for models to interact with the database.

## Workflow
1. Request sent to `public/index.php`.
2. `.htaccess` redirects request to `index.php?url=...`.
3. `public/index.php` initializes the `App`.
4. `App` routes the request to the appropriate `Controller`.
5. `Controller` interacts with `Model` (if needed).
6. `Controller` loads the `View` with data.
