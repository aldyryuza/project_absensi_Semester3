<?php

// koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'presensi_hamid'); //mysqli_connect("localhost","root","","absensi");
// echo '<pre>';
// print_r($conn);die;
extract($_REQUEST);
// ****************************    SELECT * FROM     ****************************

$siswa = query("select * from siswa_ref ");
// $siswa1 = query("select * from siswa_ref where lp= '$filter' ");
$guru = query("select * from guru_ref ");
$mapel = query("select * from mapel_ref ");
$mapel_guru = query("select * from mapel_guru ");
$presensi_ref = query("select * from presensi_ref");
$rombel_ref = query("select * from rombel_ref ");
$filter = query("select * from presensi");
$rombel_sis = query("select * from rombel_siswa");
$user = query("SELECT * from user");
$rombel9a = query("SELECT siswa_ref.nama, siswa_ref.nis, rombel_siswa.kd_rombel FROM siswa_ref INNER JOIN rombel_siswa ON siswa_ref.nis = rombel_siswa.nis WHERE kd_rombel='9A'AND tahun = 2019");

// ****************************  EMD  SELECT * FROM     **************************

// ****************************    MENGHITUNG COUNT     ****************************

// menghitung jumlah Siswa
$getsiswa = mysqli_query($conn, "select * from siswa_ref ");
$count1 = mysqli_num_rows($getsiswa);

// menghitung jumlah Guru
$getguru = mysqli_query($conn, "select * from guru_ref ");
$count2 = mysqli_num_rows($getguru);

// menghitung jumlah Matkul
$getmapel = mysqli_query($conn, "select * from mapel_ref ");
$count3 = mysqli_num_rows($getmapel);

// menghitung jumlah Matkul
$getrombel = mysqli_query($conn, "select * from rombel_ref ");
$count4 = mysqli_num_rows($getrombel);

// menghitung siswa 9A
$getrombel9a = mysqli_query($conn, "SELECT siswa_ref.nama, siswa_ref.nis, rombel_siswa.kd_rombel FROM siswa_ref INNER JOIN rombel_siswa ON siswa_ref.nis = rombel_siswa.nis WHERE kd_rombel='9A'AND tahun = 2019");
$count9a = mysqli_num_rows($getrombel9a);

// **************************      END MENGHITUNG COUNT     **************************

function query($query)   // Functions mysqli_querry
{

    global $conn;

    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}



//  =================================================================================
// tambah data siswa
if (isset($_POST["submit"])) {
    // ambil data dari tiap element dalam form
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $lp = $_POST['lp'];
    $tmp_lahir = $_POST['tmp_lahir'];
    $tgl_lahir = $_POST['tgl_lahir'];


    //query insert data
    $query = "INSERT INTO `siswa_ref` (`nis`, `nama`, `lp`, `tmp_lahir`, `tgl_lahir`)
   VALUES ('$nis', '$nama', '$lp', '$tmp_lahir', '$tgl_lahir')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
};
//Update siswa
if (isset($_POST["editmahasiswa"])) {
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $lp = $_POST['lp'];
    $tmp_lahir = $_POST['tmp_lahir'];
    $tgl_lahir = $_POST['tgl_lahir'];

    $update = mysqli_query($conn, "UPDATE siswa_ref SET 
   nis = '$nis',
   nama = '$nama',
   lp = '$lp',
   tmp_lahir = '$tmp_lahir',
   tgl_lahir = '$tgl_lahir'
   

   WHERE nis = '$nis'");

    mysqli_query($conn, $update);

    return mysqli_affected_rows($conn);
};
// fungsi hapus data siswa
if (isset($_POST["hapusmahasiswa"])) {

    $nis = $_POST['nis'];


    $delete = mysqli_query($conn, "DELETE FROM `siswa_ref` WHERE `siswa_ref`.`nis` = '$nis'");

    mysqli_query($conn, $delete);
    //  echo '<prev>';
    //  print_r($_POST);
    //  die;
    return mysqli_affected_rows($conn);
};
//  =================================================================================

// tambah guru
if (isset($_POST["tambahguru"])) {
    // ambil data dari tiap element dalam form
    $kd_guru = $_POST['kd_guru'];
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];




    //query insert data
    $query = "INSERT INTO `guru_ref` (`kd_guru`, `nip`, `nama`)
   VALUES ('$kd_guru', '$nip', '$nama')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
};
//  Update Guru_ref
if (isset($_POST["editguru"])) {
    $kd_guru = $_POST['kd_guru'];
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];


    $updateguru = mysqli_query($conn, "UPDATE guru_ref SET 
   kd_guru = '$kd_guru',
   nip = '$nip',
   nama = '$nama'


   WHERE kd_guru = '$kd_guru'");

    mysqli_query($conn, $updateguru);


    return mysqli_affected_rows($conn);
};
// hapus data guru_ref
if (isset($_POST["hapusguru"])) {

    $kd_guru = $_POST['kd_guru'];


    $delete = mysqli_query($conn, "DELETE FROM `guru_ref` WHERE `guru_ref`.`kd_guru` = '$kd_guru'");

    mysqli_query($conn, $delete);

    return mysqli_affected_rows($conn);
};
//  =================================================================================

