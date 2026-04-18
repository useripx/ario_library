<div class="container-fluid">
    <div class="row pt-4">
        <div class="col-12 d-flex justify-content-between align-items-center mb-4">
            <h2>Kelola Penerbit</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPublisherModal">
                <i class="fa fa-plus me-2"></i> Tambah Penerbit
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm p-4">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Penerbit</th>
                                <th>Ditambahkan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; foreach($data['publishers'] as $pub) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $pub['name']; ?></td>
                                <td><?= date('d M Y', strtotime($pub['created_at'])); ?></td>
                                <td>
                                    <button class="btn btn-sm btn-warning me-2 editPubBtn" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editPublisherModal"
                                            data-id="<?= $pub['id']; ?>"
                                            data-name="<?= $pub['name']; ?>">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <a href="<?= BASEURL; ?>/admin/deletePublisher/<?= $pub['id']; ?>" 
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus penerbit ini?')">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php if(empty($data['publishers'])) : ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted">Belum ada penerbit.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Publisher Modal -->
<div class="modal fade" id="addPublisherModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Penerbit Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= BASEURL; ?>/admin/addPublisher" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Penerbit</label>
                        <input type="text" class="form-control" id="name" name="name" required placeholder="Contoh: Gramedia">
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Publisher Modal -->
<div class="modal fade" id="editPublisherModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Penerbit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= BASEURL; ?>/admin/editPublisher" method="post">
                <input type="hidden" name="id" id="edit-pub-id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit-pub-name" class="form-label">Nama Penerbit</label>
                        <input type="text" class="form-control" id="edit-pub-name" name="name" required>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Handle loading data into Edit Modal
    document.querySelectorAll('.editPubBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            document.getElementById('edit-pub-id').value = id;
            document.getElementById('edit-pub-name').value = name;
        });
    });
</script>
