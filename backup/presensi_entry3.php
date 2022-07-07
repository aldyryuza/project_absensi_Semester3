<?php
extract($_REQUEST);
include("../functions.php");


$tgl = (isset($curdate) && $curdate != "undefined") ? $curdate : date("Y-m-d", time());

/*generate keterangan presensi*/
$sqlket = "select * from presensi_ref order by prioritas desc";
$qryket = mysqli_query($conn, $sqlket);

$ket = "<span class='btn-group keterangan'>";
while ($rket = mysqli_fetch_array($qryket)) {
  $ket .= "<span class='btn btn-sm btn-flat ketpres' title='" . $rket["deskripsi"] . "' btnket='" . $rket["kd_pres"] . "'>" . $rket["keterangan"] . "</span>";
}
$ket .= "</span>";

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
?>

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-info">Data Tabel Siswa</h6>
  </div>

  <div class="card-body ">


    <div class="table-responsive">
      <br>
      <table class="table table-bordered table-hover" id="tbl_pres_entry3">
        <thead>
          <tr>
            <th>No</th>
            <th>NIS</th>
            <th>Nama Siswa</th>
            <th>L / P</th>
            <th>Keterangan</th>
            <th>Rekap</th>
          </tr>
        </thead>
        <tbody class="">
          <?php
          $no = 0;
          while ($rec = mysqli_fetch_array($qry)) {
            $no++;
            echo ("<tr class='barispresensi' dbnis='" . $rec["nis"] . "' dbket='" . $rec["kd_pres"] . "'>
              <td>$no</td>
              <td>" . $rec["nis"] . "</td>
              <td>" . $rec["nama"] . "</td>
              <td>" . $rec["lp"] . "</td>
              <td>$ket</td>
              <td></td>
            </tr>");
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<div class="text-center">
  <button class=" btn btn-flat btn-danger" id="btnbatal" title="Membatalkan seleksi 'semua hadir' atau 'kosongkan' &#10; dan menampilkan presensi hari ini yang sudah tersimpan.">Batalkan</button>
  <button class=" btn btn-flat btn-success" id="btnmasuksemua" title="Menandai semua hadir, &#10;kecuali yang sudah memiliki keterangan">Semua Hadir</button>
  <button class=" btn btn-flat btn-info" id="btnkosongkan" title="Mengosongkan pilihan keterangan.">Kosongkan</button>
  <button class=" btn btn-flat btn-warning" id="btnsimpan" title="Simpan absensi yang memiliki keterangan">Simpan</button>
</div>
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
  $("#tbl_pres_entry3").on("click", ".ketpres", function() {
    var btn = $(this);
    btn.addClass("active");
    btn.siblings(".ketpres").removeClass("active");
    btn.addClass("active");
    btn.closest("tr").attr("dbket", btn.attr("btnket"));
  })

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

<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>

<!-- sweet alert -->
<script src="js/sweetalert2.all.min.js"></script>
<script src="js/jquery-3.4.1.min.js"></script>