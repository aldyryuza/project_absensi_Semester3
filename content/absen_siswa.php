<?php

include("../functions.php");
session_start();
$username = $_SESSION['username'];

// print_r($username);
// die;


$hadir = mysqli_query($conn, "SELECT * FROM `presensi` WHERE kd_pres= 'h'  AND nis = $username");
$counth = mysqli_num_rows($hadir);

$sakit = mysqli_query($conn, "SELECT * FROM `presensi` WHERE kd_pres= 's'  AND nis = $username");
$counts = mysqli_num_rows($sakit);

$izin = mysqli_query($conn, "SELECT * FROM `presensi` WHERE kd_pres= 'i'  AND nis = $username");
$counti = mysqli_num_rows($izin);

$dispen1 = mysqli_query($conn, "SELECT * FROM `presensi` WHERE kd_pres= 'd1'  AND nis = $username");
$countd1 = mysqli_num_rows($dispen1);

$dispen2 = mysqli_query($conn, "SELECT * FROM `presensi` WHERE kd_pres= 'd2'  AND nis = $username");
$countd2 = mysqli_num_rows($dispen2);

$alpa = mysqli_query($conn, "SELECT * FROM `presensi` WHERE kd_pres= 'a'  AND nis = $username");
$countal = mysqli_num_rows($alpa);

?>
<div class="container">
    <div class="row">
        <!-- CARD jumlah HADIR -->
        <div class="col-xl-3 mb-3">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-gray text-uppercase mb-1">
                                Hadir</div>
                            <div name="jumlahmhs" class="h5 mb-0 font-weight-bold text-gray-800"><?= $counth; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check fa-2x text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- CARD jumlah Sakit -->
        <div class="col-xl-3  mb-3">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-gray text-uppercase mb-1">
                                Sakit</div>
                            <div name="jumlahmhs" class="h5 mb-0 font-weight-bold text-gray-800"><?= $counts; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hospital fa-2x text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- CARD jumlah Izin -->
        <div class="col-xl-3  mb-3">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-gray text-uppercase mb-1">
                                Izin</div>
                            <div name="jumlahmhs" class="h5 mb-0 font-weight-bold text-gray-800"><?= $counti; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-receipt fa-2x text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- CARD jumlah Disepen1 -->
        <div class="col-xl-3  mb-3">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-gray text-uppercase mb-1">
                                Dispen 1</div>
                            <div name="jumlahmhs" class="h5 mb-0 font-weight-bold text-gray-800"><?= $countd1; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-running fa-2x text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- CARD jumlah Dispen2 -->
        <div class="col-xl-3  mb-3">
            <div class="card border-left-dark shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-gray text-uppercase mb-1">
                                Dispen 2</div>
                            <div name="jumlahmhs" class="h5 mb-0 font-weight-bold text-gray-800"><?= $countd2; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-walking fa-2x text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- CARD jumlah Alfa -->
        <div class="col-xl-3  mb-3">
            <div class="card card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-gray text-uppercase mb-1">
                                Alfa</div>
                            <div name="jumlahmhs" class="h5 mb-0 font-weight-bold text-gray-800"><?= $countal; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-times fa-2x text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>