const flashData = $('.flash-data').data('flashdata');
if(flashData)
{
    if(flashData == "error")
    {
        swal.fire({
            icon: 'error',
            title: 'Data sudah terdapat dalam basis data!',
            text: '',
            type: 'error'
        });
    }
    else if(flashData == "error_choose")
    {
        swal.fire({
            icon: 'error',
            title: 'Pilih data terlebih dahulu!',
            text: '',
            type: 'error'
        });
    }
    else if(flashData == "error_found")
    {
        swal.fire({
            icon: 'error',
            title: 'Data tidak ditemukan!',
            text: '',
            type: 'error'
        });
    }
    else if(flashData == "error_required")
    {
        swal.fire({
            icon: 'error',
            title: 'Isi semua data dengan benar!',
            text: '',
            type: 'error'
        });
    }
    else if(flashData == "error_kode")
    {
        swal.fire({
            icon: 'error',
            title: 'Kode Alat sudah terdapat dalam basis data!',
            text: '',
            type: 'error'
        });
    }
    else if(flashData == "error_passlast")
    {
        swal.fire({
            icon: 'error',
            title: 'Password lama yang dimasukkan salah!',
            text: '',
            type: 'error'
        });
    }
    else if(flashData == "error_sent")
    {
        swal.fire({
            icon: 'error',
            title: 'Pilih untuk item yang akan disetujui!',
            text: '',
            type: 'error'
        });
    }
    else if(flashData == "error_tolak")
    {
        swal.fire({
            icon: 'error',
            title: 'Pilih untuk item yang akan ditolak!',
            text: '',
            type: 'error'
        });
    }
    else if(flashData == "genqrcode")
    {
        swal.fire({
            icon: 'success',
            title: 'Data QR Code berhasil di generate!',
            text: '',
            type: 'success'
        });
    }
    else if(flashData == "npk_required")
    {
        swal.fire({
            icon: 'error',
            title: 'Isi NPK yang akan dicari!',
            text: '',
            type: 'error'
        });
    }
    else if(flashData == "npk_notfound")
    {
        swal.fire({
            icon: 'error',
            title: 'NPK yang dicari tidak ditemukan!',
            text: '',
            type: 'error'
        });
    }
    else if(flashData)
    {
        swal.fire({
            icon: 'success',
            title: 'Data berhasil di'+flashData,
            text: '',
            type: 'success'
        });
    }
}

$('.tombol-hapus').on('click', function(e){
    e.preventDefault();
    const href=$(this).attr('href');

    swal.fire({
        title: 'Apakah anda yakin',
        text: 'data akan dihapus?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus Data!'
    }).then((result) => {
        if(result.value)
        {
            document.location.href = href; 
        }
    })
});

$('.tombol-hapuson').on('click', function(e){
    e.preventDefault();
    const href=$(this).attr('href');

    swal.fire({
        title: 'Apakah anda yakin',
        text: 'data di non-aktifkan?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Non Active!'
    }).then((result) => {
        if(result.value)
        {
            document.location.href = href; 
        }
    })
});

$('.tombol-hapusoff').on('click', function(e){
    e.preventDefault();
    const href=$(this).attr('href');

    swal.fire({
        title: 'Apakah anda yakin',
        text: 'data diaktifkan?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Active!'
    }).then((result) => {
        if(result.value)
        {
            document.location.href = href; 
        }
    })
});

$('.beranda-konfir').on('click', function(e){
    e.preventDefault();
    const href=$(this).attr('href');

    swal.fire({
        title: 'Apakah anda yakin',
        text: 'data akan disetujui?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Setujui Data!'
    }).then((result) => {
        if(result.value)
        {
            document.location.href = href; 
        }
    })
});

$('.tombol-resetpass').on('click', function(e){
    e.preventDefault();
    const href=$(this).attr('href');

    swal.fire({
        title: 'Apakah anda yakin',
        text: 'kata sandi di reset?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Reset Data',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if(result.value)
        {
            document.location.href = href; 
        }
    })
});

$('.tombol-forgetpass').on('click', function(e){
    e.preventDefault();
    const href=$(this).attr('href');

    swal.fire({
        title: 'Lupa Password?',
        text: 'Mohon untuk dapat konfirmasi ke tim GA (General Affairs). Terimakasih!',
        type: 'questions'
    }).then((result) => {
        if(result.value)
        {
            document.location.href = href; 
        }
    })
});