// tambah mapel
if (isset($_POST["tambahmapel"])) {
    // ambil data dari tiap element dalam form
    $kd_mapel = $_POST['kd_mapel'];
    $nama_mapel = $_POST['nama_mapel'];




    //query insert data
    $query = "INSERT INTO `mapel_ref` (`kd_mapel`, `nama_mapel`)
   VALUES ('$kd_mapel', '$nama_mapel')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
};
//  Update Mapel_ref
if (isset($_POST["editmapel"])) {
    $kd_mapel = $_POST['kd_mapel'];
    $nama_mapel = $_POST['nama_mapel'];


    $updatemapel = mysqli_query($conn, "UPDATE mapel_ref SET 
   kd_mapel = '$kd_mapel',
   nama_mapel = '$nama_mapel'


   WHERE kd_mapel = '$kd_mapel'");

    // mysqli_query($conn, $updatemapel);
    if ($updatemapel == 1) {
        echo "
        <script>
        alert('data berhasil diubah !');
        </script>
        ";
    } else {
        echo "
        <script>
        alert('data tidak berhasil diubah !');
        </script>
        ";
    }


    return mysqli_affected_rows($conn);
};
// fungsi hapus data mapel
if (isset($_POST["hapusmapel"])) {

    $kd_mapel = $_POST['kd_mapel'];


    $delete = mysqli_query($conn, "DELETE FROM `mapel_ref` WHERE `mapel_ref`.`kd_mapel` = '$kd_mapel'");

    mysqli_query($conn, $delete);

    return mysqli_affected_rows($conn);
};


//  =================================================================================

// tambah rombel_ref
if (isset($_POST["tambahrombel"])) {
    // ambil data dari tiap element dalam form
    $kd_rombel = $_POST['kd_rombel'];
    $nama_rombel = $_POST['nama_rombel'];
    $tingkat = $_POST['tingkat'];




    //query insert data
    $query = "INSERT INTO `rombel_ref` (`kd_rombel`, `nama_rombel` , `tingkat`)
   VALUES ('$kd_rombel', '$nama_rombel' ,'$tingkat')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
};
//  Update rombel_ref
if (isset($_POST["editrombel"])) {
    $kd_rombel = $_POST['kd_rombel'];
    $nama_rombel = $_POST['nama_rombel'];
    $tingkat = $_POST['tingkat'];


    $updaterombel = mysqli_query($conn, "UPDATE rombel_ref SET 
   kd_rombel = '$kd_rombel',
   nama_rombel = '$nama_rombel',
   tingkat = '$tingkat'


   WHERE kd_rombel = '$kd_rombel'");

    mysqli_query($conn, $updaterombel);


    return mysqli_affected_rows($conn);
};
// fungsi hapus data rombel
if (isset($_POST["hapusrombel"])) {

    $kd_rombel = $_POST['kd_rombel'];


    $delete = mysqli_query($conn, "DELETE FROM `rombel_ref` WHERE `rombel_ref`.`kd_rombel` = '$kd_rombel'");

    mysqli_query($conn, $delete);

    return mysqli_affected_rows($conn);
};


//  =================================================================================

// tambah mapel_guru
if (isset($_POST["tambahmapelguru"])) {
    // ambil data dari tiap element dalam form
    $id_mp_guru = $_POST['id_mp_guru'];
    $tahun = $_POST['tahun'];
    $kd_rombel = $_POST['kd_rombel'];
    $kd_mapel = $_POST['kd_mapel'];
    $kd_guru = $_POST['kd_guru'];




    //query insert data
    $query = "INSERT INTO `mapel_guru` (`id_mp_guru`, `tahun`, `kd_rombel`, `kd_mapel`, `kd_guru`)
   VALUES (NULL, '$tahun' ,'$kd_rombel','$kd_mapel','$kd_guru')";
    mysqli_query($conn, $query);
    // echo '<prev>';
    // print_r($_POST);
    // die;
    return mysqli_affected_rows($conn);
};
//  Update mapel_guru
if (isset($_POST["editmapelguru"])) {
    $id_mp_guru = $_POST['id_mp_guru'];
    $tahun = $_POST['tahun'];
    $kd_rombel = $_POST['kd_rombel'];
    $kd_mapel = $_POST['kd_mapel'];
    $kd_guru = $_POST['kd_guru'];


    $update = mysqli_query($conn, "UPDATE mapel_guru SET 
   tahun = '$tahun',
   kd_rombel = '$kd_rombel',
   kd_mapel = '$kd_mapel',
   kd_guru = '$kd_guru'


   WHERE id_mp_guru = '$id_mp_guru'");

    mysqli_query($conn, $update);


    return mysqli_affected_rows($conn);
};
// fungsi hapus data mapel_guru
if (isset($_POST["hapusmapelguru"])) {

    $id_mp_guru = $_POST['id_mp_guru'];


    $delete = mysqli_query($conn, "DELETE FROM `mapel_guru` WHERE `mapel_guru`.`id_mp_guru` = '$id_mp_guru'");

    mysqli_query($conn, $delete);

    return mysqli_affected_rows($conn);
};


//  =================================================================================

// tambah presensi_ref
if (isset($_POST["tambahpresensiref"])) {
    // ambil data dari tiap element dalam form
    $kd_pres = $_POST['kd_pres'];
    $keterangan = $_POST['keterangan'];
    $deskripsi = $_POST['deskripsi'];
    $prioritas = $_POST['prioritas'];





    //query insert data
    $query = "INSERT INTO `presensi_ref` (`kd_pres`, `keterangan`, `deskripsi`, `prioritas`)
   VALUES ('$kd_pres', '$keterangan' ,'$deskripsi','$prioritas')";
    mysqli_query($conn, $query);
    // echo '<prev>';
    // print_r($_POST);
    // die;
    return mysqli_affected_rows($conn);
};
//  Update presensi_ref
if (isset($_POST["editpresensiref"])) {
    $kd_pres = $_POST['kd_pres'];
    $keterangan = $_POST['keterangan'];
    $deskripsi = $_POST['deskripsi'];
    $prioritas = $_POST['prioritas'];



    $update = mysqli_query($conn, "UPDATE presensi_ref SET 
   kd_pres = '$kd_pres',
   keterangan = '$keterangan',
   deskripsi = '$deskripsi',
   prioritas = '$prioritas'


   WHERE kd_pres = '$kd_pres'");

    mysqli_query($conn, $update);


    return mysqli_affected_rows($conn);
};
// fungsi hapus data presensi_ref
if (isset($_POST["hapuspresensiref"])) {

    $kd_pres = $_POST['kd_pres'];


    $delete = mysqli_query($conn, "DELETE FROM `presensi_ref` WHERE `presensi_ref`.`kd_pres` = '$kd_pres'");

    mysqli_query($conn, $delete);

    return mysqli_affected_rows($conn);
};


//  =================================================================================

if (isset($_POST["hapus_user"])) {

    $id_user = $_POST['id_user'];


    $delete = mysqli_query($conn, "DELETE FROM `user` WHERE `user`.`id_user` = '$id_user'");

    mysqli_query($conn, $delete);

    return mysqli_affected_rows($conn);
};
















function registrasi($data)
{
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);
    $level = $_POST["level"];

    // print_r($level);
    // die;

    $result = mysqli_query($conn, "SELECT  * from user where username = '$username'");


    if (mysqli_fetch_assoc($result)) {
        echo 'username sudah terdaftar';
        return false;
    }

    //cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
        alert('Password tidak sesuai!');
        </script>";

        return false;
    }
    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan user baru ke database
    mysqli_query($conn, " INSERT INTO user value ('','$username', '$password' , '$level') ");
}


// fungsi untuk mencari
// function carimhs($keywordmhs){
//     $query = "SELECT * FROM mahasiswa 
//                     WHERE  
//                     nim LIKE '%$keywordmhs%' OR 
//                     kode_kelas LIKE '%$keywordmhs%' OR 
//                     nama_mahasiswa LIKE '%$keywordmhs%' OR 
//                     tanggal_lahir LIKE '%$keywordmhs%' OR
//                     ttl LIKE '%$keywordmhs%' OR 
//                     jenis_kelamin LIKE '%$keywordmhs%' OR
//                     agama LIKE '%$keywordmhs%' OR 
//                     alamat LIKE '%$keywordmhs%'
//                     ";
//     return query($query);

// }
//fungsi untuk mencari data dosen
// function caridos($keyworddos){
//     $query = "SELECT * FROM dosen
//                     WHERE  
//                     id_dosen LIKE '%$keyworddos%' OR 
//                     nip LIKE '%$keyworddos%' OR 
//                     nama_dosen LIKE '%$keyworddos%' OR 
//                     username LIKE '%$keyworddos%'
                    
//                     ";
//     return query($query);

// }
