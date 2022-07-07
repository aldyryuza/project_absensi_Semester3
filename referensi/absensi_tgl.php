<?php
  include("../inc/connection.inc");
  $sqlket="select distinct tanggal as tglabsen from presensi order by tanggal desc";
  $qryket=mysqli_query($conn,$sqlket);
  
  $ket="<select class='form-control' id='tglabsensi' data-toggle='tooltip' title='Tanggal Absensi'>";
  $ket.="<option value=''>--- tanggal ---</option>";
  while($rket=mysqli_fetch_array($qryket)){
    $tanggal=date("d F Y",strtotime($rket["tglabsen"]));
    $ket.="<option value='".$rket["tglabsen"]."'>".$tanggal."</option>";
  }
  $ket.="</select>";
  echo($ket);
?>                       