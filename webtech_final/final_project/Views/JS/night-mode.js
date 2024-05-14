function NightMode() {
    var isNightMode = document.body.classList.toggle('night-mode');
    localStorage.setItem('nightMode', isNightMode);
}

window.onload = function() {
    if (localStorage.getItem('nightMode') === 'true') {
        document.body.classList.add('night-mode');
    }
};