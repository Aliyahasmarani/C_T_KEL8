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
$id_users = (int)$_GET['id_users'];

if (delete_users($id_users) > 0) {
    echo "<script>
        alert('Data Users Berhasil DIhapus');
        document.location.href = 'index.php';
        </script>";
} else {
    echo "<script>
        alert('Data Users Gagal DIhapus');
        document.location.href = 'index.php';
        </script>";
}
