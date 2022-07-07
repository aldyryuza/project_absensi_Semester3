<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

require 'functions.php';
$siswa = query("select * from siswa_ref ");
$guru = query("select * from guru_ref ");
$mapel = query("select * from mapel_ref ");

// menghitung jumlah Siswa
$getsiswa = mysqli_query($conn, "select * from siswa_ref ");
$count1 = mysqli_num_rows($getsiswa);

// menghitung jumlah Guru
$getguru = mysqli_query($conn, "select * from guru_ref ");
$count2 = mysqli_num_rows($getguru);

// menghitung jumlah Matkul
$getmapel = mysqli_query($conn, "select * from mapel_ref ");
$count3 = mysqli_num_rows($getmapel);

// menghitung jumlah Matkul
$getrombel = mysqli_query($conn, "select * from rombel_ref ");
$count4 = mysqli_num_rows($getrombel);

$atribut = mysqli_query($conn, "SELECT * FROM user WHERE username = '$_SESSION[username]' ");

$r = mysqli_fetch_assoc($atribut);
$level = $r['level_user'];


// session_start();
$_SESSION["s_guru"] = $_SESSION["username"]; //selanjutnya akan diganti dengan session kode user


// die;



?>



<script src="js/jquery-3.4.1.min.js"></script>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/Lambang-AK_15-juni-2017_edit.png" rel="icon">
  <title>E - Absen</title>



  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <!-- <link href="../sweetalert/node_modules/sweetalert2/dist/sweetalert2.css" rel="stylesheet">
  <link href="../sweetalert/node_modules/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet"> -->

  <!-- Custom CSS ku -->
  <link href="toastr/toastr.min.css" rel="stylesheet">
  <link href="css/custom1.css" rel="stylesheet">
  <!-- Datepicker CSS -->
  <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="plugins/typeahead/asset/jquery-ui.css">





</head>

<!-- Page Wrapper -->
<div id="wrapper">

  <!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion " id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center  " href="index.php">
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-edit"></i>
      </div>
      <div class="sidebar-brand-text mx-3  ">E-Absensi</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
      <a class="nav-link" href="index.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">



    <?php
    $level = $r['level_user'] == 'gp';
    if ($level) {

    ?>
      <!-- Heading -->
      <div class="sidebar-heading">
        Presensi
      </div>
      <!-- PRESENSI -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#presensi" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-edit"></i>
          <span>Presensi</span>
        </a>
        <div id="presensi" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Pilihan Tabel:</h6>
            <a class="collapse-item pilih" dok='content/presensi1.php' href="#">Presensi</a>
            <a class="collapse-item pilih" dok='cetak.php' href="#">Rekap</a>
            <!-- <a class="collapse-item" href="#" data-toggle="modal" data-target="#tbmahasiswa">Siswa_ref</a>
            <a class="collapse-item" href="#">Mata Pelajaran</a>
            <a class="collapse-item" href="#">Other</a> -->
          </div>
        </div>
      </li>

      <hr class="sidebar-divider">

    <?php } elseif ($level = $r['level_user'] == 'sis') { ?>

      <div class="sidebar-heading">
        Menu Siswa
      </div>
      <!-- MENU TABEL -->
      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed pilih " href="#" dok='content/absen_siswa.php'>
          <i class="fas fa-fw fa-table"></i>
          <span>Hasil Absen</span>
        </a>
        <!-- <div id="collapseUtilities" class="collapse " aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Pilihan Tabel:</h6>
              <a class="collapse-item pilih" dok='content/absen_siswa.php' href="#">Hasil Absen</a>
              <a class="collapse-item pilih" dok='content/siswa_ref.php' href="#">Siswa Referensi</a>
              <a class="collapse-item pilih" dok='content/mapel_ref.php' href="#">Mata Pelajaran</a>
              <a class="collapse-item pilih" dok='content/rombel_ref.php' href="#">Rombel_ref</a>
              <a class="collapse-item pilih" dok='content/mapel_guru.php' href="#">Mapel Guru</a>
              <a class="collapse-item pilih" dok='content/presensi_ref.php' href="#">presensi_ref</a>
              <a class="collapse-item pilih" dok='content/tpresensi.php' href="#">Presensi</a>
              <a class="collapse-item pilih" dok='content/rombel_siswa.php' href="#">Rombel Siswa</a>
              <a class="collapse-item" href="register.php">Tambah user</a>
            </div>
          </div> -->
      </li>
    <?php } else { ?>
      <div class="sidebar-heading">
        Menu admin
      </div>
      <!-- MENU TABEL -->
      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-table"></i>
          <span>Tabel</span>
        </a>
        <div id="collapseUtilities" class="collapse " aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Pilihan Tabel:</h6>
            <a class="collapse-item pilih" dok='content/guru_ref.php' href="#">Guru Referensi</a>
            <a class="collapse-item pilih" dok='content/siswa_ref.php' href="#">Siswa Referensi</a>
            <a class="collapse-item pilih" dok='content/mapel_ref.php' href="#">Mata Pelajaran</a>
            <a class="collapse-item pilih" dok='content/rombel_ref.php' href="#">Rombel_ref</a>
            <a class="collapse-item pilih" dok='content/mapel_guru.php' href="#">Mapel Guru</a>
            <a class="collapse-item pilih" dok='content/presensi_ref.php' href="#">presensi_ref</a>
            <a class="collapse-item pilih" dok='content/tpresensi.php' href="#">Presensi</a>
            <a class="collapse-item pilih" dok='content/rombel_siswa.php' href="#">Rombel Siswa</a>
            <a class="collapse-item pilih" dok='content/user.php' href="#">Data User</a>
            <!-- <a class="collapse-item" href="register.php">Data user</a> -->
          </div>
        </div>
      </li>
    <?php } ?>

    <!-- Divider -->
    <!-- <hr class="sidebar-divider"> -->

    <!-- Heading -->
    <!-- <div class="sidebar-heading">
        Option
      </div> -->
    <!-- OPTION / SERVICE -->
    <!-- Nav Item - Pages Collapse Menu -->
    <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-user"></i>
          <span>Add User</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">apa yang ditambah ?</h6>
            <a href="#" class="collapse-item">Admin</a>
          </div>
        </div>
      </li> -->
    <!-- <li class="nav-item active">
        <a class="nav-link pilih" href="#" dok='content/aboutme.php'>
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>About me</span></a>
      </li> -->

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


  </ul>
  <!-- End of Sidebar -->



  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">

      <div><?php include("support/banner.php"); ?></div>
      <div class="container">
        <div id="isicontent"><?php include("content/content.php"); ?></div>
      </div>




    </div>
    <!-- End of Content Wrapper -->
    <div><?php include("support/footer.php"); ?></div>
  </div>
  <!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->




<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded bg-success " href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>
</body>

</html>

<!-- Custom JS -->

<script src="js/jsku.js"></script>




<!-- Bootstrap core JavaScript-->
<!-- <script src="vendor/jquery/jquery.min.js"></script> -->
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Datepicker -->

<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>





<!-- Toaster JS -->
<script src="toastr/toastr.min.js"></script>
<!-- Fungsi Toastr -->
<script>
  function toasterberhasil() {
    Command: toastr["success"]("Berhasil disimpan")

    toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": false,
      "progressBar": false,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
  };

  function toasterupdate() {
    Command: toastr["success"]("Berhasil diupdate")

    toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": false,
      "progressBar": false,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
  };
</script>