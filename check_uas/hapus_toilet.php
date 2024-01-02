<?php

session_start();

// membatasi halaman sebelum login
if (!isset($_SESSION['login'])) {
    echo "<script>
    alert('Diharapkan Login Terlebih Dahulu')
    document.location.href = 'login.php';
    </script>";
    exit;
}

include 'config/app.php';
// menerima id akun yang dipilih pengguna
$id_toilet = (int)$_GET['id_toilet'];

if (delete_toilet($id_toilet) > 0) {
    echo "<script>
        alert('Data toilet Berhasil DIhapus');
        document.location.href = 'daftar_toilet.php';
        </script>";
} else {
    echo "<script>
        alert('Data toilet Gagal DIhapus');
        document.location.href = 'daftar_toilet.php';
        </script>";
}
