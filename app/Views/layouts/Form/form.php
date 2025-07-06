<!DOCTYPE html>
<html lang="id">
<head>
    <?= $this->include('partials/Form/head') ?>
</head>
<body>
    <?= $this->include('partials/Form/navbar') ?>

    <?= $this->renderSection('content') ?>

    <?= $this->include('partials/Form/footer') ?>
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
