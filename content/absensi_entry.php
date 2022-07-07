<?php
extract($_REQUEST);
include("../functions.php");


$tgl = (isset($curdate) && $curdate != "undefined") ? $curdate : date("Y-m-d", time());

/*generate keterangan presensi*/
$sqlket = "select * from presensi_ref order by prioritas desc";
$qryket = mysqli_query($conn, $sqlket);

$ket = " <center> <span class='keterangan'>";
while ($rket = mysqli_fetch_array($qryket)) {
  $ket .= "<span disabled class='btn btn-sm btn-flat ketpres' title='" . $rket["deskripsi"] . "' btnket='" . $rket["kd_pres"] . "'>" . $rket["keterangan"] . "</span>";
}
$ket .= "</span> </center> ";

/*list siswa*/
$sql = ("SELECT mg.kd_rombel,rs.nis, sr.nama, sr.lp,
  pres.kd_pres 
  from mapel_guru mg
  left join rombel_siswa rs on (rs.tahun=mg.tahun and rs.kd_rombel=mg.kd_rombel)
  left join siswa_ref sr on sr.nis=rs.nis
  left join presensi pres on (pres.nis=rs.nis and pres.tanggal='$tgl' and pres.id_mp_guru='$idmapelguru')
  where mg.id_mp_guru='$idmapelguru'
  order by sr.nama");
//die($sql);
$qry = mysqli_query($conn, $sql);

// // $rekap = mysqli_query($conn, "SELECT '$ket' from presensi where nis = '$qry' ");
$hadir = mysqli_query($conn, "SELECT * FROM `presensi` WHERE kd_pres= 'h' AND tanggal ='$tgl' AND id_mp_guru = $idmapelguru");
$counth = mysqli_num_rows($hadir);

$sakit = mysqli_query($conn, "SELECT * FROM `presensi` WHERE kd_pres= 's' AND tanggal ='$tgl' AND id_mp_guru = $idmapelguru");
$counts = mysqli_num_rows($sakit);

$izin = mysqli_query($conn, "SELECT * FROM `presensi` WHERE kd_pres= 'i' AND tanggal ='$tgl' AND id_mp_guru = $idmapelguru");
$counti = mysqli_num_rows($izin);

$dispen1 = mysqli_query($conn, "SELECT * FROM `presensi` WHERE kd_pres= 'd1' AND tanggal ='$tgl' AND id_mp_guru = $idmapelguru");
$countd1 = mysqli_num_rows($dispen1);

$dispen2 = mysqli_query($conn, "SELECT * FROM `presensi` WHERE kd_pres= 'd2' AND tanggal ='$tgl' AND id_mp_guru = $idmapelguru");
$countd2 = mysqli_num_rows($dispen2);

$alpa = mysqli_query($conn, "SELECT * FROM `presensi` WHERE kd_pres= 'a' AND tanggal ='$tgl' AND id_mp_guru = $idmapelguru");
$countal = mysqli_num_rows($alpa);

?>
<div class="row">
  <!-- CARD jumlah HADIR -->
  <div class="col-xl-3 mb-3">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-gray text-uppercase mb-1">
              Hadir</div>
            <div name="jumlahmhs" class="h5 mb-0 font-weight-bold text-gray-800"><?= $counth; ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-check fa-2x text-gray-400"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- CARD jumlah Sakit -->
  <div class="col-xl-3  mb-3">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-gray text-uppercase mb-1">
              Sakit</div>
            <div name="jumlahmhs" class="h5 mb-0 font-weight-bold text-gray-800"><?= $counts; ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-hospital fa-2x text-gray-400"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- CARD jumlah Izin -->
  <div class="col-xl-3  mb-3">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-gray text-uppercase mb-1">
              Izin</div>
            <div name="jumlahmhs" class="h5 mb-0 font-weight-bold text-gray-800"><?= $counti; ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-receipt fa-2x text-gray-400"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- CARD jumlah Disepen1 -->
  <div class="col-xl-3  mb-3">
    <div class="card border-left-secondary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-gray text-uppercase mb-1">
              Dispen 1</div>
            <div name="jumlahmhs" class="h5 mb-0 font-weight-bold text-gray-800"><?= $countd1; ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-running fa-2x text-gray-400"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- CARD jumlah Dispen2 -->
  <div class="col-xl-3  mb-3">
    <div class="card border-left-dark shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-gray text-uppercase mb-1">
              Dispen 2</div>
            <div name="jumlahmhs" class="h5 mb-0 font-weight-bold text-gray-800"><?= $countd2; ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-walking fa-2x text-gray-400"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- CARD jumlah Alfa -->
  <div class="col-xl-3  mb-3">
    <div class="card card border-left-danger shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-gray text-uppercase mb-1">
              Alfa</div>
            <div name="jumlahmhs" class="h5 mb-0 font-weight-bold text-gray-800"><?= $countal; ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-times fa-2x text-gray-400"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>




<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-info">Data Tabel Rekap Siswa</h6>

  </div>

  <div class="card-body ">



    <div class="table-responsive">
      <br>
      <table class="table table-bordered " id="tbl_pres_entry3">
        <thead>
          <tr>
            <th>No</th>
            <th>NIS</th>
            <th>Nama Siswa</th>
            <th>L / P</th>
            <th>Keterangan</th>

          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          while ($rec = mysqli_fetch_array($qry)) {

            echo ("
            <tr class='barispresensi' dbnis='" . $rec["nis"] . "' dbket='" . $rec["kd_pres"] . "'>
              <td>$no</td>
              <td>" . $rec["nis"] . "</td>
              <td>" . $rec["nama"] . "</td>
              <td>" . $rec["lp"] . "</td>
              <td>  $ket</td>
              
              
            </tr>");
            $no++;
          }
          ?>

        </tbody>

      </table>
    </div>
  </div>
</div>
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>

<script>
  $(document).ready(function() {
    $('#tbl_pres_entry3').DataTable({
      dom: 'Bfrtip',
      buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
      ]
    });
  });
</script> -->





<script>
  $(document).ready(function() {
    warnai_keterangan();
  })

  //--- visualisasi button sesuai database ---
  function warnai_keterangan() {
    $("#tbl_pres_entry3").find("tr.barispresensi").each(function() {
      var baris = $(this);
      var dbket = baris.attr("dbket");
      baris.find(".ketpres").each(function() {
        var btn = $(this);
        btn.removeClass("active");
        if (btn.attr("btnket") == dbket) btn.addClass("active");
      })
    })
  }

  $("#btnbatal").click(function() {
    var selmpguru = $(document).find(".mapelguru").has("option:selected[value!='']");
    var dok = selmpguru.attr("dok");
    var param = "idmapelguru=" + selmpguru.val();
    $.post(dok, param, function(respons) {
      $("#list").html(respons);
    })
  })

  //----------- masuk semua -----------------  
  function hadir_massal() {
    var jml = 0;
    $("#tbl_pres_entry3").find('.barispresensi').each(function() {
      $(this).find(".keterangan").each(function() {
        if ($(this).has("span.active").length <= 0) {
          jml++;
          $(this).find("span[btnket='h']").addClass("active");
          $(this).closest("tr").attr("dbket", "h");
        }
      })
    })
    if (jml <= 0) Swal.fire(
      'Sorry !',
      'Tidak ada yang berhasil diubah.\nSemua siswa telah diabsen sebelumnya.',
      'warning'
    );
    if (jml >= 1) Swal.fire(
      'Berhasil !',
      'berhasil di ubah menjadi " Hadir " :' + jml,
      'success'
    );
  }

  //------------- mengosongkan keterangan presensi
  function kosongkan_massal() {
    $("#tbl_pres_entry3").find('.barispresensi').attr("dbket", "");
    $("#tbl_pres_entry3").find('.barispresensi').find(".ketpres").removeClass("active");
  };

  $("#btnmasuksemua").click(function() {
    hadir_massal();
  })

  $("#btnkosongkan").click(function() {
    kosongkan_massal();
  })

  //--- visualisasi button saat click ---
  // $("#tbl_pres_entry3").on("click", ".ketpres", function() {
  //   var btn = $(this);
  //   btn.addClass("active");
  //   btn.siblings(".ketpres").removeClass("active");
  //   btn.addClass("active");
  //   btn.closest("tr").attr("dbket", btn.attr("btnket"));
  // })

  //-------------------- menyimpan data massal----------- 
  $("#btnsimpan").click(function() {
    koleksi_data();
  });

  function koleksi_data() {
    var dt = new Date();
    var tanggal = dt.getFullYear() + "-" + (dt.getMonth() + 1) + "-" + dt.getDate();
    var waktu = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
    var valgroup = "";
    var mapelguru = $(document).find(".mapelguru option:selected").filter("[value!='']").val();
    $("#tbl_pres_entry3").find("tr.barispresensi").has("span.active").each(function() {
      var nis = $(this).attr("dbnis");
      var ket = $(this).attr("dbket");
      valgroup += "('','" + tanggal + "','" + waktu + "','" + nis + "','" + ket + "','" + mapelguru + "'),";
    })
    if (valgroup.length < 1) {
      Swal.fire(
        'Sorry !',
        'Keterangan Presensi Belum Dipilih',
        'warning'
      );
      return false;
    }
    var param = "oper=pres_entry_massal&valgroup=" + valgroup.slice(0, -1);
    $.post("inc/queries.php", param, function(result) {
      Swal.fire(
        'Good job!',
        'Jumlah data : ' + result + ' berhasil disimpan',
        'success'
      );
    })
  };
  //end-------------------- menyimpan data massal-----------  
</script>













<!-- sweet alert -->
<script src="js/sweetalert2.all.min.js"></script>
<script src="js/jquery-3.4.1.min.js"></script>