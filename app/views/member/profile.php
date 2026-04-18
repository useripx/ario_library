<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Dashboard Anggota</h6>
            <h1 class="mb-5">Halo, <?= $data['user']['username']; ?>!</h1>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-lg-4 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item text-center pt-3 shadow-sm rounded">
                    <div class="p-4">
                        <i class="fa fa-3x fa-book-open text-primary mb-4"></i>
                        <h5 class="mb-3">Total Pinjaman</h5>
                        <p class="display-6 fw-bold"><?= count($data['loans']); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="service-item text-center pt-3 shadow-sm rounded">
                    <div class="p-4">
                        <i class="fa fa-3x fa-clock text-primary mb-4"></i>
                        <h5 class="mb-3">Sedang Dipinjam</h5>
                        <p class="display-6 fw-bold">
                            <?php 
                                $active = array_filter($data['loans'], function($l) { return $l['status'] == 'borrowed' || $l['status'] == 'late'; });
                                echo count($active);
                            ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item text-center pt-3 shadow-sm rounded">
                    <div class="p-4">
                        <i class="fa fa-3x fa-list text-primary mb-4"></i>
                        <h5 class="mb-3">Wishlist Anda</h5>
                        <p class="display-6 fw-bold">Koleksi Favorit</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-5">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="card border-0 shadow-sm p-4">
                    <h4 class="mb-4"><i class="fa fa-user-circle text-primary me-2"></i> Pengaturan Akun</h4>
                    <form action="<?= BASEURL; ?>/member/updateAccount" method="post">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?= $data['user']['username']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= $data['user']['email']; ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary py-2 px-4">Simpan Perubahan</button>
                    </form>
                    
                    <hr class="my-4">
                    
                    <h4 class="mb-4"><i class="fa fa-key text-primary me-2"></i> Ganti Password</h4>
                    <form action="<?= BASEURL; ?>/member/changePassword" method="post">
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Password Saat Ini</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">Password Baru</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                        </div>
                        <button type="submit" class="btn btn-warning py-2 px-4 text-white">Update Password</button>
                    </form>
                </div>
            </div>

            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="card border-0 shadow-sm p-4">
                    <h4 class="mb-4"><i class="fa fa-history text-primary me-2"></i> Aktivitas Terbaru</h4>
                    <div class="table-responsive">
                        <table class="table table-hover small">
                            <thead>
                                <tr>
                                    <th>Buku</th>
                                    <th>Status</th>
                                    <th>Batas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach(array_slice($data['loans'], 0, 5) as $loan) : ?>
                                <tr>
                                    <td><?= $loan['title']; ?></td>
                                    <td>
                                        <span class="badge bg-<?= ($loan['status'] == 'returned') ? 'success' : 'primary'; ?>">
                                            <?= $loan['status']; ?>
                                        </span>
                                    </td>
                                    <td><?= date('d/m/y', strtotime($loan['due_date'])); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center mt-3">
                        <a href="<?= BASEURL; ?>/loan" class="btn btn-sm btn-outline-primary">Lihat Semua Riwayat</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
