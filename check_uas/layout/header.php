<?php

include 'config/app.php';

?>



<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />

    <!-- Bootstrap JS (Sertakan jQuery dan Popper.js) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

    <title>KANG BAKSO</title>
</head>

<body>

    <!-- NAVBAR -->

    <nav class="navbar navbar-expand-lg navbar-dark shadow fixed-top" style="background-color: #1F6E8C">
        <div class="container">
            <a class="navbar-brand" href="#">Checklist Toilet</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <!-- Pindahkan menu navigasi ke kiri -->
                <div class="navbar-nav">

                    <?php if ($_SESSION['role'] == 1 or $_SESSION['role'] == 2) : ?>
                        <a class="nav-link" href="index.php">Users <i class="bi bi-person-heart"></i></a>
                    <?php endif; ?>

                    <?php if ($_SESSION['role'] == 1 or $_SESSION['role'] == 2) : ?>
                        <a class="nav-link" href="check_toilet.php">Checklist Toilet <i class="fas fa-tasks"></i></a>
                    <?php endif; ?>

                    <?php if ($_SESSION['role'] == 1 or $_SESSION['role'] == 2) : ?>
                        <a class="nav-link" href="daftar_toilet.php">Daftar Toilet <i class="fas fa-toilet"></i></a>
                    <?php endif; ?>

                </div>

                <!-- Gabungkan "Hai" dan "Logout" ke dalam satu div ms-auto -->
                <div class="navbar-nav ms-auto">
                    <a class="navbar-brand" href="#">Hai, <?= $_SESSION['nama'] ?></a>
                    <a class="nav-link" href="logout.php" onclick="return confirm('Yakin Ingin Logout? ')">Logout <i class="bi bi-box-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </nav>