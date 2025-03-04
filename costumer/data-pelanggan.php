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

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
} else {
    $msg = '';
}

$alert = '';
if ($msg == 'deleted') {
    $alert = '<div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-check"></i> Alert!</h5>
                  Pelanggan berhasil dihapus
                </div>';
}
if ($msg == 'updated') {
    $alert = '<div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-check-circle"></i> Alert!</h5>
                  Pelanggan berhasil diperbarui
                </div>';
}
if ($msg == 'abortied') {
    $alert = '<div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                  Pelanggan gagal dihapus
                </div>';
}
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
                        <li class="breadcrumb-item active">Data Pelanggan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section>
        <div class="container-fluid">
            <div class="card">
                <?php if ($alert != '') {
                    echo $alert;
                } ?>
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-list fa-sm"></i> Data Pelanggan</h3>
                    <a href="<?= $main_url ?>costumer/add-pelanggan.php" class="btn btn-primary btn-sm float-right"><i class="fas fa-plus fa-sm"></i> Add Pelanggan</a>
                </div>
                <div class="card-bosy table-responsive p-3">
                    <table class="table table-hover text-nowrap" id="tblData">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Telpon</th>
                                <th>Email</th>
                                <th style="width: 10%;">Operasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $pelanggan = getdata("SELECT * FROM tbl_pelanggan");
                            foreach ($pelanggan as $plg) :
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $plg["nama"]; ?></td>
                                    <td><?= $plg["alamat"]; ?></td>
                                    <td><?= $plg["telepon"]; ?></td>
                                    <td><?= $plg["email"]; ?></td>
                                    <td>
                                        <a href="edit-pelanggan.php?id=<?= $plg["id_pelanggan"] ?>" class="btn btn-warning btn-sm" title="Edit Pelanggan"><i class="fas fa-pen"></i></a>
                                        <a href="del-pelanggan.php?id=<?= $plg["id_pelanggan"] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus pelanggan ini?')" class=" btn btn-danger btn-sm" title="Hapus supplier"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>


    <?php
    require "../templates/footer.php";
    ?>