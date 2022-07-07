<?php
require '../functions.php';


?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info">Data Tabel Seluruh Rombel </h6>
    </div>
    <div class="card-body">
        <!-- open modal tambah -->
        <button class=" float-right btn btn-success btn-sm m-2" data-toggle="modal" data-target="#tambahrombel"><i class="fas fa-plus"></i></button>
        <div class="table-responsive">

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Rombel</th>
                        <th>Nama Rombel</th>
                        <th>Tingkat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <?php $i = 1; ?>
                        <?php foreach ($rombel_ref as $rowR) : ?>
                            <td><?= $i; ?></td>
                            <td><?= $rowR["kd_rombel"]; ?></td>
                            <td><?= $rowR["nama_rombel"]; ?></td>
                            <td><?= $rowR["tingkat"]; ?></td>
                            <td class="aksi">
                                <center>
                                    <a href=" " class="btn btn-warning  btn-sm m-0  " data-toggle="modal" data-target="#editrombel<?= $rowR["kd_rombel"]; ?>">
                                        <span class="icon text-white-70">
                                            <i class="fas fa-pen"></i>
                                        </span>
                                    </a>
                                    <a href=" " class="btn btn-danger  btn-sm m-0" data-toggle="modal" data-target="#hapusrombel<?= $rowR["kd_rombel"]; ?>">
                                        <span class="icon text-white-70">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                    </a>

                                </center>
                                <!-- Edit modal -->
                                <div class="modal fade" id="editrombel<?= $rowR["kd_rombel"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <!-- modal header -->
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Data rombel</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <!-- modal body -->
                                            <div class="modal-body">
                                                <form method="post">
                                                    <div class="modal-body">
                                                        <input type="text" name="kd_rombel" placeholder="Kode rombel" class="form-control" required VALUE="<?= $rowR["kd_rombel"]; ?>">
                                                        <br>
                                                        <input type="text" name="nama_rombel" placeholder="Nama" class="form-control" required VALUE="<?= $rowR["nama_rombel"]; ?>">
                                                        <br>
                                                        <input type="text" name="tingkat" placeholder="Tingkat" class="form-control" required VALUE="<?= $rowR["tingkat"]; ?>">
                                                        <br>
                                                        <button type="submit" class="btn btn-success" name="editrombel">Submit</button>

                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!-- hapus modal -->
                                <div class="modal fade" id="hapusrombel<?= $rowR["kd_rombel"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                        Apakah anda yakin ingin menghapus <?= $rowR["kd_rombel"]; ?>?
                                                        <input type="hidden" name="kd_rombel" value="<?= $rowR["kd_rombel"]; ?>">
                                                        <br>
                                                        <br>
                                                        <button type="submit" class="btn btn-danger" name="hapusrombel"> Hapus</button>
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
<div class="modal fade" id="tambahrombel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- modal header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Mata Rombel Siswa</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- modal body -->
            <form method="post">
                <div class="modal-body">
                    <input type="text" name="kd_rombel" placeholder="Kode rombel" class="form-control" required>
                    <br>
                    <input type="text" name="nama_rombel" placeholder="Nama rombel" class="form-control" required>
                    <br>
                    <input type="text" name="tingkat" placeholder="Tingkat" class="form-control" required>
                    <br>
                    <button type="submit" class="btn btn-success" name="tambahrombel">submit</button>
                </div>
            </form>


        </div>
    </div>
</div>
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>