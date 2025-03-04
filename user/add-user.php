<?php

// Cek apakah sudah login
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
require "../module/mode-user.php";

$title = "Tambah User | Arga Store";
require "../templates/header.php";
require "../templates/navbar.php";
require "../templates/sidebar.php";

if (isset($_POST['simpan'])) {
    if (insert($_POST) > 0) {
        echo "<script>
                    alert('User baru berhasil diregistrasi');
                </script>";
    }
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Users</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= $main_url ?>user/data-user.php">Users</a></li>
                        <li class="breadcrumb-item active">Add User</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-plus fa-sm"></i> Add User</h3>
                        <button type="submit" name="simpan" class="btn btn-primary btn-sm float-right"><i class="fas fa-save"></i> Simpan</button>
                        <button type="reset" class="btn btn-danger btn-sm float-right mr-1"><i class="fas fa-times"></i> Reset</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8 mb-3">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" class="form-control" id="username" placeholder="Masukkan username" autofocus autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <label for="fullname">Fullname</label>
                                    <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Masukkan nama lengkap" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan password" required>
                                </div>
                                <div class="form-group">
                                    <label for="password2">Konfirmasi Password</label>
                                    <input type="password" name="password2" class="form-control" id="password2" placeholder="Masukkan kembali password anda" required>
                                </div>
                                <div class="form-group">
                                    <label for="level">Level</label>
                                    <select name="level" class="form-control" id="level">
                                        <option value="">-- Level User --</option>
                                        <option value="1">Administrator</option>
                                        <option value="2">Supervisor</option>
                                        <option value="3">Operator</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea name="address" class="form-control" id="address" rows="3" placeholder="Masukkan alamat"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-4 text-center">
                                <img src="<?= $main_url ?>asset/image/deafult.png" class="porfile-user-img mb-3" alt="">
                                <input type="file" class="form-control" name="image">
                                <span class="text-sm">Type file gambar JPG | PNG | GIF</span><br>
                                <span class="text-sm"> Width == Length </span>
                            </div>
                        </div>
                    </div> <!-- card-body -->
                    <!-- Tambahkan penutup form di sini -->
                </form>
            </div> <!-- card -->
        </div> <!-- container-fluid -->
    </section>


    <?php
    require "../templates/footer.php";
    ?>