<?php


?>


<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white  topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    AKNPSFBLITAR
    <!-- Topbar Navbar -->
    <div class=" text-md-left embed-responsive ">

        <div class="clock text-center ">
            <div class="display">
            </div>
        </div>
    </div>
    <ul class=" navbar-nav ml-auto">

        <!-- Nav Item - Admin Informasi -->
        <li class="nav-item dropdown no-arrow">

            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION["username"] ?></span>
                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>


            </div>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Apakah anda benar ingin keluar ?</div>
            <div class="modal-footer">
                <a class="btn btn-danger" href="logout.php">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Begin Page Content -->
<div class="container-fluid">



</div>

<script>
    setInterval(function() {
        const clock = document.querySelector(".display");
        let time = new Date();
        let sec = time.getSeconds();
        let min = time.getMinutes();
        let hr = time.getHours();
        let day = 'AM';

        if (hr > 24) {
            day = 'PM';
            hr = hr - 12;
        }
        if (hr == 0) {
            hr = 12;
        }
        if (sec < 10) {
            sec = '0' + sec;
        }
        if (min < 10) {
            min = '0' + min;
        }
        if (hr < 10) {
            hr = '0' + hr;
        }
        clock.textContent = hr + ':' + min + ':' + sec + " " + day;
    });
    // setInterval(function() {
    //             var hari = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
    //             var bulan = ["Jan", "Peb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agt", "Sep", "Okt", "Nop", "Des"];
    //             var tgl = new Date;
    //             var jam = tgl.getHours() + ":" + tgl.getMinutes() + ":" + tgl.getSeconds();
    //             var hari = hari[tgl.getDay()] + ", " + tgl.getDate() + "-" + bulan[tgl.getMonth()] + "-" + tgl.getFullYear();
    //             $(container).html(jam + " | " + hari);
    //         }
</script>