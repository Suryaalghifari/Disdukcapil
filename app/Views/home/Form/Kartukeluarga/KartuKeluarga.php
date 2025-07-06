<?= $this->extend('layouts/Form/form') ?>
<?= $this->section('content') ?>

<main class="main-content">
    <div class="container">
        <div class="form-header">
            <div class="header-content">
                <div class="header-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="header-text">
                    <h1>Pengajuan Kartu Keluarga</h1>
                    <p>Lengkapi formulir berikut untuk mengajukan pembuatan Kartu Keluarga baru atau perubahan data.</p>
                </div>
            </div>
            <!-- Progress Steps -->
            <div class="progress-steps">
                <div class="step active" data-step="1"><div class="step-number">1</div><div class="step-label">Data Kepala Keluarga</div></div>
                <div class="step" data-step="2"><div class="step-number">2</div><div class="step-label">Alamat & Wilayah</div></div>
                <div class="step" data-step="3"><div class="step-number">3</div><div class="step-label">Upload Dokumen</div></div>
                <div class="step" data-step="4"><div class="step-number">4</div><div class="step-label">Verifikasi</div></div>
                <div class="step" data-step="5"><div class="step-number">5</div><div class="step-label">Selesai</div></div>
            </div>
        </div>

        <div class="form-container">
            <div id="alert-msg"></div>
            <form id="kk-form" class="multi-step-form" enctype="multipart/form-data" autocomplete="off">
                <!-- STEP 1: Data Kepala Keluarga -->
                <div class="form-step active" id="step-1">
                    <div class="step-content">
                        <h2 class="step-title"><i class="fas fa-user"></i> Data Kepala Keluarga</h2>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="nama-kepala-keluarga" class="form-label">Nama Kepala Keluarga <span class="required">*</span></label>
                                <input type="text" id="nama-kepala-keluarga" name="nama_kepala_keluarga" class="form-input" required>
                            </div>
                            <div class="form-group">
                                <label for="nik-kepala-keluarga" class="form-label">NIK Kepala Keluarga <span class="required">*</span></label>
                                <input type="text" id="nik-kepala-keluarga" name="nik_kepala_keluarga" class="form-input" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- STEP 2: Alamat & Wilayah -->
                <div class="form-step" id="step-2">
                    <div class="step-content">
                        <h2 class="step-title"><i class="fas fa-map-marker-alt"></i> Alamat & Wilayah</h2>
                        <div class="form-grid">
                            <div class="form-group full-width">
                                <label for="alamat" class="form-label">Alamat Lengkap <span class="required">*</span></label>
                                <textarea id="alamat" name="alamat" class="form-textarea" rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="rt" class="form-label">RT <span class="required">*</span></label>
                                <input type="text" id="rt" name="rt" class="form-input" required>
                            </div>
                            <div class="form-group">
                                <label for="rw" class="form-label">RW <span class="required">*</span></label>
                                <input type="text" id="rw" name="rw" class="form-input" required>
                            </div>
                            <div class="form-group">
                                <label for="kelurahan" class="form-label">Kelurahan/Desa <span class="required">*</span></label>
                                <input type="text" id="kelurahan" name="kelurahan" class="form-input" required>
                            </div>
                            <div class="form-group">
                                <label for="kecamatan" class="form-label">Kecamatan <span class="required">*</span></label>
                                <input type="text" id="kecamatan" name="kecamatan" class="form-input" required>
                            </div>
                            <div class="form-group">
                                <label for="kode-pos" class="form-label">Kode Pos <span class="required">*</span></label>
                                <input type="text" id="kode-pos" name="kode_pos" class="form-input" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- STEP 3: Upload Dokumen -->
                <div class="form-step" id="step-3">
                    <div class="step-content">
                        <h2 class="step-title"><i class="fas fa-upload"></i> Upload Dokumen Persyaratan</h2>
                        <div class="upload-section">
                            <div class="upload-info">
                                <h3>Dokumen yang Diperlukan:</h3>
                                <ul>
                                    <li><i class="fas fa-check"></i> KTP Kepala Keluarga (PDF/JPG, Max 2MB)</li>
                                    <li><i class="fas fa-check"></i> Surat Pengantar RT (PDF/JPG, Max 2MB)</li>
                                    <li><i class="fas fa-check"></i> Lampiran KK Lama (Jika Perubahan Data, PDF/JPG, Max 2MB)</li>
                                </ul>
                            </div>
                            <div class="upload-grid">
                                <div class="upload-item">
                                    <div class="upload-box" data-upload="file_ktp_kepala" style="cursor:pointer;">
                                        <div class="upload-icon"><i class="fas fa-id-card"></i></div>
                                        <div class="upload-text">
                                            <h4>KTP Kepala Keluarga</h4>
                                            <p>Drag & drop atau klik untuk upload</p>
                                            <span class="file-types">PDF, JPG (Max 2MB)</span>
                                        </div>
                                        <input type="file" id="file-ktp-kepala" name="file_ktp_kepala" accept=".pdf,.jpg,.jpeg" hidden required>
                                        <span class="file-name"></span>
                                    </div>
                                </div>
                                <div class="upload-item">
                                    <div class="upload-box" data-upload="file_pengantar_rt" style="cursor:pointer;">
                                        <div class="upload-icon"><i class="fas fa-envelope-open-text"></i></div>
                                        <div class="upload-text">
                                            <h4>Surat Pengantar RT</h4>
                                            <p>Drag & drop atau klik untuk upload</p>
                                            <span class="file-types">PDF, JPG (Max 2MB)</span>
                                        </div>
                                        <input type="file" id="file-pengantar-rt" name="file_pengantar_rt" accept=".pdf,.jpg,.jpeg" hidden required>
                                        <span class="file-name"></span>
                                    </div>
                                </div>
                                <div class="upload-item">
                                    <div class="upload-box" data-upload="file_lampiran_kk_lama" style="cursor:pointer;">
                                        <div class="upload-icon"><i class="fas fa-file-alt"></i></div>
                                        <div class="upload-text">
                                            <h4>Lampiran KK Lama</h4>
                                            <p>Drag & drop atau klik untuk upload</p>
                                            <span class="file-types">PDF, JPG (Max 2MB)</span>
                                        </div>
                                        <input type="file" id="file-lampiran-kk-lama" name="file_lampiran_kk_lama" accept=".pdf,.jpg,.jpeg" hidden>
                                        <span class="file-name"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- STEP 4: Verifikasi -->
                <div class="form-step" id="step-4">
                    <div class="step-content">
                        <h2 class="step-title"><i class="fas fa-check-circle"></i> Verifikasi Data</h2>
                        <div class="verification-content">
                            <div class="verification-section">
                                <h3><i class="fas fa-user"></i> Data Kepala Keluarga</h3>
                                <div class="verification-grid" id="verification-personal"></div>
                            </div>
                            <div class="verification-section">
                                <h3><i class="fas fa-file-alt"></i> Dokumen Terupload</h3>
                                <div class="verification-files" id="verification-files"></div>
                            </div>
                            <div class="agreement-section">
                                <label class="checkbox-container">
                                    <input type="checkbox" id="agreement" name="agreement" required>
                                    <span class="checkmark"></span>
                                    Saya menyatakan bahwa data yang saya berikan adalah benar dan dapat dipertanggungjawabkan.
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- STEP 5: Selesai -->
                <div class="form-step" id="step-5">
                    <div class="step-content">
                        <div class="success-content">
                            <div class="success-icon"><i class="fas fa-check-circle"></i></div>
                            <h2>Pengajuan Berhasil Dikirim!</h2>
                            <p>Terima kasih telah mengajukan pembuatan/ubah data Kartu Keluarga. Berikut detail pengajuan Anda:</p>
                            <div class="success-info">
                                <div class="info-item">
                                    <strong>Nomor Pengajuan:</strong>
                                    <span id="application-number"></span>
                                </div>
                                <div class="info-item">
                                    <strong>Tanggal Pengajuan:</strong>
                                    <span id="application-date"></span>
                                </div>
                                <div class="info-item">
                                    <strong>Status:</strong>
                                    <span class="status-badge">Menunggu Verifikasi</span>
                                </div>
                            </div>
                            <div class="next-steps">
                                <h3>Langkah Selanjutnya:</h3>
                                <ol>
                                    <li>Simpan nomor pengajuan untuk tracking status</li>
                                    <li>Tunggu notifikasi verifikasi (1-3 hari kerja)</li>
                                    <li>Datang ke kantor Dukcapil untuk mengambil KK</li>
                                    <li>Bawa dokumen asli untuk verifikasi ulang</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FORM NAVIGATION -->
                <div class="form-navigation">
                    <button type="button" class="btn btn-outline" id="prev-btn">Sebelumnya</button>
                    <button type="button" class="btn btn-primary" id="next-btn">Selanjutnya</button>
                    <button type="submit" class="btn btn-primary" id="submit-btn" style="display: none;">Kirim Pengajuan</button>
                </div>
            </form>
        </div>
    </div>
