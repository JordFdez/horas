<?php

session_start();
include("../include/bbddconexion.php");

if (!$conn) {
    die("Conexion fallida:" . mysqli_connect_error());
} else {
    $query = "select exception_hours.status, users.name as 'name_user', users.last_name, users.email, exception_works.code, exception_works.name, exception_hours.date, exception_hours.hour, exception_hours.id, exception_hours.who_approve from exception_hours, users, exception_works where users.id=exception_hours.user_id and exception_hours.exception_work_id=exception_works.id order by exception_hours.id desc;";
    $consulta = mysqli_query($conn, $query) or die("Fallo en la consulta");
    $num_filas = mysqli_num_rows($consulta);

    if ($consulta) {

        echo '
            <!DOCTYPE html>
<html lang="es">

<head>
<meta content="initial-scale=1, 
maximum-scale=1, user-scalable=0"
name="viewport" />

<meta name="viewport" 
content="width=device-width" />
    <title>BaumControl</title>
        <link rel="shortcut icon" href="../img/favicon.png">

    <link rel="stylesheet" href="../css/nav-bar.css">';

        include("../include/tabla.php");
        include("../include/tabla2.php");
        include("../include/menu.php");

        echo '</head>

<body>
<div class="fondo_naranja">
<div class="nav-bar">
    <span>Pages / <b>Resto de Horas</b></span>

    <!--include menu -->
    ';
        include("../template/menu.php");
        echo ' <br><br>
    <div class="medio">
            <nav class="medio_ajuste">

                <a class="item_a" href="./horas_todos.php">
                    <div class="items">
                        <span class="item_span"> Ir a horas </span>
                    </div>
                </a>

                <a class="item_a" href="../exception_works/exception_works.php">
                    <div class="items ">
                        <span class="item_span"> Ver Obras </span>
                    </div>
                </a>
                
            </nav>
        </div><br>
</div>

<div class="tabla_estilo">
    <span> Resto de Horas</span><br><br>
    <!--tables with data-->
        <table class="records_list table table-striped table-bordered table-hover" id="mydatatable">
                    <thead>
                        <tr>
                            <th>Fecha Inicio</th>
                            <th>Estado</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Email</th>
                            <th>Obra</th>
                            <th>Codigo obra</th>
                            
                            <th>Horas</th>
                            <th>Aprobado por:</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tfoot>
                <tr>
                    <th id="fecha_input" class="date_horas">Filter..</th>
                    <th class="estado">Filter..</th>
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
                    <tbody>';
        for ($i = 0; $i < $num_filas; $i++) {
            $resultado = mysqli_fetch_array($consulta);
            print "<tr><td>" . $resultado['date'] . "</td><td class='" . $resultado['status'] . "'>" . $resultado['status'] . " </td><td> " . $resultado['name_user'] . "</td><td> " . $resultado['last_name'] . "</td><td> " . $resultado['email'] . "</td><td> " . $resultado['name'] . "</td><td>" . $resultado['code'] . "</td><td>" . $resultado['hour'] . "</td><input type='hidden' name='hours_id' value='" . $resultado['id'] . "' ></td>
                            <td>" . $resultado['who_approve'] . "</td>
                            <td><form action='exception_horas_conf.php' method='GET'>
                            <button class='no_boton2' name='delete' onclick='return confirmDelete()' >
                            <i class='fa fa-trash-o' style='font-size:22px;color:red'></i>
                            </button>
                            <button name='edit' class='no_boton2' >
                            <i class='fa fa-edit' style='font-size:22px;color:black'></i>
                            </button>
                            <button name='confirm' class='no_boton2'>
                            <i class='fa fa-check-circle-o' style='font-size:22px;color:green'></i>
                            </button>
                            <input type='hidden' name='id' value='" . $resultado['id'] . "'> </form>
                </td></tr>";
        }
        echo '
                    </tbody>
                </table><br>
            </div>
        </div>
        <script>
        /* Initialization of datatables */
        $(document).ready(function () {
            $("table.display").DataTable();
        });
    </script>
    </body>
  
</html>
        ';
    } else {
        echo "<script language='javascript'>
            alert('¡¡ Error al añadir las horas!!');
            window.location.replace('./horas.php');
            </script>";
    }
}
