<!-- Begin Page Content -->
<div class="container-fluid">
    <br>
    <!-- 
    <div class="text-center">
        <div style="font-size: 70px;" class="text-gray-400">
            <i class="fas fa-edit rotate-n-15 d-inline-block "></i>
            ABSENSI
        </div>
        <p class="lead text-gray-800 mb-5">Selamat Datang Di Aplikasi Absensi Online</p>
        <p class="text-gray-500 mb-0">Lanjut Lakukan Presensi ?</p>

        <a class="collapse-item pilih" dok='content/presensi1.php' href="#">&larr; Klik disini</a>
    </div> -->

    <!-- CARD jumlah  -->
    <div class="row">
        <!-- CARD jumlah mahasiswa -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-gray text-uppercase mb-1">
                                Jumlah Siswa</div>
                            <div name="jumlahmhs" class="h5 mb-0 font-weight-bold text-gray-800"><?= $count1; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- CARD jumlah guru -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-gray text-uppercase mb-1">
                                Jumlah Guru</div>
                            <div name="jumlahmhs" class="h5 mb-0 font-weight-bold text-gray-800"><?= $count2; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-graduation-cap fa-2x text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- CARD jumlah mapel -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-gray text-uppercase mb-1">
                                Jumlah Mapel</div>
                            <div name="jumlahmhs" class="h5 mb-0 font-weight-bold text-gray-800"><?= $count3; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-2x text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- CARD jumlah kelasl -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-gray text-uppercase mb-1">
                                Jumlah Kelas</div>
                            <div name="jumlahmhs" class="h5 mb-0 font-weight-bold text-gray-800"><?= $count4; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-home fa-2x text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-info">Data Tabel Seluruh Presensi</h6>
        </div>

        <br>
        <center>
            <form method="POST">
                <table>
                    <tr>
                        <td>
                            Dari Tanggal :
                        </td>
                        <td>
                            <input type="date" name="dari_tanggal" class="form-control" required>
                        </td>
                        <td>
                            Sampai Tanggal :
                        </td>
                        <td>
                            <input type="date" name="sampai_tanggal" class="form-control" required>
                        </td>
                        <td>
                            <input type="submit" class="btn btn-primary" name="filter" value="FILTER">
                        </td>
                    </tr>
                </table>
            </form>
            <br>
            <?php
            if (isset($_POST['filter'])) {
                $dari_tanggal = mysqli_real_escape_string($conn, $_POST['dari_tanggal']);
                $sampai_tanggal = mysqli_real_escape_string($conn, $_POST['sampai_tanggal']);
                echo "Dari Tanggal " . $dari_tanggal . " -  Sampai Tanggal " . $sampai_tanggal;
            }
            ?>
        </center>



        <br>

        <div class="card-body">
            <!-- open modal tambah -->
            <!-- <button class=" float-right btn btn-success btn-sm m-2" data-toggle="modal" data-target="#tambahid"><i class="fas fa-plus"></i></button> -->
            <div class="table-responsive">

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>NIS</th>
                            <th>Kode Presensi</th>
                            <th>ID MP GURU</th>

                        </tr>
                    </thead>

                    <tbody>

                        <tr>
                            <?php $i = 1;
                            if (isset($_POST['filter'])) {
                                $dari_tanggal = mysqli_real_escape_string($conn, $_POST['dari_tanggal']);
                                $sampai_tanggal = mysqli_real_escape_string($conn, $_POST['sampai_tanggal']);
                                $filter = query("SELECT * from presensi where tanggal BETWEEN '$dari_tanggal' AND '$sampai_tanggal'");
                            } else {

                                $filter = query("select * from presensi");
                            }
                            foreach ($filter as $rowfil) : ?>
                                <td><?= $i; ?></td>
                                <td><?= $rowfil["tanggal"]; ?></td>
                                <td><?= $rowfil["waktu"]; ?></td>
                                <td><?= $rowfil["nis"]; ?></td>
                                <td><?= $rowfil["kd_pres"]; ?></td>
                                <td><?= $rowfil["id_mp_guru"]; ?></td>

                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>