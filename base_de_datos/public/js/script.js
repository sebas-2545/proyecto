// script.js

document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("btnLogin").addEventListener("click", function() {
        // Mostrar el formulario de login y ocultar el de registro
        document.getElementById("login").style.display = "block";
        document.getElementById("registrar").style.display = "none";
    });

    document.getElementById("btnRegistrar").addEventListener("click", function() {
        // Mostrar el formulario de registro y ocultar el de login
        document.getElementById("registrar").style.display = "block";
        document.getElementById("login").style.display = "none";
    });
});
