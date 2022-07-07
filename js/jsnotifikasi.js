const notifikasi = $('.info-data').data('infodata');
if(notifikasi == "Disimpan" || notifikasi == "Dihapus"){
    Swal.fire({
        icon: 'success',
        title: 'success',
        text: 'Berhasil di simpan'+notifikasi,

    })

}else if(notifikasi == "Gagal" || notifikasi == "Gagal Dihapus"){

}else if(notifikasi == "Kosong"){

}

