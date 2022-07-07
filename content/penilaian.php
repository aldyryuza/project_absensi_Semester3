<?php
  session_start();           //mengawali penggunaan session
  $guru=$_SESSION["s_guru"]; //dimuat pada index.php;
  $tahun=date("Y");          //tahun sekarang (untuk jadwal PBM) 
  
  include("../inc/connection.inc");
  $sql="select mg.id_mp_guru id, mg.kd_rombel, mg.kd_mapel, nama_mapel 
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
      <label class="col-sm-2 control-label">Rombel / Mapel</label>
      <div class="col-md-3">
        <select data-toggle="tooltip" title="Penilaian Praktikum per siswa" class="form-control mapelguru" 
        dok="content/penilaian_entry.php"><?php echo($mapel);?></select>
      </div>
      <div id="curdate" style="float: right;"><?php echo(date("l, Y-m-d",time()));?></div>
    </div>
    
    <div class="row">
      <div class="col-md-12">
        <hr />
        <div id="list"></div>
      </div>
    </div>  
  </div>
</div>
<div id="list"></div>

<script>
  var mapelguru="";
  var dok="";
  var curdate="";
  
  $(".mapelguru").change(function(){
    $(".mapelguru").not(this).val("");
    mapelguru=$(this).val();
    dok=$(this).attr("dok");
    var param="idmapelguru="+$(this).val()+"&curdate="+curdate;
    $.post(dok,param,function(respons){
      $("#list").html(respons);
    })
  })

  $(document).on("change",".curdate",function(){
    curdate=$(this).val();
    var param="idmapelguru="+mapelguru+"&curdate="+curdate;
    if(dok=="")return false;
    $.post(dok,param,function(respons){
      $("#list").html(respons);
    })
  })
  
  $('[data-toggle="tooltip"]').tooltip();

  $("#curdate").dblclick(function(){
    $.post("content/penilaian_tgl.php",function(respons){
      $("#curdate").html(respons);
    })
  })
  
  function countdown(durasi){
    setInterval(function(durasi) {
      var tgl=new Date;
      var jam = hari[tgl.getDay()]+", "+tgl.getHours() + ":" + tgl.getMinutes() + ":" + tgl.getSeconds();
      $('#jiam').text(jam);
    }, 1000);    
  }
</script>   
                  