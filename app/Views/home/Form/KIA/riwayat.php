<?= $this->extend('layouts/landing/main') ?>
<?= $this->section('content') ?>

<section class="services" id="history">
    <div class="container">
        <div class="section-header fade-in visible">
            <h2 class="section-title">Riwayat Pengajuan Kartu Identitas Anak (KIA)</h2>
            <p class="section-subtitle">
                Lihat semua pengajuan KIA Anda.<br>
                Klik <b>Download</b> jika file KIA sudah tersedia.
            </p>
        </div>

        <div class="services-grid">
            <?php if (empty($riwayat)): ?>
                <div class="service-card fade-in visible" style="text-align:center;">
                    <span>Belum ada riwayat pengajuan KIA.</span>
                </div>
            <?php else: ?>
                <?php foreach ($riwayat as $pengajuan): ?>
                    <div class="service-card fade-in visible">
                        <div style="margin-bottom: 12px;">
                            <div style="font-weight: 600; font-size: 1rem; color: #e11d48;">
                                <?= esc($pengajuan['nama_anak']) ?>
                            </div>
                            <?php if (!empty($pengajuan['nik_anak'])): ?>
                                <div style="font-size: 0.95rem; color: #777;">
                                    NIK: <?= esc($pengajuan['nik_anak']) ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div style="font-size: 0.95rem; color: #555; margin-bottom: 6px;">
                            Tempat, Tanggal Lahir: <?= esc($pengajuan['tempat_lahir']) ?>, <?= esc(date('d-m-Y', strtotime($pengajuan['tanggal_lahir'] ?? 'now'))) ?>
                        </div>

                        <div style="font-size: 0.95rem; color: #555; margin-bottom: 6px;">
                            Jenis Kelamin: <?= esc($pengajuan['jenis_kelamin']) ?><br>
                            Agama: <?= esc($pengajuan['agama']) ?><br>
                            Alamat: <?= esc($pengajuan['alamat']) ?>
                        </div>

                        <div style="font-size: 0.95rem; color: #555; margin-bottom: 6px;">
                            Nama Ayah: <?= esc($pengajuan['nama_ayah']) ?> (NIK: <?= esc($pengajuan['nik_ayah']) ?>)<br>
                            Nama Ibu: <?= esc($pengajuan['nama_ibu']) ?> (NIK: <?= esc($pengajuan['nik_ibu']) ?>)
                        </div>

                        <div style="font-size: 0.95rem; color: #555; margin-bottom: 6px;">
                            Tanggal Pengajuan: <?= esc(date('d-m-Y', strtotime($pengajuan['created_at'] ?? 'now'))) ?>
                        </div>

                        <div style="margin-bottom: 8px;">
                            <span class="feature-tag" style="margin-right:8px;">
                                <?= esc($pengajuan['status_pengajuan']) ?>
                            </span>
                        </div>

                        <?php if (!empty($pengajuan['file_pdf'])): ?>
                            <a href="<?= site_url('form/kia/download/' . $pengajuan['id']) ?>"
                               class="service-btn" style="margin-top:10px;" target="_blank">
                                <i class="fas fa-download"></i> Download KIA
                            </a>
                        <?php else: ?>
                            <span class="feature-tag" style="background: #f3f4f6; color: #b91c1c;">
                                Belum Ada File KIA
                            </span>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
