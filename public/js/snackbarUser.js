document.addEventListener('DOMContentLoaded', function () {
    const alert = document.querySelector('.alert');
    if (alert) {
        setTimeout(() => {
            alert.classList.remove('show');
            alert.classList.add('fade');
            setTimeout(() => {
                alert.remove(); // Menghapus elemen dari DOM
            }, 150); // Waktu tambahan untuk menyelesaikan animasi fade
        }, 3000); // Alert hilang otomatis setelah 3 detik
    }
});