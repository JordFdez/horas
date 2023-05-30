<?php

session_start();
include("../include/bbddconexion.php");
$user_id = $_SESSION['id'];

if (!$conn) {
    die("Conexion fallida:" . mysqli_connect_error());
} 
else {
    $query = "select hours.status, hours.created_at, users.name as 'name_user', users.last_name, users.email, works.code, works.name, works.user_id as 'responsable', hours.date, hours.hour, hours.comment, hours.id, who_approve, hours.register from hours, users, works where users.id=hours.user_id and hours.work_id=works.id ;";
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
    <span>Pages / <b>Horas</b></span>

    <!--include menu -->
    '; 
    include("../template/menu.php"); 
    echo ' <br><br>
    <div class="medio">
            <nav class="medio_ajuste">

                <a class="item_a" href="./resto_horas.php">
                    <div class="items">
                        <span class="item_span"><i class="fa fa-hand-o-right" style="font-size:18px"></i> Ir a resto horas </span>
                    </div>
                </a>

                <a class="item_a" href="../works/obras.php">
                    <div class="items ">
                        <span class="item_span"><img src="../img/const1.svg" height="25px" width="30px"> Ver Obras </span>
                    </div>
                </a>

                <a class="item_a" href="../works/mis_obras.php">
                    <div class="items ">
                        <span class="item_span"> Mis Obras </span>
                    </div>
                </a>
                <a class="item_a" href="./horas_mis_obras.php">
                    <div class="items ">
                        <span class="item_span"> Horas mis obras </span>
                    </div>
                </a>
            </nav>
    </div><br>
</div>

<div class="tabla_estilo">
    <span>Horas</span><br><br>
    <!--tables with data-->
        <table class="records_list table table-striped table-bordered table-hover" id="mydatatable">
                    <thead>
                        <tr>
                            <th id="fecha_input">Fecha</th>
                            <th>Estado</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Email</th>
                            <th>Obra</th>
                            <th>Codigo Obra</th>
                            <th>Horas</th>
                            <th>Obervaciones</th>
                            <th>Aprobado por</th>
                            <th>Extras</th>
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
                    <th>Filter..</th>
                    <th>Filter..</th>
                    
                </tr>
            </tfoot>
                    <tbody>';
                        for ($i = 0; $i < $num_filas; $i++) {
                            $resultado = mysqli_fetch_array($consulta);
                            if ($resultado['comment'] == "" && $resultado['responsable']== $user_id && $resultado['status']=="NO APROBADA"){
                            print "<tr><td id='fecha_input'>" . $resultado['date'] . "</td><td class='" . $resultado['status'] . "'>" . $resultado['status'] . " </td><td> " . $resultado['name_user'] . " </td><td>" . $resultado['last_name'] ."</td><td>".$resultado['email']."</td><td> " . $resultado['name'] . "</td><td>" . $resultado['code'] . "</td><td>" . $resultado['hour'] . "</td><td></td>
                            <td>" . $resultado['who_approve'] . "</td><td>" . $resultado['register'] . "</td>
                            <td><form action='horas_conf.php' method='GET'>
                            <button class='no_boton2' name='delete' onclick='return confirmDelete()' title='Borrar' >
                            <i class='fa fa-trash-o' style='font-size:22px;color:red'></i>
                            </button>
                            <button name='edit' class='no_boton2' title='Editar'>
                            <i class='fa fa-edit' style='font-size:22px;color:black'></i>
                            </button>
                            <button name='confirm' class='no_boton2'>
                            <i class='fa fa-check-circle-o' style='font-size:22px;color:green' title='Aprobar'></i>
                            </button>
                            <input type='hidden' name='id' value='" . $resultado['id'] . "'> </form>
                            </td></tr>";
                            }
                            else if ($resultado['comment'] != "" && $resultado['responsable'] == $user_id && $resultado['status'] == "NO APROBADA"){
                            print "<tr><td id='fecha_input'>" . $resultado['date'] . "</td><td class='" . $resultado['status'] . "'>" . $resultado['status'] . " </td><td> " . $resultado['name_user'] . " </td><td>" . $resultado['last_name'] . "</td><td>" . $resultado['email'] . "</td><td> " . $resultado['name'] . "</td><td>" . $resultado['code'] . "</td><td>" . $resultado['hour'] . "</td>
                            <td><form action='horas_comment.php' method='GET'><button class='no_boton2' title='Observaciones'>
                            <i class='fa fa-comment-o' style='font-size:22px;color:orange'></i>
                            </button><input type='hidden' name='hours_id' value='" . $resultado['id'] . "' ></form></td>
                            <td>" . $resultado['who_approve'] . "</td><td>" . $resultado['register'] . "</td>
                            <td><form action='horas_conf.php' method='GET'>
                            <button class='no_boton2' name='delete' onclick='return confirmDelete()' title='Borrar' >
                            <i class='fa fa-trash-o' style='font-size:22px;color:red'></i>
                            </button>
                            <button name='edit' class='no_boton2' title='Editar'>
                            <i class='fa fa-edit' style='font-size:22px;color:black'></i>
                            </button>
                            <button name='confirm' class='no_boton2'>
                            <i class='fa fa-check-circle-o' style='font-size:22px;color:green' title='Aprobar'></i>
                            </button>
                            <input type='hidden' name='id' value='" . $resultado['id'] . "'> </form>
                            </td></tr>";
                            }
                            else if ($resultado['status'] == "APROBADA" && $resultado['comment']!=""){
                            print "<tr><td id='fecha_input'>" . $resultado['date'] . "</td><td class='" . $resultado['status'] . "'>" . $resultado['status'] . " </td><td> " . $resultado['name_user'] . " </td><td>" . $resultado['last_name'] . "</td><td>" . $resultado['email'] . "</td><td> " . $resultado['name'] . "</td><td>" . $resultado['code'] . "</td><td>" . $resultado['hour'] . "</td>
                            <td><form action='horas_comment.php' method='GET'><button class='no_boton2' title='Observaciones'>
                            <i class='fa fa-comment-o' style='font-size:22px;color:orange'></i>
                            </button><input type='hidden' name='hours_id' value='" . $resultado['id'] . "' ></form></td>
                            <td>" . $resultado['who_approve'] . "</td><td>" . $resultado['register'] . "</td>
                            <td>
                            </td></tr>";
                            }
                            else{
                            print "<tr><td id='fecha_input'>" . $resultado['date'] . "</td><td class='" . $resultado['status'] . "'>" . $resultado['status'] . " </td><td> " . $resultado['name_user'] . " </td><td>" . $resultado['last_name'] . "</td><td>" . $resultado['email'] . "</td><td> " . $resultado['name'] . "</td><td>" . $resultado['code'] . "</td><td>" . $resultado['hour'] . "</td>
                            <td></td>
                            <td>" . $resultado['who_approve'] . "</td><td>" . $resultado['register'] . "</td>
                            <td>
                            </td></tr>";
                            }
                            
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

?>