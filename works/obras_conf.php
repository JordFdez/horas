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

$id_work = $_REQUEST['id_work'];


if(isset($_REQUEST['delete'])){

    echo "<script language='javascript'>
            alert('¡¡ Obra eliminada !!');
            window.location.replace('./obras.php');
        </script>";

    $query = "delete from works where id=$id_work ";
    $consulta = mysqli_query($conn, $query) or die ("Fallo en la consulta");
    


}

else if (isset($_REQUEST['edit'])) {

    $query = "select works.code, works.name, users.email, works.created_at, works.id from works,users where works.user_id=users.id and works.id=$id_work ;";
    $consulta = mysqli_query($conn, $query) or die("Fallo en la consulta");
    $num_filas = mysqli_num_rows($consulta);
    $resultado = mysqli_fetch_array($consulta);

    $query2 = "select email from users";
    $consulta2 = mysqli_query($conn, $query2) or die("Fallo en la consulta");
    $num_filas2 = mysqli_num_rows($consulta2);
    include("../template/formularios.php");

    print '
        <span> Obras | Editar</span>
        <form action="obras_edit_save.php" method="GET">

            <hr>
            Codigo de la obra: <br><input type="text" name="code" value=" ' . trim($resultado['code']) . '  "><br>
            Nombre de la obra: <br><input type="text" name="name" value=" ' . trim($resultado['name']) . '  "><br>
            Responsable: <br><input type="search" name="buscar_email" list="lista_emails" value="'.$resultado['email'].'"><br>
            <datalist id="lista_emails">';
    for ($i = 0; $i < $num_filas2; $i++) {
        $resultado2 = mysqli_fetch_array($consulta2);
        print ' <option name="lista_email" value="' . $resultado2['email'] . '">';
    }
    print
        '</datalist> <br>
            
            <input type="hidden" name="id" value="' . $resultado['id']  . '">

            <hr><br>

            <input type="submit" class="boton" name="save" value="Guardar">
            <input type="submit" class="boton" name="close" value="Cerrar">
        </form>
    </div>
    </div>

</body>

</html>
            ';
}

?>