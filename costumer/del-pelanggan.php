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
require "../module/mode-pelanggan.php";

$title = "Data Pelanggan | Arga Store";
require "../templates/header.php";
require "../templates/navbar.php";
require "../templates/sidebar.php";

$id = $_GET['id'];


if (delete($id)) {
    echo "<script>
                document.location.href = 'data-pelanggan.php?msg=deleted';
            </script>";
} else {
    echo "<script> 
                document.location.href = 'data-pelanggan.php?msg=aborted';
            </script>";
}