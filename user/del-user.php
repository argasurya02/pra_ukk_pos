<?php
session_start();

require "../config/config.php";
// Cek apakah sudah login
if (!isset($_SESSION["ssLoginPOS"])) {
    header("Location: " . $main_url . "auth/login.php");
    exit();
}

// Cek apakah user memiliki peran admin
if ($_SESSION["ssRolePOS"] !== "admin") {
    header("Location: " . $main_url . "pelanggan/dashboard-pelanggan.php"); // Redirect pelanggan ke dashboard mereka
    exit();
}
require "../config/functions.php";
require "../module/mode-user.php";

$id = $_GET['id'];
$foto = $_GET['foto'];

if (delete($id, $foto)) {
    echo "<script>
                alert('User berhasil dihapus');
                document.location.href = 'data-user.php';
            </script>";
} else {
    echo "<script>
                alert('User gagal dihapus');
                document.location.href = 'data-user.php';
            </script>";
}
