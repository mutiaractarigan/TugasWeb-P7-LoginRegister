# TugasWeb-P7-LoginRegister

Tugas Rutin 7 — Sistem Login/Register.

Sistem login/register sederhana dengan PHP Native, data user disimpan di file JSON (`data/users.json`).

## Cara menjalankan

```bash
php -S localhost:8000
```

Lalu buka http://localhost:8000 di browser.

## File

| File | Fungsi |
|------|--------|
| `functions.php` | Helper: session, baca/simpan JSON, `htmlspecialchars`, pesan flash |
| `register.php` | Form registrasi + validasi (nama, email, password), cek email duplikat, `password_hash()` |
| `login.php` | Login dengan `password_verify()` dan session |
| `dashboard.php` | Halaman yang diproteksi (redirect ke login jika belum login) |
| `logout.php` | Logout dengan `session_destroy()` |
| `data/users.json` | Tempat penyimpanan data user |
| `style.css` | Tampilan sederhana |
