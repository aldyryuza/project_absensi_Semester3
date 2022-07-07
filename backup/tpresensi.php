<?php
require '../functions.php';


?>

<!-- DataTales Example -->

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



<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>