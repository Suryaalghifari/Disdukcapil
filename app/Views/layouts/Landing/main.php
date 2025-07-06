<!DOCTYPE html>
<html lang="id">
<head>
    <?= $this->include('partials/Home/head') ?>
</head>
<body>
    <?= $this->include('partials/Home/navbar') ?>

    <?= $this->renderSection('content') ?>

    <?= $this->include('partials/Home/footer') ?>
</body>
</html>
