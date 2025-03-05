<?php

function generateNo()
{
    global $koneksi;

    $queryNo = mysqli_query($koneksi, "SELECT max(no_jual) as maxno FROM tbl_jual_head");
    $row = mysqli_fetch_assoc($queryNo);
    $maxno = $row['maxno'];

    $noUrut = (int) substr($maxno, 2, 4);
    $noUrut++;
    $maxno = "PJ" . sprintf("%04s", $noUrut);

    return $maxno;
}

function totalJual($noJual)
{
    global $koneksi;

    $totalJual = mysqli_query($koneksi, "SELECT sum(jml_harga) AS total FROM tbl_jual_detail WHERE no_jual = '$noJual'");
    $data = mysqli_fetch_assoc($totalJual);
    $total = $data['total'];

    return $total;
}

function insert($data)
{
    global $koneksi;

    // Log untuk debugging
    error_log("Insert function called with data: " . print_r($data, true));

    $no = mysqli_real_escape_string($koneksi, $data['nojual']);
    $tgl = mysqli_real_escape_string($koneksi, $data['tglNota']);
    $kode = trim(mysqli_real_escape_string($koneksi, $data['barcode']));
    $nama = mysqli_real_escape_string($koneksi, $data['namaBrg']);
    
    // Debug: Cek apakah qty ada
    $qty = isset($data['qty']) ? mysqli_real_escape_string($koneksi, $data['qty']) : 1;
    error_log("Qty value: " . $qty);

    $harga = mysqli_real_escape_string($koneksi, $data['harga']);
    $jmlharga = mysqli_real_escape_string($koneksi, $data['jmlHarga']);
    
    // Debug: Cek stok
    $stok_query = mysqli_query($koneksi, "SELECT stock FROM tbl_barang WHERE barcode = '$kode'");
    $stok_data = mysqli_fetch_assoc($stok_query);
    $stok = $stok_data['stock'];

    
    error_log("Barcode: $kode, Stok: $stok, Qty: $qty");

    // Cek barang sudah di input atau belum
    $cekbrg = mysqli_query($koneksi, "SELECT * FROM tbl_jual_detail WHERE no_jual = '$no' AND barcode = '$kode' ");
    if (mysqli_num_rows($cekbrg) > 0) {
        error_log("Barang sudah ada di detail penjualan");
        echo "<script>
                alert('Barang sudah ada, hapus dulu jika ingin mengubah qty');
              </script>";
        return false;
    }

    // Periksa stok terlebih dahulu
    if ($qty > $stok) {
        error_log("Stok tidak mencukupi. Qty: $qty, Stok: $stok");
        echo "<script>
                alert('Stok barang tidak mencukupi (Qty: $qty, Stok: $stok)');
              </script>";
        return false;
    }

    // Proses insert jika lolos validasi
    $sqljual = "INSERT INTO tbl_jual_detail VALUES (null, '$no', '$tgl', '$kode', '$nama', $qty, $harga, $jmlharga)";
    $insert_result = mysqli_query($koneksi, $sqljual);
    
    if (!$insert_result) {
        error_log("Gagal insert detail: " . mysqli_error($koneksi));
        return false;
    }

    $update_stok = mysqli_query($koneksi, "UPDATE tbl_barang SET stock = stock - $qty WHERE barcode = '$kode'");
    
    if (!$update_stok) {
        error_log("Gagal update stok: " . mysqli_error($koneksi));
        return false;
    }

    return mysqli_affected_rows($koneksi);
}


function delete($barcode, $idjual, $qty)
{
    global $koneksi;

    $sqlDel = "DELETE FROM tbl_jual_detail WHERE barcode = '$barcode' AND no_jual = '$idjual'";
    mysqli_query($koneksi, $sqlDel);

    mysqli_query($koneksi, "UPDATE tbl_barang SET stock = stock + $qty WHERE barcode = '$barcode'");

    return mysqli_affected_rows($koneksi);
}

function simpan($data)
{
    global $koneksi;

    $nojual = mysqli_real_escape_string($koneksi, $data['nojual']);
    $tgl = mysqli_real_escape_string($koneksi, $data['tglNota']);
    $total = mysqli_real_escape_string($koneksi, $data['total']);
    $id_pelanggan = mysqli_real_escape_string($koneksi, $data['id_pelanggan']);
    $costumer = mysqli_real_escape_string($koneksi, $data['costumer']);
    $keterangan = mysqli_real_escape_string($koneksi, $data['ketr']);
    $bayar = mysqli_real_escape_string($koneksi, $data['bayar']);
    $kembalian = mysqli_real_escape_string($koneksi, $data['kembalian']);

    // Validasi pembayaran harus lebih besar atau sama dengan total harga
    if ($bayar < $total) {
        error_log("Pembayaran kurang. Total: $total, Bayar: $bayar");
        echo "<script>
                alert('Pembayaran tidak mencukupi! Total harus dibayar: $total');
              </script>";
        return false;
    }

    $sqljual = "INSERT INTO tbl_jual_head VALUES ('$nojual', '$tgl', '$costumer', $id_pelanggan, '$total', '$keterangan', $bayar, $kembalian) ";

    mysqli_query($koneksi, $sqljual);

    return mysqli_affected_rows($koneksi);
}
