/* LabFrontEnd-SamsungDes -> Laura Toledo Gutiérrez. */

//const inputs = document.querySelectorAll('.form-group #formulario input');
const formulario = document.querySelector('form');
const inputs = formulario.querySelectorAll('input');
/* Función llamada al pulsar el botón 'Enviar' de nuestro formulario */
function validar() {
  /* Recuperamos los valores y elementos HTML correspondientes con 'document.getElementById' */
  var nombre = document.getElementById("nombre").value;
  var apellido1 = document.getElementById("apellido1").value;
  var apellido2 = document.getElementById("apellido2").value;
  var email = document.getElementById("email").value;
  var login = document.getElementById("login").value;
  var password = document.getElementById("password").value;

  var errorN = document.getElementById("errorN");
  var errorA1 = document.getElementById("errorA1");
  var errorA2 = document.getElementById("errorA2");
  var errorE = document.getElementById("errorE");
  var errorL = document.getElementById("errorL");
  var errorP = document.getElementById("errorP");

  var input = document.getElementById("nombre");
  var inputA1 = document.getElementById("apellido1");
  var inputA2 = document.getElementById("apellido2");
  var inputE = document.getElementById("email");
  var inputL = document.getElementById("login");
  var inputP = document.getElementById("password");

  /* Llamadas a las funciones para validar los campos del formulario */
  validateNameApellido(input, errorN, nombre);
  validateNameApellido(inputA1, errorA1, apellido1);
  validateNameApellido(inputA2, errorA2, apellido2);
  validateEmail(inputE, errorE, email);
  validateLogin(inputL,errorL, login);
  validatePassword1(inputP, errorP, password);
}

/* Función para validar el email usando expresiones regulares */
function validateEmailType(email) {
  var exprReg = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return exprReg.test(email);
}

/* Función para validar la contraseña, validar que tenga una longitud de más de 8 caracteres */
function validatePassword(password) {
  if (password.length >= 8) {
    return true;
  } else {
    return false;
  }
}

/* Función para indicar que el input es inválido, introducimos el elemento de entrada (input), elemento de error (error) y el mensaje de error (errorMessage) */
function invalidateInput(input, error, errorMessage) {
  /* Asigna el mensaje de error al contenido del elemento de error */
  error.textContent = errorMessage;
  /* Agrega la clase 'error' al elemento de error */
  error.classList.add("error");
  /* Elimina la clase 'input-valid' del elemento de entrada y agrega la clase 'input-invalid' */
  input.classList.remove("input-valid");
  input.classList.add("input-invalid");
  /* Establece el estilo 'display' del elemento de entrada como 'inline-block' */
  input.style.display = "inline-block";
}

/* Función para indicar que el input es validado, introducimos el elemento de entrada (input), elemento de error (error) y el mensaje de error (errorMessage) */
function validateInput(input, error, errorMessage) {
  /* Asigna el mensaje de error al contenido del elemento de error */
  error.textContent = errorMessage;
  /* Elimina la clase 'error' al elemento de error */
  error.classList.remove("error");
  /* Elimina la clase 'input-invalid' del elemento de entrada y agrega la clase 'input-valid' */
  input.classList.remove("input-invalid");
  input.classList.add("input-valid");
  /* Establece el estilo 'display' del elemento de entrada como 'inline-block' */
  input.style.display = "inline-block";
}

/* Función para validar el campo Nombre del formulario */
function validateNameApellido(input, error, nombre) {
  /* Controla si el campo está vacío */
  if (nombre === "") {
    /* Si está vacío llama a la función para invalidar ese campo */
    invalidateInput(input, error, "Rellene este campo");
    /* Controla si el nombre contiene un número o dígitos */
  } else if (!isNaN(nombre) || /\d/.test(nombre)) {
    /* Llama a la función para invalidar ese campo si el nombre contiene un número o dígitos */
    invalidateInput(input, error, "El nombre/apellidos solo puede contener caracteres alfabéticos");
    /* Si el nombre es válido (no está vacío y solo tiene caracteres alfabéticos) */
  } else {
    /* Llama a la función para validar el campo */
    validateInput(input, error, " ");
  }
}

