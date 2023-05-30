<?php

session_start();

include("../include/bbddconexion.php");
$user_id = $_SESSION['id'];

if (!$conn) {
    die("Conexion fallida:" . mysqli_connect_error());
} 
else {
    $query = "select works.id, works.code, works.name as 'nombre_obra', users.email, works.created_at, works.id from works, users  where users.id=works.user_id and users.id=$user_id";
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
            <span>Pages / <b>Mis Obras</b></span>
        
            <!--include menu -->
            ';
            include("../template/menu.php"); 
            echo ' <br><br>
            <div class="medio">
            <nav class="medio_ajuste">

                <a class="item_a" href="../works/obras.php">
                <div class="items ">
                    <span class="item_span"> <img src="../img/const1.svg" height="25px" width="30px"> Ver Obras </span>
                </div>
                </a>

                <a class="item_a" href="./works_add.php">
                 <div class="items">
                    <span class="item_span"> Añadir Obra </span>
                </div>
                </a>
            </nav>
        </div><br><br>

        
        <div class="tabla_estilo">
            <span>Mis Obras</span><br><br>
            <!--tables with data-->
        <table class="records_list table table-striped table-bordered table-hover" id="mydatatable">
                            <thead>
                                <tr>
                                    
                                    <th>Codigo</th>
                                    <th>Nombre</th>
                                    <th>Responsable</th>
                                    <th>Fecha</th>
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
                </tr>
            </tfoot>
                            <tbody>';
                                for ($i = 0; $i < $num_filas; $i++) {
                                    $resultado = mysqli_fetch_array($consulta);
                                    
                                    print "<tr><td>" . $resultado['code'] . "</td><td>" . $resultado['nombre_obra'] . "</td><td>" . $resultado['email'] . "</td>
                                        <td>" . $resultado['created_at'] . "</td>
                                        <td><form action='mis_obras_conf.php' method='GET' >
                                        <input type='hidden' name='id_hours' value='" . $resultado['id'] . "'>
                                        <button class='no_boton2' name='delete'  title='Borrar' >
                                        <i class='fa fa-trash-o' style='font-size:22px;color:red'></i>
                                        </button>
                                        <button name='edit' class='no_boton2' title='Editar'>
                                        <i class='fa fa-edit' style='font-size:22px;color:black'></i>
                                        </button></form></td</tr>";
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
    } 
    else {
        echo "<script language='javascript'>
            alert('¡¡ Error al añadir las horas!!');
            window.location.replace('./horas_propias.php');
            </script>";
    }
}
