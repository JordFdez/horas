<?php

session_start();

include("../include/bbddconexion.php");

$id = $_REQUEST['id_hours'];
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



    if(isset($_REQUEST['edit'])){
        include("../template/formularios.php");
        print '
        <span> Horas | Editar </span>
        <form action="horas_edit_save.php" method="GET">

            <hr><br>
            Nombre de la obra: <br><input type="search" name="buscar_obra" list="lista_obras" value="' . $resultado['name'] . '"><br>
            <datalist id="lista_obras">';
        for ($i = 0; $i < $num_filas2; $i++) {
            $resultado2 = mysqli_fetch_array($consulta2);
            print' <option name="lista_obra" value="'. $resultado2['name'] .'">';
        }
            print '</datalist>
            
            Codigo de la obra:<br> <input type="text" name="cod_obra" value="'.$resultado['code']. '" placeholder="Codigo de la obra (automático)" readonly><br>
            Horas: <br><input type="text" name="horas" value="' . $resultado['hour'] . '"><br>
            Hora extra: <input type="checkbox" class="extra" name="extra" value=""><br>
            Fecha: <input type="date" name="fecha" value="' . $resultado['date'] . '"><br>

            <input type="hidden" name="id_hours" value="'.$resultado['id']. '">
            <input type="hidden" name="id_works" value="' . $resultado['id_work'] . '">

            <hr><br>

            <input type="submit" name="act" class="boton" value="Actualizar">
            <input type="submit" class="boton" name="close" value="Cerrar">
        </form>
    </div>

</body>

</html>
            ';
        
    }

    else if (isset($_REQUEST['delete'])){
        $query3 = "delete from hours where id=$id";
        $consulta3 = mysqli_query($conn, $query3) or die("Fallo en la consulta");
        echo "<script language='javascript'>
                alert('¡¡ Fila de hora eliminada !!');
                window.location.replace('./horas_propias.php');
                </script>";



    }

    else if (isset($_REQUEST['confirm'])){

        $query4 = "update hours set status='APROBADA', who_approve=(select concat(name,' ', last_name) from users where id=$id_user ) where id=$id; ";
        $conuslta4 = mysqli_query($conn, $query4) or die ("fallo en la consulta");
        echo "<script language='javascript'>
                alert('¡¡ Hora aprobada !!');
                window.location.replace('./horas_todos.php');
                </script>";
    }

}
