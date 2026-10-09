<?php
require 'functions.php';

// Halaman ini hanya untuk user yang sudah login
if (!isLoggedIn()) {
    setFlash('error', 'Silakan login terlebih dahulu.');
    header('Location: login.php');
    exit;
}

$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="box">
        <h2>Dashboard</h2>

        <?php showFlash(); ?>

        <p>Halo, <strong><?= e($user['nama']) ?></strong>!</p>
        <p>Kamu login dengan email: <?= e($user['email']) ?></p>

        <a href="logout.php" class="btn-logout">Logout</a>
    </div>
</body>
</html>
