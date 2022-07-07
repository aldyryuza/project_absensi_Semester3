// ambil dulu elemen yang akan dicari 
var keywordmhs = document.getElementById('keywordmhs');
var carimhs = document.getElementById('carimhs');
var container = document.getElementById('containermhs');

carimhs.addEventListener('click' , function(){
    alert('berhasil!');
});

//ditambahkan event ketika keyword ditulis
keywordmhs.addEventListener('keyup', function(){
    
    // buat object AJAX
    var xhr = new XMLHttpRequest();

    // cek kesiapan AJAX
    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
            containermhs.innerHTML = xhr.responseText;
        }
    }


    // eksekusi AJAX
    xhr.open('GET', 'ajax/mahasiswa.php?keywordmhs=' +keywordmhs.value , true);
    xhr.send();
});