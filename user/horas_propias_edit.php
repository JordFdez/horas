<?php 
session_start();

include("../include/bbddconexion.php");

$id = $_REQUEST['id_hours_edit'];
$id_user = $_SESSION['id'];


if (!$conn) {
die("Conexion fallida:" . mysqli_connect_error());
}
else {
$query = "select hours.status, works.name, hours.date, hours.hour, hours.comment, hours.id from hours, users, works where users.id=hours.user_id and hours.work_id=works.id and hours.id=$id;";
$consulta = mysqli_query($conn, $query) or die("Fallo en la consulta");
$num_filas = mysqli_num_rows($consulta);
$resultado = mysqli_fetch_array($consulta);

$query2 = "select * from works;";
$consulta2 = mysqli_query($conn, $query2) or die("Fallo en la consulta");
$num_filas2 = mysqli_num_rows($consulta2);

include("../template/formularios.php");
print '
<span> Horas | Editar </span>
<form action="horas_edit_save.php" method="GET">

    <hr>
    Nombre de la obra: <br><input type="search" name="buscar_obra" list="lista_obras" value="' . $resultado['name'] . '"><br>
    <datalist id="lista_obras">';
        for ($i = 0; $i < $num_filas2; $i++) { $resultado2=mysqli_fetch_array($consulta2); print' <option name="lista_obra" value="'. $resultado2['name'] .'">';
            }
            print '</datalist>

    Codigo de la obra:<br> <input type="text" name="cod_obra" value="'.$resultado['code']. '" readonly><br>
    Horas: <br><input type="text" name="horas" value="' . $resultado['hour'] . '"><br>
    Hora extra: <br><input type="checkbox" name="extra" value=""><br>
    Fecha: <br><input type="date" name="fecha" value="' . $resultado['date'] . '"><br>
    <textarea name="observacion" rows="8" cols="40" placeholder="Escribe tus observaciones..."> '.$resultado['comment'].'</textarea><br><br> 

    <input type="hidden" name="id_hours" value="'.$resultado['id']. '">
    <input type="hidden" name="id_works" value="' . $resultado['id_work'] . '">



    <hr><br>

    <input type="submit" class="boton" name="act" value="Actualizar">
    <input type="submit" class="boton" name="close" value="Cerrar">
</form>
</div>
</div>

</body>

</html>
';

}
