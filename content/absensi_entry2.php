<?php
extract($_REQUEST);
include("../functions.php");
$tgl = date("Y-m-d", time());

$sqlket = "select * from presensi_ref order by prioritas desc";
$qryket = mysqli_query($conn, $sqlket);

$ket = "<span class='btn-group keterangan'>";
while ($rket = mysqli_fetch_array($qryket)) {
  $ket .= "<span class='btn btn-xs btn-flat ketpres' title='" . $rket["deskripsi"] . "' 
    btnket='" . $rket["kd_pres"] . "'>" . $rket["keterangan"] . "</span>";
}
$ket .= "</span>";

$sql = ("select mg.kd_rombel,rs.nis, sr.nama, sr.lp, pres.kd_pres 
  from mapel_guru mg
  left join rombel_siswa rs on (rs.tahun=mg.tahun and rs.kd_rombel=mg.kd_rombel)
  left join siswa_ref sr on sr.nis=rs.nis
  left join presensi pres on (pres.nis=rs.nis and pres.tanggal='$tgl' and pres.id_mp_guru='$idmapelguru')
  where mg.id_mp_guru='$idmapelguru'
  order by sr.nama");
$qry = mysqli_query($conn, $sql);
?>
<table class="table table-bordered table-hover" id="tbl_pres_entry">
  <thead>
    <tr>
      <th>NO</th>
      <th>NIS</th>
      <th>NAMA SISWA</th>
      <th>LP</th>
      <th>KETERANGAN</th>
      <th>REKAP</th>
    </tr>
  </thead>
  <tbody>
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

<script>
  $(document).ready(function() {
    warnai_keterangan();
  })

  //--- visualisasi button sesuai database ---
  function warnai_keterangan() {
    $("#tbl_pres_entry").find("tr.barispresensi").each(function() {
      var baris = $(this);
      var dbket = baris.attr("dbket");
      baris.find(".ketpres").each(function() {
        var btn = $(this);
        btn.removeClass("active");
        if (btn.attr("btnket") == dbket) btn.addClass("active");
      })
    })
  }

  $("#tbl_pres_entry").on("click", ".ketpres", function() {
    var btn = $(this);
    var ket = btn.attr("btnket");
    var nis = btn.closest("tr").attr("dbnis");
    var mapelguru = $(document).find("#mapelguru option:selected").filter("[value!='']").val();
    $.post("inc/queries.php", "oper=pres_entry&keterangan=" + ket + "&nis=" + nis + "&mapelguru=" + mapelguru, function(hasil) {
      if (hasil >= 1) {
        //if(hasil>1)alert("Update"); else alert("Save");//selanjutnya dapat dihilangkan
        btn.closest(".keterangan").find(".ketpres").removeClass("active");
        btn.addClass("active");
        btn.closest("tr").attr("dbket", ket); //ada hubungannya dengan CSS
      }
    });
  })
</script>