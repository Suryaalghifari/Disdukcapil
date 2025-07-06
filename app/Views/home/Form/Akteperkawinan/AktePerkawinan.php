<?= $this->extend('layouts/Form/form') ?>
<?= $this->section('content') ?>

<main class="main-content">
    <div class="container">
        <div class="form-header">
            <div class="header-content">
                <div class="header-icon">
                    <i class="fas fa-ring"></i>
                </div>
                <div class="header-text">
                    <h1>Pengajuan Akte Perkawinan</h1>
                    <p>Lengkapi formulir berikut untuk mengajukan pembuatan Akte Perkawinan.</p>
                </div>
            </div>
            <div class="progress-steps">
                <div class="step active" data-step="1"><div class="step-number">1</div><div class="step-label">Data Suami</div></div>
                <div class="step" data-step="2"><div class="step-number">2</div><div class="step-label">Data Istri</div></div>
                <div class="step" data-step="3"><div class="step-number">3</div><div class="step-label">Data Perkawinan</div></div>
                <div class="step" data-step="4"><div class="step-number">4</div><div class="step-label">Upload Dokumen</div></div>
                <div class="step" data-step="5"><div class="step-number">5</div><div class="step-label">Verifikasi</div></div>
                <div class="step" data-step="6"><div class="step-number">6</div><div class="step-label">Selesai</div></div>
            </div>
        </div>

        <div class="form-container">
            <div id="alert-msg"></div>
            <form id="perkawinan-form" class="multi-step-form" enctype="multipart/form-data" autocomplete="off">
                <!-- STEP 1: Data Suami -->
                <div class="form-step active" id="step-1">
                    <div class="step-content">
                        <h2 class="step-title"><i class="fas fa-male"></i> Data Suami</h2>
                        <div class="form-grid">
                            <div class="form-group">
                                <label>Nama Suami <span class="required">*</span></label>
                                <input type="text" name="nama_suami" class="form-input" required>
                            </div>
                            <div class="form-group">
                                <label>NIK Suami <span class="required">*</span></label>
                                <input type="text" name="nik_suami" class="form-input" required>
                            </div>
                            <div class="form-group">
                                <label>Tempat Lahir Suami <span class="required">*</span></label>
                                <input type="text" name="tempat_lahir_suami" class="form-input" required>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Lahir Suami <span class="required">*</span></label>
                                <input type="date" name="tanggal_lahir_suami" class="form-input" required>
                            </div>
                            <div class="form-group">
                                <label>Agama Suami <span class="required">*</span></label>
                                <input type="text" name="agama_suami" class="form-input" required>
                            </div>
                            <div class="form-group full-width">
                                <label>Alamat Suami <span class="required">*</span></label>
                                <textarea name="alamat_suami" class="form-textarea" rows="2" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- STEP 2: Data Istri -->
                <div class="form-step" id="step-2">
                    <div class="step-content">
                        <h2 class="step-title"><i class="fas fa-female"></i> Data Istri</h2>
                        <div class="form-grid">
                            <div class="form-group">
                                <label>Nama Istri <span class="required">*</span></label>
                                <input type="text" name="nama_istri" class="form-input" required>
                            </div>
                            <div class="form-group">
                                <label>NIK Istri <span class="required">*</span></label>
                                <input type="text" name="nik_istri" class="form-input" required>
                            </div>
                            <div class="form-group">
                                <label>Tempat Lahir Istri <span class="required">*</span></label>
                                <input type="text" name="tempat_lahir_istri" class="form-input" required>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Lahir Istri <span class="required">*</span></label>
                                <input type="date" name="tanggal_lahir_istri" class="form-input" required>
                            </div>
                            <div class="form-group">
                                <label>Agama Istri <span class="required">*</span></label>
                                <input type="text" name="agama_istri" class="form-input" required>
                            </div>
                            <div class="form-group full-width">
                                <label>Alamat Istri <span class="required">*</span></label>
                                <textarea name="alamat_istri" class="form-textarea" rows="2" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- STEP 3: Data Perkawinan -->
                <div class="form-step" id="step-3">
                    <div class="step-content">
                        <h2 class="step-title"><i class="fas fa-calendar-check"></i> Data Perkawinan</h2>
                        <div class="form-grid">
                            <div class="form-group">
                                <label>Tanggal Perkawinan <span class="required">*</span></label>
                                <input type="date" name="tanggal_perkawinan" class="form-input" required>
                            </div>
                            <div class="form-group">
                                <label>Tempat Perkawinan <span class="required">*</span></label>
                                <input type="text" name="tempat_perkawinan" class="form-input" required>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- STEP 4: Upload Dokumen -->
                <div class="form-step" id="step-4">
                    <div class="step-content">
                        <h2 class="step-title"><i class="fas fa-upload"></i> Upload Dokumen Persyaratan</h2>
                        <div class="upload-section">
                            <div class="upload-info">
                                <h3>Dokumen yang Diperlukan:</h3>
                                <ul>
                                    <li><i class="fas fa-check"></i> KTP Suami (PDF/JPG, Max 2MB)</li>
                                    <li><i class="fas fa-check"></i> KTP Istri (PDF/JPG, Max 2MB)</li>
                                    <li><i class="fas fa-check"></i> Kartu Keluarga (PDF/JPG, Max 2MB)</li>
                                    <li><i class="fas fa-check"></i> Buku Nikah (PDF/JPG, Max 2MB)</li>
                                    <li><i class="fas fa-check"></i> Surat Keterangan Perkawinan (PDF/JPG, Max 2MB)</li>
                                </ul>
                            </div>
                            <div class="upload-grid">
                                <div class="upload-item">
                                    <div class="upload-box" data-upload="file_ktp_suami" style="cursor:pointer;">
                                        <div class="upload-icon"><i class="fas fa-id-card"></i></div>
                                        <div class="upload-text">
                                            <h4>KTP Suami</h4>
                                            <p>Drag & drop atau klik untuk upload</p>
                                            <span class="file-types">PDF, JPG (Max 2MB)</span>
                                        </div>
                                        <input type="file" id="file-ktp-suami" name="file_ktp_suami" accept=".pdf,.jpg,.jpeg" hidden required>
                                        <span class="file-name"></span>
                                    </div>
                                </div>
                                <div class="upload-item">
                                    <div class="upload-box" data-upload="file_ktp_istri" style="cursor:pointer;">
                                        <div class="upload-icon"><i class="fas fa-id-card"></i></div>
                                        <div class="upload-text">
                                            <h4>KTP Istri</h4>
                                            <p>Drag & drop atau klik untuk upload</p>
                                            <span class="file-types">PDF, JPG (Max 2MB)</span>
                                        </div>
                                        <input type="file" id="file-ktp-istri" name="file_ktp_istri" accept=".pdf,.jpg,.jpeg" hidden required>
                                        <span class="file-name"></span>
                                    </div>
                                </div>
                                <div class="upload-item">
                                    <div class="upload-box" data-upload="file_kk" style="cursor:pointer;">
                                        <div class="upload-icon"><i class="fas fa-users"></i></div>
                                        <div class="upload-text">
                                            <h4>Kartu Keluarga</h4>
                                            <p>Drag & drop atau klik untuk upload</p>
                                            <span class="file-types">PDF, JPG (Max 2MB)</span>
                                        </div>
                                        <input type="file" id="file-kk" name="file_kk" accept=".pdf,.jpg,.jpeg" hidden required>
                                        <span class="file-name"></span>
                                    </div>
                                </div>
                                <div class="upload-item">
                                    <div class="upload-box" data-upload="file_buku_nikah" style="cursor:pointer;">
                                        <div class="upload-icon"><i class="fas fa-book"></i></div>
                                        <div class="upload-text">
                                            <h4>Buku Nikah</h4>
                                            <p>Drag & drop atau klik untuk upload</p>
                                            <span class="file-types">PDF, JPG (Max 2MB)</span>
                                        </div>
                                        <input type="file" id="file-buku-nikah" name="file_buku_nikah" accept=".pdf,.jpg,.jpeg" hidden required>
                                        <span class="file-name"></span>
                                    </div>
                                </div>
                                <div class="upload-item">
                                    <div class="upload-box" data-upload="file_surat_perkawinan" style="cursor:pointer;">
                                        <div class="upload-icon"><i class="fas fa-file-alt"></i></div>
                                        <div class="upload-text">
                                            <h4>Surat Perkawinan</h4>
                                            <p>Drag & drop atau klik untuk upload</p>
                                            <span class="file-types">PDF, JPG (Max 2MB)</span>
                                        </div>
                                        <input type="file" id="file-surat-perkawinan" name="file_surat_perkawinan" accept=".pdf,.jpg,.jpeg" hidden required>
                                        <span class="file-name"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- STEP 5: Verifikasi -->
                <div class="form-step" id="step-5">
                    <div class="step-content">
                        <h2 class="step-title"><i class="fas fa-check-circle"></i> Verifikasi Data</h2>
                        <div class="verification-content">
                            <div class="verification-section">
                                <h3><i class="fas fa-user"></i> Data Suami & Istri</h3>
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

                <!-- STEP 6: Selesai -->
                <div class="form-step" id="step-6">
                    <div class="step-content">
                        <div class="success-content">
                            <div class="success-icon"><i class="fas fa-check-circle"></i></div>
                            <h2>Pengajuan Berhasil Dikirim!</h2>
                            <p>Terima kasih telah mengajukan pembuatan Akte Perkawinan. Berikut detail pengajuan Anda:</p>
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
                                    <li>Datang ke kantor Dukcapil untuk mengambil akte</li>
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
let currentStep = 1, totalSteps = 6;
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
     // Validasi khusus NIK Suami
     if (currentStep === 1) {
        const nikSuami = document.querySelector('input[name="nik_suami"]').value.trim();
        const nikPattern = /^\d{16}$/;
        if (!nikPattern.test(nikSuami)) {
            showWarningMessage('NIK Suami harus berupa 16 digit angka.');
            return false;
        }
    }

    // Validasi khusus NIK Istri
    if (currentStep === 2) {
        const nikIstri = document.querySelector('input[name="nik_istri"]').value.trim();
        const nikPattern = /^\d{16}$/;
        if (!nikPattern.test(nikIstri)) {
            showWarningMessage('NIK Istri harus berupa 16 digit angka.');
            return false;
        }
    }

    if (currentStep === 4) {
        let uploads = [
            {id: 'file-ktp-suami', label: 'KTP Suami'},
            {id: 'file-ktp-istri', label: 'KTP Istri'},
            {id: 'file-kk', label: 'Kartu Keluarga'},
            {id: 'file-buku-nikah', label: 'Buku Nikah'},
            {id: 'file-surat-perkawinan', label: 'Surat Perkawinan'}
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
document.getElementById('perkawinan-form').onsubmit = function(e) {
    e.preventDefault();
    if (!validateCurrentStep()) return;
    submitPerkawinanAjax();
};

// Upload drag-drop & tampilkan nama file
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

function submitPerkawinanAjax() {
    let form = document.getElementById('perkawinan-form');
    let formData = new FormData(form);

    document.getElementById('loading-overlay').style.display = 'flex';
    submitBtn.disabled = true;
    document.getElementById('alert-msg').innerHTML = '';

    fetch('<?= base_url('form/akteperkawinan/prosesAkteAjax') ?>', {
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
            setTimeout(() => window.location.href = '<?= base_url('form/akteperkawinan/riwayat') ?>', 2000);
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
