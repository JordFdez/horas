<?php

session_start();
include("../include/bbddconexion.php");

$hours_id = $_REQUEST['hours_id'];

if (!$conn) {
    die("Conexion fallida:" . mysqli_connect_error());
} else {
    $query = "select comment from hours where id=$hours_id";
    $consulta = mysqli_query($conn, $query) or die("Fallo en la consulta");
    $resultado = mysqli_fetch_array($consulta);
}

include("../template/formularios.php");
?>

<span> Horas | Observaciones </span>
<form action="horas_comment_add.php" method="GET">

    <hr>
    <br><textarea name="observacion" rows="13" cols="40" placeholder="Escribe tus observaciones..."><?php echo $resultado['comment'] ?></textarea>
    <br>
    <input type="hidden" name="hour_id" value="<?php echo $hours_id  ?> ">

    <br><hr><br>


</form>
</div>
</div>

</body>

</html>