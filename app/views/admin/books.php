<div class="container-fluid">
    <div class="row pt-4">
        <div class="col-12 d-flex justify-content-between align-items-center mb-4">
            <h2>Kelola Buku</h2>
            <div class="d-flex">
                <form action="<?= BASEURL; ?>/admin/books" method="GET" class="d-flex me-2">
                    <input type="text" name="q" class="form-control me-2" placeholder="Cari judul/penulis/penerbit..." value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : ''; ?>">
                    <button type="submit" class="btn btn-outline-primary"><i class="fa fa-search"></i></button>
                </form>
                <button class="btn btn-primary text-nowrap" data-bs-toggle="modal" data-bs-target="#addBookModal">
                    <i class="fa fa-plus me-2"></i> Tambah Buku
                </button>
            </div>
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
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Kategori</th>
                                <th>Penerbit</th>
                                <th>ISBN</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; foreach($data['books'] as $book) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $book['title']; ?></td>
                                <td><?= $book['author_name']; ?></td>
                                <td><?= $book['category_name']; ?></td>
                                <td><?= $book['publisher_name']; ?></td>
                                <td><?= $book['isbn']; ?></td>
                                <td>
                                    <?php if($book['stock'] <= 0) : ?>
                                        <span class="badge bg-danger">Habis</span>
                                    <?php else : ?>
                                        <span class="badge bg-success"><?= $book['stock']; ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-info me-2 viewPdfBtn" 
                                            onclick="window.open('<?= $book['pdf_link']; ?>', '_blank')">
                                        <i class="fa fa-file-pdf"></i>
                                    </button>
                                    <button class="btn btn-sm btn-warning me-2 editBookBtn" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editBookModal"
                                            data-id="<?= $book['id']; ?>"
                                            data-title="<?= $book['title']; ?>"
                                            data-author="<?= $book['author_id']; ?>"
                                            data-category="<?= $book['category_id']; ?>"
                                            data-publisher="<?= $book['publisher_id']; ?>"
                                            data-isbn="<?= $book['isbn']; ?>"
                                            data-date="<?= $book['published_date']; ?>"
                                            data-pdf="<?= $book['pdf_link']; ?>"
                                            data-desc="<?= htmlspecialchars($book['description']); ?>"
                                            data-stock="<?= $book['stock']; ?>">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <a href="<?= BASEURL; ?>/admin/deleteBook/<?= $book['id']; ?>" 
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php if(empty($data['books'])) : ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted">Belum ada buku.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Book Modal -->
<div class="modal fade" id="addBookModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Buku Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= BASEURL; ?>/admin/addBook" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="title" class="form-label">Judul Buku</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="isbn" class="form-label">ISBN</label>
                            <input type="text" class="form-control" id="isbn" name="isbn">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="description" class="form-label">Deskripsi / Sinopsis Buku</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Masukkan deskripsi buku"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="author_id" class="form-label">Penulis</label>
                            <select class="form-select" id="author_id" name="author_id" required>
                                <option value="">Pilih Penulis</option>
                                <?php foreach($data['authors'] as $author) : ?>
                                <option value="<?= $author['id']; ?>"><?= $author['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="category_id" class="form-label">Kategori</label>
                            <select class="form-select" id="category_id" name="category_id" required>
                                <option value="">Pilih Kategori</option>
                                <?php foreach($data['categories'] as $cat) : ?>
                                <option value="<?= $cat['id']; ?>"><?= $cat['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="publisher_id" class="form-label">Penerbit</label>
                            <select class="form-select" id="publisher_id" name="publisher_id" required>
                                <option value="">Pilih Penerbit</option>
                                <?php foreach($data['publishers'] as $pub) : ?>
                                <option value="<?= $pub['id']; ?>"><?= $pub['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="published_date" class="form-label">Tanggal Terbit</label>
                            <input type="date" class="form-control" id="published_date" name="published_date">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="pdf_link" class="form-label">Link PDF (Google Drive)</label>
                            <input type="url" class="form-control" id="pdf_link" name="pdf_link" placeholder="https://drive.google.com/...">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="stock" class="form-label">Jumlah Stok</label>
                            <input type="number" class="form-control" id="stock" name="stock" value="1" min="0" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Buku</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Book Modal -->
<div class="modal fade" id="editBookModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Data Buku</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= BASEURL; ?>/admin/editBook" method="post">
                <input type="hidden" name="id" id="edit-book-id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit-title" class="form-label">Judul Buku</label>
                            <input type="text" class="form-control" id="edit-title" name="title" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit-isbn" class="form-label">ISBN</label>
                            <input type="text" class="form-control" id="edit-isbn" name="isbn">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="edit-description" class="form-label">Deskripsi / Sinopsis Buku</label>
                            <textarea class="form-control" id="edit-description" name="description" rows="3" placeholder="Masukkan deskripsi buku"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="edit-author_id" class="form-label">Penulis</label>
                            <select class="form-select" id="edit-author_id" name="author_id" required>
                                <?php foreach($data['authors'] as $author) : ?>
                                <option value="<?= $author['id']; ?>"><?= $author['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="edit-category_id" class="form-label">Kategori</label>
                            <select class="form-select" id="edit-category_id" name="category_id" required>
                                <?php foreach($data['categories'] as $cat) : ?>
                                <option value="<?= $cat['id']; ?>"><?= $cat['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="edit-publisher_id" class="form-label">Penerbit</label>
                            <select class="form-select" id="edit-publisher_id" name="publisher_id" required>
                                <?php foreach($data['publishers'] as $pub) : ?>
                                <option value="<?= $pub['id']; ?>"><?= $pub['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit-published_date" class="form-label">Tanggal Terbit</label>
                            <input type="date" class="form-control" id="edit-published_date" name="published_date">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit-pdf_link" class="form-label">Link PDF (Google Drive)</label>
                            <input type="url" class="form-control" id="edit-pdf_link" name="pdf_link">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit-stock" class="form-label">Jumlah Stok</label>
                            <input type="number" class="form-control" id="edit-stock" name="stock" min="0" required>
                        </div>
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
    document.querySelectorAll('.editBookBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.getElementById('edit-book-id').value = this.getAttribute('data-id');
            document.getElementById('edit-title').value = this.getAttribute('data-title');
            document.getElementById('edit-author_id').value = this.getAttribute('data-author');
            document.getElementById('edit-category_id').value = this.getAttribute('data-category');
            document.getElementById('edit-publisher_id').value = this.getAttribute('data-publisher');
            document.getElementById('edit-isbn').value = this.getAttribute('data-isbn');
            document.getElementById('edit-published_date').value = this.getAttribute('data-date');
            document.getElementById('edit-pdf_link').value = this.getAttribute('data-pdf');
            document.getElementById('edit-description').value = this.getAttribute('data-desc');
            document.getElementById('edit-stock').value = this.getAttribute('data-stock');
        });
    });
</script>
