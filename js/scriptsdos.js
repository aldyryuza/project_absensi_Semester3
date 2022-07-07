// ambil dulu elemen yang akan dicari 
var keyworddos = document.getElementById('keyworddos');
var carimhs = document.getElementById('caridos');
var container = document.getElementById('containerdos');

carimhs.addEventListener('click' , function(){
    alert('berhasil!');
});

//ditambahkan event ketika keyword ditulis
keyworddos.addEventListener('keyup', function(){
    
    // buat object AJAX
    var xhr = new XMLHttpRequest();

    // cek kesiapan AJAX
    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
            containermhs.innerHTML = xhr.responseText;
        }
    }


    // eksekusi AJAX
    xhr.open('GET', 'ajax/dosen.php?keyworddos=' +keyworddos.value , true);
    xhr.send();
});