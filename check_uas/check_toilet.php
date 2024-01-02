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
// if ($_SESSION["role"] == 1) {
//     echo "<script>
//     alert('Perhatian anda tidak punya hak akses')
//     document.location.href = 'login.php';
//     </script>";
//     exit;
// }

$title = 'Daftar Menu';

include 'layout/header.php';

$data_checklist = select("SELECT * FROM checklist");

// Ambil data checklist dengan informasi toilet dan petugas
$data_checklist = select("SELECT checklist.*, toilet.lokasi AS nama_toilet, users.nama AS nama_petugas FROM checklist
                         INNER JOIN toilet ON checklist.toilet_id = toilet.id_toilet
                         INNER JOIN users ON checklist.users_id = users.id_users
                         ORDER BY checklist.id_checklist DESC");

// Ambil data toilet dan users
$data_toilet = select("SELECT * FROM toilet");
$data_users = select("SELECT * FROM users");

// jika tombol tambah di tekan jalankan script berikut
if (isset($_POST['tambah'])) {
    if (create_checklist($_POST) > 0) {
        echo "<script>
        alert('Data checklist Berhasil Ditambahkan');
        document.location.href = 'check_toilet.php';
        </script>";
    } else {
        echo "<script>
        alert('Data checklist Gagal Ditambahkan');
        document.location.href = 'check_toilet.php';
        </script>";
    }
}

// jika tombol ubah di tekan jalankan script berikut
if (isset($_POST['ubah'])) {
    if (update_checklist($_POST) > 0) {
        echo "<script>
        alert('Data checklist Berhasil DiUbah');
        document.location.href = 'check_toilet.php';
        </script>";
    } else {
        echo "<script>
        alert('Data checklist Gagal DiUbah');
        document.location.href = 'check_toilet.php';
        </script>";
    }
}

?>



<div class="container" style="margin-top: 5rem;">
    <h2>DATA CHECKLIST</h2>
    <hr>



    <button type="button" class="btn  btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#modalTambah"> <i class="fas fa-plus-circle"></i> Tambah</button>


    <table class="table table-bordered table-striped" id="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Kode Toilet</th>
                <th>Kloset</th>
                <th>Westafel</th>
                <th>Lantai</th>
                <th>Dinding</th>
                <th>Kaca</th>
                <th>Bau</th>
                <th>Sabun</th>
                <th>Petugas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($data_checklist as $checklist) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= date('d/m/Y', strtotime($checklist['tanggal'])); ?></td>
                    <td><?= $checklist['nama_toilet'] ?></td>
                    <td><?= $checklist['kloset'] ?></td>
                    <td><?= $checklist['wastafel'] ?>
                    <td><?= $checklist['lantai'] ?></td>
                    <td><?= $checklist['dinding'] ?></td>
                    <td><?= $checklist['kaca'] ?></td>
                    <td><?= $checklist['bau'] ?></td>
                    <td><?= $checklist['sabun'] ?></td>
                    <td><?= $checklist['nama_petugas'] ?></td>
                    <td width="15%" class="text-center">
                        <button type="button" class="btn btn-success mb-1" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $checklist['id_checklist']; ?>">Ubah</button>
                        <button type="button" class="btn btn-danger mb-1" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $checklist['id_checklist']; ?>">Hapus</button>

                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Checklist</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">

                    <div class="col-mb-3">
                        <label for="toilet_id" class="form-label">Kode Toilet</label>
                        <input type="text" name="toilet_id" value="<?= $data_toilet[0]['id_toilet']; ?>" required>
                    </div>

                    <!-- Formulir tersembunyi untuk users_id -->
                    <div class="col-sm-6">
                        <label for="users_id" class="form-label">Petugas</label>
                        <input type="text" name="users_id" value="<?= $_SESSION['id_users']; ?>" required readonly>
                        <!-- Tambahkan atribut readonly agar input tidak dapat diedit oleh pengguna -->
                    </div>




                    <div class="col-mb-3">
                        <label for="kloset" class="form-label">Kloset</label>
                        <select class="form-select" id="kloset" name="kloset" required>
                            <option value="" selected disabled>Pilih Kategori</option>
                            <option value="1">Bersih</option>
                            <option value="2">Kotor</option>
                            <option value="3">Rusak</option>
                            <!-- Tambahkan opsi kategori lainnya sesuai kebutuhan -->
                        </select>
                    </div>

                    <div class="col-mb-3">
                        <label for="wastafel" class="form-label">Wastafel</label>
                        <select class="form-select" id="wastafel" name="wastafel" required>
                            <option value="" selected disabled>Pilih Kategori</option>
                            <option value="1">Bersih</option>
                            <option value="2">Kotor</option>
                            <option value="3">Rusak</option>
                            <!-- Tambahkan opsi kategori lainnya sesuai kebutuhan -->
                        </select>
                    </div>

                    <div class="col-mb-3">
                        <label for="lantai" class="form-label">Lantai</label>
                        <select class="form-select" id="lantai" name="lantai" required>
                            <option value="" selected disabled>Pilih Kategori</option>
                            <option value="1">Bersih</option>
                            <option value="2">Kotor</option>
                            <option value="3">Rusak</option>
                            <!-- Tambahkan opsi kategori lainnya sesuai kebutuhan -->
                        </select>
                    </div>

                    <div class="col-mb-3">
                        <label for="dinding" class="form-label">Dinding</label>
                        <select class="form-select" id="dinding" name="dinding" required>
                            <option value="" selected disabled>Pilih Kategori</option>
                            <option value="1">Bersih</option>
                            <option value="2">Kotor</option>
                            <option value="3">Rusak</option>
                            <!-- Tambahkan opsi kategori lainnya sesuai kebutuhan -->
                        </select>
                    </div>

                    <div class="col-mb-3">
                        <label for="kaca" class="form-label">Kaca</label>
                        <select class="form-select" id="kaca" name="kaca" required>
                            <option value="" selected disabled>Pilih Kategori</option>
                            <option value="1">Bersih</option>
                            <option value="2">Kotor</option>
                            <option value="3">Rusak</option>
                            <!-- Tambahkan opsi kategori lainnya sesuai kebutuhan -->
                        </select>
                    </div>

                    <div class="col-mb-3">
                        <label for="bau" class="form-label">Bau</label>
                        <select class="form-select" id="bau" name="bau" required>
                            <option value="" selected disabled>Pilih Kategori</option>
                            <option value="1">Ya</option>
                            <option value="2">Tidak</option>
                            <!-- Tambahkan opsi kategori lainnya sesuai kebutuhan -->
                        </select>
                    </div>

                    <div class="col-mb-3">
                        <label for="sabun" class="form-label">Sabun</label>
                        <select class="form-select" id="sabun" name="sabun" required>
                            <option value="" selected disabled>Pilih Kategori</option>
                            <option value="1">Ada</option>
                            <option value="2">Habis</option>
                            <option value="3">Hilang</option>
                            <!-- Tambahkan opsi kategori lainnya sesuai kebutuhan -->
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
<?php foreach ($data_checklist as $checklist) : ?>
    <div class="modal fade" id="modalUbah<?= $checklist['id_checklist']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah checklist</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" class="row g-3">
                        <input type="hidden" name="id_checklist" value="<?= $checklist['id_checklist']; ?>">

                        <div class="col-sm-6">
                            <label for="toilet_id" class="form-label">Kode Toilet</label>
                            <input type="text" name="toilet_id" value=" <?= $checklist['toilet_id']; ?>" required>
                            <!-- <input type="text" class="form-control" value="<?= $data_toilet[0]['lokasi']; ?>" readonly> -->
                        </div>

                        <!-- Formulir tersembunyi untuk users_id -->
                        <div class="col-sm-6">
                            <label for="users_id" class="form-label">Petugas</label>
                            <input type="text" name="users_id" value="<?= $_SESSION['id_users']; ?>" required readonly>
                            <!-- Tambahkan atribut readonly agar input tidak dapat diedit oleh pengguna -->
                        </div>



                        <div class="col-sm-6">
                            <label for="kloset" class="form-label">Kloset</label>
                            <select class="form-select" id="kloset" name="kloset" required>
                                <option value="" disabled>Pilih Kategori</option>
                                <option value="1" <?= ($checklist['kloset'] == '1') ? 'selected' : ''; ?>>Bersih</option>
                                <option value="2" <?= ($checklist['kloset'] == '2') ? 'selected' : ''; ?>>Kotor</option>
                                <option value="3" <?= ($checklist['kloset'] == '3') ? 'selected' : ''; ?>>Rusak</option>
                                <!-- Tambahkan opsi kategori lainnya sesuai kebutuhan -->
                            </select>
                        </div>

                        <div class="col-sm-6">
                            <label for="wastafel" class="form-label">Wastafel</label>
                            <select class="form-select" id="wastafel" name="wastafel" required>
                                <option value="" disabled>Pilih Kategori</option>
                                <option value="1" <?= ($checklist['wastafel'] == '1') ? 'selected' : ''; ?>>Bersih</option>
                                <option value="2" <?= ($checklist['wastafel'] == '2') ? 'selected' : ''; ?>>Kotor</option>
                                <option value="3" <?= ($checklist['wastafel'] == '3') ? 'selected' : ''; ?>>Rusak</option>
                                <!-- Tambahkan opsi kategori lainnya sesuai kebutuhan -->
                            </select>
                        </div>

                        <div class="col-sm-6">
                            <label for="lantai" class="form-label">Lantai</label>
                            <select class="form-select" id="lantai" name="lantai" required>
                                <option value="" disabled>Pilih Kategori</option>
                                <option value="1" <?= ($checklist['lantai'] == '1') ? 'selected' : ''; ?>>Bersih</option>
                                <option value="2" <?= ($checklist['lantai'] == '2') ? 'selected' : ''; ?>>Kotor</option>
                                <option value="3" <?= ($checklist['lantai'] == '3') ? 'selected' : ''; ?>>Rusak</option>
                                <!-- Tambahkan opsi kategori lainnya sesuai kebutuhan -->
                            </select>
                        </div>

                        <div class="col-sm-6">
                            <label for="dinding" class="form-label">Dinding</label>
                            <select class="form-select" id="dinding" name="dinding" required>
                                <option value="" disabled>Pilih Kategori</option>
                                <option value="1" <?= ($checklist['dinding'] == '1') ? 'selected' : ''; ?>>Bersih</option>
                                <option value="2" <?= ($checklist['dinding'] == '2') ? 'selected' : ''; ?>>Kotor</option>
                                <option value="3" <?= ($checklist['dinding'] == '3') ? 'selected' : ''; ?>>Rusak</option>
                                <!-- Tambahkan opsi kategori lainnya sesuai kebutuhan -->
                            </select>
                        </div>

                        <div class="col-sm-6">
                            <label for="kaca" class="form-label">Kaca</label>
                            <select class="form-select" id="kaca" name="kaca" required>
                                <option value="" disabled>Pilih Kategori</option>
                                <option value="1" <?= ($checklist['kaca'] == '1') ? 'selected' : ''; ?>>Bersih</option>
                                <option value="2" <?= ($checklist['kaca'] == '2') ? 'selected' : ''; ?>>Kotor</option>
                                <option value="3" <?= ($checklist['kaca'] == '3') ? 'selected' : ''; ?>>Rusak</option>
                                <!-- Tambahkan opsi kategori lainnya sesuai kebutuhan -->
                            </select>
                        </div>

                        <div class="col-sm-6">
                            <label for="bau" class="form-label">Bau</label>
                            <select class="form-select" id="bau" name="bau" required>
                                <option value="" disabled>Pilih Kategori</option>
                                <option value="1" <?= ($checklist['bau'] == '1') ? 'selected' : ''; ?>>Ya</option>
                                <option value="2" <?= ($checklist['bau'] == '2') ? 'selected' : ''; ?>>Tidak</option>
                                <!-- Tambahkan opsi kategori lainnya sesuai kebutuhan -->
                            </select>
                        </div>

                        <div class="col-sm-6">
                            <label for="sabun" class="form-label">Sabun</label>
                            <select class="form-select" id="sabun" name="sabun" required>
                                <option value="" disabled>Pilih Kategori</option>
                                <option value="1" <?= ($checklist['sabun'] == '1') ? 'selected' : ''; ?>>Ada</option>
                                <option value="2" <?= ($checklist['sabun'] == '2') ? 'selected' : ''; ?>>Habis</option>
                                <option value="3" <?= ($checklist['sabun'] == '3') ? 'selected' : ''; ?>>Hilang</option>

                                <!-- Tambahkan opsi kategori lainnya sesuai kebutuhan -->
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                            <button type="submit" name="ubah" class="btn btn-primary">Ubah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
    <?php endforeach; ?>

    <!-- Modal Hapus -->
    <?php foreach ($data_checklist as $checklist) : ?>
        <div class="modal fade" id="modalHapus<?= $checklist['id_checklist']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus checklist</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Yakin Anda Ingin Menghapus Data Lokasi checklist Tersebut : <?= $checklist['lokasi']; ?></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        <a href="hapus_checklist.php?id_checklist=<?= $checklist['id_checklist']; ?>" class="btn btn-danger">Hapus</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <?php
    include 'layout/footer.php';
    ?>