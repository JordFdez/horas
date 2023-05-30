<?php

session_start();
include("./include/bbddconexion.php");

if (!$conn) {
    die("Conexion fallida:" . mysqli_connect_error());
} 
else {
    $query = "select * from gastos";
    $consulta = mysqli_query($conn, $query) or die("Fallo en la consulta");
    $num_filas = mysqli_num_rows($consulta);
    $resultado = mysqli_fetch_array($consulta);

if(isset($_REQUEST['edit'])){

    print '
            <!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>BaumControl</title>
    <link rel="stylesheet" type="text/css" href="../css/user_add.css">
</head>

<body>
    <div class="cuerpo">
        <form action="gastos_edit_save.php" method="GET">
            <h4> Gastos | Editar </h4>
            <hr>
            Estado: <input type="text" name="estado" value="'  . $resultado['estado'] . '" ><br>
            Nombre: <input type="text" name="nombre" value="' . $resultado['nombre'] . '"> <br>
            Codigo Obra: <input type="text" name="nombre" value="' . $resultado['work_id'] . '"> <br>
            Tipo de gasto: <input type="text" name="nombre" value="' . $resultado['tipo_gasto'] . '"> <br>
            Importe: <input type="text" name="nombre" value="' . $resultado['importe'] . '"> <br>
            Observaciones: <input type="text" name="nombre" value="' . $resultado['comentario'] . '"> <br><br>
            <input type="hidden" name="id_rol" value="' . $resultado['id']  . '">

            <hr><br>

            <input type="submit" name="save" value="Actualizar">
        </form>
    </div>

</body>

</html>
            ';
    
}

else if (isset($_REQUEST['delete'])) {

    

}

}

?>