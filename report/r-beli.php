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

$tgl1 = $_GET['tgl1'];
$tgl2 = $_GET['tgl2'];

$dataBeli = getdata("SELECT * FROM tbl_beli_head WHERE tgl_beli BETWEEN '$tgl1' AND '$tgl2'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pembelian</title>
</head>

<body>
    <div style="text-align: center;">
        <h2 style="margin-bottom: -15px;">Rekap Laporan Pembelian</h2>
        <h2 style="margin-bottom: 15px;">Arga Store</h2>
    </div>

    <table>
        <thead>
            <tr>
                <td colspan="5" style="height: 5px;">
                    <hr style="margin-bottom: 2px; margin-left:-5px;" , size="3" , color="grey">
                </td>
            </tr>
            <tr>
                <th>No</th>
                <th style="width:120px;">Tgl Pembelian</th>
                <th style="width:120px;">Id Pembelian</th>
                <th style="width:300px;">Supplier</th>
                <th>Total Pembelian</th>
            </tr>
            <tr>
                <td colspan="5" style="height: 5px;">
                    <hr style="margin-bottom: 2px; margin-left:-5px; margin-top: 2px" , size="3" , color="grey">
                </td>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($dataBeli as $data) { ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= in_date($data['tgl_beli']) ?></td>
                    <td><?= $data['no_beli'] ?></td>
                    <td style="padding-left: 80px;"><?= $data['supplier'] ?></td>
                    <td class="text-right"><?= number_format($data['total'], 0, ',', '.') ?></td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" style="height: 5px;">
                    <hr style="margin-bottom: 2px; margin-left:-5px; margin-top: 2px" , size="3" , color="grey">
                </td>
            </tr>
        </tfoot>
    </table>

    <script>
        window.print();
    </script>
</body>

</html>