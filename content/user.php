<?php
require '../functions.php';


?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info">Data Seluruh User </h6>
    </div>
    <div class="card-body">
        <!-- open modal tambah -->
        <a href="register.php" class=" float-right btn btn-success btn-sm m-2"><i class="fas fa-plus"></i> Tambah User</a>
        <div class="table-responsive">

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Level User</th>
                        <th>Opsi</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <?php $i = 1; ?>
                        <?php foreach ($user as $row) : ?>
                            <td><?= $i; ?></td>
                            <td><?= $row["username"]; ?></td>
                            <td><?= $row["level_user"]; ?></td>
                            <td class="aksi">
                                <center>
                                    <a href=" " class="btn btn-danger  btn-sm m-0" data-toggle="modal" data-target="#hapus_user<?= $row["id_user"]; ?>">
                                        <span class="icon text-white-70">
                                            <i class="fas fa-trash"></i>
                                            Hapus
                                        </span>
                                    </a>

                                </center>



                                <!-- hapus modal -->
                                <div class="modal fade" id="hapus_user<?= $row["id_user"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                        Apakah anda yakin ingin menghapus <?= $row["username"]; ?>?
                                                        <input type="hidden" name="id_user" value="<?= $row["id_user"]; ?>">
                                                        <br>
                                                        <br>
                                                        <button type="submit" class="btn btn-danger" name="hapus_user"> Hapus</button>
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



<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>