<!-- app/Views/partials/navbar_form.php -->
<nav class="navbar">
    <div class="nav-container">
        <div class="nav-brand">
            <div class="brand-logo">
                <img src="<?= base_url('assets/Auth/img/donggala.png') ?>" alt="Logo Disdukcapil">
            </div>
            <div class="brand-text">
                <h3>DISDUKCAPIL</h3>
                <span>Donggala</span>
            </div>
        </div>
        <div class="nav-actions">
            <a href="<?= base_url('/') ?>" class="btn-back">
                <i class="fas fa-arrow-left"></i> Kembali ke Beranda
            </a>
            <div class="profile-dropdown">
                <button class="profile-btn" id="profile-btn">
                    <img src="<?= base_url('assets/Frontend/img/boy.png') ?>" alt="Profile" class="profile-img">
                    <span class="profile-name">
                        <?php $user = session()->get('user'); echo $user ? esc($user['nama_lengkap']) : 'Tamu'; ?>
                    </span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dropdown-menu" id="dropdown-menu">
                    <a href="#profile" class="dropdown-item">
                        <i class="fas fa-user"></i> Profil Saya
                    </a>
                    <a href="#settings" class="dropdown-item">
                        <i class="fas fa-cog"></i> Pengaturan
                    </a>
                    <a href="#history" class="dropdown-item">
                        <i class="fas fa-history"></i> Riwayat
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="<?= base_url('logout') ?>" class="dropdown-item logout">
                        <i class="fas fa-sign-out-alt"></i> Keluar
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>
