  <?php
    require '../functions.php';


    ?>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-info">Data Tabel Seluruh Mapel </h6>
      </div>
      <div class="card-body">
          <!-- open modal tambah -->
          <button class=" float-right btn btn-success btn-sm m-2" data-toggle="modal" data-target="#tambahmapel"><i class="fas fa-plus"></i></button>
          <div class="table-responsive">

              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>Kode Mapel</th>
                          <th>Nama</th>
                          <th>Opsi</th>
                      </tr>
                  </thead>

                  <tbody>

                      <tr>
                          <?php $i = 1; ?>
                          <?php foreach ($mapel as $rowM) : ?>
                              <td><?= $i; ?></td>
                              <td><?= $rowM["kd_mapel"]; ?></td>
                              <td><?= $rowM["nama_mapel"]; ?></td>
                              <td class="aksi">
                                  <center>
                                      <a href=" " class="btn btn-warning  btn-sm m-0  " data-toggle="modal" data-target="#editmapel<?= $rowM["kd_mapel"]; ?>">
                                          <span class="icon text-white-70">
                                              <i class="fas fa-pen"></i>
                                          </span>
                                      </a>
                                      <a href=" " class="btn btn-danger  btn-sm m-0" data-toggle="modal" data-target="#hapusmapel<?= $rowM["kd_mapel"]; ?>">
                                          <span class="icon text-white-70">
                                              <i class="fas fa-trash"></i>
                                          </span>
                                      </a>

                                  </center>
                                  <!-- Edit modal -->
                                  <div class="modal fade" id="editmapel<?= $rowM["kd_mapel"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                              <!-- modal header -->
                                              <div class="modal-header">
                                                  <h5 class="modal-title" id="exampleModalLabel">Edit Data Mapel</h5>
                                                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">×</span>
                                                  </button>
                                              </div>
                                              <!-- modal body -->
                                              <div class="modal-body">
                                                  <form method="post">
                                                      <div class="modal-body">
                                                          <input type="hidden" name="kd_mapel" placeholder="Kode mapel" class="form-control" required VALUE="<?= $rowM["kd_mapel"]; ?>">
                                                          <input type="text" name="nama_mapel" placeholder="Nama" class="form-control" required VALUE="<?= $rowM["nama_mapel"]; ?>">
                                                          <br>
                                                          <button type="submit" class="btn btn-success" name="editmapel">Submit</button>

                                                      </div>
                                                  </form>
                                              </div>

                                          </div>
                                      </div>
                                  </div>

                                  <!-- hapus modal -->
                                  <div class="modal fade" id="hapusmapel<?= $rowM["kd_mapel"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                          Apakah anda yakin ingin menghapus <?= $rowM["nama_mapel"]; ?>?
                                                          <input type="hidden" name="kd_mapel" value="<?= $rowM["kd_mapel"]; ?>">
                                                          <br>
                                                          <br>
                                                          <button type="submit" class="btn btn-danger" name="hapusmapel"> Hapus</button>
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
  <div class="modal fade" id="tambahmapel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                      <input type="text" name="kd_mapel" placeholder="Kode mapel" class="form-control" required>
                      <br>
                      <input type="text" name="nama_mapel" placeholder="Nama Mapel" class="form-control" required>
                      <br>
                      <button type="submit" class="btn btn-success" name="tambahmapel">submit</button>
                  </div>
              </form>


          </div>
      </div>
  </div>
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>