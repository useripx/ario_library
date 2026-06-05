<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Daftar Favorit</h6>
            <h1 class="mb-5">Buku-Buku Pilihan Anda</h1>
        </div>

        <div class="row g-4">
            <?php foreach($data['wishlist'] as $book) : ?>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="course-item bg-light shadow-sm">
                    <div class="position-relative overflow-hidden">
                        <img class="img-fluid" src="<?= BASEURL; ?>/img/cover.jpg" alt="">
                        <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">
                            <a href="<?= BASEURL; ?>/book/detail/<?= $book['id']; ?>" class="flex-shrink-0 btn btn-sm btn-primary px-3 border-end" style="border-radius: 30px 0 0 30px;">Detail</a>
                            <a href="<?= BASEURL; ?>/book/toggleWishlist/<?= $book['id']; ?>" class="flex-shrink-0 btn btn-sm btn-danger px-3 text-white" style="border-radius: 0 30px 30px 0;"><i class="fa fa-heart"></i></a>
                        </div>
                    </div>
                    <div class="text-center p-4 pb-0">
                        <h5 class="mb-2"><?= $book['title']; ?></h5>
                        <p class="mb-1 text-muted small"><i class="fa fa-user me-2"></i><?= $book['author_name']; ?></p>
                        <p class="text-primary fw-bold"><?= $book['category_name']; ?></p>
                    </div>
                    <div class="d-flex border-top">
                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-book me-2"></i>Digital</small>
                        <small class="flex-fill text-center py-2">
                             <a href="<?= BASEURL; ?>/loan/borrow/<?= $book['id']; ?>" class="text-success text-decoration-none">
                                <i class="fa fa-shopping-basket me-2"></i>Pinjam
                             </a>
                        </small>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            
            <?php if(empty($data['wishlist'])) : ?>
            <div class="col-12 text-center py-5">
                <i class="fa fa-heart fa-3x text-muted mb-3"></i>
                <p class="text-muted">Daftar favorit Anda masih kosong.</p>
                <a href="<?= BASEURL; ?>/book" class="btn btn-primary">Lihat Koleksi Buku</a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
