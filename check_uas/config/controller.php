<?php

// fungsi menampilkan data menu
function select($query)
{
    // panggil koneksi
    global $db;

    $result = mysqli_query($db, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

// fungsi tambah users
function create_users($post)
{
    global $db;

    $username   = $post['username'];
    $password   = $post['password'];
    $nama       = $post['nama'];
    $email      = $post['email'];
    $status     = $post['status'];
    $role       = $post['role'];

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // query tambah data
    $query = "INSERT INTO users VALUES(null, '$username', '$password','$nama', '$email', '$status', '$role')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// fungsi ubah users
function update_users($post)
{
    global $db;

    $id_users   = $post['id_users'];
    $username   = $post['username'];
    $password   = $post['password'];
    $nama       = $post['nama'];
    $email      = $post['email'];
    $status     = $post['status'];
    $role       = $post['role'];

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // query Ubah data
    $query = "UPDATE users SET username = '$username', password = '$password', nama = '$nama', email = '$email', status = '$status', role = '$role' WHERE id_users = $id_users ";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// fungsi menghapus data users
function delete_users($id_users)
{
    global $db;

    // query hapus data profile
    $query = "DELETE FROM users WHERE id_users = $id_users";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}


// fungsi tambah toilet
function create_toilet($post)
{
    global $db;

    $lokasi   = $post['lokasi'];
    $keterangan   = $post['keterangan'];

    // query tambah data
    $query = "INSERT INTO toilet VALUES(null, '$lokasi', '$keterangan')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// fungsi ubah toilet
function update_toilet($post)
{
    global $db;

    $id_toilet   = $post['id_toilet'];
    $lokasi      = $post['lokasi'];
    $keterangan  = $post['keterangan'];


    // query Ubah data toilet
    $query = "UPDATE toilet SET lokasi = '$lokasi', keterangan = '$keterangan' WHERE id_toilet = $id_toilet ";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// fungsi menghapus data toilet
function delete_toilet($id_toilet)
{
    global $db;

    // query hapus data profile
    $query = "DELETE FROM toilet WHERE id_toilet = $id_toilet";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// fungsi menambahkan data checklist toilet
function create_checklist($post)
{
    global $db;

    $toilet_id      = $post['toilet_id'];
    $kloset         = $post['kloset'];
    $wastafel       = $post['wastafel'];
    $lantai         = $post['lantai'];
    $dinding        = $post['dinding'];
    $kaca           = $post['kaca'];
    $bau            = $post['bau'];
    $sabun          = $post['sabun'];
    $users_id       = $post['users_id'];

    // query tambah data
    $query = "INSERT INTO checklist VALUES(null, CURRENT_TIMESTAMP(), '$toilet_id', '$kloset', '$wastafel', '$lantai', '$dinding', '$kaca', '$bau', '$sabun', '$users_id')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// fungsi mengubah data checklist toilet
function update_checklist($post)
{
    global $db;

    $id_checklist  = $post['id_checklist'];

    $toilet_id      = $post['toilet_id'];
    $kloset         = $post['kloset'];
    $wastafel       = $post['wastafel'];
    $lantai         = $post['lantai'];
    $dinding        = $post['dinding'];
    $kaca           = $post['kaca'];
    $bau            = $post['bau'];
    $sabun          = $post['sabun'];
    $users_id       = $post['users_id'];

    // query ubah data
    $query = "UPDATE checklist SET toilet_id = '$toilet_id', kloset = '$kloset', wastafel = '$wastafel', lantai = '$lantai', dinding = '$dinding', kaca = '$kaca', bau = '$bau', sabun = '$sabun', users_id = '$users_id' WHERE id_checklist = $id_checklist";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// fungsi menghapus data checklist toilet
function delete_checklist($id_checklist)
{
    global $db;

    // query hapus data checklist
    $query = "DELETE FROM checklist WHERE id_checklist = $id_checklist";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}
