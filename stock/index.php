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
require "../module/mode-barang.php";

$title = "Laporan | Arga Store";
require "../templates/header.php";
require "../templates/navbar.php";
require "../templates/sidebar.php";

$stockBrg = getdata("SELECT * FROM tbl_barang");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Stock Barang</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Stock</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-list fa-sm"></i> Stock </h3>
                    <a href="<?= $main_url ?>report/r-stock.php" class="mr-2 btn btn-sm btn-outline-primary float-right" target="_blank"><i class="fas fa-print fa-sm"></i> Cetak</a>
                </div>
            </div>
            <div class="card-body table-responsive p-3">
                <table class="table table-hover text-nowrap" id="tblData">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Satuan</th>
                            <th>Jumlah Stock</th>
                            <th>Stock Minimal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($stockBrg as $stock) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $stock['id_barang'] ?></td>
                                <td><?= $stock['nama_barang'] ?></td>
                                <td><?= $stock['satuan'] ?></td>
                                <td class="text-center"><?= $stock['stock'] ?></td>
                                <td class="text-center"><?= $stock['stock_minimal'] ?></td>
                                <td>
                                    <?php
                                        if($stock['stock'] <= $stock['stock_minimal']) {
                                            echo "<span class='text-danger'>Stock Kurang</span>";
                                        }else {
                                            echo "<span class='text-success'>Stock Cukup</span>";
                                        }
                                    ?>
                                </td>
                            </tr>
                        <?php
                        }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <?php require "../templates/footer.php"; ?>