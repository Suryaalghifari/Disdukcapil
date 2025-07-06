<?= $this->extend('layouts/landing/main') ?>
<?= $this->section('content') ?>

<section class="services" id="history">
    <div class="container">
        <div class="section-header fade-in visible">
            <h2 class="section-title">Riwayat Pengajuan KTP Digital</h2>
            <p class="section-subtitle">
                Lihat semua pengajuan KTP elektronik Anda.<br>
                Klik <b>Download</b> jika file sudah tersedia.
            </p>
        </div>

        <div class="services-grid">
            <?php if (empty($riwayat)): ?>
                <div class="service-card fade-in visible" style="text-align:center;">
                    <span>Belum ada riwayat pengajuan.</span>
                </div>
            <?php else: ?>
                <?php foreach ($riwayat as $pengajuan): ?>
                    <div class="service-card fade-in visible">
                        <div style="margin-bottom: 12px;">
                            <div style="font-weight: 600; font-size: 1rem; color: #b91c1c;"><?= esc($pengajuan['nik']) ?></div>
                            <div style="font-size: 1.1rem; color: #222;"><?= esc($pengajuan['nama_lengkap']) ?></div>
                        </div>
                        <div style="font-size: 0.95rem; color: #555; margin-bottom: 6px;">
                            Tanggal: <?= esc(date('d-m-Y', strtotime($pengajuan['created_at'] ?? 'now'))) ?>
                        </div>
                        <div style="margin-bottom: 8px;">
                            <span class="feature-tag" style="margin-right:8px;">
                                <?= esc($pengajuan['status_pengajuan']) ?>
                            </span>
                        </div>
                        <?php if (!empty($pengajuan['file_pdf'])): ?>
                            <a href="<?= site_url('form/download-ktp/' . $pengajuan['id']) ?>"
                               class="service-btn" style="margin-top:10px;" target="_blank">
                                <i class="fas fa-download"></i> Download KTP
                            </a>
                        <?php else: ?>
                            <span class="feature-tag" style="background: #f3f4f6; color: #b91c1c;">
                                Belum Ada File
                            </span>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
