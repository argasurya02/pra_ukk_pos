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

$title = "Edit Pelanggan | Arga Store";
require "../templates/header.php";
require "../templates/navbar.php";
require "../templates/sidebar.php";

// jalankan fungsi update data

if (isset($_POST['update'])) {
    if (update($_POST)) {
        echo '<script>
                    document.location.href = "data-pelanggan.php?msg=updated";
                </script>';
    }
}

$id = $_GET['id'];

$sqlEdit = "SELECT * FROM tbl_pelanggan WHERE id_pelanggan = '$id'";
$pelanggan = getdata($sqlEdit)[0];

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pelanggan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= $main_url ?>costumer/data-pelanggan.php">Pelanggan</a></li>
                        <li class="breadcrumb-item active">Edit Costuemr</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <form action="" method="post">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-plus fa-sm"></i> Edit Pelanggan</h3>
                        <button type="submit" name="update" class="btn btn-primary btn-sm float-right"><i class="fas fa-save"></i> update</button>
                        <button type="reset" class="btn btn-danger btn-sm float-right mr-1"><i class="fas fa-times"></i> Reset</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <input type="hidden" value="<?= $pelanggan['id_pelanggan'] ?>" name="id">
                            <div class="col-lg-8 mb-3">
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan nama costumer" autofocus value="<?= $pelanggan['nama'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="telepon">Telepon</label>
                                    <input type="text" name="telepon" class="form-control" id="telepon" placeholder="Masukkan no telepon costumer" value="<?= $pelanggan['telepon'] ?>" pattern="[0-9]{5,}" title="minimal 5 angka" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <textarea name="email" id="email" rows="1" class="form-control" placeholder="Masukkan email Pelanggan" required><?= $pelanggan['telepon'] ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="alamat" id="alamat" rows="3" class="form-control" placeholder="Masukkan alamat costumer" required><?= $pelanggan['alamat'] ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <?php require "../templates/footer.php" ?>