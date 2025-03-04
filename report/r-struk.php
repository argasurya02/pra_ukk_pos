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

$nota = $_GET['nota'];
$dataJual = getdata("SELECT * FROM tbl_jual_head WHERE no_jual = '$nota'")[0];
$itemJual = getdata("SELECT * FROM tbl_jual_detail WHERE no_jual = '$nota'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Belanja</title>
</head>

<body>

    <table style="border-bottom: solid 2px; text-align: center; font-size: 14px; width:240px;">
        <tr>
            <td><b>Arga Store</b></td>
        </tr>
        <tr>
            <td><?= 'No Nota :' . $nota ?></td>
        </tr>
        <tr>
            <td><?= date('d-m-Y H:i:s') ?></td>
        </tr>
        <tr>
            <td><?= userLogin()['username'] ?></td>
        </tr>
    </table>
    <table style="border-bottom: dotted 2px; font-size: 14px; width:240px;">
        <?php
        foreach ($itemJual as $item) { ?>
            <tr>
                <td colspan="6"><?= $item['nama_brg'] ?></td>
            </tr>
            <tr>
                <td colspan="2" style="width: 70px;">Qty</td>
                <td style="width: 10px; text-align: right;"><?= $item['qty'] ?></td>
                <td style="width: 70px; text-align: right;">x <?= number_format($item['harga_jual'], 0, ',', '.') ?></td>
                <td style="width: 70px; text-align: right;" colspan="2"> <?= number_format($item['jml_harga'], 0, ',', '.') ?></td>
            </tr>
        <?php }
        ?>
    </table>
    <table style="border-bottom: dotted 2px; font-size: 14px; width:240px;">
        <tr>
            <td colspan="3" style="width: 100px;"></td>
            <td style="text-align: right; width: 50px;">Total</td>
            <td colspan="2" style="text-align: right; width: 70px;"><b><?= number_format($dataJual['total'], 0, ',', '.') ?></b></td>
        </tr>
        <tr>
            <td colspan="3" style="width: 100px;"></td>
            <td style="text-align: right; width: 50px;">Bayar</td>
            <td colspan="2" style="text-align: right; width: 70px;"><b><?= number_format($dataJual['jml_bayar'], 0, ',', '.') ?></b></td>
        </tr>
    </table>
    <table style="border-bottom: solid 2px; font-size: 14px; width:240px;">
        <tr>
            <td colspan="3" style="width: 100px;"></td>
            <td style="text-align: right; width: 50px;">Kembali</td>
            <td colspan="2" style="text-align: right; width: 70px;"><b><?= number_format($dataJual['kembalian'], 0, ',', '.') ?></b></td>
        </tr>
    </table>
    <table style="text-align: center; font-size: 14px; width:240px; margin-top: 10px;">
        <tr>
            <td>Terima Kasih Sudah Berbelanja</td>
        </tr>
    </table>
    
    <script>
        setTimeout(function() {
            window.print()
        }, 5000);
    </script>

</body>

</html>