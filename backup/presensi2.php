<?php
require '../functions.php';
session_start();           //mengawali penggunaan session
$guru = $_SESSION["s_guru"]; //dimuat pada index.php;
$tahun = date("Y");          //tahun sekarang 

$sql = "SELECT mg.id_mp_guru id, mg.kd_rombel, mg.kd_mapel, nama_mapel 
      from mapel_guru mg 
      left join mapel_ref mr on mr.kd_mapel=mg.kd_mapel
      where mg.tahun='$tahun' and mg.kd_guru='$guru'";
$qry = mysqli_query($conn, $sql);

$mapel = "<option value=''>-- pilih --</option>";
while ($r = mysqli_fetch_array($qry)) {
    $mapel .= "<option value='" . $r["id"] . "'>" . $r["kd_rombel"] . " - " . $r["nama_mapel"] . "</option>";
}
// $sqlket = "SELECT distinct tanggal as tglabsen from presensi order by tanggal desc";
// $qryket = mysqli_query($conn, $sqlket);

// $ket = "<select class='form-control' id='tglabsensi' data-toggle='tooltip' title='Tanggal Absensi'>";
// $ket .= "<option value=''>--- tanggal ---</option>";
// while ($rket = mysqli_fetch_array($qryket)) {
//     $tanggal = date("d F Y", strtotime($rket["tglabsen"]));
//     $ket .= "<option value='" . $rket["tglabsen"] . "'>" . $tanggal . "</option>";
// }
// $ket .= "</select>";
// // echo ($ket);

?>


<div class="container-fluid">
    <div class="box box-info">
        <div class="box-body">
            <div class="form-group">
                <div class="float-right"><span class="col-md-12" id="waktu"></span></div>

                <div class="col-md-3">
                    <label class="col-sm-1 control-label">Rombel</label>
                    <select class="form-control" id="mapelguru" data-toggle="tooltip" title="Rombel-Mapel"><?php echo ($mapel); ?></select>

                </div>
                <br>
                <div class="col-md-3">
                    <label class="col-sm-1 control-label ">Tanggal</label>
                    <select class="form-control" id="tanggal"></select>
                </div>


            </div>

            <div class="row">
                <div class="col-md-12">

                    <div id="list"></div>
                </div>
            </div>
        </div>
    </div>

</div>


<script>
    $(".mapelguru").change(function() {
        $(".mapelguru").not(this).val("");
        var dok = $(this).attr("dok");
        var param = "idmapelguru=" + $(this).val();
        $.post(dok, param, function(respons) {
            $("#list").html(respons);
        })
    })

    $('[data-toggle="tooltip"]').tooltip();
</script>

<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
        muatwaktu("#waktu");
        muattanggal("#tanggal");
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
        $.post("content/presensi_entry3.php", param, function(respons) {
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

    function muattanggal(container) {
        $.post("content/absensi_tgl.php", function(respons) {
            $(container).html(respons);
        })
    }
</script>