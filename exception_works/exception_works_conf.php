<script type="text/javascript">
    function confirmDelete() {
        var resp = confirm("¿Desea eliminarlo?");

        if ($resp == true) {
            return true;
        } else {
            return false;
        }
    }
</script>

<?php

session_start();
include("../include/bbddconexion.php");

$id_work = $_REQUEST['id_work'];


if (isset($_REQUEST['delete'])) {

    echo "<script language='javascript'>
            window.location.replace('./exception_works.php');
        </script>";

    $query = "delete from exception_works where id=$id_work ";
    $consulta = mysqli_query($conn, $query) or die("Fallo en la consulta");
} 
else if (isset($_REQUEST['edit'])) {

    $query = "select * from exception_works where id=$id_work ;";
    $consulta = mysqli_query($conn, $query) or die("Fallo en la consulta");
    $num_filas = mysqli_num_rows($consulta);
    $resultado = mysqli_fetch_array($consulta);
    include("../template/formularios.php");
    print '
        <span> Obras | Editar </span>
        <form action="obras_edit_save.php" method="GET">

            <hr>
            Codigo de la obra: <br><input type="text" name="code" value=" ' . trim($resultado['code']) . '  " readonly><br>
            Nombre de la obra: <br><input type="text" name="name" value=" ' . trim($resultado['name']) . '  "><br>
            
            <input type="hidden" name="id" value="' . $resultado['id']  . '">

            <br><hr><br>

            <input type="submit" class="boton" name="save" value="Guardar">
        </form>
    </div>

</body>

</html>
            ';
}

?>