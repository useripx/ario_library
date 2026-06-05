<div class="container-fluid">
    <div class="row pt-4">
        <div class="col-12 d-flex justify-content-between align-items-center mb-4">
            <h2>Daftar Masukan & Keluhan Pengguna</h2>
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
                                <th>Pengirim</th>
                                <th>Topik</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; foreach($data['messages'] as $msg) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td>
                                    <strong><?= $msg['username']; ?></strong><br>
                                    <small class="text-muted"><?= $msg['email']; ?></small>
                                </td>
                                <td><?= (strlen($msg['subject']) > 30) ? substr($msg['subject'], 0, 30) . '...' : $msg['subject']; ?></td>
                                <td><?= date('d M Y, H:i', strtotime($msg['created_at'])); ?></td>
                                <td>
                                    <?php if($msg['status'] == 'unread') : ?>
                                        <span class="badge bg-danger">Baru</span>
                                    <?php elseif($msg['status'] == 'read') : ?>
                                        <span class="badge bg-warning text-dark">Dibaca</span>
                                    <?php else : ?>
                                        <span class="badge bg-success">Dibalas</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-info text-white me-1 viewMsgBtn" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#viewMessageModal"
                                            data-id="<?= $msg['id']; ?>"
                                            data-sender="<?= $msg['username']; ?>"
                                            data-subject="<?= htmlspecialchars($msg['subject'] ?? ''); ?>"
                                            data-message="<?= htmlspecialchars(nl2br($msg['message'] ?? '')); ?>"
                                            data-reply="<?= htmlspecialchars(nl2br($msg['reply'] ?? '')); ?>"
                                            data-status="<?= $msg['status']; ?>">
                                        <i class="fa fa-eye"></i> Detail & Balas
                                    </button>
                                    <?php if($msg['status'] == 'unread') : ?>
                                    <a href="<?= BASEURL; ?>/admin/markMessageRead/<?= $msg['id']; ?>" class="btn btn-sm btn-outline-secondary">
                                        <i class="fa fa-check"></i> Tandai Dibaca
                                    </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php if(empty($data['messages'])) : ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted">Belum ada masukan dari pelanggan.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail & Balas Masukan -->
<div class="modal fade" id="viewMessageModal" tabindex="-1" aria-labelledby="viewMessageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewMessageModalLabel">Detail Masukan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= BASEURL; ?>/admin/replyMasukan" method="post">
                <div class="modal-body">
                    <input type="hidden" name="id" id="modal-msg-id">
                    
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">Pengirim:</div>
                        <div class="col-md-9" id="modal-msg-sender"></div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">Topik / Subjek:</div>
                        <div class="col-md-9" id="modal-msg-subject"></div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-3 fw-bold">Pesan Pengguna:</div>
                        <div class="col-md-9 border-start border-3 border-primary ps-3" id="modal-msg-content" style="min-height: 50px;">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="reply" class="form-label fw-bold">Balasan Anda:</label>
                        <textarea class="form-control" id="modal-msg-reply" name="reply" rows="4" placeholder="Ketik balasan Anda di sini... (kosongkan jika belum ingin membalas)"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane me-2"></i> Kirim Balasan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const viewBtns = document.querySelectorAll('.viewMsgBtn');
        const modalId = document.getElementById('modal-msg-id');
        const modalSender = document.getElementById('modal-msg-sender');
        const modalSubject = document.getElementById('modal-msg-subject');
        const modalContent = document.getElementById('modal-msg-content');
        const modalReply = document.getElementById('modal-msg-reply');

        viewBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                modalId.value = this.getAttribute('data-id');
                modalSender.innerHTML = this.getAttribute('data-sender');
                modalSubject.innerHTML = this.getAttribute('data-subject');
                modalContent.innerHTML = this.getAttribute('data-message');
                
                // Menangani unescaped entities
                let d = document.createElement('div');
                d.innerHTML = this.getAttribute('data-reply');
                // Untuk raw text tanpa <br> di dalam textarea
                modalReply.value = d.innerText.replace(/<br\s*[\/]?>/gi, "");
            });
        });
    });
</script>
