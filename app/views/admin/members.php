<div class="container-fluid">
    <div class="row pt-4">
        <div class="col-12 d-flex justify-content-between align-items-center mb-4">
            <h2>Data Anggota Perpustakaan</h2>
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
                                <th>Username</th>
                                <th>Email</th>
                                <th>Terdaftar Pada</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; foreach($data['members'] as $user) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><strong><?= $user['username']; ?></strong></td>
                                <td><?= $user['email']; ?></td>
                                <td><?= date('d M Y', strtotime($user['created_at'])); ?></td>
                                <td>
                                    <button class="btn btn-sm btn-warning text-white btn-edit-user" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#userModal"
                                            data-id="<?= $user['id']; ?>"
                                            data-username="<?= $user['username']; ?>"
                                            data-email="<?= $user['email']; ?>">
                                        <i class="fa fa-edit"></i> Edit
                                    </button>
                                    <a href="<?= BASEURL; ?>/admin/deleteMember/<?= $user['id']; ?>" 
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Hapus anggota ini?')">
                                        <i class="fa fa-trash"></i> Hapus
                                    </a>
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

<!-- User Modal -->
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Edit Data Anggota</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= BASEURL; ?>/admin/updateMember" method="post">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="modal-username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="modal-email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password Baru (Kosongkan jika tidak ganti)</label>
                        <input type="password" class="form-control" id="modal-password" name="password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const editBtns = document.querySelectorAll('.btn-edit-user');
    const modalId = document.getElementById('id');
    const modalUsername = document.getElementById('modal-username');
    const modalEmail = document.getElementById('modal-email');

    editBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            modalId.value = this.getAttribute('data-id');
            modalUsername.value = this.getAttribute('data-username');
            modalEmail.value = this.getAttribute('data-email');
            document.getElementById('modal-password').value = '';
        });
    });
});
</script>
