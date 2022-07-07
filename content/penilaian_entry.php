<style>
.unsurpenilaian .btn{
  margin-left: 5px;
}
.unsur{
  background-color: #FFE6CC;
}
.unsur.active{
  background-color: #FFB76F;
  font-size: 2em;
}
</style>
<?php
  extract($_REQUEST);
  include("../inc/connection.inc");
  $tgl=(isset($curdate) && $curdate!="")?$curdate:date("Y-m-d",time());
  /*generate keterangan presensi*/
  $sqlket="select * from penilaian order by id asc";
  $qryket=mysqli_query($conn,$sqlket);
  
  $unsur="<span class='unsurpenilaian'>";
  $r=0;
  while($rket=mysqli_fetch_array($qryket)){
    $r++;
    $first=($r==1)?"unsur":"";
    $title=$rket["sub_kom"]."&#10;nilai max: ".$rket["nilai_max"].", durasi: ".($rket["durasi"]*60)." detik";
    $unsur.="<span class='btn btn-xs btn-flat $first' title='".$title."' subkom='".$rket["id"]."' nilai='".$rket["nilai_max"]."' durasi='".$rket["durasi"]."'>".$rket["kd_sub_kom"]."</span>";
  }
  $unsur.="</span>";
  
  /*list siswa*/
  $sql=("select mg.kd_rombel,rs.nis, sr.nama, sr.lp,
  group_concat(nil.item) subkom,group_concat(nil.nilai) nilai 
  from mapel_guru mg
  left join rombel_siswa rs on (rs.tahun=mg.tahun and rs.kd_rombel=mg.kd_rombel)
  left join siswa_ref sr on sr.nis=rs.nis
  left join nilai nil on (nil.nis=rs.nis and nil.tanggal='$tgl')
  where mg.id_mp_guru='$idmapelguru'
  group by sr.nis
  order by sr.nama");
  //echo($sql);
  $qry=mysqli_query($conn,$sql);
?>
<table class="table table-bordered table-hover" id="tbl_nilai_entry">
  <thead>
  <tr>
    <th>NOm</th>
    <th>NIS</th>
    <th>NAMA SISWA</th>
    <th>LP</th>
    <th>KETERANGAN</th>
    <th>REKAP</th>
  </tr>  
  </thead>
  <tbody>
<?php
  $no=0;
  $btn="<span class='btn btn-warning btn-flat btn-xs mulai'>Mulai</span>";
  while($rec=mysqli_fetch_array($qry)){
    $no++;
    echo("<tr class='barispresensi' dbnis='".$rec["nis"]."'>
      <td>$no</td>
      <td>".$rec["nis"]."</td>
      <td>".$rec["nama"]."</td>
      <td>".$rec["lp"]."</td>
      <td>$unsur</td>
      <td class='nilaiakhir'></td>
    </tr>");
  }
?>
</tbody>
</table> 

<script>
  $(document).ready(function(){
    //warnai_keterangan();
    $("#tbl_nilai_entry").DataTable();
  })

  //--- visualisasi button sesuai database ---
  function warnai_keterangan(){
    $("#tbl_pres_entry2").find("tr.barispresensi").each(function(){
      var baris=$(this);
      var dbket=baris.attr("dbket");
      baris.find(".ketpres").each(function(){
        var btn=$(this);
        btn.removeClass("active");
        if(btn.attr("btnket")==dbket)btn.addClass("active");
      })
    })
  }
  
  var btnunsur="";  
  var durunsur=0;
  var curdur=0; 
  var timer=false; 
  var tunda=false;
  var nilunsur=0;
  $("#tbl_nilai_entry").on("click",".unsur",function(){
    btnunsur=$(this);
    var subkom=btnunsur.attr("subkom");
    var nis=btnunsur.closest("tr").attr("dbnis");
    var mapelguru=$(document).find(".mapelguru option:selected").filter("[value!='']").val(); 
    nilunsur=btnunsur.attr("nilai");
    durunsur=eval(btnunsur.attr("durasi")*60);
    if(timer){
      //stop timer
      clearInterval(timer);
      timer=false;
      simpannilai(nis,subkom,nilai());
    }else{
      //timer runs
      curdur=durunsur;
      btnunsur.addClass("active");
      timer=setInterval(function(){
        curdur--;
        if(curdur<=0){
          //time over
          alert("Waktu habis.");
          clearInterval(timer);
          timer=false;
          simpannilai(nis,subkom,nilai());
        }
        btnunsur.text(curdur);
      },1000);
    }
    
    function nilai(){
      var nilaiunsur=eval(curdur/durunsur*nilunsur);
      return nilaiunsur.toFixed(2);
    }
    
    function nilaiakhir(){
      var nilmax=0;
      var nilperoleh=0;
      btnunsur.closest(".unsurpenilaian").find(".nil").each(function(){
        nilmax+=parseFloat($(this).attr("nilai"));
        nilperoleh+=parseFloat($(this).text());
      })
      return((nilperoleh/nilmax*100).toFixed(2));
    }
    
    function simpannilai(nis,item,nilai){
      var param="oper=nilai_entry&nis="+nis+"&item="+item+"&nilai="+nilai;
      $.post("inc/queriesnilai.php",param,function(hasil){
        btnunsur.html(nilai).removeClass("unsur active").addClass("btn-success nil");
        btnunsur.closest("tr").find(".nilaiakhir").html(nilaiakhir());
        btnunsur.next(".btn").addClass("unsur");//alert(hasil);
      })
    }
    /*   
    $.post("inc/queries.php","oper=pres_entry&keterangan="+ket+"&nis="+nis+"&mapelguru="+mapelguru,function(hasil){
      if(hasil>=1){
        if(hasil>1)alert("Update"); else alert("Save");//selanjutnya dapat dihilangkan
        btn.closest(".keterangan").find(".ketpres").removeClass("active");
        btn.addClass("active");
        btn.closest("tr").attr("dbket",ket);  //ada hubungannya dengan CSS
      }
    });*/
  })
  

</script>                      