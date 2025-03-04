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
require "../module/mode-supplier.php";

$title = "Data Supplier | Arga Store";
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
                  Supplier berhasil dihapus
                </div>';
}
if ($msg == 'updated') {
    $alert = '<div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-check-circle"></i> Alert!</h5>
                  Supplier berhasil diperbarui
                </div>';
}
if ($msg == 'abortied') {
    $alert = '<div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                  Supplier gagal dihapus
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
                    <h1 class="m-0">Supplier</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Data Supplier</li>
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
                    <h3 class="card-title"><i class="fas fa-list fa-sm"></i> Data Supplier</h3>
                    <a href="<?= $main_url ?>supplier/add-supplier.php" class="btn btn-primary btn-sm float-right"><i class="fas fa-plus fa-sm"></i> Add Supplier</a>
                </div>
                <div class="card-bosy table-responsive p-3">
                    <table class="table table-hover text-nowrap" id="tblData">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Telepon</th>
                                <th>Alamat</th>
                                <th>Deskripsi</th>
                                <th style="width: 10%;">Operasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $suppliers = getdata("SELECT * FROM tbl_supplier");
                            foreach ($suppliers as $supplier) :
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $supplier["nama"]; ?></td>
                                    <td><?= $supplier["telepon"]; ?></td>
                                    <td><?= $supplier["alamat"]; ?></td>
                                    <td><?= $supplier["deskripsi"]; ?></td>
                                    <td>
                                        <a href="edit-supplier.php?id=<?= $supplier["id_supplier"] ?>" class="btn btn-warning btn-sm" title="Edit supplier"><i class="fas fa-pen"></i></a>
                                        <a href="del-supplier.php?id=<?= $supplier["id_supplier"] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus supplier ini?')" class=" btn btn-danger btn-sm" title="Hapus supplier"><i class="fas fa-trash"></i></a>
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