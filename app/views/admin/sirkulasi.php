<div class="container-fluid">
    <div class="row pt-4">
        <div class="col-12 d-flex justify-content-between align-items-center mb-4">
            <h2>Manajemen Sirkulasi</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm p-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Buku</th>
                                <th>Peminjam</th>
                                <th>Pinjam / Batas</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; foreach($data['loans'] as $loan) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $loan['title']; ?></td>
                                <td>
                                    <strong><?= $loan['username']; ?></strong><br>
                                    <small class="text-muted"><?= $loan['email']; ?></small>
                                </td>
                                <td>
                                    <small>P: <?= date('d/m/y', strtotime($loan['loan_date'])); ?></small><br>
                                    <small class="<?= ($loan['status'] == 'borrowed' && time() > strtotime($loan['due_date'])) ? 'text-danger fw-bold' : ''; ?>">
                                        B: <?= date('d/m/y', strtotime($loan['due_date'])); ?>
                                    </small>
                                </td>
                                <td>
                                    <?php if($loan['status'] == 'borrowed') : ?>
                                        <span class="badge bg-primary">Dipinjam</span>
                                    <?php elseif($loan['status'] == 'returned') : ?>
                                        <span class="badge bg-success">Kembali</span>
                                    <?php else : ?>
                                        <span class="badge bg-danger">Terlambat</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($loan['status'] != 'returned') : ?>
                                        <a href="<?= BASEURL; ?>/admin/returnBook/<?= $loan['id']; ?>" 
                                           class="btn btn-sm btn-success"
                                           onclick="return confirm('Tandai buku ini sudah kembali?')">
                                            <i class="fa fa-undo me-1"></i> Check-in
                                        </a>
                                    <?php else : ?>
                                        <small class="text-muted">Kembali: <?= date('d/m/y', strtotime($loan['return_date'])); ?></small>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
