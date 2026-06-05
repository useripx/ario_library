<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Katalog Buku</h6>
            <h1 class="mb-5">Jelajahi Koleksi Ario Library</h1>
        </div>

        <div class="row mb-5 justify-content-center">
            <div class="col-md-8">
                <form action="<?= BASEURL; ?>/book" method="GET" class="d-flex align-items-center">
                    <select name="limit" class="form-select me-2" style="width: auto;" onchange="this.form.submit()">
                        <option value="5" <?= $data['limit'] == 5 ? 'selected' : ''; ?>>5 Tampil</option>
                        <option value="10" <?= $data['limit'] == 10 ? 'selected' : ''; ?>>10 Tampil</option>
                        <option value="15" <?= $data['limit'] == 15 ? 'selected' : ''; ?>>15 Tampil</option>
                        <option value="20" <?= $data['limit'] == 20 ? 'selected' : ''; ?>>20 Tampil</option>
                        <option value="25" <?= $data['limit'] == 25 ? 'selected' : ''; ?>>25 Tampil</option>
                        <option value="30" <?= $data['limit'] == 30 ? 'selected' : ''; ?>>30 Tampil</option>
                    </select>
                    <div class="input-group flex-grow-1">
                        <input type="text" name="q" class="form-control" placeholder="Cari judul, penulis, atau kategori..." value="<?= htmlspecialchars($data['keyword']); ?>" autocomplete="off">
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row g-4">
            <?php foreach($data['books'] as $book) : ?>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="course-item bg-light shadow-sm">
                    <div class="position-relative overflow-hidden">
                        <img class="img-fluid" src="<?= BASEURL; ?>/img/cover.jpg" alt="">
                        <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">
                            <a href="<?= BASEURL; ?>/book/detail/<?= $book['id']; ?>" class="flex-shrink-0 btn btn-sm btn-primary px-3 border-end" style="border-radius: 30px 0 0 30px;">Detail</a>
                            <a href="<?= BASEURL; ?>/loan/borrow/<?= $book['id']; ?>" class="flex-shrink-0 btn btn-sm btn-primary px-3" style="border-radius: 0 30px 30px 0;">Pinjam</a>
                        </div>
                    </div>
                    <div class="text-center p-4 pb-0">
                        <h5 class="mb-2" style="word-break: break-word; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;" title="<?= $book['title']; ?>"><?= $book['title']; ?></h5>
                        <p class="mb-1 text-muted small"><i class="fa fa-user me-2"></i><?= $book['author_name']; ?></p>
                        <p class="text-primary fw-bold"><?= $book['category_name']; ?></p>
                    </div>
                    <div class="d-flex border-top">
                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-book me-2"></i>Buku Digital</small>
                        <small class="flex-fill text-center py-2"><i class="fa fa-check-circle text-success me-2"></i>Tersedia</small>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            
            <?php if(empty($data['books'])) : ?>
            <div class="col-12 text-center py-5">
                <i class="fa fa-search fa-3x text-muted mb-3"></i>
                <p class="text-muted">Buku tidak ditemukan.</p>
                <a href="<?= BASEURL; ?>/book" class="btn btn-outline-primary">Tampilkan Semua</a>
            </div>
            <?php endif; ?>

            <?php if ($data['total_pages'] > 1) : ?>
            <div class="col-12 mt-5">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <?php 
                        $qStr = !empty($data['keyword']) ? '&q=' . urlencode($data['keyword']) : '';
                        $limStr = '&limit=' . $data['limit'];
                        $prev = $data['current_page'] > 1 ? $data['current_page'] - 1 : 1;
                        $next = $data['current_page'] < $data['total_pages'] ? $data['current_page'] + 1 : $data['total_pages'];
                        ?>
                        <li class="page-item <?= $data['current_page'] <= 1 ? 'disabled' : ''; ?>">
                            <a class="page-link" href="<?= BASEURL; ?>/book?page=<?= $prev . $limStr . $qStr; ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        
                        <?php 
                        $startPage = max(1, $data['current_page'] - 2);
                        $endPage = min($data['total_pages'], $data['current_page'] + 2);
                        
                        if ($startPage > 1) {
                            echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                        }
                        ?>
                        
                        <?php for($i = $startPage; $i <= $endPage; $i++) : ?>
                        <li class="page-item <?= $data['current_page'] == $i ? 'active' : ''; ?>">
                            <a class="page-link" href="<?= BASEURL; ?>/book?page=<?= $i . $limStr . $qStr; ?>"><?= $i; ?></a>
                        </li>
                        <?php endfor; ?>
                        
                        <?php 
                        if ($endPage < $data['total_pages']) {
                            echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                        }
                        ?>
                        
                        <li class="page-item <?= $data['current_page'] >= $data['total_pages'] ? 'disabled' : ''; ?>">
                            <a class="page-link" href="<?= BASEURL; ?>/book?page=<?= $next . $limStr . $qStr; ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
