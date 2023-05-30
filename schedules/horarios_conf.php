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

    echo "<script language='javascript'>
                window.location.replace('./horarios.php');
            </script>";
            if ($resp == true){
            
    $query = "delete from schedules where id=$id_schedules ";
    $consulta = mysqli_query($conn, $query) or die ("Fallo en la consulta");
            }

}

else if (isset($_REQUEST['edit'])) {

    $query = "select id,name,L,M,X,J,V from schedules where id=$id_schedules;";
    $consulta = mysqli_query($conn, $query) or die("Fallo en la consulta");
    $num_filas = mysqli_num_rows($consulta);
    $resultado = mysqli_fetch_array($consulta);
    include("../template/formularios.php");
    print '
        <span> Horarios | Editar </span>
        <form action="horarios_edit_save.php" method="GET">

            <hr>
            <br>Nombre: <input type="text" class="horario_name" name="name" value="'.$resultado['name'].'"><br>
            Lunes: <input class="horario" type="number" name="L" value="'.$resultado['L']. '"><br>
            Martes: <input type="number" class="horario" name="M" value="' . $resultado['M'] . '"><br>
            Miercoles: <input type="number" class="horario" name="X" value="' . $resultado['X'] . '"><br>
            Jueves: <input type="number" class="horario" name="J" value="' . $resultado['J'] . '"><br>
            Viernes: <input type="number" class="horario" name="V" value="' . $resultado['V'] . '"><br>

            <input type="hidden" name="id_schedules" value="'.$resultado['id']. '">

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

?>