<?php
require 'functions.php';

if (isLoggedIn()) {
    header('Location: dashboard.php');
    exit;
}

$errors = [];
$nama = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $konfirmasi = $_POST['konfirmasi'] ?? '';

    // Validasi nama
    if ($nama === '') {
        $errors[] = 'Nama wajib diisi.';
    } elseif (strlen($nama) < 3) {
        $errors[] = 'Nama minimal 3 karakter.';
    }

    // Validasi email
    if ($email === '') {
        $errors[] = 'Email wajib diisi.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Format email tidak valid.';
    } elseif (findUserByEmail($email) !== null) {
        $errors[] = 'Email sudah terdaftar, silakan gunakan email lain.';
    }

    // Validasi password
    if ($password === '') {
        $errors[] = 'Password wajib diisi.';
    } elseif (strlen($password) < 6) {
        $errors[] = 'Password minimal 6 karakter.';
    } elseif ($password !== $konfirmasi) {
        $errors[] = 'Konfirmasi password tidak sama.';
    }

    if (empty($errors)) {
        $users = getUsers();
        $users[] = [
            'id' => uniqid(),
            'nama' => $nama,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s'),
        ];
        saveUsers($users);

        setFlash('sukses', 'Registrasi berhasil! Silakan login.');
        header('Location: login.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="box">
        <h2>Register</h2>

        <?php if (!empty($errors)): ?>
            <div class="alert error">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= e($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="post" action="register.php">
            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" value="<?= e($nama) ?>">

            <label for="email">Email</label>
            <input type="text" id="email" name="email" value="<?= e($email) ?>">

            <label for="password">Password</label>
            <input type="password" id="password" name="password">

            <label for="konfirmasi">Konfirmasi Password</label>
            <input type="password" id="konfirmasi" name="konfirmasi">

            <button type="submit">Daftar</button>
        </form>

        <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
    </div>
</body>
</html>
