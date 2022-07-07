<div id="jiam"></div>
<?php
  include("../inc/connection.inc");
  $sqlket="select distinct tanggal from nilai order by tanggal desc";
  $qryket=mysqli_query($conn,$sqlket);
  
  $ket="<select class='form-control curdate'><option>--- Tanggal ---</option>";
  while($rket=mysqli_fetch_array($qryket)){
    $ket.="<option value='".$rket["tanggal"]."'>".$rket["tanggal"]."</option>";
  }
  $ket.="</select>";
  echo($ket);
?>
<script>
  setInterval(function() {
    var hari=["Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"];
    var tgl=new Date;
    var jam = hari[tgl.getDay()]+", "+tgl.getHours() + ":" + tgl.getMinutes() + ":" + tgl.getSeconds();
    $('#jiam').text(jam);
  }, 1000);
</script>                        