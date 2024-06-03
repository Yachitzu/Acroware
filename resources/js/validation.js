
function validatePassword(input) {
    input.value = input.value.replace(/[^A-Za-z0-9]/g, ''); // Elimina caracteres especiales
    input.value = input.value.slice(0, 20); // Limita la longitud a 20 caracteres
                        
    if (input.value.length < 8) {
        input.setCustomValidity("La contraseña debe tener al menos 8 caracteres.");
    } else if (input.value.length > 20) {
        input.setCustomValidity("La contraseña no puede tener más de 20 caracteres.");
    } else if (!/[A-Z]/.test(input.value)) {
        input.setCustomValidity("La contraseña debe contener al menos una letra mayúscula.");
    } else if (!/\d/.test(input.value)) {
        input.setCustomValidity("La contraseña debe contener al menos un número.");
    } else {
        input.setCustomValidity(""); // Restablece el mensaje de error personalizado
    }
}

function checkPasswordMatch() {
    var password = document.getElementById("passwordC").value;
    var confirmPassword = document.getElementById("conPasswordC").value;
    var errorDiv = document.getElementById("passwordMatchError");

    if (password !== confirmPassword) {
        errorDiv.style.display = "block";
        document.getElementById("conPasswordC").setCustomValidity("Las contraseñas no coinciden.");
    } else {
        errorDiv.style.display = "none";
        document.getElementById("conPasswordC").setCustomValidity("");
    }
}
