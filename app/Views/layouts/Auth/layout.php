<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Auth | Disdukcapil') ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/Auth/css/styles.css') ?>">
    <link rel="icon" type="image/png" href="<?= base_url('assets/Auth/img/donggala.png') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <?php if (isset($head)) echo $head; ?>
</head>
<body>
    <main class="container">
        <div class="auth-card">
            <div class="card-header">
                <div class="logo-container">
                    <div class="logo">
                        <img src="<?= base_url('assets/Auth/img/donggala.png') ?>" alt="Disdukcapil Logo">
                    </div>
                </div>
                <h1 class="title">DISDUKCAPIL</h1>
                <p class="subtitle">Dinas Kependudukan dan Pencatatan Sipil</p>
            </div>
            <div class="card-content">
                <?= $this->renderSection('content') ?>
            </div>
            <div class="card-footer">
                <p>© <span id="current-year"></span> Disdukcapil. All rights reserved.</p>
            </div>
        </div>
    </main>

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= base_url('assets/sweetGlobal/global.js') ?>"></script>
    <script src="<?= base_url('assets/Auth/js/script.js') ?>"></script>
    <script>
    <?php if (session()->getFlashdata('flash_success')): ?>
        showSuccessMessage("<?= esc(session('flash_success')) ?>");
    <?php endif; ?>
    <?php if (session()->getFlashdata('flash_error')): ?>
        showErrorMessage("<?= esc(session('flash_error')) ?>");
    <?php endif; ?>
    <?php if (session()->getFlashdata('flash_warning')): ?>
        showWarningMessage("<?= esc(session('flash_warning')) ?>");
    <?php endif; ?>
    <?php if (session()->getFlashdata('flash_info')): ?>
        showInfoMessage("<?= esc(session('flash_info')) ?>");
    <?php endif; ?>
    </script>

</body>
</html>
