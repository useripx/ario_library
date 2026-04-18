    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div class="owl-carousel header-carousel position-relative">
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="<?= BASEURL; ?>/img/carousel-1.jpg" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(24, 29, 56, .7);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-sm-10 col-lg-8">
                                <h5 class="text-primary text-uppercase mb-3 animated slideInDown">Perpustakaan Digital Terbaik</h5>
                                <h1 class="display-3 text-white animated slideInDown">Platform Literasi Modern Ario Library</h1>
                                <p class="fs-5 text-white mb-4 pb-2">Akses ribuan buku digital berkualitas dari mana saja dan kapan saja. Kami hadir untuk mencerdaskan bangsa melalui teknologi.</p>
                                <a href="" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Selengkapnya</a>
                                <a href="<?= BASEURL; ?>/auth" class="btn btn-light py-md-3 px-md-5 animated slideInRight">Daftar Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="<?= BASEURL; ?>/img/carousel-2.jpg" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(24, 29, 56, .7);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-sm-10 col-lg-8">
                                <h5 class="text-primary text-uppercase mb-3 animated slideInDown">Koleksi Buku Terlengkap</h5>
                                <h1 class="display-3 text-white animated slideInDown">Baca Buku Favoritmu di Ario Library</h1>
                                <p class="fs-5 text-white mb-4 pb-2">Dapatkan akses ke berbagai kategori buku mulai dari fiksi, edukasi, hingga jurnal ilmiah internasional.</p>
                                <a href="" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Selengkapnya</a>
                                <a href="<?= BASEURL; ?>/auth" class="btn btn-light py-md-3 px-md-5 animated slideInRight">Daftar Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-graduation-cap text-primary mb-4"></i>
                            <h5 class="mb-3">Pustakawan Ahli</h5>
                            <p>Tim profesional yang siap membantu Anda menemukan referensi terbaik.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-globe text-primary mb-4"></i>
                            <h5 class="mb-3">Akses Online 24/7</h5>
                            <p>Baca buku kapan saja melalui platform digital yang responsif.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-home text-primary mb-4"></i>
                            <h5 class="mb-3">Baca di Rumah</h5>
                            <p>Nikmati pengalaman membaca yang nyaman langsung dari perangkat Anda.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-book-open text-primary mb-4"></i>
                            <h5 class="mb-3">Koleksi Digital</h5>
                            <p>Ribuan E-Book tersedia dalam format PDF yang interaktif.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->

    <!-- Courses Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Koleksi Terbaru</h6>
                <h1 class="mb-5">Buku Terbaru di Perpustakaan</h1>
            </div>
            <div class="row g-4 justify-content-center">
                <?php foreach($data['latest_books'] as $book) : ?>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="course-item bg-light shadow-sm">
                        <div class="position-relative overflow-hidden">
                            <img class="img-fluid" src="<?= BASEURL; ?>/img/course-1.jpg" alt="">
                            <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">
                                <a href="<?= BASEURL; ?>/book/detail/<?= $book['id']; ?>" class="flex-shrink-0 btn btn-sm btn-primary px-3 border-end" style="border-radius: 30px 0 0 30px;">Detail</a>
                                <a href="<?= BASEURL; ?>/loan/borrow/<?= $book['id']; ?>" class="flex-shrink-0 btn btn-sm btn-primary px-3" style="border-radius: 0 30px 30px 0;">Pinjam</a>
                            </div>
                        </div>
                        <div class="text-center p-4 pb-0">
                            <h5 class="mb-2"><?= $book['title']; ?></h5>
                            <p class="mb-1 text-muted small"><i class="fa fa-user me-2"></i><?= $book['author_name']; ?></p>
                            <p class="text-primary fw-bold"><?= $book['category_name']; ?></p>
                        </div>
                        <div class="d-flex border-top">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-book me-2"></i>Digital</small>
                            <small class="flex-fill text-center py-2"><i class="fa fa-check-circle text-success me-2"></i>Tersedia</small>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="text-center mt-5">
                <a href="<?= BASEURL; ?>/book" class="btn btn-primary py-3 px-5">Lihat Semua Koleksi</a>
            </div>
        </div>
    </div>
    <!-- Courses End -->


    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="img-fluid position-absolute w-100 h-100" src="<?= BASEURL; ?>/img/about.jpg" alt="" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h6 class="section-title bg-white text-start text-primary pe-3">Tentang Kami</h6>
                    <h1 class="mb-4">Selamat Datang di Ario Library</h1>
                    <p class="mb-4">Kami adalah perpustakaan digital modern yang berkomitmen untuk menyediakan akses informasi dan literasi yang luas bagi seluruh masyarakat.</p>
                    <p class="mb-4">Dengan teknologi terkini, kami memudahkan Anda untuk meminjam, membaca, dan mengelola koleksi buku favorit secara digital.</p>
                    <div class="row gy-2 gx-4 mb-4">
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Koleksi Terbaru</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Pinjam Online</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Interaktif Reader</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Manajemen Denda</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>E-Book PDF</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Layanan 24 Jam</p>
                        </div>
                    </div>
                    <a class="btn btn-primary py-3 px-5 mt-2" href="">Baca Selengkapnya</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
