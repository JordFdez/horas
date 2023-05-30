<?php

session_start();
include("../include/bbddconexion.php");

if (!$conn) {
    die("Conexion fallida:" . mysqli_connect_error());
} 
else {


    $query4 = "select * from users";
    $consulta4 = mysqli_query($conn, $query4) or die("Fallo en la consulta");
    $num_filas4 = mysqli_num_rows($consulta4);

    include("../template/formularios.php");
    print
        '<span> Importe HORAS | Añadir </span>
        <form action="add_horas_tabla.php" method="GET">

            <hr><br>
            <input type="search" name="buscar_user" list="lista_users" placeholder="Email de usuario" >
            <datalist id="lista_users">';
    for ($i = 0; $i < $num_filas4; $i++) {
        $resultado4 = mysqli_fetch_array($consulta4);
        print ' <option name="lista_obras" value="' . $resultado4['email'] . '">';
    }
    print
    '</datalist> <br>
            
            <br><input type="text" name="importe" placeholder="Importe horas" ><br>
            <br><hr><br>

            <input type="submit" class="boton" name="add" value="Añadir">
            <input type="submit" class="boton" name="close" value="Cerrar">
        </form>
    </div>

</body>

</html>';
}

?>