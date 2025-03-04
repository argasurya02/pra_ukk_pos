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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Barcode</title>
</head>
<body>
    <?php
    
    $jmlCetak = $_GET['jmlCetak'] ?? 1;
    $barcode = $_GET['barcode'] ?? '';

    require '../asset/barcodeGenerator/vendor/autoload.php';

    $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
    $barcodeSVG = $generator->getBarcode($barcode, $generator::TYPE_CODE_128);

    for ($i = 1; $i <= $jmlCetak; $i++) { ?>
        <div style="text-align: center; width: 210px; float: left; margin-right: 30px; margin-bottom: 30px;">
            <?= $barcodeSVG ?>
            <div><?= htmlspecialchars($barcode) ?></div>
        </div>
    <?php } ?>

    <script>
        window.print();
    </script>
</body>
</html>
