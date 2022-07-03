<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?= base_url('bootstrap/css/bootstrap.min.css') ?>">
  <title>Document</title>
</head>
<body>
  <?= $this->include('partials/header') ?>
  <?= $this->renderSection('content') ?>
  <?= $this->include('partials/footer') ?>
  <script src="<?= base_url('bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <script src="<?= base_url('js/main.js') ?>"></script>
</body>
</html>