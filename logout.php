<?php
require 'functions.php';

// Hapus semua data session
$_SESSION = [];
session_destroy();

// Mulai session baru hanya untuk menampilkan pesan logout
session_start();
setFlash('sukses', 'Kamu berhasil logout.');

header('Location: login.php');
exit;
