 <?php
session_start();


require "config/config.php";
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

    require "config/functions.php";

    $title = "Error Page | Arga Store";
    require "templates/header.php";
    require "templates/navbar.php";
    require "templates/sidebar.php";


?>

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>404 Error Page</h1>
                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                         <li class="breadcrumb-item active">404 Error Page</li>
                     </ol>
                 </div>
             </div>
         </div><!-- /.container-fluid -->
     </section>

     <!-- Main content -->
     <section class="content">
         <div class="error-page">
             <h2 class="headline text-warning"> 404</h2>

             <div class="error-content">
                 <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Page not found.</h3>

                 <p>
                     We could not find the page you were looking for.
                     Meanwhile, you may <a href="dashboard.php">return to dashboard</a> 
                 </p>
             </div>
             <!-- /.error-content -->
         </div>
         <!-- /.error-page -->
     </section>
     <!-- /.content -->
<?php
    require "templates/footer.php";
?>