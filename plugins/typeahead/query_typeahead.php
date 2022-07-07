
<?php
include_once("../../inc/connect.inc");

// Get search term
$searchTerm = $_GET['term'];
$key=$_GET["key"];
$arrData = array();
if(strlen($searchTerm)<3)return;

if($key=="nama"){
  $query = mysqli_query($conn,"SELECT ap.nik,ap.nama,rr.ranting,ai.id_anggota
  from anggota_person ap 
  left join anggota_iphi ai on ai.nik=ap.nik
  left join ref_ranting rr on rr.kd_ranting=ai.ranting
  WHERE (ap.nama LIKE '%".$searchTerm."%'
  or ap.nik LIKE '%".$searchTerm."%')
  ORDER BY ap.nama ASC");
  while($row = mysqli_fetch_array($query)){
    $data['value'] = $row['nama']." (".$row['ranting'].")";
    $data['nik'] = $row['nik'];
    $data['nama'] = $row['nama'];
    $data['idanggota'] = $row['id_anggota'];
    array_push($arrData, $data);
  }
}

if($key=="nik"){
  $query = mysqli_query($conn,"SELECT ap.nik,ap.nama
  from anggota_person ap 
  WHERE (ap.nik LIKE '%".$searchTerm."%' || ap.nama LIKE '%".$searchTerm."%')
  ORDER BY ap.nik ASC");
  while($row = mysqli_fetch_array($query)){
    $data['value'] = $row['nik']." (".$row['nama'].")";
    $data['nik'] = $row['nik'];
    array_push($arrData, $data);
  }
}

if($key=="kota"){
  $query = mysqli_query($conn,"SELECT distinct(ap.tmp_lahir) kota
  from anggota_person ap 
  WHERE ap.tmp_lahir LIKE '%".$searchTerm."%'
  UNION ALL
  SELECT distinct(ap.alamat_kec) kota
  from anggota_person ap 
  WHERE ap.alamat_kec LIKE '%".$searchTerm."%'
  ");
  while($row = mysqli_fetch_array($query)){
    $data['value'] = $row['kota'];
    array_push($arrData, $data);
  }
}

if($key=="kegiatan"){
  $query = mysqli_query($conn,"SELECT id_kegiatan, tgl_kegiatan,nama_kegiatan
  from kegiatan 
  WHERE nama_kegiatan LIKE '%".$searchTerm."%'
  ");
  while($row = mysqli_fetch_array($query)){
    $data['value'] = $row['tgl_kegiatan']." - ".$row['nama_kegiatan'];
    $data['nama'] = $row['nama_kegiatan'];
    $data['id'] = $row['id_kegiatan'];
    array_push($arrData, $data);
  }
}
// Return results as json encoded array
echo json_encode($arrData);

?>