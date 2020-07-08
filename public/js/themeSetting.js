// funcion que setea un determinado tema en el almacenamiento local
function setTheme(themeName) {
    localStorage.setItem('theme', themeName);
    document.documentElement.className = themeName;
} // Invocamos a la funcion que setea el tema en la carga inicial
(function () {
    themeName = localStorage.getItem('theme');
    if (themeName != null) {
        setTheme(themeName);
    } else {
        setTheme('theme-light');
    }
})();
