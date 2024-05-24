document.addEventListener("DOMContentLoaded", function() {
    let warningTime = 120000;  // 1 minuto para el aviso
    let signOutTime = 180000; // 2 minutos para cerrar sesión

    let timeLeft = warningTime; // Tiempo restante que se irá reduciendo
    let warningTimeout = setTimeout(showWarning, warningTime);
    let signOutTimeout = setTimeout(logout, signOutTime);
    let countdownInterval; // Intervalo para el contador regresivo

    function resetTimer() {
        clearTimeout(warningTimeout);
        clearTimeout(signOutTimeout);
        clearInterval(countdownInterval);
        timeLeft = warningTime;
        warningTimeout = setTimeout(showWarning, warningTime);
        signOutTimeout = setTimeout(logout, signOutTime);
    }

    function showWarning() {
        console.log('Mostrando advertencia');  // Para depuración
        var alertBox = document.createElement('div');
        alertBox.style.position = 'fixed';
        alertBox.style.left = '0';
        alertBox.style.bottom = '0';
        alertBox.style.width = '100%';
        alertBox.style.backgroundColor = 'green';
        alertBox.style.color = 'white';
        alertBox.style.textAlign = 'center';
        alertBox.style.padding = '10px';
        alertBox.style.fontSize = '16px';
        document.body.appendChild(alertBox);

        countdownInterval = setInterval(function() {
            if (timeLeft <= 0) {
                clearInterval(countdownInterval);
                document.body.removeChild(alertBox);
            } else {
                timeLeft -= 1000;
                alertBox.textContent = 'Tu sesión está a punto de expirar por inactividad en ' + (timeLeft / 1000) + ' segundos. Por favor, realiza alguna acción.';
            }
        }, 1000);

        // Asegurarse de que el mensaje se elimina cuando expira el tiempo
        setTimeout(function() {
            if (alertBox.parentNode) {
                document.body.removeChild(alertBox);
            }
            clearInterval(countdownInterval);
        }, timeLeft);
    }

    function logout() {
        alert('Su sesión fue cerrada por inactividad. Por eso vuelve a iniciar sesión.');
        window.location.href = 'logout.php';
    }

    window.onload = resetTimer;
    window.onmousemove = resetTimer;
    window.onmousedown = resetTimer;
    window.ontouchstart = resetTimer;
    window.onclick = resetTimer;
    window.onkeypress = resetTimer;
});
