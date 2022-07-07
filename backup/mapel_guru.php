<?php
require '../functions.php';


?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info">Data Tabel Seluruh Mapel Guru </h6>
    </div>
    <div class="card-body">
        <!-- open modal tambah -->
        <button class=" float-right btn btn-success btn-sm m-2" data-toggle="modal" data-target="#tambahmapelguru"><i class="fas fa-plus"></i></button>
        <div class="table-responsive">

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID MP Guru</th>
                        <th>Tahun</th>
                        <th>Kode Rombel</th>
                        <th>Kode Mapel</th>
                        <th>Kode Guru</th>
                        <th>Opsi</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <?php $i = 1; ?>
                        <?php foreach ($mapel_guru as $rowMG) : ?>
                            <td><?= $i; ?></td>
                            <td><?= $rowMG["id_mp_guru"]; ?></td>
                            <td><?= $rowMG["tahun"]; ?></td>
                            <td><?= $rowMG["kd_rombel"]; ?></td>
                            <td><?= $rowMG["kd_mapel"]; ?></td>
                            <td><?= $rowMG["kd_guru"]; ?></td>
                            <td class="aksi">
                                <center>
                                    <a href=" " class="btn btn-warning  btn-sm m-0  " data-toggle="modal" data-target="#editmapelguru<?= $rowMG["id_mp_guru"]; ?>">
                                        <span class="icon text-white-70">
                                            <i class="fas fa-pen"></i>
                                        </span>
                                    </a>
                                    <a href=" " class="btn btn-danger  btn-sm m-0" data-toggle="modal" data-target="#hapusmapelguru<?= $rowMG["id_mp_guru"]; ?>">
                                        <span class="icon text-white-70">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                    </a>

                                </center>
                                <!-- Edit modal -->
                                <div class="modal fade" id="editmapelguru<?= $rowMG["id_mp_guru"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <!-- modal header -->
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Data Mapel Guru</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <!-- modal body -->
                                            <div class="modal-body">
                                                <form method="post">
                                                    <div class="modal-body">
                                                        <input type="text" name="tahun" placeholder="Tahun" class="form-control" required VALUE="<?= $rowMG["tahun"]; ?>">
                                                        <br>
                                                        <input type="text" name="kd_rombel" placeholder="Kode Rombel" class="form-control" required VALUE="<?= $rowMG["kd_rombel"]; ?>">
                                                        <br>
                                                        <input type="text" name="kd_mapel" placeholder="Kode Mapel" class="form-control" required VALUE="<?= $rowMG["kd_mapel"]; ?>">
                                                        <br>
                                                        <input type="text" name="kd_guru" placeholder="Kode Guru" class="form-control" required VALUE="<?= $rowMG["kd_guru"]; ?>">
                                                        <br>
                                                        <input type="hidden" name="id_mp_guru" placeholder="ID MP Guru" class="form-control" required VALUE="<?= $rowMG["id_mp_guru"]; ?>">
                                                        <button type="submit" class="btn btn-success" name="editmapelguru">Submit</button>

                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!-- hapus modal -->
                                <div class="modal fade" id="hapusmapelguru<?= $rowMG["id_mp_guru"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                        Apakah anda yakin ingin menghapus <?= $rowMG["id_mp_guru"]; ?>?
                                                        <input type="hidden" name="id_mp_guru" value="<?= $rowMG["id_mp_guru"]; ?>">
                                                        <br>
                                                        <br>
                                                        <button type="submit" class="btn btn-danger" name="hapusmapelguru"> Hapus</button>
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
<div class="modal fade" id="tambahmapelguru" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- modal header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Mata Pelajaran</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- modal body -->
            <form method="post">
                <div class="modal-body">
                    <input type="hidden" name="id_mp_guru" placeholder="id_mp_guru" class="form-control">
                    <input type="text" name="tahun" placeholder="Tahun" class="form-control" required>
                    <br>
                    <input type="text" name="kd_rombel" placeholder="Kode Rombel" class="form-control" required>
                    <br>
                    <input type="text" name="kd_mapel" placeholder="Kode Mapel" class="form-control" required>
                    <br>
                    <input type="text" name="kd_guru" placeholder="Kode Guru" class="form-control" required>
                    <br>
                    <button type="submit" class="btn btn-success" name="tambahmapelguru">submit</button>
                </div>
            </form>


        </div>
    </div>
</div>
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>