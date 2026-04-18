<div class="container-fluid">
    <div class="row pt-4">
        <div class="col-12 d-flex justify-content-between align-items-center mb-4">
            <h2>Kelola Admin Cabang</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStaffModal">
                <i class="fa fa-user-plus me-2"></i> Tambah Admin
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
                                <th>Username</th>
                                <th>Role</th>
                                <th>Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; foreach($data['staff'] as $s) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $s['username']; ?></td>
                                <td>
                                    <span class="badge bg-<?= ($s['role'] == 'super_admin') ? 'danger' : 'primary'; ?>">
                                        <?= ($s['role'] == 'super_admin') ? 'Super Admin' : 'Branch Admin'; ?>
                                    </span>
                                </td>
                                <td><?= date('d M Y', strtotime($s['created_at'])); ?></td>
                                <td>
                                    <button class="btn btn-sm btn-warning me-2 editStaffBtn" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editStaffModal"
                                            data-id="<?= $s['id']; ?>"
                                            data-username="<?= $s['username']; ?>"
                                            data-role="<?= $s['role']; ?>">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <?php if($s['role'] != 'super_admin') : ?>
                                    <a href="<?= BASEURL; ?>/admin/deleteStaff/<?= $s['id']; ?>" 
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus admin ini?')">
                                        <i class="fa fa-trash"></i>
                                    </a>
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

<!-- Add Staff Modal -->
<div class="modal fade" id="addStaffModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Admin Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= BASEURL; ?>/admin/addStaff" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-select" id="role" name="role" required>
                            <option value="branch_admin">Branch Admin</option>
                            <option value="super_admin">Super Admin</option>
                        </select>
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

<!-- Edit Staff Modal -->
<div class="modal fade" id="editStaffModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Data Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= BASEURL; ?>/admin/editStaff" method="post">
                <input type="hidden" name="id" id="edit-staff-id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit-username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="edit-username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-password" class="form-label">Password Baru (Kosongkan jika tidak diubah)</label>
                        <input type="password" class="form-control" id="edit-password" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="edit-role" class="form-label">Role</label>
                        <select class="form-select" id="edit-role" name="role" required>
                            <option value="branch_admin">Branch Admin</option>
                            <option value="super_admin">Super Admin</option>
                        </select>
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
    document.querySelectorAll('.editStaffBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.getElementById('edit-staff-id').value = this.getAttribute('data-id');
            document.getElementById('edit-username').value = this.getAttribute('data-username');
            document.getElementById('edit-role').value = this.getAttribute('data-role');
        });
    });
</script>
