<div class="container-fluid">
    <div class="row pt-4">
        <div class="col-12 d-flex justify-content-between align-items-center mb-4">
            <h2>Kelola Kategori</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                <i class="fa fa-plus me-2"></i> Tambah Kategori
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
                                <th>Nama Kategori</th>
                                <th>Ditambahkan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; foreach($data['categories'] as $cat) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $cat['name']; ?></td>
                                <td><?= date('d M Y', strtotime($cat['created_at'])); ?></td>
                                <td>
                                    <button class="btn btn-sm btn-warning me-2 editCatBtn" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editCategoryModal"
                                            data-id="<?= $cat['id']; ?>"
                                            data-name="<?= $cat['name']; ?>">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <a href="<?= BASEURL; ?>/admin/deleteCategory/<?= $cat['id']; ?>" 
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php if(empty($data['categories'])) : ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted">Belum ada kategori.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kategori Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= BASEURL; ?>/admin/addCategory" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" id="name" name="name" required placeholder="Contoh: Teknologi">
                    </div>
                </div>
                <div class="modal-header border-0 pb-0"></div> <!-- Spacer -->
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= BASEURL; ?>/admin/editCategory" method="post">
                <input type="hidden" name="id" id="edit-id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit-name" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" id="edit-name" name="name" required>
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
    document.querySelectorAll('.editCatBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-name').value = name;
        });
    });
</script>
