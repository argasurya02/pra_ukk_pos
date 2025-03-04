<?php
session_start();
require "../config/config.php";

// Cek apakah sudah login
if (!isset($_SESSION["ssLoginPOS"])) {
    header("Location: " . $main_url . "auth/login.php");
    exit();
}

require "../config/functions.php";

$tgl1 = $_GET['tgl1'];
$tgl2 = $_GET['tgl2'];
$costumer = isset($_GET['costumer']) ? $_GET['costumer'] : ''; // Tambahkan parameter pelanggan

// Query dengan filter pelanggan jika parameter costumer ada
if (!empty($costumer)) {
    $dataJual = getdata("
        SELECT 
            jh.no_jual, jh.tgl_jual, jh.costumer, jh.total, jh.jml_bayar, jh.kembalian, 
            jd.barcode, jd.nama_brg, jd.qty, jd.harga_jual, jd.jml_harga
        FROM tbl_jual_head jh
        JOIN tbl_jual_detail jd ON jh.no_jual = jd.no_jual
        WHERE jh.tgl_jual BETWEEN '$tgl1' AND '$tgl2' AND jh.costumer = '$costumer'
        ORDER BY jh.no_jual ASC, jh.tgl_jual ASC
    ");
} else {
    // Query asli jika tidak ada filter pelanggan
    $dataJual = getdata("
        SELECT 
            jh.no_jual, jh.tgl_jual, jh.costumer, jh.total, jh.jml_bayar, jh.kembalian, 
            jd.barcode, jd.nama_brg, jd.qty, jd.harga_jual, jd.jml_harga
        FROM tbl_jual_head jh
        JOIN tbl_jual_detail jd ON jh.no_jual = jd.no_jual
        WHERE jh.tgl_jual BETWEEN '$tgl1' AND '$tgl2'
        ORDER BY jh.no_jual ASC, jh.tgl_jual ASC
    ");
}

$judul = !empty($costumer) ? "Rekap Laporan Penjualan - $costumer" : "Rekap Laporan Penjualan";
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            border-spacing: 0;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .sub-header {
            background-color: #e8e8e8;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div style="text-align: center;">
        <h2 style="margin-bottom: -15px;"><?= $judul ?></h2>
        <h3 style="margin-bottom: 15px;">Arga Store</h3>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tgl Penjualan</th>
                <th>ID Penjualan</th>
                <th>Costumer</th>
                <th>Total Penjualan</th>
                <th>Pembayaran</th>
                <th>Kembali</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $current_no_jual = null;
            $grand_total = 0;

            if (empty($dataJual)) {
                echo '<tr><td colspan="7" class="text-center">Tidak ada data untuk periode dan pelanggan yang dipilih</td></tr>';
            } else {
                foreach ($dataJual as $data) {
                    if ($current_no_jual !== $data['no_jual']) {
                        $current_no_jual = $data['no_jual'];
                        $grand_total += $data['total'];
            ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= in_date($data['tgl_jual']) ?></td>
                        <td><?= $data['no_jual'] ?></td>
                        <td><?= $data['costumer'] ?></td>
                        <td class="text-right"><?= number_format($data['total'], 0, ',', '.') ?></td>
                        <td class="text-right"><?= number_format($data['jml_bayar'], 0, ',', '.') ?></td>
                        <td class="text-right"><?= number_format($data['kembalian'], 0, ',', '.') ?></td>
                    </tr>
                    <tr class="sub-header">
                        <th colspan="2">Barcode</th>
                        <th>Nama Barang</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th colspan="2">Subtotal</th>
                    </tr>
                <?php
                    }
                ?>
                <tr>
                    <td colspan="2"><?= $data['barcode'] ?></td>
                    <td><?= $data['nama_brg'] ?></td>
                    <td class="text-center"><?= $data['qty'] ?></td>
                    <td class="text-right"><?= number_format($data['harga_jual'], 0, ',', '.') ?></td>
                    <td colspan="2" class="text-right"><?= number_format($data['jml_harga'], 0, ',', '.') ?></td>
                </tr>
            <?php 
                }
            ?>
                <tr>
                    <th colspan="4" class="text-right">Grand Total</th>
                    <th colspan="3" class="text-right"><?= number_format($grand_total, 0, ',', '.') ?></th>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

    <script>
        window.print();
    </script>
</body>

</html>
