<!-- app/Views/partials/navbar.php -->
<nav class="navbar" id="navbar">
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
        
        <div class="nav-menu" id="nav-menu">
            <a href="#home" class="nav-link active">Beranda</a>
            <a href="#services" class="nav-link">Layanan</a>
            <a href="#documents" class="nav-link">Dokumen Digital</a>
            <a href="#about" class="nav-link">Tentang</a>
            <a href="#contact" class="nav-link">Kontak</a>
        </div>
        
        <div class="nav-actions">
            <div class="profile-dropdown">
                <button class="profile-btn" id="profile-btn">
                    <img src="<?= base_url('assets/Frontend/img/boy.png') ?>" alt="Profile" class="profile-img">
                    <?php $user = session()->get('user'); ?>
                    <span class="profile-name"><?= $user ? esc($user['nama_lengkap']) : 'Tamu'; ?></span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dropdown-menu" id="dropdown-menu">
                    <a href="#profile" class="dropdown-item">
                        <i class="fas fa-user"></i> Profil Saya
                    </a>
                    <a href="#settings" class="dropdown-item">
                        <i class="fas fa-cog"></i> Pengaturan
                    </a>
                    <a href="<?= base_url('form/riwayat') ?>" class="dropdown-item">
                        <i class="fas fa-history"></i> Riwayat KTP
                    </a>
                    <a href="<?= base_url('form/aktekelahiran/riwayat') ?>" class="dropdown-item">
                        <i class="fas fa-history"></i> Riwayat Akte Kelahiran
                    </a>

                    <a href="<?= base_url('form/aktekematian/riwayat') ?>" class="dropdown-item">
                        <i class="fas fa-history"></i> Riwayat Akte Kematian
                    </a>

                    <a href="<?= base_url('form/aktekelahiran/riwayat') ?>" class="dropdown-item">
                        <i class="fas fa-history"></i> Riwayat Akte Kelahiran
                    </a>
                    
                    <a href="<?= base_url('form/akteperkawinan/riwayat') ?>" class="dropdown-item">
                        <i class="fas fa-history"></i> Riwayat Akte Perkawinan
                    </a>

                    <a href="<?= base_url('form/akteperceraian/riwayat') ?>" class="dropdown-item">
                        <i class="fas fa-history"></i> Riwayat Akte Perceraian
                    </a>
                
                    <a href="<?= base_url('form/keteranganpindah/riwayat') ?>" class="dropdown-item">
                        <i class="fas fa-history"></i> Riwayat Ketarangan Pindah
                    </a>


                    <div class="dropdown-divider"></div>
                    <a href="<?= base_url('logout') ?>" class="dropdown-item logout">
                        <i class="fas fa-sign-out-alt"></i> Keluar
                    </a>

                    

                    <a href="<?= base_url('/') ?>" class="dropdown-item logout">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>

                </div>
            </div>
            <button class="mobile-menu-btn" id="mobile-menu-btn">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>
</nav>
