<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Layanan Pelanggan</h6>
            <h1 class="mb-5">Hubungi Customer Service</h1>
        </div>

        <div class="row g-4">
            <!-- Form Kirim Tiket -->
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <h5>Kirim Masukan / Keluhan</h5>
                <p class="mb-4">Jika Anda memiliki kendala teknis atau pertanyaan, silakan tulis di bawah ini. Tim admin kami akan membalas pesan Anda.</p>
                <form action="<?= BASEURL; ?>/customerservice/send" method="post">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="subject" name="subject" placeholder="Subjek" required>
                                <label for="subject">Subjek / Topik</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Tuliskan pesan Anda" id="message" name="message" style="height: 150px" required></textarea>
                                <label for="message">Pesan Anda</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary w-100 py-3" type="submit">Kirim Pesan</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Riwayat Tiket -->
            <div class="col-lg-8 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <h5>Riwayat Masukan Anda</h5>
                <div class="accordion mt-4" id="messagesAccordion">
                    <?php if(empty($data['messages'])) : ?>
                        <div class="alert alert-light text-center">Belum ada riwayat masukan.</div>
                    <?php else : ?>
                        <?php foreach($data['messages'] as $index => $msg) : ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading<?= $msg['id']; ?>">
                                    <button class="accordion-button <?= $index !== 0 ? 'collapsed' : ''; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $msg['id']; ?>" aria-expanded="<?= $index === 0 ? 'true' : 'false'; ?>" aria-controls="collapse<?= $msg['id']; ?>">
                                        <div class="d-flex justify-content-between w-100 pe-3 align-items-center">
                                            <span>
                                                <strong><?= $msg['subject']; ?></strong> 
                                                <small class="text-muted d-block"><?= date('d M Y, H:i', strtotime($msg['created_at'])); ?></small>
                                            </span>
                                            <span>
                                                <?php if($msg['status'] == 'replied') : ?>
                                                    <span class="badge bg-success">Dibalas</span>
                                                <?php elseif($msg['status'] == 'read') : ?>
                                                    <span class="badge bg-info">Dibaca</span>
                                                <?php else : ?>
                                                    <span class="badge bg-secondary">Menunggu</span>
                                                <?php endif; ?>
                                            </span>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapse<?= $msg['id']; ?>" class="accordion-collapse collapse <?= $index === 0 ? 'show' : ''; ?>" aria-labelledby="heading<?= $msg['id']; ?>" data-bs-parent="#messagesAccordion">
                                    <div class="accordion-body">
                                        <div class="mb-3">
                                            <p class="mb-1 text-muted"><small>Pesan Anda:</small></p>
                                            <div class="p-3 bg-light rounded">
                                                <?= nl2br(htmlspecialchars($msg['message'])); ?>
                                            </div>
                                        </div>
                                        <?php if(!empty($msg['reply'])) : ?>
                                        <div class="mt-3 text-end">
                                            <p class="mb-1 text-primary"><small>Balasan Admin:</small></p>
                                            <div class="p-3 bg-primary text-white rounded d-inline-block text-start w-100">
                                                <?= nl2br(htmlspecialchars($msg['reply'])); ?>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
