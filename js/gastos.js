var selectElement = document.getElementById('opciones');
var inputElement = document.getElementById('campo-input');

selectElement.addEventListener('change', function() {
  if (selectElement.value == 'DIETA') {
    inputElement.style.display = 'block';  // Mostrar el campo de entrada si se selecciona la opción 2
  } else {
    inputElement.style.display = 'none';   // Ocultar el campo de entrada para otras opciones seleccionadas
  }
});