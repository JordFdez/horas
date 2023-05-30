<?php

session_start();
include("../include/bbddconexion.php");

if (!$conn) {
    die("Conexion fallida:" . mysqli_connect_error());
} 
else {

$query2 = "select name from schedules";
$consulta2 = mysqli_query($conn, $query2) or die("Fallo en la consulta");
$num_filas2 = mysqli_num_rows($consulta2);

$query3 = "select name from roles";
$consulta3 = mysqli_query($conn, $query3) or die("Fallo en la consulta");
$num_filas3 = mysqli_num_rows($consulta3);

include ("../template/formularios.php");
print '<span>Usuario | Añadir</span>
        <form action="add_user_tabla.php" method="GET">

            <hr>
            <br><input type="text" name="nombre" placeholder="Nombre">
            <br><input type="text" name="apellido" placeholder="Apellidos">
            <br><input type="email" name="email" placeholder="Email">
            <br><input type="password" name="pass" placeholder="Contraseña"><br>
            Estado: <select name="estado">
                <option>ACTIVADA</option>
                <option>NO ACTIVADA</option>
            </select><br><br>

            <input type="search" name="buscar_horario" list="lista_horarios" placeholder="Horario"><br>
            <datalist id="lista_horarios">';
                for ($i = 0; $i < $num_filas2; $i++) { 
                    $resultado2=mysqli_fetch_array($consulta2); 
                    print ' <option name="lista_horario" value="' . $resultado2['name'] . '">' ; 
                } 
            print
    '</datalist> <br>

        <input type="search" name="buscar_rol" list="lista_roles" placeholder="Rol">
            <datalist id="lista_roles">';
            for ($i = 0; $i < $num_filas3; $i++) {
                $resultado3 = mysqli_fetch_array($consulta3);
                print ' <option name="lista_rol" value="' . $resultado3['name'] . '">';
            }
            print '</datalist><br><br>

            <hr><br>

            <input type="submit" class="boton" name="add" value="Añadir">
            <input type="submit" class="boton" name="close" value="Cerrar">
        </form>
    </div>
    </div>

</body>

</html>';

}