/* Función para validar el campo Email del formulario */
function validateEmail(input, error, email) {
  /* Controla si el campo está vacío */
  if (email === "") {
    /* Si está vacío llama a la función para invalidar ese campo */
    invalidateInput(input, error, "Rellene este campo");
    /* Controla llamando a la función 'validateEmailType' si el formato del email es válido, devuelve false si es inválido */
  } else if (!validateEmailType(input.value)) {
    /* Llama a la función para invalidar el campo si el formato es erróneo */
    invalidateInput(input, error, "Email inválido");
    /* Si el email es válido (no está vacío y tiene el formato correcto) */
  } else {
    /* Llama a la función para validar el campo */
    validateInput(input, error, " ");
  }
}
/* Función para validar el campo Login del formulario */
function validateLogin(input, error, login){
    /* Controla si el campo esta vací */
    if (login===""){
        invalidateInput(input, error, "Rellene este campo");
    }else{
        /* Llama a la función para validar el campo */
        validateInput(input, error, "");
    }
}

/* Función para validar el campo Clave del formulario */
function validatePassword1(input, error, password) {
  /* Controla si el campo está vacío */
  if (password === "") {
    /* Si está vacío llama a la función para invalidar ese campo */
    invalidateInput(input, error, "Rellene este campo");
    /* Controla llamando a la función 'validatePassword' si el formato de la clave es válido, devuelve false si es inválido */
  } else if (!validatePassword(input.value)) {
    /* Llama a la función para invalidar el campo si el formato es erróneo */
    invalidateInput(input, error, "Debe tener más de 8 caracteres");
    /* Si la clave es válida (no está vacía y tiene el formato correcto) */
  } else {
    /* Llama a la función para validar el campo */
    validateInput(input, error, " ");
  }
}

/* Valida los campos del formulario de registro, haciendo uso de un evento que es capturado cuando se produce un cambio en algun campo del formulario */
const validarFormulario = (e) => {
    switch (e.target.name) {
      case "nombre":
        var errorN = document.getElementById("errorN");
        var inputNombre = document.getElementById("nombre");
        var valorNombre = inputNombre.value;
        validateNameApellido(inputNombre, errorN, valorNombre);
        break;
      case "apellido1":
        var errorA1 = document.getElementById("errorA1");
        var inputApellido1 = document.getElementById("apellido1");
        var valorApellido1 = inputApellido1.value;
        validateNameApellido(inputApellido1, errorA1, valorApellido1);
        break;
      case "apellido2":
        var errorA2 = document.getElementById("errorA2");
        var inputApellido2 = document.getElementById("apellido2");
        var valorApellido2 = inputApellido2.value;
        validateNameApellido(inputApellido2, errorA2, valorApellido2);
        break;
      case "email":
        var errorE = document.getElementById("errorE");
        var inputEmail = document.getElementById("email");
        var valorEmail = inputEmail.value;
        validateEmail(inputEmail, errorE, valorEmail);
        break;
      case "login":
        var errorL = document.getElementById("errorL");
        var inputLogin = document.getElementById("login");
        var valorLogin = inputLogin.value;
        validateLogin(inputLogin, errorL, valorLogin);
        break;
      case "password":
        var errorP = document.getElementById("errorP");
        var inputPassword = document.getElementById("password");
        var valorPassword = inputPassword.value;
        validatePassword1(inputPassword, errorP, valorPassword);
        break;
    }
  }
  
/* Agregamos los eventos a cada elemento del arreglo de inputs, cada vez que ocurra alguno de estos eventos, se llamará a la función 'validarFormulario' */
inputs.forEach((input) => {
  input.addEventListener("blur", validarFormulario);
  input.addEventListener("keyup", validarFormulario);
});

