<div class="container-fluid">
    <div class="row pt-4">
        <div class="col-12">
            <h2 class="mb-4">Admin Dashboard</h2>
            <p>Selamat datang, <strong><?= $_SESSION['username']; ?></strong>!</p>
        </div>
    </div>

    <!-- Stats Row -->
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card card-stats p-4 bg-white">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 bg-primary-light p-3 rounded-circle me-3">
                        <i class="fa fa-book fa-2x text-primary"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Total Buku</h6>
                        <h3 class="mb-0"><?= $data['stats']['total_books']; ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-stats p-4 bg-white">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 bg-success-light p-3 rounded-circle me-3">
                        <i class="fa fa-users fa-2x text-success"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Total Anggota</h6>
                        <h3 class="mb-0"><?= $data['stats']['total_members']; ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-stats p-4 bg-white">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 bg-warning-light p-3 rounded-circle me-3">
                        <i class="fa fa-hand-holding fa-2x text-warning"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Sedang Dipinjam</h6>
                        <h3 class="mb-0"><?= $data['stats']['total_borrowed']; ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-stats p-4 bg-white">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 bg-info-light p-3 rounded-circle me-3">
                        <i class="fa fa-user-shield fa-2x text-info"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Total Admin</h6>
                        <h3 class="mb-0"><?= $data['stats']['total_admin']; ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm p-4">
                <h4>Aktivitas Terakhir</h4>
                <hr>
                <p class="text-muted">Belum ada aktivitas terbaru untuk ditampilkan.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4">
                <h4>Quick Links</h4>
                <hr>
                <div class="list-group list-group-flush">
                    <a href="<?= BASEURL; ?>/admin/addBook" class="list-group-item list-group-item-action border-0 px-0">
                        <i class="fa fa-plus me-2 text-primary"></i> Tambah Buku Baru
                    </a>
                    <a href="<?= BASEURL; ?>/admin/loans" class="list-group-item list-group-item-action border-0 px-0">
                        <i class="fa fa-sync me-2 text-success"></i> Kelola Peminjaman
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-primary-light { background-color: rgba(6, 187, 204, 0.1); }
    .bg-success-light { background-color: rgba(40, 167, 69, 0.1); }
    .bg-warning-light { background-color: rgba(255, 193, 7, 0.1); }
    .bg-info-light { background-color: rgba(23, 162, 184, 0.1); }
</style>
