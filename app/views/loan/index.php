<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Pinjaman Saya</h6>
            <h1 class="mb-5">Kelola Buku yang Anda Pinjam</h1>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm p-4">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="bg-light">
                                <tr>
                                    <th>#</th>
                                    <th>Judul Buku</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Batas Kembali</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; foreach($data['loans'] as $loan) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td>
                                        <div class="fw-bold"><?= $loan['title']; ?></div>
                                        <div class="small text-muted"><?= $loan['author_name']; ?></div>
                                    </td>
                                    <td><?= date('d M Y', strtotime($loan['loan_date'])); ?></td>
                                    <td>
                                        <?php 
                                            $due = strtotime($loan['due_date']);
                                            $is_late = (time() > $due && $loan['status'] == 'borrowed');
                                        ?>
                                        <span class="<?= $is_late ? 'text-danger fw-bold' : ''; ?>">
                                            <?= date('d M Y', strtotime($loan['due_date'])); ?>
                                            <?php if($is_late) : ?>
                                                <i class="fa fa-exclamation-triangle ms-1"></i>
                                            <?php endif; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if($loan['status'] == 'borrowed') : ?>
                                            <span class="badge bg-primary">Sedang Dipinjam</span>
                                        <?php elseif($loan['status'] == 'returned') : ?>
                                            <span class="badge bg-success">Sudah Kembali</span>
                                        <?php else : ?>
                                            <span class="badge bg-danger">Terlambat</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($loan['status'] == 'borrowed' || $loan['status'] == 'late') : ?>
                                            <div class="d-flex flex-column gap-2">
                                                <a href="<?= BASEURL; ?>/book/read/<?= $loan['id']; ?>" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-book-reader me-2"></i> Baca
                                                </a>
                                                <a href="<?= BASEURL; ?>/loan/return/<?= $loan['id']; ?>" 
                                                   class="btn btn-sm btn-success"
                                                   onclick="return confirm('Kembalikan buku ini?')">
                                                    <i class="fa fa-undo-alt me-2"></i> Kembalikan
                                                </a>
                                                <?php if($loan['renewal_count'] < 3) : ?>
                                                    <a href="<?= BASEURL; ?>/loan/renew/<?= $loan['id']; ?>" 
                                                       class="btn btn-sm btn-outline-info"
                                                       onclick="return confirm('Perpanjang masa pinjam 7 hari? (Pembaruan ke-<?= $loan['renewal_count']+1 ?>)')">
                                                        <i class="fa fa-sync me-2"></i> Perpanjang (<?= $loan['renewal_count']; ?>/3)
                                                    </a>
                                                <?php else : ?>
                                                    <span class="badge bg-secondary">Batas Perpanjangan Habis</span>
                                                <?php endif; ?>
                                            </div>
                                        <?php else : ?>
                                            <button class="btn btn-sm btn-secondary px-3" disabled>Sudah Kembali</button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                
                                <?php if(empty($data['loans'])) : ?>
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <p class="text-muted mb-3">Anda belum memiliki riwayat peminjaman.</p>
                                        <a href="<?= BASEURL; ?>/book" class="btn btn-primary">Cari Buku untuk Dipinjam</a>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
