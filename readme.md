hi guys ini projek ukk yang saya coba buat sc dari : youtube codigline

// Cek apakah sudah login
if (!isset($_SESSION["ssLoginPOS"])) {
    header("location: /arga_pos-main/auth/login.php");
    exit();
}

// Cek apakah user memiliki peran admin
if ($_SESSION["ssRolePOS"] !== "admin") {
    header("location: /arga_pos-main/pelanggan/dashboard-pelanggan.php"); // Redirect pelanggan ke dashboard mereka
    exit();
}

utuk sessionnya pastikan header locationnnya di ubah sesuai dengan nama folder ($mainurl) masing masing 