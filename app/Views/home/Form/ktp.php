<?= $this->extend('layouts/Form/form') ?>
<?= $this->section('content') ?>

<main class="main-content">
    <div class="container">
        <div class="form-header">
            <div class="header-content">
                <div class="header-icon">
                    <i class="fas fa-id-card"></i>
                </div>
                <div class="header-text">
                    <h1>Pengajuan KTP Elektronik</h1>
                    <p>Lengkapi formulir berikut untuk mengajukan pembuatan atau perpanjangan KTP elektronik</p>
                </div>
            </div>
            <!-- Progress Steps -->
            <div class="progress-steps">
                <div class="step active" data-step="1"><div class="step-number">1</div><div class="step-label">Data Pribadi</div></div>
                <div class="step" data-step="2"><div class="step-number">2</div><div class="step-label">Upload Dokumen</div></div>
                <div class="step" data-step="3"><div class="step-number">3</div><div class="step-label">Verifikasi</div></div>
                <div class="step" data-step="4"><div class="step-number">4</div><div class="step-label">Selesai</div></div>
            </div>
        </div>

        <div class="form-container">
            <div id="alert-msg"></div>
            <form id="ktp-form" class="multi-step-form" enctype="multipart/form-data" autocomplete="off">
                <!-- STEP 1: Data Pribadi -->
                <div class="form-step active" id="step-1">
                    <div class="step-content">
                        <h2 class="step-title"><i class="fas fa-user"></i> Data Pribadi</h2>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="nik" class="form-label">NIK <span class="required">*</span></label>
                                <input type="text" id="nik" name="nik" class="form-input" maxlength="16" 
                                    value="<?= old('nik', $user['nik'] ?? '') ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nama-lengkap" class="form-label">Nama Lengkap <span class="required">*</span></label>
                                <input type="text" id="nama-lengkap" name="nama_lengkap" class="form-input" required
                                    value="<?= old('nama_lengkap', $user['nama_lengkap'] ?? '') ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="tempat-lahir" class="form-label">Tempat Lahir <span class="required">*</span></label>
                                <input type="text" id="tempat-lahir" name="tempat_lahir" class="form-input" required
                                    value="<?= old('tempat_lahir', $user['tempat_lahir'] ?? '') ?>">
                            </div>
                            <div class="form-group">
                                <label for="tanggal-lahir" class="form-label">Tanggal Lahir <span class="required">*</span></label>
                                <input type="date" id="tanggal-lahir" name="tanggal_lahir" class="form-input" required
                                    value="<?= old('tanggal_lahir', $user['tanggal_lahir'] ?? '') ?>">
                            </div>
                            <div class="form-group">
                                <label for="jenis-kelamin" class="form-label">Jenis Kelamin <span class="required">*</span></label>
                                <select id="jenis-kelamin" name="jenis_kelamin" class="form-select" required>
                                    <option value="">Pilih jenis kelamin</option>
                                    <option value="L" <?= old('jenis_kelamin', $user['jenis_kelamin'] ?? '') == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                                    <option value="P" <?= old('jenis_kelamin', $user['jenis_kelamin'] ?? '') == 'P' ? 'selected' : '' ?>>Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="agama" class="form-label">Agama <span class="required">*</span></label>
                                <select id="agama" name="agama" class="form-select" required>
                                    <option value="">Pilih agama</option>
                                    <option value="Islam" <?= old('agama', $user['agama'] ?? '') == 'Islam' ? 'selected' : '' ?>>Islam</option>
                                    <option value="Kristen" <?= old('agama', $user['agama'] ?? '') == 'Kristen' ? 'selected' : '' ?>>Kristen</option>
                                    <option value="Katolik" <?= old('agama', $user['agama'] ?? '') == 'Katolik' ? 'selected' : '' ?>>Katolik</option>
                                    <option value="Hindu" <?= old('agama', $user['agama'] ?? '') == 'Hindu' ? 'selected' : '' ?>>Hindu</option>
                                    <option value="Buddha" <?= old('agama', $user['agama'] ?? '') == 'Buddha' ? 'selected' : '' ?>>Buddha</option>
                                    <option value="Konghucu" <?= old('agama', $user['agama'] ?? '') == 'Konghucu' ? 'selected' : '' ?>>Konghucu</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status-perkawinan" class="form-label">Status Perkawinan <span class="required">*</span></label>
                                <select id="status-perkawinan" name="status_perkawinan" class="form-select" required>
                                    <option value="">Pilih status perkawinan</option>
                                    <option value="Belum Kawin" <?= old('status_perkawinan', $user['status_perkawinan'] ?? '') == 'Belum Kawin' ? 'selected' : '' ?>>Belum Kawin</option>
                                    <option value="Kawin" <?= old('status_perkawinan', $user['status_perkawinan'] ?? '') == 'Kawin' ? 'selected' : '' ?>>Kawin</option>
                                    <option value="Cerai Hidup" <?= old('status_perkawinan', $user['status_perkawinan'] ?? '') == 'Cerai Hidup' ? 'selected' : '' ?>>Cerai Hidup</option>
                                    <option value="Cerai Mati" <?= old('status_perkawinan', $user['status_perkawinan'] ?? '') == 'Cerai Mati' ? 'selected' : '' ?>>Cerai Mati</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pekerjaan" class="form-label">Pekerjaan <span class="required">*</span></label>
                                <input type="text" id="pekerjaan" name="pekerjaan" class="form-input" required
                                    value="<?= old('pekerjaan', $user['pekerjaan'] ?? '') ?>">
                            </div>
                            <div class="form-group full-width">
                                <label for="alamat" class="form-label">Alamat Lengkap <span class="required">*</span></label>
                                <textarea id="alamat" name="alamat" class="form-textarea" rows="3" required><?= old('alamat', $user['alamat'] ?? '') ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="rt" class="form-label">RT <span class="required">*</span></label>
                                <input type="text" id="rt" name="rt" class="form-input" maxlength="3" required
                                    value="<?= old('rt', $user['rt'] ?? '') ?>">
                            </div>
                            <div class="form-group">
                                <label for="rw" class="form-label">RW <span class="required">*</span></label>
                                <input type="text" id="rw" name="rw" class="form-input" maxlength="3" required
                                    value="<?= old('rw', $user['rw'] ?? '') ?>">
                            </div>
                            <div class="form-group">
                                <label for="kelurahan" class="form-label">Kelurahan/Desa <span class="required">*</span></label>
                                <input type="text" id="kelurahan" name="kelurahan" class="form-input" required
                                    value="<?= old('kelurahan', $user['kelurahan'] ?? '') ?>">
                            </div>
                            <div class="form-group">
                                <label for="kecamatan" class="form-label">Kecamatan <span class="required">*</span></label>
                                <input type="text" id="kecamatan" name="kecamatan" class="form-input" required
                                    value="<?= old('kecamatan', $user['kecamatan'] ?? '') ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- STEP 2: Upload Dokumen -->
                <div class="form-step" id="step-2">
                    <div class="step-content">
                        <h2 class="step-title"><i class="fas fa-upload"></i> Upload Dokumen Persyaratan</h2>
                        <div class="upload-section">
                            <div class="upload-info">
                                <h3>Dokumen yang Diperlukan:</h3>
                                <ul>
                                    <li><i class="fas fa-check"></i> Kartu Keluarga (KK) - Format PDF/JPG, Max 2MB</li>
                                    <li><i class="fas fa-check"></i> Akta Kelahiran - Format PDF/JPG, Max 2MB</li>
                                    <li><i class="fas fa-check"></i> Surat Nikah/Cerai (jika sudah menikah/cerai) - PDF/JPG, Max 2MB</li>
                                    <li><i class="fas fa-check"></i> Pas Foto 4x6 (Merah) - JPG, Max 1MB</li>
                                </ul>
                            </div>
                            <div class="upload-grid">
                                <div class="upload-item">
                                    <div class="upload-box" data-upload="kk">
                                        <div class="upload-icon"><i class="fas fa-users"></i></div>
                                        <div class="upload-text"><h4>Kartu Keluarga</h4><p>Drag & drop atau klik untuk upload</p><span class="file-types">PDF, JPG (Max 2MB)</span></div>
                                        <input type="file" id="file-kk" name="file-kk" accept=".pdf,.jpg,.jpeg" hidden required>
                                    </div>
                                    <div class="upload-result" id="result-kk"></div>
                                </div>
                                <div class="upload-item">
                                    <div class="upload-box" data-upload="akta">
                                        <div class="upload-icon"><i class="fas fa-certificate"></i></div>
                                        <div class="upload-text"><h4>Akta Kelahiran</h4><p>Drag & drop atau klik untuk upload</p><span class="file-types">PDF, JPG (Max 2MB)</span></div>
                                        <input type="file" id="file-akta" name="file-akta" accept=".pdf,.jpg,.jpeg" hidden required>
                                    </div>
                                    <div class="upload-result" id="result-akta"></div>
                                </div>
                                <div class="upload-item">
                                    <div class="upload-box" data-upload="nikah">
                                        <div class="upload-icon"><i class="fas fa-ring"></i></div>
                                        <div class="upload-text"><h4>Surat Nikah/Cerai</h4><p>Drag & drop atau klik untuk upload</p><span class="file-types">PDF, JPG (Max 2MB) - Opsional</span></div>
                                        <input type="file" id="file-nikah" name="file-nikah" accept=".pdf,.jpg,.jpeg" hidden>
                                    </div>
                                    <div class="upload-result" id="result-nikah"></div>
                                </div>
                                <div class="upload-item">
                                    <div class="upload-box" data-upload="foto">
                                        <div class="upload-icon"><i class="fas fa-camera"></i></div>
                                        <div class="upload-text"><h4>Pas Foto 4x6</h4><p>Drag & drop atau klik untuk upload</p><span class="file-types">JPG (Max 1MB, Merah)</span></div>
                                        <input type="file" id="file-foto" name="file-foto" accept=".jpg,.jpeg" hidden required>
                                    </div>
                                    <div class="upload-result" id="result-foto"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- STEP 3: Verifikasi -->
                <div class="form-step" id="step-3">
                    <div class="step-content">
                        <h2 class="step-title"><i class="fas fa-check-circle"></i> Verifikasi Data</h2>
                        <div class="verification-content">
                            <div class="verification-section">
                                <h3><i class="fas fa-user"></i> Data Pribadi</h3>
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

                <!-- STEP 4: Selesai -->
                <div class="form-step" id="step-4">
                    <div class="step-content">
                        <div class="success-content">
                            <div class="success-icon"><i class="fas fa-check-circle"></i></div>
                            <h2>Pengajuan Berhasil Dikirim!</h2>
                            <p>Terima kasih telah mengajukan pembuatan KTP elektronik. Berikut detail pengajuan Anda:</p>
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
                                    <li>Datang ke kantor Disdukcapil untuk pengambilan KTP</li>
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
let currentStep = 1, totalSteps = 4;
const prevBtn = document.getElementById('prev-btn');
const nextBtn = document.getElementById('next-btn');
const submitBtn = document.getElementById('submit-btn');
const formSteps = document.querySelectorAll('.form-step');

