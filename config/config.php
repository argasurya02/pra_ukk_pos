<?php

date_default_timezone_set("Asia/Jakarta");

$host = "localhost";
$user = "root";
$pass = "";
$db = "db_argapos";

$koneksi = mysqli_connect($host, $user, $pass, $db);

// if (mysqli_connect_errno()) {
//     echo "koneksi database gagal : " . mysqli_connect_error();
//     exit();
// } else {
//     echo "berhasil terkoneksi dengan database";
// }

$main_url = "http://localhost/arga_pos-main/";
?>