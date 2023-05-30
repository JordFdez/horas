<script type="text/javascript">
    function confirmDelete(){
        var resp = confirm("¿Desea eliminarlo?");

        if ($resp == true){
            return true;
        }
        else{
            return false;
        }
    }
</script>

<?php

session_start();
include("../include/bbddconexion.php");

$id_schedules = $_REQUEST['id_schedules'];


if(isset($_REQUEST['delete'])){

    $query = "delete from schedules where id=$id_schedules ";
    $consulta = mysqli_query($conn, $query) or die ("Fallo en la consulta");
    if( $consulta){
        echo "<script language='javascript'>
                window.location.replace('./horarios.php');
            </script>";
    }
        

}

else if (isset($_REQUEST['edit'])) {

    $query = "select id,name,L,M,X,J,V from schedules where id=$id_schedules;";
    $consulta = mysqli_query($conn, $query) or die("Fallo en la consulta");
    $num_filas = mysqli_num_rows($consulta);
    $resultado = mysqli_fetch_array($consulta);
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
        <form action="horarios_general_edit_save.php" method="GET">
            <h4> Horarios | Editar </h4>
            <hr>
            Nombre: <br><input type="text" name="name" value="'.$resultado['name'].'"><br>
            Lunes: <br><input type="number" name="L" value="'.$resultado['L']. '"><br>
            Martes: <br><input type="number" name="M" value="' . $resultado['M'] . '"><br>
            Miercoles: <br><input type="number" name="X" value="' . $resultado['X'] . '"><br>
            Jueves: <br><input type="number" name="J" value="' . $resultado['J'] . '"><br>
            Viernes: <br><input type="number" name="V" value="' . $resultado['V'] . '"><br>

            <input type="hidden" name="id_schedules" value="'.$resultado['id'].'">

            <hr><br>

            <input type="submit" name="act" value="Actualizar">
        </form>
    </div>

</body>

</html>
            ';
}

?>