// --- Validasi Step: ---
function validateCurrentStep() {
    let valid = true;
    let fields = document.querySelectorAll('.form-step.active [required]');

    // Cek semua required
    fields.forEach(field => {
        if (field.type === 'checkbox') {
            if (!field.checked) valid = false;
        } else if (!field.value.trim()) {
            valid = false;
        }
    });

    // Khusus Step Upload Dokumen (step 2)
    if (currentStep === 2) {
        let uploads = [
            {id: 'file-kk', label: 'Kartu Keluarga'},
            {id: 'file-akta', label: 'Akta Kelahiran'},
            {id: 'file-foto', label: 'Pas Foto'}
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
nextBtn.onclick = () => {
    if (!validateCurrentStep()) return;
    if (currentStep < totalSteps - 1) { currentStep++; showStep(currentStep); }
};
document.getElementById('ktp-form').onsubmit = function(e) {
    e.preventDefault();
    if (!validateCurrentStep()) return;
    submitKtpAjax();
};

function submitKtpAjax() {
    let form = document.getElementById('ktp-form');
    let formData = new FormData(form);

    document.getElementById('loading-overlay').style.display = 'flex';
    submitBtn.disabled = true;
    document.getElementById('alert-msg').innerHTML = '';

    fetch('<?= base_url('form/ktp/ajax') ?>', {
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
            document.getElementById('application-number').textContent = res.application_number;
            document.getElementById('application-date').textContent =
                new Date(res.application_date).toLocaleDateString('id-ID', {weekday:'long',year:'numeric',month:'long',day:'numeric'});
            document.getElementById('alert-msg').innerHTML =
                '<div class="alert alert-success">'+res.message+'</div>';
            showSuccessMessage(res.message || 'Pengajuan berhasil dikirim!');
            setTimeout(() => window.location.href = '<?= base_url('form/riwayat') ?>', 2000);

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
</script>

<?= $this->endSection() ?>
