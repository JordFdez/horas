<!DOCTYPE html>
<html>
<head>
  <title>Ventana Modal</title>
  <style>
    /* Estilos para la ventana modal */
    .modal {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
      background-color: #fefefe;
      margin: 15% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
    }

    /* Estilos adicionales para cerrar la ventana modal */
    .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }

    .close:hover,
    .close:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
    }
  </style>
  <script>
    // Función para mostrar la ventana modal
    function showModal() {
        var modal = document.getElementById("myModal");
        modal.style.display = "block";
	    var form = document.getElementById('form1').reset(); //para borrar todos los datos que tenga los input, textareas, select.
       
    }

    // Función para cerrar la ventana modal
    function closeModal() {
      var modal = document.getElementById("myModal");
      modal.style.display = "none";
    }

    function enviarModal(){
        var modal = document.getElementById("myModal");
        modal.style.display = "none";
    }
   
  </script>
</head>
<body>
  <h2>Ventana Modal</h2>
  <button onclick="showModal()">Añadir</button>

  <!-- Ventana Modal -->
  <div id="myModal" class="modal">
    <!-- Contenido de la ventana modal -->
    <div class="modal-content">
      <span class="close" onclick="closeModal()">&times;</span>
        <form action="prueba1.php" method="GET" id="form1">
            Nombre: <input type="text" name="nombre"><br>
            <button type="submit" name="enviar" >Enviar</button>
        </form>
    </div>
  </div>
</body>
</html>
