function validarFormulario() {
    let identidad = document.getElementsByName('identidad')[0].value;
    let nombre = document.getElementsByName('nombre')[0].value;
    let ficha = document.getElementsByName('ficha')[0].value;
    let correo = document.getElementsByName('correo')[0].value;
    let celular = document.getElementsByName('celular')[0].value;
    let nivel = document.getElementsByName('nivel')[0].value;
    let programa = document.getElementsByName('programa')[0].value;
    let instructor = document.getElementsByName('instructor')[0].value;
    let productiva = document.getElementsByName('productiva')[0].value;
    let fechainicio = document.getElementsByName('fechainicio')[0].value;
    let fechacierre = document.getElementsByName('fechacierre')[0].value;
    let ciudad = document.getElementsByName('ciudad')[0].value;
    let direccem = document.getElementsByName('direccem')[0].value;
    let jefe = document.getElementsByName('jefe')[0].value;
    let celujefe = document.getElementsByName('celujefe')[0].value;
    let correjefe = document.getElementsByName('correjefe')[0].value;
    let alternativa = document.getElementsByName('alternativa')[0].value;

    // Validar que los campos no estén vacíos
    if (
        identidad === '' || nombre === '' || ficha === '' || correo === '' || celular === '' ||
        nivel === '' || programa === '' || instructor === '' || productiva === '' ||
        fechainicio === '' || fechacierre === '' || ciudad === '' || direccem === '' ||
        jefe === '' || celujefe === '' || correjefe === '' || alternativa === ''
    ) {
        mostrarMensaje('Por favor complete todos los campos.', 'alert-danger');
        return false;
    }

    // Validar que los campos de números solo contengan números
    if (!validarNumeros(identidad) || !validarNumeros(ficha) || !validarNumeros(celular) || !validarNumeros(celujefe) ) {
        mostrarMensaje('Por favor ingrese solo números en los campos correspondientes.', 'alert-danger');
        return false;
    }

    // Si todas las validaciones pasan, retorna true para enviar el formulario
    return true;
}

function validarNumeros(valor) {
    // Expresión regular que coincide con solo números
    let numerosRegex = /^[0-9]+$/;
    return numerosRegex.test(valor);
}

function mostrarMensaje(mensaje, clase) {
    // Agregar un div de alerta con la clase de Bootstrap y el mensaje proporcionado
    let divMensaje = document.createElement('div');
    divMensaje.className = 'alert ' + clase;
    divMensaje.textContent = mensaje;

    // Insertar el mensaje antes del formulario
    let formulario = document.getElementById('miFormulario');
    formulario.parentNode.insertBefore(divMensaje, formulario);
    
    // Después de 5 segundos, eliminar el mensaje
    setTimeout(function() {
        divMensaje.remove();
    }, 5000);
}

document.getElementById("miFormulario").addEventListener("submit", function(event) {
    // Llama a la función validarFormulario() al enviar el formulario
    if (!validarFormulario()) {
        event.preventDefault(); // Evita que se envíe el formulario si la validación falla
    }
});