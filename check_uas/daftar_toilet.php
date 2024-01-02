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

$data_toilet = select("SELECT * FROM toilet");

// jika tombol tambah di tekan jalankan script berikut
if (isset($_POST['tambah'])) {
    if (create_toilet($_POST) > 0) {
        echo "<script>
        alert('Data Toilet Berhasil Ditambahkan');
        document.location.href = 'daftar_toilet.php';
        </script>";
    } else {
        echo "<script>
        alert('Data Toilet Gagal Ditambahkan');
        document.location.href = 'daftar_toilet.php';
        </script>";
    }
}

// jika tombol ubah di tekan jalankan script berikut
if (isset($_POST['ubah'])) {
    if (update_toilet($_POST) > 0) {
        echo "<script>
        alert('Data Toilet Berhasil DiUbah');
        document.location.href = 'daftar_toilet.php';
        </script>";
    } else {
        echo "<script>
        alert('Data Toilet Gagal DiUbah');
        document.location.href = 'daftar_toilet.php';
        </script>";
    }
}

?>



<div class="container" style="margin-top: 5rem;">
    <h2>DATA TOILET</h2>
    <hr>



    <button type="button" class="btn  btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#modalTambah"> <i class="fas fa-plus-circle"></i> Tambah</button>


    <table class="table table-bordered table-striped" id="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Lokasi</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($data_toilet as $toilet) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $toilet['lokasi']; ?></td>
                    <td><?= $toilet['keterangan']; ?></td>
                    <td width="15%" class="text-center">
                        <button type="button" class="btn btn-success mb-1" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $toilet['id_toilet']; ?>">Ubah</button>
                        <button type="button" class="btn btn-danger mb-1" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $toilet['id_toilet']; ?>">Hapus</button>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah toilet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">

                    <div class="mb-3">
                        <label for="lokasi">Lokasi</label>
                        <input type="text" name="lokasi" id="lokasi" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" name="keterangan" id="keterangan" class="form-control" required>
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
<?php foreach ($data_toilet as $toilet) : ?>
    <div class="modal fade" id="modalUbah<?= $toilet['id_toilet']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah toilet</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <input type="hidden" name="id_toilet" value="<?= $toilet['id_toilet']; ?>">

                        <div class="mb-3">
                            <label for="lokasi">Lokasi</label>
                            <input type="text" name="lokasi" id="lokasi" class="form-control" value="<?= $toilet['lokasi']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" name="keterangan" id="keterangan" class="form-control" value="<?= $toilet['keterangan']; ?>" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    <button type="submit" name="ubah" class="btn btn-primary">Ubah</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Hapus -->
<?php foreach ($data_toilet as $toilet) : ?>
    <div class="modal fade" id="modalHapus<?= $toilet['id_toilet']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus toilet</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Yakin Anda Ingin Menghapus Data Lokasi Toilet Tersebut : <?= $toilet['lokasi']; ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    <a href="hapus_toilet.php?id_toilet=<?= $toilet['id_toilet']; ?>" class="btn btn-danger">Hapus</a>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?php
include 'layout/footer.php';
?>