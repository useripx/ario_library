<div class="container-xxl py-5 bg-dark" style="min-height: 100vh;">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-white mb-0"><?= $data['loan']['title']; ?></h2>
            <a href="<?= BASEURL; ?>/loan" class="btn btn-outline-light"><i class="fa fa-arrow-left me-2"></i> Kembali ke Rak</a>
        </div>
        
        <div class="card bg-white border-0 shadow-lg overflow-hidden position-relative" style="height: 80vh;">
            <?php if(!empty($data['pdf_id'])) : ?>
                <!-- Overlay to block the Pop-out / Download button in Google Drive Iframe -->
                <div class="reader-overlay"></div>
                
                <iframe 
                    src="https://drive.google.com/file/d/<?= $data['pdf_id']; ?>/preview" 
                    width="100%" 
                    height="100%" 
                    allow="autoplay" 
                    style="border: none;">
                </iframe>
            <?php else : ?>
                <div class="d-flex flex-column align-items-center justify-content-center h-100 p-5">
                    <i class="fa fa-exclamation-triangle fa-4x text-warning mb-3"></i>
                    <h4>Link Reader Tidak Valid</h4>
                    <p class="text-muted">Link PDF buku ini tidak dalam format Google Drive yang benar.</p>
                    <a href="<?= $data['loan']['pdf_link']; ?>" target="_blank" class="btn btn-primary mt-3">Buka Langsung di Browser</a>
                </div>
            <?php endif; ?>
        </div>

        <div class="mt-4 text-center text-white-50">
            <p><small><i class="fa fa-lock me-2"></i> Mode Membaca Aman - Ario Library Digital Portal</small></p>
        </div>
    </div>
</div>

<style>
    /* Reader Security Overlay */
    .reader-overlay {
        position: absolute;
        top: 0;
        right: 0;
        width: 150px; /* Covered area for the pop-out button */
        height: 60px;
        background: transparent;
        z-index: 10;
        cursor: default;
    }
    
    /* Disabling right click on the reader container */
    .card {
        user-select: none;
        -webkit-user-select: none;
    }

    /* Hide the navbar globally when reading for better focus */
    .navbar { display: none !important; }
    body { background-color: #1a1e21; }
</style>
