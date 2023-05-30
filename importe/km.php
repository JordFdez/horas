<?php

session_start();
include("../include/bbddconexion.php");

if (!$conn) {
    die("Conexion fallida:" . mysqli_connect_error());
} else {

    include("../template/formularios.php");
    print
        '<span> Importe KM | Añadir </span>
        <form action="add_km_tabla.php" method="GET">

            <hr><br>
            
            <br><input type="text" name="importe" placeholder="Importe km" ><br>
            <br><hr><br>

            <input type="submit" class="boton" name="add" value="Añadir">
            <input type="submit" class="boton" name="close" value="Cerrar">
        </form>
    </div>

</body>

</html>';
}
