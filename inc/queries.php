<?php
include("../functions.php");
extract($_REQUEST);
switch ($oper) {
  case "pres_entry":
    $tgl = date('Y-m-d', time());
    $wkt = date('h:i:s', time());
    $sqli = ("insert into presensi values('','$tgl','$wkt','$nis','$keterangan','$mapelguru')
              on duplicate key update kd_pres='$keterangan'");
    $sqld = ("delete from presensi where nis='$nis' and tanggal='$tgl' and id_mp_guru='$mapelguru'");
    //$sql=($keterangan=="h")?$sqld:$sqli;
    $sql = $sqli;
    //die($sql);
    break;
  case "pres_entry_massal":
    $sql = ("insert into presensi values $valgroup
              on duplicate key update tanggal=values(tanggal),waktu=values(waktu),kd_pres=values(kd_pres)");
    //die($sql);
    break;

  case "siswa_new":
    $sql = ("insert into siswa_ref values('$nis','$nama','$jkel','$tmp_lahir','$tgl_lahir')");
    break;
  case "siswa_upd":
    $sql = ("update siswa_ref set nama='$nama',lp='$jkel',tmp_lahir='$tmp_lahir',tgl_lahir='$tgl_lahir'
            where nis='$nis'");
    break;
  case "siswa_del":
    $sql = ("delete from siswa_ref where nis='$nis'");
    break;
}
$qry = mysqli_query($conn, $sql);
$cek = mysqli_affected_rows($conn);
echo ($cek);
