<?php

session_start();
include("../include/bbddconexion.php");
$id_user = $_SESSION['id'];

if (!$conn) {
    die("Conexion fallida:" . mysqli_connect_error());
} else {
    $query = "select gastos.id, gastos.estado, gastos.alta_gasto, users.name as 'user_name', users.last_name, users.email, works.name as 'work_name', works.code, gastos.fecha, gastos.tipo_gasto, gastos.importe, gastos.comentario, gastos.who_approve, gastos.imagen_gasto from gastos, users, works where users.id=gastos.user_id and gastos.work_id=works.id and gastos.user_id=$id_user";
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
    include("../include/menu.php");
    include("../include/eliminar.php");
    ?>

</head>

<body>
    <div class="fondo_naranja">
        <div class="nav-bar">
            <span>Pages / <b>Gastos</b></span>

            <!--include menu -->
            <?php include("../template/menu_user.php"); ?>
            <br><br>
            <div class="medio">
                <nav class="medio_ajuste">
                    <a class="item_a" href="./add_gastos.php">
                        <div class="items">
                            <span class="item_span"> Añadir Gastos </span>
                        </div>
                    </a>

                </nav>
            </div><br>
        </div>

        <div class="tabla_estilo">
            <span>Gastos</span><br><br>
            <!--tables with data-->
            <table class="records_list table table-striped table-bordered table-hover" id="mydatatable">
                <thead>
                    <tr>

                        <th id="fecha_input_alta">Alta</th>
                        <th id="fecha_input">Fecha</th>
                        <th>Estado</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Email</th>
                        <th>Obra</th>
                        <th>Codigo Obra</th>
                        <th>Tipo</th>
                        <th>Importe</th>
                        <th>Observaciones</th>
                        <th>Aprobado por</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>

                        <th class="alta_gasto" id="fecha_input_alta">Filter..</th>
                        <th class="date" id="fecha_input">Filter..</th>
                        <th class="estado">Filter..</th>
                        <th>Filter..</th>
                        <th>Filter..</th>
                        <th>Filter..</th>
                        <th>Filter..</th>
                        <th>Filter..</th>
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
                        if ($resultado['estado'] == "NO APROBADA" && $resultado['imagen_gasto'] != "") {
                            print "<tr><td>" . $resultado['alta_gasto'] . "</td><td>" . $resultado['fecha'] . "</td><td class='" . $resultado['estado'] . "'>" . $resultado['estado'] . " </td><td>" . $resultado['user_name'] . "</td><td> " . $resultado['last_name'] . "</td><td> " . $resultado['email'] . "</td><td>" . $resultado['work_name'] . "</td><td>" . $resultado['code'] . "</td><td>" . $resultado['tipo_gasto'] . "</td><td>" . $resultado['importe'] . "</td><td>" . $resultado['comentario'] . "</td><td>" . $resultado['who_approve'] . "</td>
                            <td><form action='gastos_imagen.php' method='GET'><input name='id_gastos' type='hidden' value=" . $resultado['id'] . ">
                            <button class='no_boton2' name='imagen'><img src='../img_gastos/" . $resultado['imagen_gasto'] . "' heigth=60px width=60px></button></form></td>
                            <td><form action='gastos_conf.php' method='GET'><input name='id_gastos' type='hidden' value=" . $resultado['id'] . ">
                            <button class='no_boton2' name='delete' onclick='return confirmDelete()' title='Borrar' >
                            <i class='fa fa-trash-o' style='font-size:22px;color:red'></i>
                            </button></form>
                            <form action='gastos_edit_conf.php' method='GET'>
                            <input name='id_gastos' type='hidden' value=" . $resultado['id'] . ">
                             <button name='edit' class='no_boton2' title='Editar'>
                            <i class='fa fa-edit' style='font-size:22px;color:black'></i>
                            </button>
                            </form></td></tr>";
                        } else if ($resultado['estado'] == "NO APROBADA" && $resultado['imagen_gasto'] == "") {
                            print "<tr><td>" . $resultado['alta_gasto'] . "</td><td>" . $resultado['fecha'] . "</td><td class='" . $resultado['estado'] . "'>" . $resultado['estado'] . " </td><td>" . $resultado['user_name'] . "</td><td> " . $resultado['last_name'] . "</td><td> " . $resultado['email'] . "</td><td>" . $resultado['work_name'] . "</td><td>" . $resultado['code'] . "</td><td>" . $resultado['tipo_gasto'] . "</td><td>" . $resultado['importe'] . "</td><td>" . $resultado['comentario'] . "</td><td>" . $resultado['who_approve'] . "</td>
                            <td></td>
                            <td><form action='gastos_conf.php' method='GET'><input name='id_gastos' type='hidden' value=" . $resultado['id'] . ">
                            <button class='no_boton2' name='delete' onclick='return confirmDelete()' title='Borrar' >
                            <i class='fa fa-trash-o' style='font-size:22px;color:red'></i>
                            </button></form>
                            <form action='gastos_edit_conf.php' method='GET'>
                            <input name='id_gastos' type='hidden' value=" . $resultado['id'] . ">
                             <button name='edit' class='no_boton2' title='Editar'>
                            <i class='fa fa-edit' style='font-size:22px;color:black'></i>
                            </button>
                            </form></td></tr>";
                        } else if ($resultado['estado'] == "APROBADA" && $resultado['imagen_gasto'] != "") {
                            print "<tr><td>" . $resultado['alta_gasto'] . "</td><td>" . $resultado['fecha'] . "</td><td class='" . $resultado['estado'] . "'>" . $resultado['estado'] . " </td><td>" . $resultado['user_name'] . "</td><td> " . $resultado['last_name'] . "</td><td> " . $resultado['email'] . "</td><td>" . $resultado['work_name'] . "</td><td>" . $resultado['code'] . "</td><td>" . $resultado['tipo_gasto'] . "</td><td>" . $resultado['importe'] . "</td><td>" . $resultado['comentario'] . "</td><td>" . $resultado['who_approve'] . "</td>
                            <td><form action='gastos_imagen.php' method='GET'><input name='id_gastos' type='hidden' value=" . $resultado['id'] . ">
                            <button class='no_boton2' name='imagen'><img src='../img_gastos/" . $resultado['imagen_gasto'] . "' heigth=60px width=60px></button></form></td>
                        <td></td></tr>";
                        } else if ($resultado['estado'] == "APROBADA" && $resultado['imagen_gasto'] == "") {
                            print "<tr><td>" . $resultado['alta_gasto'] . "</td><td>" . $resultado['fecha'] . "</td><td class='" . $resultado['estado'] . "'>" . $resultado['estado'] . " </td><td>" . $resultado['user_name'] . "</td><td> " . $resultado['last_name'] . "</td><td> " . $resultado['email'] . "</td><td>" . $resultado['work_name'] . "</td><td>" . $resultado['code'] . "</td><td>" . $resultado['tipo_gasto'] . "</td><td>" . $resultado['importe'] . "</td><td>" . $resultado['comentario'] . "</td><td>" . $resultado['who_approve'] . "</td>
                            <td></td>
                        <td></td></tr>";
                        }
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