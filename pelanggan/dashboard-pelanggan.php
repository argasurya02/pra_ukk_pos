<?php

session_start();


require "../config/config.php";
// Cek apakah sudah login
if (!isset($_SESSION["ssLoginPOS"])) {
    header("Location: " . $main_url . "auth/login.php");
    exit();
}

// Cek apakah user memiliki peran admin
if ($_SESSION["ssRolePOS"] !== "pelanggan") {
    header("Location: " . $main_url . "dashboard.php"); // Redirect pelanggan ke dashboard mereka
    exit();
}
require "../config/functions.php";

$title = "Dashboard | Arga Store";
require "../templates/header.php";
require "../templates/navbar.php";
require "../templates/sidebar-pelanggan.php";

// Ambil data pelanggan dari database
$id_pelanggan = $_SESSION["ssIdPelanggan"];
$queryPelanggan = mysqli_query($koneksi, "SELECT * FROM tbl_pelanggan WHERE id_pelanggan = '$id_pelanggan'");
$dataPelanggan = mysqli_fetch_assoc($queryPelanggan);

// Ambil riwayat transaksi pelanggan
$queryTransaksi = mysqli_query($koneksi, "SELECT * FROM tbl_jual_head WHERE id_pelanggan = '$id_pelanggan' ORDER BY tgl_jual DESC");

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard Pelanggan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= $main_url ?>pelanggan/dashboard-pelanggan.php">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard Pelanggan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-list fa-sm"></i> Data Penjualan </h3>
                </div>
            </div>
            <div class="card-body table-responsive p-3">
                <table class="table table-hover text-nowrap" id="tblData">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Penjualan</th>
                            <th>Tgl Penjualan</th>
                            <th>Nama Costumer</th>
                            <th>Total Penjualan</th>
                            <th>Pembayaran</th>
                            <th>Kembali</th>
                            <th style="width: 10%;" class="text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($queryTransaksi as $jual) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $jual['no_jual'] ?></td>
                                <td><?= in_date($jual['tgl_jual'])   ?></td>
                                <td><?= $jual['costumer'] ?></td>
                                <td class="text-center"><?= number_format($jual['total'], 0, ',', '.') ?></td>
                                <td class="text-center"><?= number_format($jual['jml_bayar'], 0, ',', '.') ?></td>
                                <td class="text-center"><?= number_format($jual['kembalian'], 0, ',', '.') ?></td>
                                <td class="text-center"><a href="detail-penjualan.php?id=<?= $jual['no_jual'] ?>&tgl=<?= in_date($jual['tgl_jual']) ?>" class="btn btn-sm btn-info" title="rincian barang">Detail</a></td>
                            </tr>
                        <?php
                        }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

   

<?php require "../templates/footer.php";?>