<?= $this->extend('layouts/landing/main') ?>
<?= $this->section('content') ?>


<!-- Hero Section -->
<section class="hero" id="home">
    <div class="hero-background">
        <div class="hero-overlay"></div>
    </div>
    <div class="hero-content">
        <div class="hero-text">
            <h1 class="hero-title">
                <span class="title-main">Selamat Datang di</span>
                <span class="title-highlight">DISDUKCAPIL DONGGALA</span>
            </h1>
            <p class="hero-subtitle">
                Layanan Digital Kependudukan dan Pencatatan Sipil yang Modern, Cepat, dan Terpercaya
            </p>
            <div class="hero-buttons">
                <button class="btn btn-primary" onclick="scrollToSection('services')">
                    <i class="fas fa-rocket"></i> Mulai Layanan
                </button>
                <button class="btn btn-outline" onclick="scrollToSection('about')">
                    <i class="fas fa-info-circle"></i> Pelajari Lebih Lanjut
                </button>
            </div>
        </div>
        <div class="hero-image">
            <div class="floating-card">
                <i class="fas fa-id-card"></i>
                <span>KTP Digital</span>
            </div>
            <div class="floating-card">
                <i class="fas fa-certificate"></i>
                <span>Akta Kelahiran</span>
            </div>
            <div class="floating-card">
                <i class="fas fa-ring"></i>
                <span>Akta Nikah</span>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="services" id="services">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Layanan Unggulan</h2>
            <p class="section-subtitle">Berbagai layanan digital untuk memudahkan urusan kependudukan Anda</p>
        </div>
        
        <div class="services-grid">
            <div class="service-card" data-service="ktp">
                <div class="service-icon">
                    <i class="fas fa-id-card"></i>
                </div>
                <h3 class="service-title">KTP Elektronik</h3>
                <p class="service-description">Pembuatan dan perpanjangan KTP elektronik dengan proses yang cepat dan mudah</p>
                <div class="service-features">
                    <span class="feature-tag">Online</span>
                    <span class="feature-tag">Cepat</span>
                </div>
                <button class="service-btn" onclick="window.location.href='<?= site_url('form/ktp') ?>'">
                    <i class="fas fa-arrow-right"></i> Ajukan Sekarang
                </button>
            </div>

            <div class="service-card" data-service="kk">
                <div class="service-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h3 class="service-title">Kartu Keluarga</h3>
                <p class="service-description">Penerbitan dan perubahan data Kartu Keluarga secara digital</p>
                <div class="service-features">
                    <span class="feature-tag">Digital</span>
                    <span class="feature-tag">Akurat</span>
                </div>
                <button class="service-btn" onclick="window.location.href='<?= site_url('form/kartukeluarga') ?>'">
                    <i class="fas fa-arrow-right"></i> Ajukan Sekarang
                </button>
            </div>


            <div class="service-card" data-service="akta-lahir">
                <div class="service-icon">
                    <i class="fas fa-baby"></i>
                </div>
                <h3 class="service-title">Akta Kelahiran</h3>
                <p class="service-description">Pembuatan akta kelahiran untuk bayi baru lahir dan duplikat akta</p>
                <div class="service-features">
                    <span class="feature-tag">Gratis</span>
                    <span class="feature-tag">Legal</span>
                </div>
                <button class="service-btn" onclick="window.location.href='<?= site_url('form/aktekelahiran') ?>'">
                    <i class="fas fa-arrow-right"></i> Ajukan Sekarang
                </button>
            </div>


            <div class="service-card" data-service="akta-nikah">
                <div class="service-icon">
                    <i class="fas fa-ring"></i>
                </div>
                <h3 class="service-title">Akta Pernikahan</h3>
                <p class="service-description">Penerbitan akta pernikahan dan duplikat untuk pasangan yang telah menikah</p>
                <div class="service-features">
                    <span class="feature-tag">Resmi</span>
                    <span class="feature-tag">Sah</span>
                </div>
                <<button class="service-btn" onclick="window.location.href='<?= site_url('form/akteperkawinan') ?>'">
                    <i class="fas fa-arrow-right"></i> Ajukan Sekarang
                </button>
            </div>

            <div class="service-card" data-service="akta-nikah">
                <div class="service-icon">
                    <i class="fas fa-ring"></i>
                </div>
                <h3 class="service-title">Akta Perceraian</h3>
                <p class="service-description">Penerbitan akta Perceraian dan duplikat untuk pasangan yang telah berpisah</p>
                <div class="service-features">
                    <span class="feature-tag">Resmi</span>
                    <span class="feature-tag">Sah</span>
                </div>
                <<button class="service-btn" onclick="window.location.href='<?= site_url('form/akteperceraian') ?>'">
                    <i class="fas fa-arrow-right"></i> Ajukan Sekarang
                </button>
            </div>


            <div class="service-card" data-service="akta-mati">
                <div class="service-icon">
                    <i class="fas fa-cross"></i>
                </div>
                <h3 class="service-title">Akta Kematian</h3>
                <p class="service-description">Penerbitan akta kematian untuk keperluan administrasi keluarga</p>
                <div class="service-features">
                    <span class="feature-tag">Mudah</span>
                    <span class="feature-tag">Cepat</span>
                </div>
                <<button class="service-btn" onclick="window.location.href='<?= site_url('form/aktekematian') ?>'">
                    <i class="fas fa-arrow-right"></i> Ajukan Sekarang
                </button>
            </div>


            <div class="service-card" data-service="pindah">
                <div class="service-icon">
                    <i class="fas fa-truck-moving"></i>
                </div>
                <h3 class="service-title">Surat Pindah</h3>
                <p class="service-description">Pengurusan surat pindah untuk perpindahan domisili antar daerah</p>
                <div class="service-features">
                    <span class="feature-tag">Online</span>
                    <span class="feature-tag">Praktis</span>
                </div>
                <<button class="service-btn" onclick="window.location.href='<?= site_url('form/keteranganpindah') ?>'">
                    <i class="fas fa-arrow-right"></i> Ajukan Sekarang
                </button>
            </div>

            <div class="service-card" data-service="pindah">s
                <div class="service-icon">
                    <i class="fas fa-id-card"></i>
                </div>
                <h3 class="service-title">KIA</h3>
                <p class="service-description">Pengurusan Kartu Indonesia Anak</p>
                <div class="service-features">
                    <span class="feature-tag">Online</span>
                    <span class="feature-tag">Praktis</span>
                </div>
                <<button class="service-btn" onclick="window.location.href='<?= site_url('form/kia') ?>'">
                    <i class="fas fa-arrow-right"></i> Ajukan Sekarang
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Digital Documents Section -->
<section class="digital-docs" id="documents">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Dokumen Digital</h2>
            <p class="section-subtitle">Akses dan kelola dokumen kependudukan Anda secara digital</p>
        </div>
        
        <div class="docs-content">
            <div class="docs-features">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-cloud-download-alt"></i>
                    </div>
                    <div class="feature-text">
                        <h4>Download Dokumen</h4>
                        <p>Unduh dokumen resmi dalam format PDF yang telah terverifikasi</p>
                    </div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-qrcode"></i>
                    </div>
                    <div class="feature-text">
                        <h4>QR Code Verification</h4>
                        <p>Setiap dokumen dilengkapi QR code untuk verifikasi keaslian</p>
                    </div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="feature-text">
                        <h4>Keamanan Terjamin</h4>
                        <p>Dokumen digital dengan enkripsi tingkat tinggi dan aman</p>
                    </div>
                </div>
            </div>
            
            <div class="docs-preview">
                <div class="document-mockup">
                    <div class="doc-header">
                        <div class="doc-logo"></div>
                        <div class="doc-title">KARTU TANDA PENDUDUK</div>
                    </div>
                    <div class="doc-content">
                        <div class="doc-photo"></div>
                        <div class="doc-info">
                            <div class="info-line"></div>
                            <div class="info-line short"></div>
                            <div class="info-line"></div>
                            <div class="info-line medium"></div>
                        </div>
                    </div>
                    <div class="doc-qr"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="stats">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-number" data-target="15000">0</div>
                <div class="stat-label">Dokumen Terbit</div>
            </div>
            <div class="stat-item">
                <div class="stat-number" data-target="98">0</div>
                <div class="stat-label">Tingkat Kepuasan (%)</div>
            </div>
            <div class="stat-item">
                <div class="stat-number" data-target="24">0</div>
                <div class="stat-label">Jam Layanan</div>
            </div>
            <div class="stat-item">
                <div class="stat-number" data-target="5">0</div>
                <div class="stat-label">Menit Rata-rata</div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
