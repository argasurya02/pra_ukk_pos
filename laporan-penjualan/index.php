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

$penjualan = getdata("SELECT * FROM tbl_jual_head");
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Penjualan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Penjualan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-list fa-sm"></i> Data Penjualan </h3>
                    <button type="button" class="btn btn-sm btn-outline-primary float-right" data-toggle="modal" data-target="#mdlPeriodeJual"><i class="fas fa-print"></i> Cetak</button>
                </div>
            </div>
            <div class="card-body table-responsive p-3">
                <table class="table table-hover text-nowrap" id="tblData">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Penjualan</th>
                            <th>Tgl Penjualan</th>
                            <th>Costumer</th>
                            <th>Total Penjualan</th>
                            <th>Pembayaran</th>
                            <th>Kembali</th>
                            <th style="width: 10%;" class="text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($penjualan as $jual) { ?>
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

     <!-- Modal untuk memilih periode dan pelanggan -->
<div class="modal fade" id="mdlPeriodeJual">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Periode Penjualan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="tgl1" class="col-sm-3 col-form-label">Tanggal awal</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control" id="tgl1">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tgl2" class="col-sm-3 col-form-label">Tanggal akhir</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control" id="tgl2">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="selectCostumer" class="col-sm-3 col-form-label">Pelanggan</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="selectCostumer">
                            <option value="">-- Semua Pelanggan --</option>
                            <?php
                            // Ambil semua pelanggan unik dari database
                            $customers = getdata("SELECT DISTINCT costumer FROM tbl_jual_head ORDER BY costumer ASC");
                            foreach ($customers as $cust) {
                                echo '<option value="' . $cust['costumer'] . '">' . $cust['costumer'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="printDoc()"><i class="fas fa-print"></i> Cetak</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
    let tgl1 = document.getElementById('tgl1');
    let tgl2 = document.getElementById('tgl2');
    let selectCostumer = document.getElementById('selectCostumer');

    function printDoc() {
        if (tgl1.value != "" && tgl2.value != "") {
            let url = "../report/r-jual.php?tgl1=" + tgl1.value + "&tgl2=" + tgl2.value;
            
            // Tambahkan parameter costumer jika dipilih
            if (selectCostumer.value !== "") {
                url += "&costumer=" + encodeURIComponent(selectCostumer.value);
            }
            
            window.open(url, "", "width=900,height=600,left=100");
        }
    }
</script>

    <?php require "../templates/footer.php"; ?>