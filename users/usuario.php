<?php
session_start();
include("../include/bbddconexion.php");

if (!$conn) {
    die("Conexion fallida:" . mysqli_connect_error());
} else {
    $query = "select users.id, users.name, users.last_name, users.email, roles.name as 'rol', users.type, schedules.name as 'schedule', users.created_at from users, roles, schedules where users.rol_id=roles.id and users.schedule_id=schedules.id;";
    $consulta = mysqli_query($conn, $query) or die("Fallo en la consulta");
    $num_filas = mysqli_num_rows($consulta);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta content="initial-scale=1, 
maximum-scale=1, user-scalable=0" name="viewport" />

    <meta name="viewport" content="width=device-width" />
    <title>BaumControl</title>
    <link rel="shortcut icon" href="../img/favicon.png">
    <link rel="stylesheet" href="../css/nav-bar.css">

    <?php include("../include/tabla.php");
    include("../include/tabla2.php");
    include("../include/menu.php"); ?>

</head>

<body>
    <div class="fondo_naranja">
        <div class="nav-bar">
            <span>Pages / <b>Usuarios</b></span>

            <!--include menu -->
            <?php include("../template/menu.php"); ?>
            <br><br>
            <div class="medio">
                <nav class="medio_ajuste">
                    <a class="item_a" href="./add_user.php">
                        <div class="items">
                            <span class="item_span"> Añadir Usuario
                            </span>
                        </div>
                    </a>

                </nav>
            </div><br><br>
        </div>


        <div class="tabla_estilo">
            <span>Usuarios</span><br><br>
            <!--tables with data-->
            <table class="records_list table table-striped table-bordered table-hover" id="mydatatable">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th>Horario</th>
                        <th>Fecha alta</th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Filter..</th>
                        <th>Filter..</th>
                        <th>Filter..</th>
                        <th>Filter..</th>
                        <th>Filter..</th>
                        <th>Filter..</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    for ($i = 0; $i < $num_filas; $i++) {
                        $resultado = mysqli_fetch_array($consulta);
                        print "<tr><td><h6>" . $resultado['name'] . " " . $resultado['last_name'] . "</h6> <p><input type='hidden' name='email' value='" . $resultado['email'] . "'>" . $resultado['email'] . " </p></td><td>" . $resultado['rol'] . "</td><td class='" . $resultado['type'] . "'>" . $resultado['type'] . "</td><td>" . $resultado['schedule'] . "</td><td>" . $resultado['created_at'] . "</td><td><form action='edit_user.php' method='GET'><input name='id_user' type='hidden' value=" . $resultado['id'] . ">
                            <button name='edit' class='no_boton2' title='Editar'>
                            <i class='fa fa-edit' style='font-size:22px;color:black'></i>
                            </button>
                           
                </form></td></tr>";
                    }
                    ?>

                </tbody>
            </table><br>
        </div>
    </div>
    <script>
        /* Initialization of datatables */
        $(document).ready(function() {
            $("table.display").DataTable();
        });
    </script>
</body>

</html>