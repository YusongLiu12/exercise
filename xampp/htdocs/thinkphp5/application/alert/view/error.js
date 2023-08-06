Swal.fire({
    position: 'center',
    icon: 'error',
    title: '操作失败',
    text: "<? echo $message; ?>",
    showConfirmButton: true
}).then(() => {
    window.history.back();
});