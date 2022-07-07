<?php
require '../functions.php';




?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info">Data Tabel Referensi Presensi </h6>
    </div>
    <div class="card-body">
        <!-- open modal tambah -->
        <button class=" float-right btn btn-success btn-sm m-2" data-toggle="modal" data-target="#tambahpresensiref"><i class="fas fa-plus"></i></button>
        <div class="table-responsive">

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Presensi</th>
                        <th>Keterangan</th>
                        <th>Deskripsi</th>
                        <th>Prioritas</th>
                        <th>Opsi</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <?php $i = 1; ?>
                        <?php foreach ($presensi_ref as $rowPR) : ?>
                            <td><?= $i; ?></td>
                            <td><?= $rowPR["kd_pres"]; ?></td>
                            <td><?= $rowPR["keterangan"]; ?></td>
                            <td><?= $rowPR["deskripsi"]; ?></td>
                            <td><?= $rowPR["prioritas"]; ?></td>

                            <td class="aksi">
                                <center>
                                    <a href=" " class="btn btn-warning  btn-sm m-0  " data-toggle="modal" data-target="#editpresensiref<?= $rowPR["kd_pres"]; ?>">
                                        <span class="icon text-white-70">
                                            <i class="fas fa-pen"></i>
                                        </span>
                                    </a>
                                    <a href=" " class="btn btn-danger  btn-sm m-0" data-toggle="modal" data-target="#hapuspresensiref<?= $rowPR["kd_pres"]; ?>">
                                        <span class="icon text-white-70">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                    </a>

                                </center>
                                <!-- Edit modal -->
                                <div class="modal fade" id="editpresensiref<?= $rowPR["kd_pres"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <!-- modal header -->
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Data Presensi ref</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <!-- modal body -->
                                            <div class="modal-body">
                                                <form method="post">
                                                    <div class="modal-body">
                                                        <input type="text" name="kd_pres" placeholder="Kode Presensi" class="form-control" required VALUE="<?= $rowPR["kd_pres"]; ?>">
                                                        <br>
                                                        <input type="text" name="keterangan" placeholder="Keterangan" class="form-control" required VALUE="<?= $rowPR["keterangan"]; ?>">
                                                        <br>
                                                        <input type="text" name="deskripsi" placeholder="Deskripsi" class="form-control" required VALUE="<?= $rowPR["deskripsi"]; ?>">
                                                        <br>
                                                        <input type="text" name="prioritas" placeholder="Prioritas" class="form-control" required VALUE="<?= $rowPR["prioritas"]; ?>">
                                                        <br>

                                                        <button type="submit" class="btn btn-success" name="editpresensiref">Submit</button>

                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!-- hapus modal -->
                                <div class="modal fade" id="hapuspresensiref<?= $rowPR["kd_pres"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <!-- modal header -->
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin ?</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <!-- modal body -->
                                            <div class="modal-body">
                                                <form method="post">
                                                    <div class="modal-body">
                                                        Apakah anda yakin ingin menghapus <?= $rowPR["kd_pres"]; ?>?
                                                        <input type="hidden" name="kd_pres" value="<?= $rowPR["kd_pres"]; ?>">
                                                        <br>
                                                        <br>
                                                        <button type="submit" class="btn btn-danger" name="hapuspresensiref"> Hapus</button>
                                                    </div>
                                            </div>

                                            </form>
                                        </div>

                                    </div>
                                </div>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach; ?>


                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- tambah modal -->
<div class="modal fade" id="tambahpresensiref" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- modal header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Referensi Presensi</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- modal body -->
            <form method="post">
                <div class="modal-body">
                    <input type="hidden" name="id_mp_guru" placeholder="id_mp_guru" class="form-control">
                    <input type="text" name="kd_pres" placeholder="Kode Presensi" class="form-control" required>
                    <br>
                    <input type="text" name="keterangan" placeholder="Keterangan" class="form-control" required>
                    <br>
                    <input type="text" name="deskripsi" placeholder="Deskripsi" class="form-control" required>
                    <br>
                    <input type="text" name="prioritas" placeholder="Prioritas" class="form-control" required>
                    <br>
                    <button type="submit" class="btn btn-success" name="tambahpresensiref">submit</button>
                </div>
            </form>


        </div>
    </div>
</div>
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>