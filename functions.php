<?php
// File helper yang dipakai semua halaman
session_start();

define('USERS_FILE', __DIR__ . '/data/users.json');

// Ambil semua user dari file JSON
function getUsers()
{
    if (!file_exists(USERS_FILE)) {
        return [];
    }
    $isi = file_get_contents(USERS_FILE);
    $users = json_decode($isi, true);
    return is_array($users) ? $users : [];
}

// Simpan semua user ke file JSON
function saveUsers($users)
{
    file_put_contents(USERS_FILE, json_encode($users, JSON_PRETTY_PRINT));
}

// Cari user berdasarkan email
function findUserByEmail($email)
{
    foreach (getUsers() as $user) {
        if (strtolower($user['email']) === strtolower($email)) {
            return $user;
        }
    }
    return null;
}

// Sanitasi output agar aman dari XSS
function e($teks)
{
    return htmlspecialchars($teks, ENT_QUOTES, 'UTF-8');
}

// Simpan pesan sementara (muncul sekali di halaman berikutnya)
function setFlash($tipe, $pesan)
{
    $_SESSION['flash'] = ['tipe' => $tipe, 'pesan' => $pesan];
}

function showFlash()
{
    if (isset($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        echo '<div class="alert ' . e($flash['tipe']) . '">' . e($flash['pesan']) . '</div>';
    }
}

function isLoggedIn()
{
    return isset($_SESSION['user']);
}
