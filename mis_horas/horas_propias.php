<?php

session_start();

include("../include/bbddconexion.php");
$user_id = $_SESSION['id'];

if (!$conn) {
    die("Conexion fallida:" . mysqli_connect_error());
} 
else {
    $query = "select hours.status, works.name, hours.date, hours.hour, hours.comment, hours.id, hours.register from hours, users, works where users.id=hours.user_id and hours.work_id=works.id and users.id=$user_id order by hours.id desc;";
    $consulta = mysqli_query($conn, $query) or die("Fallo en la consulta");
    $num_filas = mysqli_num_rows($consulta);

    if ($consulta) {

        echo '<!DOCTYPE html>
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
            include("../include/eliminar.php");
        
        echo '</head>
        
        <body>
        <div class="fondo_naranja">
        <div class="nav-bar">
            <span>Pages / <b>Mis Horas</b></span>
        
            <!--include menu -->
            ';
            include("../template/menu.php"); 
            echo ' <br><br>
            <div class="medio">
            <nav class="medio_ajuste">

                <a class="item_a" href="./resto_horas.php">
                    <div class="items">
                        <span class="item_span"> Ir a resto horas </span>
                    </div>
                </a>

                <a class="item_a" href="../works/obras.php">
                    <div class="items ">
                        <span class="item_span"> <img src="../img/const1.svg" height="25px" width="30px"> Ver Obras </span>
                    </div>
                </a>

                <a class="item_a" href="add_horas_propias.php">
                    <div class="items ">
                        <span class="item_span"> Añadir Horas </span>
                    </div>
                </a>
            </nav>
        </div><br><br>

        
        <div class="tabla_estilo">
            <span>Mis Horas</span><br><br>
            <!--tables with data-->
        <table class="records_list table table-striped table-bordered table-hover" id="mydatatable">
                            <thead>
                                <tr>
                                    
                                    <th>Fecha</th>
                                    <th>Obra</th>
                                    <th>Estado</th>
                                    <th>Horas</th>
                                    <th>Obervaciones</th>
                                    <th>Horas Extras</th>
                                    <th>Acciones</th>
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
                    <th>Filter..</th>          
                </tr>
            </tfoot>
                            <tbody>';
                                for ($i = 0; $i < $num_filas; $i++) {
                                    $resultado = mysqli_fetch_array($consulta);
                                    if ($resultado['comment'] == ""){
                print "<tr><td>" . $resultado['date'] . "</td><td>" . $resultado['name'] . "</td><td class='" . $resultado['status'] . "'>" . $resultado['status'] . " </td><td>" . $resultado['hour'] . "</td><td></td>
                                    <td>" . $resultado['register'] . "</td>
                                    <td><form action='horas_propias_conf.php' method='GET' >
                                    <input type='hidden' name='id_hours' value='" . $resultado['id'] . "'>
                                    <button class='no_boton2' name='delete' title='Borrar' >
                            <i class='fa fa-trash-o' style='font-size:22px;color:red'></i>
                            </button>
                            <button name='edit' class='no_boton2' title='Editar'>
                            <i class='fa fa-edit' style='font-size:22px;color:black'></i>
                            </button></form></td</tr>";
                                    }
                                    else{
                print "<tr><td>" . $resultado['date'] . "</td><td>" . $resultado['name'] . "</td><td class='" . $resultado['status'] . "'>" . $resultado['status'] . " </td><td>" . $resultado['hour'] . "</td><td><form action='../horas_general/horas_comment.php' method='GET'><button class='no_boton2'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-chat-dots-fill' viewBox='0 0 16 16'>
                                    <path d='M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM5 8a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z'/>
                                    </svg></button><input type='hidden' name='hours_id' value='" . $resultado['id'] . "' ></form></td>
                                    <td>" . $resultado['register'] . "</td>
                                    <td><form action='horas_propias_conf.php' method='GET' >
                                    <input type='hidden' name='id_hours' value='" . $resultado['id'] . "'>
                                    <button class='no_boton2' name='delete'  title='Borrar' >
                            <i class='fa fa-trash-o' style='font-size:22px;color:red'></i>
                            </button>
                            <button name='edit' class='no_boton2' title='Editar'>
                            <i class='fa fa-edit' style='font-size:22px;color:black'></i>
                            </button></form></td</tr>";
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
          
        </html>';
    } else {
        echo "<script language='javascript'>
            alert('¡¡ Error al añadir las horas!!');
            window.location.replace('./horas_propias.php');
            </script>";
    }
}

?>