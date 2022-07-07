<?php
  session_start();           //mengawali penggunaan session
  $guru="abd";//$_SESSION["s_guru"]; //memanggil kode guru;
  $tahun=date("Y");          //tahun sekarang (untuk jadwal PBM) 
  include("../inc/connection.inc");
  $sql="select 
      mg.id_mp_guru id, 
      mg.kd_rombel, 
      mg.kd_mapel, 
      nama_mapel 
      from mapel_guru mg 
      left join mapel_ref mr on mr.kd_mapel=mg.kd_mapel
      where mg.tahun='$tahun' and mg.kd_guru='$guru'";
  $qry=mysqli_query($conn,$sql);
  
  $mapel="<option value=''>-- pilih --</option>";
  while($r=mysqli_fetch_array($qry)){
    $mapel.="<option value='".$r["id"]."'>".$r["kd_rombel"]." - ".$r["nama_mapel"]."</option>";
  }
?>

<div class="box box-info">
  <div class="box-body">
    <div class="form-group">
      <label class="col-sm-1 control-label">Rombel</label>
      <div class="col-md-3">
        <select class="form-control" id="mapelguru" 
          data-toggle="tooltip" title="Rombel-Mapel"><?php echo($mapel);?></select>
      </div>
      <label class="col-sm-1 control-label">Tanggal</label>
      <div class="col-md-2" id="tanggal"></div>
      <div class="pull-right"><span class="col-md-12" id="waktu"></span></div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <hr />
        <div id="list"></div>
      </div>
    </div>  
  </div>
</div>

<script>
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
    muatwaktu("#waktu");
    muattanggal("#tanggal");    
  })
  
  var mapelguru="";
  var curdate="";
  
  $("#mapelguru").change(function(){
    mapelguru=$(this).val();
    muatabsensi();
  })

  $(document).on("change","#tglabsensi",function(){
    curdate=$(this).val();
    muatabsensi();
  })
  
  function muatabsensi(){
    var param="idmapelguru="+mapelguru+"&curdate="+curdate;
    $.post("content/absensi_entry.php",param,function(respons){
      $("#list").html(respons);
    })
  }
  
  function muatwaktu(container){
    setInterval(function() {
      var hari=["Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"];
      var bulan=["Jan","Peb","Mar","Apr","Mei","Jun","Jul","Agt","Sep","Okt","Nop","Des"];
      var tgl=new Date;
      var jam = tgl.getHours() + ":" + tgl.getMinutes() + ":" + tgl.getSeconds();
      var hari=hari[tgl.getDay()]+", "+tgl.getDate()+"-"+bulan[tgl.getMonth()]+"-"+tgl.getFullYear();
      $(container).html(jam+" | "+hari);
    }, 1000);     
  }

  function muattanggal(container){
    $.post("content/absensi_tgl.php",function(respons){
      $(container).html(respons);
    })
  }
</script>   
                  