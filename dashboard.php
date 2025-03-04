<?php
session_start();


require "config/config.php";
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

require "config/functions.php";

$title = "Dashboard | Arga Store";
require "templates/header.php";
require "templates/navbar.php";
require "templates/sidebar.php";

$users = getdata("SELECT * FROM tbl_user");
$userNum = count($users);

$suppliers = getdata("SELECT * FROM tbl_supplier");
$supplierNum = count($suppliers);

$costumer = getdata("SELECT * FROM tbl_pelanggan");
$costumerNum = count($costumer);

$barang = getdata("SELECT * FROM tbl_barang");
$barangNum = count($barang);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $userNum ?></h3>

                            <p>Users</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="<?= $main_url ?>user" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $supplierNum ?></h3>

                            <p>Supplier</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-android-bus"></i>
                        </div>
                        <a href="<?= $main_url ?>supplier" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= $costumerNum ?></h3>

                            <p>Costumer</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-stalker"></i>
                        </div>
                        <a href="<?= $main_url ?>costumer" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?= $barangNum ?></h3>

                            <p>Item Barang</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-android-cart"></i>
                        </div>
                        <a href="<?= $main_url ?>barang" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card card-outline card-danger">
                        <div class="card-header text-info">
                            <h5 class="card-title">Info Stock Barang</h5>
                            <a href="stock" class="float-right" title="laporan stock"><i class="fas fa-arrow-right"></i></a>
                        </div>
                        <table class="table">
                            <tbody>
                                <?php
                                $stockMin = getdata("SELECT * FROM tbl_barang WHERE stock <= stock_minimal");
                                foreach ($stockMin as $min) { ?>
                                    <tr>
                                        <td><?= $min['nama_barang'] ?></td>
                                        <td class="text-danger">Stock Kurang</td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card card-outline card-success">
                        <div class="card-header text-info">
                            <h5>Omzet Penjualan </h5>
                        </div>
                        <div class="card-body text-primary">
                            <h2><span class="h4">Rp <?= omzet() ?></span></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
    <?php
    require "templates/footer.php";
    ?>