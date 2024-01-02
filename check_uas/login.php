<?php

session_start();

include 'config/app.php';


// check apakah tombol login ditekan
if (isset($_POST['login'])) {
    // ambil input username dan password
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    // check username
    $result = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'");

    // jika ada usernya
    if (mysqli_num_rows($result) == 1) {
        // check passwordnya
        $hasil = mysqli_fetch_assoc($result);
        if (password_verify($password, $hasil['password'])) {
            // set session
            $_SESSION['login']      = true;
            $_SESSION['id_users']   = $hasil['id_users'];
            $_SESSION['username']   = $hasil['username'];
            $_SESSION['nama']       = $hasil['nama'];
            $_SESSION['email']      = $hasil['email'];
            $_SESSION['status']     = $hasil['status'];
            $_SESSION['role']       = $hasil['role'];

            // jika login benar arahkan ke index.php
            header("Location: index.php");
            exit;
        }
    }
    // jika tidak ada usernya/login salah
    $error = true;
}

?>







<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>LOGIN</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <style>
        body {
            background-image: url('assets/img/c2.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: auto;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .form-signin .mb-4 {
            width: 100%;
            max-width: 100px;
        }

        .form-signin h1 {
            font-size: 2rem;
            color: #333;
        }

        .form-floating {
            margin-bottom: 1rem;
        }

        .form-floating label {
            color: #333;
        }

        .form-floating input {
            background-color: transparent;
            border: 1px solid #333;
            color: #333;
            border-radius: 5px;
        }

        .form-floating input::placeholder {
            color: #555;
        }

        .form-signin button {
            background-color: #3498db;
            border: 1px solid #3498db;
            border-radius: 5px;
            color: #fff;
            transition: background-color 0.3s;
        }

        .form-signin button:hover {
            background-color: #2980b9;
        }

        .mt-5 {
            margin-top: 3rem !important;
        }

        .text-muted {
            color: #888;
        }
    </style>
</head>

<body class="text-center">

    <main class="form-signin">
        <form action="" method="POST">
            <img class="mb-4" src="assets/img/c3.png" alt="" width="80" height="80">
            <h1 class="h3 mb-3 fw-normal">LOGIN</h1>

            <?php if (isset($error)) : ?>
                <div class="alert alert-danger text-center">
                    <b>Username/Password SALAH!</b>
                </div>
            <?php endif; ?>

            <div class="form-floating">
                <input type="text" name="username" class="form-control" id="floatingInput" placeholder="Username..." required>
                <label for="floatingInput">Username</label>
            </div>
            <div class="form-floating">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password..." required>
                <label for="floatingPassword">Password</label>
            </div>

            <button class="w-100 btn btn-lg" type="submit" name="login">Login</button>
            <p class="mt-5 mb-3 text-muted">Copyright &copy; CT-KEL-8-A2 <?= date('Y') ?></p>
        </form>
    </main>

</body>

</html>