<?php

session_start();
include("../include/bbddconexion.php");

$id_user = $_REQUEST['id_user'];

if (!$conn) {
    die("Conexion fallida:" . mysqli_connect_error());
} 
else {
    $query = "select users.id, users.name, users.password, users.last_name, users.email, roles.name as 'rol', users.type, schedules.name as 'schedule', users.created_at from users, roles, schedules where users.rol_id=roles.id and users.schedule_id=schedules.id and users.id=$id_user ";
    $consulta = mysqli_query($conn, $query) or die("Fallo en la consulta");
    $num_filas = mysqli_num_rows($consulta);
    $resultado = mysqli_fetch_array($consulta);

    $query2 = "select name from schedules";
    $consulta2 = mysqli_query($conn, $query2) or die ("Fallo en la consulta");
    $num_filas2 = mysqli_num_rows($consulta2);

    $query3 = "select name from roles";
    $consulta3 = mysqli_query($conn, $query3) or die("Fallo en la consulta");
    $num_filas3 = mysqli_num_rows($consulta3);
    include("../template/formularios.php");

    if ($consulta ){
        print '
            <span> Usuario | Editar </span>
        <form action="edit_user_save.php" method="GET">

            <hr>
            Nombre <br><input type="text" name="nombre" value=" ' . $resultado['name'] . '  "><br>
            Apellido <br><input type="text" name="apellido" value=" ' . $resultado['last_name'] . '  "><br>
            Email <br><input type="email" name="email" value=" ' . $resultado['email'] . '  "><br>
            Contraseña <br><input type="password" name="pass" value=" ' . $resultado['password'] . '  "><br><br>
            Estado <select name="estado">
                <option> ' . $resultado['type'] . ' </option>
                <option>ACTIVADA</option>
                <option>NO ACTIVADA</option>
            </select><br><br>

            Horario <input type="search" name="buscar_horario" list="lista_horarios" value="' . $resultado['schedule'] . '"><br>
                <datalist id="lista_horarios">';
        for ($i = 0; $i < $num_filas2; $i++) {
            $resultado2 = mysqli_fetch_array($consulta2);
            print ' <option name="lista_horario" value="' . $resultado2['name'] . '">';
        }
        print '</datalist>
                
            <br>
            Rol <input type="search" name="buscar_rol" list="lista_roles" value="' . $resultado['rol'] . '">
            <datalist id="lista_roles">';
        for ($i = 0; $i < $num_filas3; $i++) {
            $resultado3 = mysqli_fetch_array($consulta3);
            print ' <option name="lista_rol" value="' . $resultado3['name'] . '">';
        }
        print '</datalist>    
            <br>
            <input type="hidden" name="id_user" value="'. $resultado['id']  . '">

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
    else{
        print "error";
    }
}
?>