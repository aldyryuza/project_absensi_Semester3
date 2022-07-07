  <?php
    require '../functions.php';


    ?>


  <!-- DataTales Example -->
  <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-info">Data Tabel Seluruh Mahasiswa </h6>
      </div>
      <div class="card-body">
          <!-- open modal tambah -->
          <button class=" float-right btn btn-success btn-sm m-2" data-toggle="modal" data-target="#tambahModal"><i class="fas fa-plus"></i></button>
          <div class="table-responsive">

              <table class="table table-bordered  " id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>NIS</th>
                          <th>Nama</th>
                          <th>Jenis Kelamin</th>
                          <th>Tempat Tanggal Lahir</th>
                          <th>Opsi</th>
                      </tr>
                  </thead>

                  <tbody>

                      <tr>
                          <?php $i = 1; ?>
                          <?php foreach ($siswa as $row) : ?>
                              <td><?= $i; ?></td>
                              <td><?= $row["nis"]; ?></td>
                              <td><?= $row["nama"]; ?></td>
                              <td><?= $row["lp"]; ?></td>
                              <td><?= $row["tmp_lahir"]; ?>, <?= $row["tgl_lahir"]; ?></td>
                              <td class="aksi">
                                  <center>
                                      <a href=" " class="btn btn-warning  btn-sm m-0  " data-toggle="modal" data-target="#EditModal<?= $row["nis"]; ?>">
                                          <span class="icon text-white-70">
                                              <i class="fas fa-pen"></i>
                                          </span>
                                      </a>
                                      <a href=" " class="btn btn-danger  btn-sm m-0" data-toggle="modal" data-target="#hapusm<?= $row["nis"]; ?>">
                                          <span class="icon text-white-70">
                                              <i class="fas fa-trash"></i>
                                          </span>
                                      </a>

                                  </center>
                                  <!-- Edit modal -->
                                  <div class="modal fade" id="EditModal<?= $row["nis"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                              <!-- modal header -->
                                              <div class="modal-header">
                                                  <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                                                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">×</span>
                                                  </button>
                                              </div>
                                              <!-- modal body -->
                                              <div class="modal-body">
                                                  <form method="post">
                                                      <div class="modal-body">
                                                          <input type="text" name="nis" placeholder="NIS" class="form-control" required VALUE="<?= $row["nis"]; ?>">
                                                          <br>
                                                          <input type="text" name="nama" placeholder="Nama" class="form-control" required VALUE="<?= $row["nama"]; ?>">
                                                          <br>
                                                          <input type="text" name="lp" placeholder="Jenis Kelamin" class="form-control" required VALUE="<?= $row["lp"]; ?>">
                                                          <br>
                                                          <input type="text" name="tmp_lahir" placeholder="Tempat Lahir" class="form-control" required VALUE="<?= $row["tmp_lahir"]; ?>">
                                                          <br>
                                                          <input type="text" name="tgl_lahir" placeholder="Tanggal Lahir" class="form-control" required VALUE="<?= $row["tgl_lahir"]; ?>">
                                                          <br>
                                                          <button type="submit" class="btn btn-success" name="editmahasiswa">Submit</button>

                                                      </div>
                                                  </form>
                                              </div>

                                          </div>
                                      </div>
                                  </div>

                                  <!-- hapus modal -->
                                  <div class="modal fade" id="hapusm<?= $row["nis"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                          Apakah anda yakin ingin menghapus <?= $row["nama"]; ?>?
                                                          <input type="hidden" name="nis" value="<?= $row["nis"]; ?>">
                                                          <br>
                                                          <br>
                                                          <button type="submit" class="btn btn-danger" name="hapusmahasiswa"> Hapus</button>
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
  <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <!-- modal header -->
              <div class="modal-header">
                  <h4 class="modal-title">Tambah Mahsiswa</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <!-- modal body -->
              <form method="post">
                  <div class="modal-body">
                      <input type="text" name="nis" placeholder="NIS" class="form-control" required>
                      <br>
                      <input type="text" name="nama" placeholder="Nama" class="form-control" required>
                      <br>
                      <input type="text" name="lp" placeholder="Jenis Kelamin" class="form-control" required>
                      <br>
                      <input type="text" name="tmp_lahir" placeholder="Tempat Lahir" class="form-control" required>
                      <br>
                      <input type="text" name="tgl_lahir" placeholder="Tanggal Lahir" class="form-control" required>
                      <br>
                      <button type="submit" class="btn btn-success" name="submit">submit</button>
                  </div>
              </form>


          </div>
      </div>
  </div>

  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>