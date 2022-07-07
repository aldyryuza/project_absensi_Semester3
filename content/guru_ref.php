  <?php
    require '../functions.php';


    ?>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-info">Data Tabel Seluruh Guru </h6>
      </div>
      <div class="card-body">
          <!-- open modal tambah -->
          <button class=" float-right btn btn-success btn-sm m-2" data-toggle="modal" data-target="#tambahguru"><i class="fas fa-plus"></i></button>
          <div class="table-responsive">

              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>Kode Guru</th>
                          <th>NIP</th>
                          <th>Nama</th>
                          <th>Opsi</th>
                      </tr>
                  </thead>

                  <tbody>

                      <tr>
                          <?php $i = 1; ?>
                          <?php foreach ($guru as $rowG) : ?>
                              <td><?= $i; ?></td>
                              <td><?= $rowG["kd_guru"]; ?></td>
                              <td><?= $rowG["nip"]; ?></td>
                              <td><?= $rowG["nama"]; ?></td>
                              <td class="aksi">
                                  <center>
                                      <a href=" " class="btn btn-warning  btn-sm m-0  " data-toggle="modal" data-target="#editguru<?= $rowG["kd_guru"]; ?>">
                                          <span class="icon text-white-70">
                                              <i class="fas fa-pen"></i>
                                          </span>
                                      </a>
                                      <a href=" " class="btn btn-danger  btn-sm m-0" data-toggle="modal" data-target="#hapusguru<?= $rowG["kd_guru"]; ?>">
                                          <span class="icon text-white-70">
                                              <i class="fas fa-trash"></i>
                                          </span>
                                      </a>

                                  </center>
                                  <!-- Edit modal -->
                                  <div class="modal fade" id="editguru<?= $rowG["kd_guru"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                              <!-- modal header -->
                                              <div class="modal-header">
                                                  <h5 class="modal-title" id="exampleModalLabel">Edit Data Guru</h5>
                                                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">×</span>
                                                  </button>
                                              </div>
                                              <!-- modal body -->
                                              <div class="modal-body">
                                                  <form method="post">
                                                      <div class="modal-body">
                                                          <input type="hidden" name="kd_guru" placeholder="Kode Guru" class="form-control" required VALUE="<?= $rowG["kd_guru"]; ?>">

                                                          <input type="text" name="nip" placeholder="NIP" class="form-control" required VALUE="<?= $rowG["nip"]; ?>">
                                                          <br>
                                                          <input type="text" name="nama" placeholder="Nama" class="form-control" required VALUE="<?= $rowG["nama"]; ?>">
                                                          <br>
                                                          <button type="submit" class="btn btn-success" name="editguru">Submit</button>

                                                      </div>
                                                  </form>
                                              </div>

                                          </div>
                                      </div>
                                  </div>

                                  <!-- hapus modal -->
                                  <div class="modal fade" id="hapusguru<?= $rowG["kd_guru"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                          Apakah anda yakin ingin menghapus <?= $rowG["nama"]; ?>?
                                                          <input type="hidden" name="kd_guru" value="<?= $rowG["kd_guru"]; ?>">
                                                          <br>
                                                          <br>
                                                          <button type="submit" class="btn btn-danger" name="hapusguru"> Hapus</button>
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
  <div class="modal fade" id="tambahguru" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <!-- modal header -->
              <div class="modal-header">
                  <h4 class="modal-title">Tambah Guru</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <!-- modal body -->
              <form method="post">
                  <div class="modal-body">
                      <input type="text" name="kd_guru" placeholder="Kode Guru" class="form-control" required>
                      <br>
                      <input type="text" name="nip" placeholder="NIP" class="form-control" required>
                      <br>
                      <input type="text" name="nama" placeholder="nama" class="form-control" required>
                      <br>
                      <button type="submit" class="btn btn-success" name="tambahguru">submit</button>
                  </div>
              </form>


          </div>
      </div>
  </div>

  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>