<?php


function insert($data)
{
    global $koneksi;

    $nama = mysqli_real_escape_string($koneksi, $data['nama']);
    $telepon = mysqli_real_escape_string($koneksi, $data['telepon']);
    $alamat = mysqli_real_escape_string($koneksi, $data['alamat']);
    $email = mysqli_real_escape_string($koneksi, $data['email']);
    $pass = mysqli_real_escape_string($koneksi, $data['password']);

    $cekemail = mysqli_query($koneksi, "SELECT email FROM tbl_pelanggan WHERE email = '$email' ");

    if (mysqli_num_rows($cekemail) > 0) {
        echo "<script>
                    alert('Email sudah terpakai');
                </script>";
        return false;
    }
    
    $sqlPelanggan = "INSERT INTO tbl_pelanggan (id_pelanggan, nama, alamat, telepon, email, password, created_at) 
                     VALUES (NULL, '$nama', '$alamat', '$telepon', '$email', '$pass', CURRENT_TIMESTAMP)";

    mysqli_query($koneksi, $sqlPelanggan);

    return mysqli_affected_rows($koneksi);}

    function delete($id)
    {
        global $koneksi;
    
        $sqlDelete = "DELETE FROM tbl_pelanggan WHERE id_pelanggan = $id";
    
        mysqli_query($koneksi, $sqlDelete);
    
        return mysqli_affected_rows($koneksi);
    }

function update($data)
{
    global $koneksi;

    $id = mysqli_real_escape_string($koneksi, $data['id']);
    $nama = mysqli_real_escape_string($koneksi, $data['nama']);
    $telepon = mysqli_real_escape_string($koneksi, $data['telepon']);
    $alamat = mysqli_real_escape_string($koneksi, $data['alamat']);
    $email = mysqli_real_escape_string($koneksi, $data['email']);

    $sqlPelanggan = "UPDATE tbl_pelanggan 
                     SET nama = '$nama', 
                         telepon = '$telepon', 
                         email = '$email', 
                         alamat = '$alamat' 
                     WHERE id_pelanggan = $id";

    mysqli_query($koneksi, $sqlPelanggan);

    return mysqli_affected_rows($koneksi);
}