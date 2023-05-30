<?php


session_start();

include("../include/bbddconexion.php");
$user_id = $_SESSION['id'];

if (!$conn) {
    die("Conexion fallida:" . mysqli_connect_error());
} 
else {


    $query2 = "select name from exception_works";
    $consulta2 = mysqli_query($conn, $query2) or die("Fallo en la consulta");
    $num_filas2 = mysqli_num_rows($consulta2);

    $query3 = "select name from roles";
    $consulta3 = mysqli_query($conn, $query3) or die("Fallo en la consulta");
    $num_filas3 = mysqli_num_rows($consulta3);
    include("../template/formularios.php");

    print
        '<span> Resto Horas | Añadir </span>
        <form action="add_exception_horas_tabla.php" method="GET">

            <hr>
            <br>
           <input type="search" placeholder="Nombre de la obra" name="buscar_exception_obra" list="lista_exception_obras">
            <datalist id="lista_exception_obras">';
    for ($i = 0; $i < $num_filas2; $i++) {
        $resultado2 = mysqli_fetch_array($consulta2);
        print ' <option name="lista_exception_obras" value="' . $resultado2['name'] . '">';
    }
    print
        '</datalist> <br>
            <br><input type="text" placeholder="Codigo de la obra (automático) " name="cod_exception_works" readonly><br>
            <br><input type="text" name="hora" placeholder="Hora" ><br>
            <br>Fecha: <input type="date" name="fecha"><br><br>

            <hr><br>

            <input type="submit" class="boton" name="add" value="Añadir">
            <input type="submit" class="boton" name="close" value="Cerrar">
        </form>
    </div>

</body>

</html>';
}

?>