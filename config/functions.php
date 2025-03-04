<?php
function uploadimg($url = null, $name = null)
{
    $namafile = $_FILES['image']['name'];
    $ukuran   = $_FILES['image']['size'];
    $tmp      = $_FILES['image']['tmp_name'];

    // validasi file gambar yang boleh di upload 
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'gif'];
    $ekstensiGambar      = explode('.', $namafile);
    $ekstensiGambar      = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        if ($url != null) {
            echo '<script>
                    alert("file yang anda upload bukan gambar, Data gagal di update");
                    document.location.href = "' . $url . '";
                </script>';
            die();
        } else {
            echo '<script>
                    alert("file yang anda upload bukan gambar, data gagal");
                </script>';
            return false;
        }
    }
    if ($ukuran > 1000000) {
        if ($url != null) {
            echo '<script>
                    alert("file yang anda upload terlalu besar melebihi 1MB, Data gagal di update");
                    document.location.href = "' . $url . '";
                </script>';
            die();
        } else {
        echo "<script>
                    alert('Ukuran gambar tidak boleh melebihi 1MB');
                </script>";
        return false;
        }
    }

    if($name != null){
        $namafileBaru = $name. '.' . $ekstensiGambar;
    }else{
        $namafileBaru = rand(10, 1000) . '.' . $namafile;
    }

    move_uploaded_file($tmp, '../asset/image/' . $namafileBaru);
    return $namafileBaru;
}

function getdata($sql)
{
    global $koneksi;

    $result = mysqli_query($koneksi, $sql);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows; // Pindahkan return ke dalam function
}

//untuk emngecek user yang aktif di sistem
function userLogin()
{
    $userActive = $_SESSION['ssUserPOS'];
    $dataUser = getdata("SELECT * FROM tbl_user WHERE username = '$userActive'");

    if (!empty($dataUser)) {
        return $dataUser[0];
    } else {
        return null; // Hindari error
    }
}


function pelangganLogin()
{
    $userActive = $_SESSION['ssUserPOS'];
    $dataUser = getdata("SELECT * FROM tbl_pelanggan WHERE email = '$userActive'");

    if (!empty($dataUser)) {
        return $dataUser[0];
    } else {
        return null; // Hindari error
    }
}


function userMenu(){
    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri_segments = explode('/', $uri_path);
    $menu = $uri_segments[2];

    return $menu;
}

function menuHome(){
    if(userMenu() == 'dashboard.php'){
        $result = "active";
    }else{
        $result = null;
    }

    return $result;
}
function costumerMenu(){
    if( userMenu() == 'costumer'){
        $result = "active";
    }else{
        $result = null;
    }

    return $result;
}

//membuat menu pengaturan tetap terbuka
function menuSetting(){
    if(userMenu() == 'user' ){
        $result = 'menu-is-opening menu-open';
    }else{
        $result = null;
    }

    return $result;
}

function menuUser()
{
    if (userMenu() == 'user') {
        $result = "active";
    } else {
        $result = null;
    }

    return $result;
}
function menuSupplier()
{
    if (userMenu() == 'supplier') {
        $result = "active";
    } else {
        $result = null;
    }

    return $result;
}

function menuMaster()
{
    if (userMenu() == 'supplier'  || userMenu() == 'barang') {
        $result = 'menu-is-opening menu-open';
    } else {
        $result = null;
    }

    return $result;
}


function menuCostumer()
{
    if (userMenu() == 'costumer') {
        $result = "active";
    } else {
        $result = null;
    }

    return $result;
}

function menuBarang()
{
if (userMenu() == 'barang') {
        $result = "active";
    } else {
        $result = null;
    }

    return $result;
}
function menuLaporanStock()
{
if (userMenu() == 'stock') {
        $result = "active";
    } else {
        $result = null;
    }

    return $result;
}
function menuLaporanPembelian()
{
if (userMenu() == 'laporan-pembelian') {
        $result = "active";
    } else {
        $result = null;
    }

    return $result;
}
function menuLaporanPenjualan()
{
if (userMenu() == 'laporan-penjualan') {
        $result = "active";
    } else {
        $result = null;
    }

    return $result;
}
function menuBeli()
{
if (userMenu() == 'pembelian') {
        $result = "active";
    } else {
        $result = null;
    }

    return $result;
}
function menuJual()
{
if (userMenu() == 'penjualan') {
        $result = "active";
    } else {
        $result = null;
    }

    return $result;
}

function in_date($tgl){
    $tg = substr($tgl, 8, 2);
    $bln = substr($tgl, 5, 2);
    $thn = substr($tgl, 0, 4);

    return $tg . '-' . $bln . '-' . $thn;
}

function omzet(){
    global $koneksi;
    
    $queryOmzet = mysqli_query($koneksi, "SELECT SUM(total) AS omzet FROM tbl_jual_head");
    $data = mysqli_fetch_assoc($queryOmzet);
    $omzet = number_format($data['omzet'], 0, ',', '.');

    return $omzet; 
}
?>