</main>
<div class="loading-overlay" id="loading-overlay" style="display:none;">
    <div class="loading-content">
        <div class="loading-spinner"></div>
        <p>Memproses pengajuan...</p>
    </div>
</div>

<script>
let currentStep = 1, totalSteps = 5;
const prevBtn = document.getElementById('prev-btn');
const nextBtn = document.getElementById('next-btn');
const submitBtn = document.getElementById('submit-btn');
const formSteps = document.querySelectorAll('.form-step');

function validateCurrentStep() {
    let valid = true;
    let fields = document.querySelectorAll('.form-step.active [required]');
    fields.forEach(field => {
        if (field.type === 'checkbox') {
            if (!field.checked) valid = false;
        } else if (!field.value.trim()) {
            valid = false;
        }
    });
    if (currentStep === 1) {
        const nikSuami = document.querySelector('input[name="nik_kepala_keluarga"]').value.trim();
        const nikPattern = /^\d{16}$/;
        if (!nikPattern.test(nikSuami)) {
            showWarningMessage('NIK Suami harus berupa 16 digit angka.');
            return false;
        }
    }
    if (currentStep === 3) {
        let uploads = [
            {id: 'file-ktp-kepala', label: 'KTP Kepala Keluarga'},
            {id: 'file-pengantar-rt', label: 'Surat Pengantar RT'}
        ];
        for (let i = 0; i < uploads.length; i++) {
            let fileInput = document.getElementById(uploads[i].id);
            if (!fileInput.files || fileInput.files.length === 0) {
                valid = false;
                showWarningMessage('File wajib "' + uploads[i].label + '" belum diupload!');
                fileInput.parentElement.classList.add('error');
                return false;
            } else {
                fileInput.parentElement.classList.remove('error');
            }
        }
    }
    if (!valid) showWarningMessage('Mohon isi semua data pada langkah ini!');
    return valid;
}

