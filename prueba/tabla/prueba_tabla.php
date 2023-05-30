<?php

$conexion = mysqli_connect("localhost", "root", "rootroot") or die ("No se puede conectar con el servidor");

mysqli_select_db($conexion, "baumcontrol_controlhoras2") or die ("No se puede seleccionar la base de datos");

$instruccion1 = "select * from hours";

$consulta = mysqli_query($conexion, $instruccion1) or die ("Fallo en la consulta");
$num_filas = mysqli_num_rows($consulta);


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Tabla</title>

    <!-- Required meta tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js"></script>

    <!-- Datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.18/datatables.min.css">
    <script src="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.18/datatables.min.js"></script>

    <!-- Buttons -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.53/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.53/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <style>
        #mydatatable tfoot input {
            width: 100% !important;
        }

        #mydatatable tfoot {
            display: table-header-group !important;
        }
        .no_boton{
            border: none;
        }
        #APROBADA{
            background-color: pink; 
        }
        

    </style>
        <script type="text/javascript" src="./tabla_ex.js"></script>
        <!-- <script type="text/javascript">
            function cambiarFondo(td){
                var td = document.getElementById("estado");
                console.log(td.value);
                if("NO APROBADA" == td.value){ 
                    td.style.backgroundColor = "blue";
                }
                else{
                    td.style.backgroundColor = "Red";
                }
                
            }
        </script> -->
</head>

<body class="container-fluid p-5">
    
    <div class="arriba">
        <button class="no_boton"> <img src="./mis_horas.svg" height="30px" width="35px">Mis horas</button>
        <button class="no_boton"> <img src="./users1.svg" height="30px" width="35px">Usuarios</button>
        <button class="no_boton"> <img src="./rol.svg" height="30px" width="35px">Roles</button>
        <button class="no_boton"> <img src="./reloj.svg" height="30px" width="35px">Horas</button>
        <button class="no_boton"> <img src="./const1.svg" height="30px" width="35px">Obras</button>       
        <button class="no_boton"> <img src="./horarios.svg" height="30px" width="35px">Horarios</button>
        <button class="no_boton"> <img src="./user.svg" height="30px" width="35px">Nombre</button>
        <button class="no_boton"> <img src="./salir.svg" height="30px" width="35px">Cerrar Sesion</button>
        
    </div><br>

    <div class="table-responsive" id="mydatatable-container">
        <table class="records_list table table-striped table-bordered table-hover" id="mydatatable">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>usuario</th>
                    <th>horas</th>
                    <th>work</th>
                    <th>comment</th>
                    <th>who_approve</th>
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
                    <th>Filter..</th>
                    
                </tr>
            </tfoot>
            <tbody>
                    <?php 
                        for ($i=0; $i<$num_filas; $i++){
                            $resultado = mysqli_fetch_array($consulta);
                            print"<tr><td>". $resultado["date"] ."</td>
                            <td id='".$resultado['status']."'> ". $resultado["status"] ."</td>
                            <td>". $resultado["user_id"] ."</td>
                            <td>". $resultado["hour"] ."</td>
                            <td>". $resultado["work_id"] ."</td>
                            <td>". $resultado["comment"] ."</td>
                            <td>". $resultado["who_approve"] ."</td>
                            <td>botones</td></tr> ";
                        }
                    ?>
                
            </tbody>
        </table>
    </div>




</body>

</html>