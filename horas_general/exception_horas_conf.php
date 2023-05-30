<?php

session_start();

include("../include/bbddconexion.php");

$id = $_REQUEST['id'];
$name_aprobado = $_SESSION['name'];
$ape_aprobado = $_SESSION['last_name'];
$id_user = $_SESSION['id'];


if (!$conn) {
    die("Conexion fallida:" . mysqli_connect_error());
} 
else {
    $query = "select exception_hours.status, users.name as 'name_user', exception_works.code, exception_works.name, exception_hours.date, exception_hours.hour, exception_hours.id, exception_hours.who_approve from exception_hours, users, exception_works where users.id=exception_hours.user_id and exception_hours.exception_work_id=exception_works.id and exception_hours.id=$id ;";
    $consulta = mysqli_query($conn, $query) or die("Fallo en la consulta");
    $num_filas = mysqli_num_rows($consulta);
    $resultado = mysqli_fetch_array($consulta);

    $query2 = "select * from exception_works;";
    $consulta2 = mysqli_query($conn, $query2) or die("Fallo en la consulta");
    $num_filas2 = mysqli_num_rows($consulta2);



    if(isset($_REQUEST['edit'])){
        include("../template/formularios.php");
        print '
        <span> Horas | Editar </span>
        <form action="exception_horas_edit_save.php" method="GET">

            <hr><br>
            Nombre de la obra: <br><input type="search" name="buscar_obra" list="lista_obras" value="' . $resultado['name'] . '"><br>
            <datalist id="lista_obras">';
        for ($i = 0; $i < $num_filas2; $i++) {
            $resultado2 = mysqli_fetch_array($consulta2);
            print' <option name="lista_obra" value="'. $resultado2['name'] .'">';
        }
            print '</datalist>
            
            Codigo de la obra: <br><input type="text" name="cod_obra" value=" '.$resultado['code']. '"  readonly><br>
            Horas: <br><input type="text" name="horas" value="' . $resultado['hour'] . '"><br>
            Fecha: <br><input type="date" name="fecha" value="' . $resultado['date'] . '"><br>

            <input type="hidden" name="id_hours" value="'.$resultado['id']. '">
            <input type="hidden" name="id_works" value="' . $resultado['id_work'] . '">

            <br><hr><br>

            <input type="submit" name="act" class="boton" value="Actualizar">
            <input type="submit" class="boton" name="close" value="Cerrar">
        </form>
    </div>

</body>

</html>
            ';
        
    }

    else if (isset($_REQUEST['delete'])){
        $query3 = "delete from exception_hours where id=$id";
        $consulta3 = mysqli_query($conn, $query3) or die("Fallo en la consulta");
        echo "<script language='javascript'>
                alert('¡¡ Fila de hora eliminada !!');
                window.location.replace('./resto_horas.php');
                </script>";



    }

    else if (isset($_REQUEST['confirm'])){

        $query4 = "update exception_hours set status='APROBADA', who_approve=(select email from users where id=$id_user ) where id=$id; ";
        $conuslta4 = mysqli_query($conn, $query4) or die ("fallo en la consulta");
        echo "<script language='javascript'>
                alert('¡¡ Hora aprobada !!');
                window.location.replace('./resto_horas.php');
                </script>";
    }

}