function showStep(step) {
    formSteps.forEach((el, i) => el.classList.toggle('active', i === step - 1));
    prevBtn.style.display = step > 1 ? 'inline-block' : 'none';
    nextBtn.style.display = step < totalSteps ? 'inline-block' : 'none';
    submitBtn.style.display = step === totalSteps - 1 ? 'inline-block' : 'none';
    document.querySelectorAll('.progress-steps .step').forEach((el, i) => {
        el.classList.remove('active', 'completed');
        if (i + 1 === step) el.classList.add('active');
        if (i + 1 < step) el.classList.add('completed');
    });
}
showStep(currentStep);

prevBtn.onclick = () => { if (currentStep > 1) { currentStep--; showStep(currentStep); }};
nextBtn.onclick = () => { if (!validateCurrentStep()) return; if (currentStep < totalSteps - 1) { currentStep++; showStep(currentStep); } };
document.getElementById('kk-form').onsubmit = function(e) {
    e.preventDefault();
    if (!validateCurrentStep()) return;
    submitKkAjax();
};

// Upload box drag-drop & tampilkan nama file
document.querySelectorAll('.upload-box').forEach(box => {
    box.addEventListener('click', function(e) {
        if (!e.target.matches('input[type="file"]')) {
            let fileInput = this.querySelector('input[type="file"]');
            if (fileInput) fileInput.click();
        }
    });
    box.addEventListener('dragover', function(e) {
        e.preventDefault(); box.classList.add('drag-over');
    });
    box.addEventListener('dragleave', function(e) {
        e.preventDefault(); box.classList.remove('drag-over');
    });
    box.addEventListener('drop', function(e) {
        e.preventDefault(); box.classList.remove('drag-over');
        let fileInput = this.querySelector('input[type="file"]');
        if (fileInput) {
            fileInput.files = e.dataTransfer.files;
            fileInput.dispatchEvent(new Event('change'));
        }
    });
});

document.querySelectorAll('input[type="file"]').forEach(input => {
    input.addEventListener('change', function() {
        let fileNameSpan = this.closest('.upload-box').querySelector('.file-name');
        if (this.files.length > 0 && fileNameSpan) {
            fileNameSpan.textContent = 'File diupload: ' + this.files[0].name;
            fileNameSpan.style.color = 'green';
        } else if (fileNameSpan) {
            fileNameSpan.textContent = '';
        }
    });
});

function submitKkAjax() {
    let form = document.getElementById('kk-form');
    let formData = new FormData(form);

    document.getElementById('loading-overlay').style.display = 'flex';
    submitBtn.disabled = true;
    document.getElementById('alert-msg').innerHTML = '';

    fetch('<?= base_url('form/kartukeluarga/prosesKkAjax') ?>', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(res => {
        submitBtn.disabled = false;
        document.getElementById('loading-overlay').style.display = 'none';
        if (res.status === 'success') {
            currentStep = totalSteps;
            showStep(currentStep);
            document.getElementById('application-number').textContent = res.id;
            document.getElementById('application-date').textContent =
                new Date().toLocaleDateString('id-ID', {weekday:'long',year:'numeric',month:'long',day:'numeric'});
            document.getElementById('alert-msg').innerHTML =
                '<div class="alert alert-success">'+res.message+'</div>';
            showSuccessMessage(res.message || 'Pengajuan berhasil dikirim!');
            setTimeout(() => window.location.href = '<?= base_url('form/kartukeluarga/riwayat') ?>', 2000);
        } else {
            let err = res.message;
            if (res.errors)
                err += "<ul>"+Object.values(res.errors).map(v=>"<li>"+v+"</li>").join('')+"</ul>";
            document.getElementById('alert-msg').innerHTML =
                '<div class="alert alert-danger">'+err+'</div>';
            showErrorMessage(res.message || 'Gagal menyimpan data');
        }
    })
    .catch(() => {
        submitBtn.disabled = false;
        document.getElementById('loading-overlay').style.display = 'none';
        document.getElementById('alert-msg').innerHTML =
            '<div class="alert alert-danger">Terjadi error jaringan.</div>';
        showErrorMessage('Terjadi error jaringan!');
    });
}

function showWarningMessage(msg){ alert(msg);}
function showSuccessMessage(msg){ alert(msg);}
function showErrorMessage(msg){ alert(msg);}
</script>

<?= $this->endSection() ?>
