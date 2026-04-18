<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                <div class="position-relative">
                    <img class="img-fluid w-100 shadow rounded" src="<?= BASEURL; ?>/img/course-1.jpg" alt="<?= $data['book']['title']; ?>">
                </div>
            </div>
            <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.3s">
                <h6 class="section-title bg-white text-start text-primary pe-3">Detail Buku</h6>
                <h1 class="mb-4"><?= $data['book']['title']; ?></h1>
                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <p class="mb-2"><strong>Penulis:</strong> <?= $data['book']['author_name']; ?></p>
                        <p class="mb-2"><strong>Kategori:</strong> <?= $data['book']['category_name']; ?></p>
                        <p class="mb-2"><strong>Penerbit:</strong> <?= $data['book']['publisher_name']; ?></p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-2"><strong>ISBN:</strong> <?= $data['book']['isbn'] ?: '-'; ?></p>
                        <p class="mb-2"><strong>Tanggal Terbit:</strong> <?= $data['book']['published_date'] ? date('d M Y', strtotime($data['book']['published_date'])) : '-'; ?></p>
                        <p class="mb-2"><strong>Status:</strong> <span class="badge bg-success">Tersedia Digital</span></p>
                    </div>
                </div>

                <p class="mb-4">Buku ini tersedia dalam format digital (E-Book) dan dapat dibaca langsung melalui platform Ario Library setelah Anda melakukan peminjaman. Pinjaman berlaku selama 7 hari sebelum harus dikembalikan atau diperpanjang.</p>
                
                <div class="d-flex align-items-center mb-4">
                    <?php if(!isset($_SESSION['user_id'])) : ?>
                        <div class="alert alert-info w-100">
                            <i class="fa fa-info-circle me-2"></i> Silakan <a href="<?= BASEURL; ?>/auth" class="fw-bold">Login</a> terlebih dahulu untuk meminjam buku ini.
                        </div>
                    <?php elseif($data['is_borrowed']) : ?>
                        <div class="alert alert-success w-100 d-flex justify-content-between align-items-center">
                            <span><i class="fa fa-check-circle me-2"></i> Anda sedang meminjam buku ini.</span>
                            <div class="d-flex gap-2">
                                <a href="<?= BASEURL; ?>/loan" class="btn btn-success btn-sm">Baca Sekarang</a>
                                <a href="<?= BASEURL; ?>/book/toggleWishlist/<?= $data['book']['id']; ?>" class="btn btn-<?= $data['is_wishlist'] ? 'danger' : 'outline-danger'; ?> btn-sm">
                                    <i class="fa fa-heart"></i>
                                </a>
                            </div>
                        </div>
                    <?php else : ?>
                        <a href="<?= BASEURL; ?>/loan/borrow/<?= $data['book']['id']; ?>" class="btn btn-primary py-3 px-5 me-3">Pinjam Sekarang</a>
                        <a href="<?= BASEURL; ?>/book/toggleWishlist/<?= $data['book']['id']; ?>" class="btn btn-<?= $data['is_wishlist'] ? 'danger' : 'outline-danger'; ?> py-3 px-4">
                            <i class="fa fa-heart fa-2x"></i>
                        </a>
                    <?php endif; ?>
                </div>

                <div class="row g-4">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center border-start border-5 border-primary px-3">
                            <h1 class="flex-shrink-0 display-5 text-primary mb-0" data-toggle="counter-up">100</h1>
                            <div class="ps-4">
                                <p class="mb-0">Dilihat</p>
                                <h6 class="text-uppercase mb-0">Kali</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center border-start border-5 border-primary px-3">
                            <h1 class="flex-shrink-0 display-5 text-primary mb-0" data-toggle="counter-up">24</h1>
                            <div class="ps-4">
                                <p class="mb-0">Sedang</p>
                                <h6 class="text-uppercase mb-0">Dipinjam</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
