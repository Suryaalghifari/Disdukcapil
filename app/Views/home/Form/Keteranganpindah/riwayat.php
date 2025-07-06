<?= $this->extend('layouts/landing/main') ?>
<?= $this->section('content') ?>

<section class="services" id="history">
    <div class="container">
        <div class="section-header fade-in visible">
            <h2 class="section-title">Riwayat Pengajuan Surat Keterangan Pindah</h2>
            <p class="section-subtitle">
                Lihat semua pengajuan Surat Keterangan Pindah Anda.<br>
                Klik <b>Download</b> jika file surat sudah tersedia.
            </p>
        </div>

        <div class="services-grid">
            <?php if (empty($riwayat)): ?>
                <div class="service-card fade-in visible" style="text-align:center;">
                    <span>Belum ada riwayat pengajuan Surat Keterangan Pindah.</span>
                </div>
            <?php else: ?>
                <?php foreach ($riwayat as $pengajuan): ?>
                    <div class="service-card fade-in visible">
                        <div style="margin-bottom: 12px;">
                            <div style="font-weight: 600; font-size: 1rem; color: #e11d48;">
                                <?= esc($pengajuan['nama_pemohon']) ?>
                            </div>
                            <?php if (!empty($pengajuan['nik_pemohon'])): ?>
                                <div style="font-size: 0.95rem; color: #777;">
                                    NIK: <?= esc($pengajuan['nik_pemohon']) ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div style="font-size: 0.95rem; color: #555; margin-bottom: 6px;">
                            Asal: <?= esc($pengajuan['alamat_asal']) ?>
                            <?= (!empty($pengajuan['rt_asal']) && !empty($pengajuan['rw_asal'])) ? '(RT ' . esc($pengajuan['rt_asal']) . '/RW ' . esc($pengajuan['rw_asal']) . ')' : '' ?>,
                            <?= esc($pengajuan['kelurahan_asal']) ?>,
                            <?= esc($pengajuan['kecamatan_asal']) ?>,
                            <?= esc($pengajuan['kabupaten_asal']) ?>,
                            <?= esc($pengajuan['provinsi_asal']) ?>
                        </div>
                        <div style="font-size: 0.95rem; color: #555; margin-bottom: 6px;">
                            Tujuan: <?= esc($pengajuan['alamat_tujuan']) ?>
                            <?= (!empty($pengajuan['rt_tujuan']) && !empty($pengajuan['rw_tujuan'])) ? '(RT ' . esc($pengajuan['rt_tujuan']) . '/RW ' . esc($pengajuan['rw_tujuan']) . ')' : '' ?>,
                            <?= esc($pengajuan['kelurahan_tujuan']) ?>,
                            <?= esc($pengajuan['kecamatan_tujuan']) ?>,
                            <?= esc($pengajuan['kabupaten_tujuan']) ?>,
                            <?= esc($pengajuan['provinsi_tujuan']) ?>
                        </div>
                        <div style="font-size: 0.95rem; color: #555; margin-bottom: 6px;">
                            Alasan Pindah: <?= esc($pengajuan['alasan_pindah']) ?><br>
                            Jumlah Anggota Pindah: <?= esc($pengajuan['jumlah_anggota_pindah']) ?>
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
                            <a href="<?= site_url('form/keteranganpindah/download/' . $pengajuan['id']) ?>"
                               class="service-btn" style="margin-top:10px;" target="_blank">
                                <i class="fas fa-download"></i> Download Surat
                            </a>
                        <?php else: ?>
                            <span class="feature-tag" style="background: #f3f4f6; color: #b91c1c;">
                                Belum Ada File Surat
                            </span>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
