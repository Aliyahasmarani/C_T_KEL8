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

// membatasi halaman sesuai user login
// if ($_SESSION["role"] != 1 or $_SESSION["role"] != 2) {
//     echo "<script>
//     alert('Perhatian anda tidak punya hak akses')
//     document.location.href = 'login.php';
//     </script>";
//     exit;
// }

$title = 'Daftar Menu';

include 'layout/header.php';

// tampil seluruh data
$data_users = select("SELECT * FROM users");

// tampil data berdasarkan user login
$id_users = $_SESSION['id_users'];
$data_bylogin = select("SELECT * FROM users WHERE id_users = $id_users");

// jika tombol tambah di tekan jalankan script berikut
if (isset($_POST['tambah'])) {
    if (create_users($_POST) > 0) {
        echo "<script>
        alert('Data Users Berhasil Ditambahkan');
        document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
        alert('Data Users Gagal Ditambahkan');
        document.location.href = 'index.php';
        </script>";
    }
}

// jika tombol ubah di tekan jalankan script berikut
if (isset($_POST['ubah'])) {
    if (update_users($_POST) > 0) {
        echo "<script>
        alert('Data Users Berhasil DiUbah');
        document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
        alert('Data Users Gagal DiUbah');
        document.location.href = 'index.php';
        </script>";
    }
}


?>



<div class="container" style="margin-top: 5rem;">
    <h2>DATA USERS</h2>
    <hr>



    <button type="button" class="btn  btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#modalTambah"> <i class="fas fa-plus-circle"></i> Tambah User</button>


    <table class="table table-bordered table-striped" id="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Password</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Status</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <!-- tampil seluruh data -->
            <?php if ($_SESSION['role'] == 1) : ?>
                <?php foreach ($data_users as $users) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $users['username']; ?></td>
                        <td>Password Ter-enkripsi</td>
                        <td><?= $users['nama']; ?></td>
                        <td><?= $users['email']; ?></td>
                        <td><?= $users['status']; ?></td>
                        <td><?= $users['role']; ?></td>
                        <td width="15%" class="text-center">
                            <button type="button" class="btn btn-success mb-1" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $users['id_users']; ?>">Ubah</button>
                            <button type="button" class="btn btn-danger mb-1" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $users['id_users']; ?>">Hapus</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <!-- tampil data berdasarkan user login -->
                <?php foreach ($data_bylogin as $akun) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $akun['username']; ?></td>
                        <td>Password Ter-enkripsi</td>
                        <td><?= $akun['nama']; ?></td>
                        <td><?= $akun['email']; ?></td>
                        <td><?= $akun['status']; ?></td>
                        <td><?= $akun['role']; ?></td>
                        <td width="18%" class="text-center">
                            <button type="button" class="btn btn-success mb-1" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $akun['id_users']; ?>"> <i class="fas fa-edit"></i> Ubah</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php foreach ($data_bylogin as $akun) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $akun['username']; ?></td>
                        <td>Password Ter-enkripsi</td>
                        <td><?= $akun['nama']; ?></td>
                        <td><?= $akun['email']; ?></td>
                        <td><?= $akun['status']; ?></td>
                        <td><?= $akun['role']; ?></td>
                        <td width="18%" class="text-center">
                            <button type="button" class="btn btn-success mb-1" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $akun['id_users']; ?>"> <i class="fas fa-edit"></i> Ubah</button>
                        </td>
                    </tr>
                <?php endforeach; ?>

            <?php endif; ?>

        </tbody>
    </table>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Users</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">

                    <div class="mb-3">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required minlength="6">
                    </div>

                    <div class="mb-3">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="">-- Pilih status</option>
                            <option value="1">Aktif</option>
                            <option value="2">Non-Aktif</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="role">role</label>
                        <select name="role" id="role" class="form-control" required>
                            <option value="">-- Pilih Role</option>
                            <option value="1">Admin</option>
                            <option value="2">User</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Ubah -->
<?php foreach ($data_users as $users) : ?>
    <div class="modal fade" id="modalUbah<?= $users['id_users']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Users</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <input type="hidden" name="id_users" value="<?= $users['id_users']; ?>">

                        <div class="mb-3">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" value="<?= $users['username']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="password">Password <small>(Masukkan Password baru/lama)</small></label>
                            <input type="password" name="password" id="password" class="form-control" required minlength="6">
                        </div>

                        <div class="mb-3">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control" value="<?= $users['nama']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="<?= $users['email']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <?php $status = $users['status']; ?>
                                <option value="1" <?= $status == '1' ? 'selected' : null ?>>Aktif</option>
                                <option value="2" <?= $status == '2' ? 'selected' : null ?>>Non-Aktif</option>
                            </select>
                        </div>
                        <?php if ($_SESSION['role'] == 1) : ?>
                            <div class="mb-3">
                                <label for="role">role</label>
                                <select name="role" id="role" class="form-control" required>
                                    <?php $role = $users['role']; ?>
                                    <option value="1" <?= $role == '1' ? 'selected' : null ?>>Admin</option>
                                    <option value="2" <?= $role == '2' ? 'selected' : null ?>>User</option>
                                </select>
                            </div>
                        <?php else : ?>
                            <input type="hidden" name="role" value="<?= $akun['role']; ?>">
                        <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    <button type="submit" name="ubah" class="btn btn-success">Ubah</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Hapus -->
<?php foreach ($data_users as $users) : ?>
    <div class="modal fade" id="modalHapus<?= $users['id_users']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Users</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Yakin Anda Ingin Menghapus Data User : <?= $users['nama']; ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    <a href="hapus_users.php?id_users=<?= $users['id_users']; ?>" class="btn btn-danger">Hapus</a>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?php
include 'layout/footer.php';
?>