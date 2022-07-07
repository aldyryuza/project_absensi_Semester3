<?php
require '../functions.php';
session_start();           //mengawali penggunaan session
$guru = $_SESSION["s_guru"]; //memanggil kode guru;
$tahun = date("Y");          //tahun sekarang (untuk jadwal PBM) 

$sql = "SELECT 
      mg.id_mp_guru id, 
      mg.kd_rombel, 
      mg.kd_mapel, 
      nama_mapel 
      from mapel_guru mg 
      left join mapel_ref mr on mr.kd_mapel=mg.kd_mapel
      where mg.tahun='$tahun' and mg.kd_guru='$guru'";
$qry = mysqli_query($conn, $sql);

$mapel = "<option value=''>-- Pilih Rombel --</option>";
while ($r = mysqli_fetch_array($qry)) {
  $mapel .= "<option value='" . $r["id"] . "'>" . $r["kd_rombel"] . " - " . $r["nama_mapel"] . "</option>";
}
$sqlket = "SELECT distinct tanggal as tglabsen from presensi order by tanggal desc";
$qryket = mysqli_query($conn, $sqlket);

$ket = "<select class='form-control' id='tglabsensi' data-toggle='tooltip' title='Tanggal Absensi'>";
$ket .= "<option value=''>--- Pilih Tanggal ---</option>";
while ($rket = mysqli_fetch_array($qryket)) {
  $tanggal = date("d F Y", strtotime($rket["tglabsen"]));
  $ket .= "<option value='" . $rket["tglabsen"] . "'>" . $tanggal . "</option>";
}
$ket .= "</select>";
// echo ($ket);


?>

<div class="container-fluid">
  <div class="box box-info">
    <div class="box-body">
      <div class="form-group">
        <label class="col-sm-1 control-label">Rombel</label>
        <div class="col-md-3">
          <select class="form-control" id="mapelguru" data-toggle="tooltip" title="Rombel-Mapel"><?php echo ($mapel); ?></select>
        </div>
        <br>
        <!-- <div class="float-right"><span class="col-md-12" id="waktu"></span></div> -->
        <label class="col-sm-1 control-label">Tanggal</label>
        <div class="col-md-3 " id="tanggal">
          <?= $ket; ?>
        </div>

      </div>
      <div class="row">
        <div class="col-md-12">

          <div id="list"></div>

          <a href="#" class=" float-right btn btn-flat btn-success pilih" dok='cetak.php'>Cetak</a>
          <!-- <button class=" float-right btn btn-flat btn-success" onclick="generatePDF()"> Cetak</button> -->
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
    muatwaktu("#waktu");

  })


  var mapelguru = "";
  var curdate = "";

  $("#mapelguru").change(function() {
    mapelguru = $(this).val();
    muatabsensi();
  })

  $(document).on("change", "#tglabsensi", function() {
    curdate = $(this).val();
    muatabsensi();
  })

  function muatabsensi() {
    var param = "idmapelguru=" + mapelguru + "&curdate=" + curdate;
    $.post("content/absensi_entry.php", param, function(respons) {
      $("#list").html(respons);
    })
  }

  function muatwaktu(container) {
    setInterval(function() {
      var hari = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
      var bulan = ["Jan", "Peb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agt", "Sep", "Okt", "Nop", "Des"];
      var tgl = new Date;
      var jam = tgl.getHours() + ":" + tgl.getMinutes() + ":" + tgl.getSeconds();
      var hari = hari[tgl.getDay()] + ", " + tgl.getDate() + "-" + bulan[tgl.getMonth()] + "-" + tgl.getFullYear();
      $(container).html(jam + " | " + hari);
    }, 1000);
  }
</script>
<!-- Tambahkan Libraries - JQuery and jspdf-->
<!-- <script src="https://code.jquery.com/jquery-1.12.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script>
<script type="text/javascript">
  var doc = new jsPDF();
  var specialElementHandlers = {
    '#content': function(element, renderer) {
      return true;
    }
  };
  $('#konvert').click(function() {
    doc.fromHTML($('#list').html(), 15, 15, {
      'width': 170,
      'elementHandlers': specialElementHandlers
    });
    doc.save('contoh-file.pdf');
  });
</script> -->
<script>
  /* MENU */
  $(".pilih").click(function() {
    var item = $(this);
    var dok = item.attr("dok").trim();
    $.post(dok)
      .done(function(hasil) {
        $("#isicontent").html(hasil);
      })
      .fail(function() {
        $("#isicontent").load("404.html");
      });
  });
</script>
<script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
<script>
  function generatePDF() {

    let element = document.getElementById("list");
    console.log(element);
    // html2pdf()
    //   .from(element)
    //   .save();
  }
</script>