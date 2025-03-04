<?php

function update($data){
    global $koneksi;

    $curPass = trim(mysqli_real_escape_string($koneksi, $_POST['curPass']));
    $newPass = trim(mysqli_real_escape_string($koneksi, $_POST['newPass']));
    $confPass = trim(mysqli_real_escape_string($koneksi, $_POST['confPass']));
    
    $userActive = userLogin()['username'];

    if($newPass !== $confPass){
        echo "<script>
                    alert('Password Gagal diperbarui.. ');
                    document.location='?msg=err1';
                </script>";
            return false;
    }

    if(!password_verify($curPass, userLogin()['password'])){
        echo "<script>
                    alert('Password Gagal diperbarui.. ');
                    document.location='?msg=err2';
                </script>";
            return false;
    }else {
        $pass = password_hash($newPass, PASSWORD_DEFAULT);
        mysqli_query($koneksi, "UPDATE tbl_user SET password = '$pass' WHERE username = '$userActive'");
        return mysqli_affected_rows($koneksi);
    }
}
function updatePelanggan($data){
    global $koneksi;

    // Ambil input dari form
    $curPass = trim(mysqli_real_escape_string($koneksi, $data['curPass']));
    $newPass = trim(mysqli_real_escape_string($koneksi, $data['newPass']));
    $confPass = trim(mysqli_real_escape_string($koneksi, $data['confPass']));

    // Ambil email pelanggan yang sedang login
    $userActive = pelangganLogin()['email'];

    // Ambil password pelanggan dari database
    $result = mysqli_query($koneksi, "SELECT password FROM tbl_pelanggan WHERE email = '$userActive'");
    $row = mysqli_fetch_assoc($result);

    // Jika password lama tidak cocok (langsung dibandingkan tanpa hash)
    if ($curPass !== $row['password']) {
        echo "<script>
                    alert('Password Gagal diperbarui. Password lama salah.');
                    document.location='?msg=err2';
                </script>";
        return false;
    }

    // Jika password baru dan konfirmasi password tidak cocok
    if ($newPass !== $confPass) {
        echo "<script>
                    alert('Password Gagal diperbarui. Konfirmasi password tidak cocok.');
                    document.location='?msg=err1';
                </script>";
        return false;
    }

    // Simpan password baru TANPA HASH (hanya jika tetap ingin plain text)
    mysqli_query($koneksi, "UPDATE tbl_pelanggan SET password = '$newPass' WHERE email = '$userActive'");

    return mysqli_affected_rows($koneksi);
}


?>