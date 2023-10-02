window.addEventListener('online', () => {
    document.querySelector('#offline').style.opacity = '0';
});

window.addEventListener('offline', () => {
    document.querySelector('#offline').style.opacity = '1';
});