<?php


session_start();

include("../include/bbddconexion.php");
$user_id = $_SESSION['id'];

if (!$conn) {
    die("Conexion fallida:" . mysqli_connect_error());
} 
else {


    $query2 = "select name from works";
    $consulta2 = mysqli_query($conn, $query2) or die("Fallo en la consulta");
    $num_filas2 = mysqli_num_rows($consulta2);

    include("../template/formularios.php");


    print
        '<span> Horas | Añadir </span>
        <form action="add_horas_propias_tabla.php" method="GET">

            <hr>
            <br>
           <input type="search" name="buscar_obra" list="lista_obras" placeholder="Nombre de la obra">
            <datalist id="lista_obras">';
    for ($i = 0; $i < $num_filas2; $i++) {
        $resultado2 = mysqli_fetch_array($consulta2);
        print ' <option name="lista_obras" value="' . $resultado2['name'] . '">';
    }
    print
        '</datalist> <br>
            <br><input type="text" name="cod_works" placeholder="Codigo de la obra (automático)" readonly><br>
            <br><input type="text" name="hora" placeholder="Horas"><br>
            Hora extra: <input type="checkbox" class="extra" name="extra"><br>
            Fecha: <input type="date" name="fecha"><br>
            <br><textarea name="observacion" rows="10" cols="40" placeholder="Escriba sus observaciones..."></textarea><br> 


            <br><hr><br>

            <input type="submit" name="add" class="boton" value="Añadir">
            <input type="submit" class="boton" name="close" value="Cerrar">
        </form>
    </div>
    </div>

</body>

</html>';
}
