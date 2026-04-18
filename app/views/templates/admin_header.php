<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>ARIO LIBRARY Admin - <?= $data['judul']; ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?= BASEURL; ?>/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?= BASEURL; ?>/css/style.css" rel="stylesheet">
    <link href="<?= BASEURL; ?>/css/logout.css" rel="stylesheet">
    
    <style>
        :root {
            --sidebar-width: 250px;
        }
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #181d38;
            color: white;
            padding-top: 20px;
            z-index: 1000;
        }
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 20px;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 15px 25px;
            transition: 0.3s;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: white;
            background-color: rgba(255,255,255,0.1);
            border-left: 4px solid #06BBCC;
        }
        .sidebar .navbar-brand {
            color: white;
            padding: 0 25px 30px;
            display: block;
            font-size: 1.5rem;
            font-weight: 700;
        }
        .card-stats {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: 0.3s;
        }
        .card-stats:hover {
            transform: translateY(-5px);
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <a href="<?= BASEURL; ?>/admin" class="navbar-brand">
            <i class="fa fa-book me-2"></i>ARIO LIB
        </a>
        <div class="nav flex-column">
            <a href="<?= BASEURL; ?>/admin" class="nav-link <?= ($data['judul'] == 'Dashboard') ? 'active' : ''; ?>">
                <i class="fa fa-tachometer-alt me-2"></i> Dashboard
            </a>
            <a href="<?= BASEURL; ?>/admin/books" class="nav-link <?= ($data['judul'] == 'Kelola Buku') ? 'active' : ''; ?>">
                <i class="fa fa-book-open me-2"></i> Kelola Buku
            </a>
            <a href="<?= BASEURL; ?>/admin/categories" class="nav-link <?= ($data['judul'] == 'Kategori') ? 'active' : ''; ?>">
                <i class="fa fa-tags me-2"></i> Kategori
            </a>
            <a href="<?= BASEURL; ?>/admin/authors" class="nav-link <?= ($data['judul'] == 'Penulis') ? 'active' : ''; ?>">
                <i class="fa fa-user-edit me-2"></i> Penulis
            </a>
            <a href="<?= BASEURL; ?>/admin/publishers" class="nav-link <?= ($data['judul'] == 'Penerbit') ? 'active' : ''; ?>">
                <i class="fa fa-print me-2"></i> Penerbit
            </a>
            <?php if ($_SESSION['role'] == 'super_admin') : ?>
            <a href="<?= BASEURL; ?>/admin/staff" class="nav-link <?= ($data['judul'] == 'Admin Cabang') ? 'active' : ''; ?>">
                <i class="fa fa-users-cog me-2"></i> Admin Cabang
            </a>
            <?php endif; ?>
            <div class="mt-auto p-4 mb-4">
                <button class="logoutButton logoutButton--dark w-100 p-0" style="background: transparent; border: none;">
                    <svg class="doorway" viewBox="0 0 100 100">
                        <path d="M93.4 86.3H58.6c-1.9 0-3.4-1.5-3.4-3.4V17.1c0-1.9 1.5-3.4 3.4-3.4h34.8c1.9 0 3.4 1.5 3.4 3.4v65.8c0 1.9-1.5 3.4-3.4 3.4z" />
                        <path class="bang" d="M40.5 43.7L26.6 31.4l-2.5 6.7zM41.9 50.4l-19.5-4-1.4 6.3zM40 57.4l-17.7 3.9 3.9 5.7z" />
                    </svg>
                    <svg class="figure" viewBox="0 0 100 100">
                        <circle cx="52.1" cy="32.4" r="6.4" />
                        <path d="M50.7 62.8c-1.2 2.5-3.6 5-7.2 4-3.2-.9-4.9-3.5-4-7.8.7-3.4 3.1-13.8 4.1-15.8 1.7-3.4 1.6-4.6 7-3.7 4.3.7 4.6 2.5 4.3 5.4-.4 3.7-2.8 15.1-4.2 17.9z" />
                        <g class="arm1">
                            <path d="M55.5 56.5l-6-9.5c-1-1.5-.6-3.5.9-4.4 1.5-1 3.7-1.1 4.6.4l6.1 10c1 1.5.3 3.5-1.1 4.4-1.5.9-3.5.5-4.5-.9z" />
                            <path class="wrist1" d="M69.4 59.9L58.1 58c-1.7-.3-2.9-1.9-2.6-3.7.3-1.7 1.9-2.9 3.7-2.6l11.4 1.9c1.7.3 2.9 1.9 2.6 3.7-.4 1.7-2 2.9-3.8 2.6z" />
                        </g>
                        <g class="arm2">
                            <path d="M34.2 43.6L45 40.3c1.7-.6 3.5.3 4 2 .6 1.7-.3 4-2 4.5l-10.8 2.8c-1.7.6-3.5-.3-4-2-.6-1.6.3-3.4 2-4z" />
                            <path class="wrist2" d="M27.1 56.2L32 45.7c.7-1.6 2.6-2.3 4.2-1.6 1.6.7 2.3 2.6 1.6 4.2L33 58.8c-.7 1.6-2.6 2.3-4.2 1.6-1.7-.7-2.4-2.6-1.7-4.2z" />
                        </g>
                        <g class="leg1">
                            <path d="M52.1 73.2s-7-5.7-7.9-6.5c-.9-.9-1.2-3.5-.1-4.9 1.1-1.4 3.8-1.9 5.2-.9l7.9 7c1.4 1.1 1.7 3.5.7 4.9-1.1 1.4-4.4 1.5-5.8.4z" />
                            <path class="calf1" d="M52.6 84.4l-1-12.8c-.1-1.9 1.5-3.6 3.5-3.7 2-.1 3.7 1.4 3.8 3.4l1 12.8c.1 1.9-1.5 3.6-3.5 3.7-2 0-3.7-1.5-3.8-3.4z" />
                        </g>
                        <g class="leg2">
                            <path d="M37.8 72.7s1.3-10.2 1.6-11.4 2.4-2.8 4.1-2.6c1.7.2 3.6 2.3 3.4 4l-1.8 11.1c-.2 1.7-1.7 3.3-3.4 3.1-1.8-.2-4.1-2.4-3.9-4.2z" />
                            <path class="calf2" d="M29.5 82.3l9.6-10.9c1.3-1.4 3.6-1.5 5.1-.1 1.5 1.4.4 4.9-.9 6.3l-8.5 9.6c-1.3 1.4-3.6 1.5-5.1.1-1.4-1.3-1.5-3.5-.2-5z" />
                        </g>
                    </svg>
                    <svg class="door" viewBox="0 0 100 100">
                        <path d="M93.4 86.3H58.6c-1.9 0-3.4-1.5-3.4-3.4V17.1c0-1.9 1.5-3.4 3.4-3.4h34.8c1.9 0 3.4 1.5 3.4 3.4v65.8c0 1.9-1.5 3.4-3.4 3.4z" />
                        <circle cx="66" cy="50" r="3.7" />
                    </svg>
                    <span class="button-text">Log Out</span>
                </button>
            </div>
        </div>
    </div>
    <div class="main-content">
