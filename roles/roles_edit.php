<?php

session_start();
include("../include/bbddconexion.php");

$id_rol = $_REQUEST['id_rol'];

    if (!$conn) {
        die("Conexion fallida:" . mysqli_connect_error());
    } 
    else{
        $query = "select users.id, users.name as 'user', users.last_name, users.email, roles.name from users, roles where users.rol_id=roles.id and users.id=$id_rol";
        $consulta = mysqli_query($conn, $query) or die("Fallo en la consulta");
        $resultado = mysqli_fetch_array($consulta);
        
        if($consulta){
        include("../template/formularios.php");
            print '
            <span> Roles | Editar </span>
        <form action="roles_edit_save.php" method="GET">

            <hr>
            Nombre:  '  . $resultado['user'] . ' <br>
            Apellido: ' . $resultado['last_name'] . ' <br>
            Email: ' . $resultado['email'] . ' <br><br>
            Rol:<select name="rol">
                <option> ' . $resultado['name'] . ' </option>
                <option>root</option>
                <option>admin</option>
                <option>user</option>
                <option>gestion</option>
            </select><br>
            <input type="hidden" name="id_rol" value="' . $resultado['id']  . '">

            <br><hr><br>

            <input type="submit" name="save" class="boton" value="Guardar">
            <input type="submit" class="boton" name="close" value="Cerrar">
        </form>
    </div>
    </div>

</body>

</html>
            ';
        
        }
        else{
            print "error consulta";
        }
}
?>