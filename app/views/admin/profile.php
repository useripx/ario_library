<div class="container-fluid">
    <div class="row pt-4">
        <div class="col-12 mb-4">
            <h2>Profil Saya</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= BASEURL; ?>/admin">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profil</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm p-4 h-100">
                <h5 class="mb-4">Informasi Akun</h5>
                <form action="<?= BASEURL; ?>/admin/updateAccount" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?= $data['admin']['username']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <input type="text" class="form-control" value="<?= strtoupper($data['admin']['role']); ?>" readonly>
                        <small class="text-muted">Role tidak dapat diubah oleh Anda sendiri.</small>
                    </div>
                    <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
                </form>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm p-4 h-100">
                <h5 class="mb-4">Ganti Password</h5>
                <form action="<?= BASEURL; ?>/admin/changePassword" method="post">
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Password Saat Ini</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label">Password Baru</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                    </div>
                    <button type="submit" class="btn btn-warning px-4 text-white">Update Password</button>
                </form>
            </div>
        </div>
    </div>
</div>
