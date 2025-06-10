function goBackOrFallback(fallbackUrl = 'index.php') {
    if (window.history.length > 1) {
        window.history.back();
    } else {
        window.location.href = fallbackUrl;
    }
}
document.querySelectorAll('.go-back-btn').forEach(function(el) {
    el.addEventListener('click', function () {
        goBackOrFallback('index.php'); // fallback nếu không có trang trước
    });
});