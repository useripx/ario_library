<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>ARIO LIBRARY - <?= $data['judul']; ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="<?= BASEURL; ?>/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?= BASEURL; ?>/lib/animate/animate.min.css" rel="stylesheet">
    <link href="<?= BASEURL; ?>/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?= BASEURL; ?>/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?= BASEURL; ?>/css/style.css" rel="stylesheet">
    <link href="<?= BASEURL; ?>/css/logout.css" rel="stylesheet">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="<?= BASEURL; ?>" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h2 class="m-0 text-primary"><i class="fa fa-book me-3"></i>ARIO LIBRARY</h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="<?= BASEURL; ?>" class="nav-item nav-link <?= ($data['judul'] == 'Home') ? 'active' : ''; ?>">Home</a>
                <a href="<?= BASEURL; ?>/book" class="nav-item nav-link <?= ($data['judul'] == 'Koleksi Buku') ? 'active' : ''; ?>">Koleksi Buku</a>
                
                <?php if(isset($_SESSION['user_id'])) : ?>
                    <a href="<?= BASEURL; ?>/loan" class="nav-item nav-link <?= ($data['judul'] == 'Pinjaman Saya') ? 'active' : ''; ?>">Pinjaman Saya</a>
                <?php endif; ?>

                <div class="nav-item position-relative d-flex align-items-center me-3 mt-3 mt-lg-0">
                    <div class="input-group">
                        <input type="text" id="liveSearchInput" class="form-control rounded-pill px-4" placeholder="Ketik judul buku..." style="min-width: 250px;">
                    </div>
                    <div id="liveSearchResults" class="dropdown-menu shadow w-100 border-0 p-2 position-absolute top-100 start-0 mt-2 d-none" style="max-height: 400px; overflow-y: auto; z-index: 1050;">
                    </div>
                </div>
            </div>

            <?php if(isset($_SESSION['admin_id'])) : ?>
                <div class="nav-item dropdown d-none d-lg-block">
                    <a href="#" class="btn btn-primary py-4 px-lg-5 dropdown-toggle" data-bs-toggle="dropdown">
                        Admin Panen <i class="fa fa-user-shield ms-3"></i>
                    </a>
                    <div class="dropdown-menu m-0">
                        <a href="<?= BASEURL; ?>/admin" class="dropdown-item">Dashboard</a>
                        <a href="<?= BASEURL; ?>/admin/profile" class="dropdown-item">Profil Saya</a>
                        <a href="<?= BASEURL; ?>/auth/logout" class="dropdown-item text-danger">Logout</a>
                    </div>
                </div>
            <?php elseif(isset($_SESSION['user_id'])) : ?>
                <div class="nav-item dropdown d-none d-lg-block">
                    <a href="#" class="btn btn-primary py-4 px-lg-5 dropdown-toggle" data-bs-toggle="dropdown">
                        Halo, <?= $_SESSION['username']; ?> <i class="fa fa-user ms-3"></i>
                    </a>
                    <div class="dropdown-menu m-0">
                        <a href="<?= BASEURL; ?>/member/profile" class="dropdown-item">Profil Saya</a>
                        <a href="<?= BASEURL; ?>/loan" class="dropdown-item">Pinjaman Saya</a>
                        <a href="<?= BASEURL; ?>/book/wishlist" class="dropdown-item">Daftar Favorit</a>
                        <div class="dropdown-divider"></div>
                        <div class="px-3 py-2">
                            <button class="logoutButton logoutButton--light w-100 p-0" style="background: transparent; border: none;">
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
            <?php else : ?>
                <a href="<?= BASEURL; ?>/auth" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Masuk<i class="fa fa-sign-in-alt ms-3"></i></a>
            <?php endif; ?>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Live Search Script -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('liveSearchInput');
        const searchResults = document.getElementById('liveSearchResults');
        
        let debounceTimer;

        searchInput.addEventListener('input', function() {
            clearTimeout(debounceTimer);
            const query = this.value.trim();

            if (query.length < 2) {
                searchResults.classList.add('d-none');
                return;
            }

            debounceTimer = setTimeout(() => {
                fetch('<?= BASEURL; ?>/book/liveSearch?q=' + encodeURIComponent(query))
                    .then(response => response.json())
                    .then(data => {
                        searchResults.innerHTML = '';
                        searchResults.classList.remove('d-none');
                        
                        if (data.status === 'success' && data.data.length > 0) {
                            data.data.forEach(book => {
                                const author = book.author_name ? `<small class="text-muted d-block">${book.author_name}</small>` : '';
                                searchResults.innerHTML += `
                                    <a href="<?= BASEURL; ?>/book/detail/${book.id}" class="dropdown-item py-2 border-bottom text-wrap">
                                        <div class="d-flex align-items-center">
                                            <i class="fa fa-book text-primary me-3"></i>
                                            <div>
                                                <span class="d-block fw-bold">${book.title}</span>
                                                ${author}
                                            </div>
                                        </div>
                                    </a>
                                `;
                            });
                        } else {
                            searchResults.innerHTML = '<div class="dropdown-item text-muted text-wrap text-center py-3"><i class="fa fa-search-minus mb-2 fs-4 d-block"></i> Buku tidak ditemukan</div>';
                        }
                    })
                    .catch(err => console.error(err));
            }, 300); // 300ms debounce
        });

        // Hide results when clicking outside
        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
                searchResults.classList.add('d-none');
            }
        });
    });
    </script>

