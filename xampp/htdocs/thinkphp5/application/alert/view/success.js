Swal.fire({
    position: 'center',
    icon: 'success',
    title: '操作成功',
    showConfirmButton: false,
    timer: 1500
    }).then(() => {
        window.location.href = '<? echo $referer; ?>';
    });