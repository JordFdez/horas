<?php

session_start();
include("../include/bbddconexion.php");

if (!$conn) {
    die("Conexion fallida:" . mysqli_connect_error());
} else {

    $query2 = "select email from users";
    $consulta2 = mysqli_query($conn, $query2) or die("Fallo en la consulta");
    $num_filas2 = mysqli_num_rows($consulta2);

    $query3 = "select name, code from works";
    $consulta3 = mysqli_query($conn, $query3) or die("Fallo en la consulta");
    $num_filas3 = mysqli_num_rows($consulta3);
    include("../template/formularios.php");

    print
    '<span>Obras | Añadir</span>
        <form action="works_add_tabla.php" method="GET">

            <hr>
            <br><input type="text" name="codigo" placeholder="Codigo de la obra"><br>
            <br><input type="text" name="nombre" placeholder="Nombre la obra"><br>
            <br><input type="search" placeholder="Responsable" name="buscar_email" list="lista_emails"><br>
            <datalist id="lista_emails">';
    for ($i = 0; $i < $num_filas2; $i++) {
        $resultado2 = mysqli_fetch_array($consulta2);
        print ' <option name="lista_email" value="' . $resultado2['email'] . '">';
    }
    print
        '</datalist> <br>

            <hr><br>

            <input type="submit" class="boton" name="add" value="Añadir">
            <input type="submit" class="boton" name="close" value="Cerrar">
        </form>
    </div>
    </div>

</body>

</html>';
}
