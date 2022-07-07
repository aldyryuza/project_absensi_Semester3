<?php
require '../functions.php';


?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-info">Data Tabel Siswa 9A 2019</h5>
        <span class="icon text-white-70 float-lg-right ">
            <i class="fas fa-user"></i>
            : <?= $count9a; ?>
        </span>


    </div>
    <div class="card-body">

        <!-- open modal tambah -->
        <!-- <button class=" float-right btn btn-success btn-sm m-2" data-toggle="modal" data-target="#tambahid"><i class="fas fa-plus"></i></button> -->
        <div class="table-responsive">

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-dark">
                    <tr class="text-light">
                        <th>No</th>
                        <th>NIS</th>
                        <th>Nama</th>

                        <th>Kode Rombel</th>
                        <th>Option</th>
                        <th>Keterangan</th>


                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <?php $i = 1; ?>
                        <?php foreach ($rombel9a as $row9) : ?>
                            <td><?= $i; ?></td>
                            <td><?= $row9["nis"]; ?></td>
                            <td><?= $row9["nama"]; ?></td>

                            <td><?= $row9["kd_rombel"]; ?></td>
                            <td>
                                <form>
                                    <div class="form-group">

                                        <select class="form-control" id="pilihJurusan">
                                            <option>Masuk</option>
                                            <option>Alfa</option>
                                            <option>Dispen 1</option>
                                            <option>Dispen 2</option>
                                            <option>Sakit</option>
                                        </select>
                                    </div>
                                </form>

                                <!-- <form method="POST">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="hadir<?= $row9["nis"]; ?>" name="example" value="customEx">
                                        <label class="custom-control-label" for="hadir<?= $row9["nis"]; ?>">H</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="sakit<?= $row9["nis"]; ?>" name="example" value="customEx">
                                        <label class="custom-control-label" for="sakit<?= $row9["nis"]; ?>">S</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="dispen<?= $row9["nis"]; ?>" name="example" value="customEx">
                                        <label class="custom-control-label" for="dispen<?= $row9["nis"]; ?>">D</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="izin<?= $row9["nis"]; ?>" name="example" value="customEx">
                                        <label class="custom-control-label" for="izin<?= $row9["nis"]; ?>">I</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="alfa<?= $row9["nis"]; ?>" name="example" value="customEx">
                                        <label class="custom-control-label" for="alfa<?= $row9["nis"]; ?>">A</label>
                                    </div>
                                </form> -->

                            </td>
                            <td>
                                <form method="POST" action="">
                                    <div class="col">
                                        <input type="text" class="form-control" id="keterangan" placeholder="Keterangan...." name="keterangan">
                                    </div>
                                </form>
                            </td>

                    </tr>
                    <?php $i++; ?>
                <?php endforeach; ?>


                </tbody>

            </table>
            <center>
                <a href="#" class="btn btn-success  btn-md m-2" data-toggle="modal" data-target="#">
                    Simpan
                    <span class="icon text-white-70">
                        <i class="fas fa-check"></i>
                    </span>
                </a>
            </center>
        </div>
    </div>
</div>



<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>