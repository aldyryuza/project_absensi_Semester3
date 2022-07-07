<?php
session_start();



require 'functions.php';



if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}


if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    // Login Biasa
    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username' ");


    // Login Admin





    // cek username
    if (mysqli_num_rows($result) > 0) {

        // cek password
        $row = mysqli_fetch_assoc($result);


        if (password_verify($password, $row["password"])) {


            // set session
            $_SESSION["login"] = true;
            $_SESSION["username"] = $username;


            // cek remember me 
            if (isset($_POST['remember'])) {
            }



            header("Location: index.php");
            exit;
        }
    }

    $error = true;
}


?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="img/Lambang-AK_15-juni-2017_edit.png" rel="icon">
    <title>E- Absen - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-info">
    <a href="content/aboutme.php" class="btn  btn-light float-right mt-3 mx-3"><i class="fas fa-info-circle"></i> About me</a>
    <div class="container">
        <br>
        <br>
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-4 ">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">

                        <!-- Nested Row within Card Body -->
                        <div class="row">


                            <div class="col-lg-12">

                                <div class="p-5">

                                    <div class="text-center">
                                        <div class="sidebar-brand-icon rotate-n-15">
                                            <i class="fas fa-book"></i>
                                        </div>
                                        <br>
                                        <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                    </div>



                                    <form class="user" method="post" action="">
                                        <?php
                                        if (isset($error)) : ?>
                                            <p style="color : red ; font-style : italic ; "> username / password salah </p>
                                        <?php endif; ?>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="username" id="username" placeholder="Enter Username...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" name="remember" id="remember">
                                                <label class="custom-control-label" for="customCheck">Remember Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" name="login" class="btn btn-success btn-user btn-block">
                                            Login
                                        </button>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <div class="container my-auto">

        <br>


        <div class="copyright text-center my-auto  text-white mb-4 ">
            <i class="fas fa-book rotate-n-15 "></i>
            <span>E - Absensi Mahasiswa &copy; Your Website 2021</span>




        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>