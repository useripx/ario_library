<div class="container-fluid">
    <div class="row pt-4">
        <div class="col-12 d-flex justify-content-between align-items-center mb-4">
            <h2>Kelola Penulis</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAuthorModal">
                <i class="fa fa-plus me-2"></i> Tambah Penulis
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
                                <th>Nama Penulis</th>
                                <th>Ditambahkan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; foreach($data['authors'] as $author) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $author['name']; ?></td>
                                <td><?= date('d M Y', strtotime($author['created_at'])); ?></td>
                                <td>
                                    <button class="btn btn-sm btn-warning me-2 editAuthorBtn" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editAuthorModal"
                                            data-id="<?= $author['id']; ?>"
                                            data-name="<?= $author['name']; ?>">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <a href="<?= BASEURL; ?>/admin/deleteAuthor/<?= $author['id']; ?>" 
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus penulis ini?')">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php if(empty($data['authors'])) : ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted">Belum ada penulis.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Author Modal -->
<div class="modal fade" id="addAuthorModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Penulis Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= BASEURL; ?>/admin/addAuthor" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Penulis</label>
                        <input type="text" class="form-control" id="name" name="name" required placeholder="Contoh: Andrea Hirata">
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

<!-- Edit Author Modal -->
<div class="modal fade" id="editAuthorModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Penulis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= BASEURL; ?>/admin/editAuthor" method="post">
                <input type="hidden" name="id" id="edit-author-id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit-author-name" class="form-label">Nama Penulis</label>
                        <input type="text" class="form-control" id="edit-author-name" name="name" required>
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
    document.querySelectorAll('.editAuthorBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            document.getElementById('edit-author-id').value = id;
            document.getElementById('edit-author-name').value = name;
        });
    });
</script>
