<?= $this->extend('layouts/Auth/layout') ?>
<?= $this->section('content') ?>
<div class="tabs">
    <button class="tab-btn <?= $activeTab === 'login' ? 'active' : '' ?>" data-tab="login">Masuk</button>
    <button class="tab-btn <?= $activeTab === 'register' ? 'active' : '' ?>" data-tab="register">Daftar</button>
</div>
<div class="tab-content">
    <div class="tab-pane <?= $activeTab === 'login' ? 'active' : '' ?>" id="login-tab">
        <form id="login-form" method="post" action="<?= base_url('auth/login/process') ?>">
            <div class="form-group">
                <input type="text" id="username" name="username" class="form-input" placeholder=" " required>
                <label for="username" class="form-label">Email atau NIK</label>
            </div>

            <div class="form-group">
                <input type="password" id="password" name="password" class="form-input" placeholder=" " required>
                <label for="password" class="form-label">Password</label>
                <button type="button" class="toggle-password"><i class="fas fa-eye"></i></button>
            </div>
            <button type="submit" class="submit-btn">Masuk</button>
        </form>
    </div>

    <div class="tab-pane <?= $activeTab === 'register' ? 'active' : '' ?>" id="register-tab">
        <form id="register-form" method="post" action="<?= base_url('auth/register/process') ?>">
            <div class="form-group">
                <input type="text" id="fullName" name="nama_lengkap" class="form-input" placeholder=" " required>
                <label for="fullName" class="form-label">Nama Lengkap</label>
            </div>
            <div class="form-group">
                <input type="text" id="nik" name="nik" class="form-input" placeholder=" " required>
                <label for="nik" class="form-label">NIK</label>
            </div>
            <div class="form-group">
                <input type="email" id="email" name="email" class="form-input" placeholder=" " required>
                <label for="email" class="form-label">Email</label>
            </div>
            <div class="form-group">
                <input type="text" id="no_telpon" name="no_telpon" class="form-input" placeholder=" ">
                <label for="no_telpon" class="form-label">No Telpon</label>
            </div>
            <div class="form-group">
                <input type="password" id="registerPassword" name="password" class="form-input" placeholder=" " required>
                <label for="registerPassword" class="form-label">Password</label>
                <button type="button" class="toggle-password"><i class="fas fa-eye"></i></button>
            </div>
            <div class="form-group">
                <input type="password" id="confirmPassword" name="pass_confirm" class="form-input" placeholder=" " required>
                <label for="confirmPassword" class="form-label">Konfirmasi Password</label>
                <button type="button" class="toggle-password"><i class="fas fa-eye"></i></button>
            </div>

            <div class="form-options">
                <div class="remember-me">
                    <input type="checkbox" id="agreeTerms" class="checkbox" required>
                    <label for="agreeTerms">Saya menyetujui syarat dan ketentuan</label>
                </div>
            </div>
            <button type="submit" class="submit-btn">Daftar</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    <?php if(session()->getFlashdata('flash_error')): ?>
        Swal.fire({
            icon: 'error',
            title: 'Terjadi Kesalahan',
            html: `<?= session()->getFlashdata('flash_error') ?>`,
            showConfirmButton: true
        });
    <?php endif; ?>

    <?php if(session()->getFlashdata('flash_success')): ?>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            html: `<?= session()->getFlashdata('flash_success') ?>`,
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false
        });
    <?php endif; ?>
});
</script>
<?= $this->endSection() ?>