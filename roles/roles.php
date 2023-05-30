<?php
session_start();
include("../include/bbddconexion.php");

if (!$conn) {
    die("Conexion fallida:" . mysqli_connect_error());
} else {
    $query = "select users.id, users.name as 'user', users.last_name, users.email, roles.name from users, roles where users.rol_id=roles.id;";
    $consulta = mysqli_query($conn, $query) or die("Fallo en la consulta");
    $num_filas = mysqli_num_rows($consulta);
    if ($consulta){
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
<span>Pages / <b>Roles</b></span>

<!--include menu -->
'; 
include("../template/menu.php"); 
echo ' <br><br>

<div class="tabla_estilo">
<span>Roles</span><br><br>
<!--tables with data-->
        <table class="records_list table table-striped table-bordered table-hover" id="mydatatable">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Rol</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tfoot>
                <tr>
                    <th>Filter..</th>
                    <th>Filter..</th>
                    <th>Filter..</th>
                    
                </tr>
            </tfoot>
                    <tbody>';
                     for ($i = 0; $i < $num_filas; $i++) {
                        $resultado = mysqli_fetch_array($consulta);
                        print "<tr><td><h6>" . $resultado['user'] . " " . $resultado['last_name'] . "</h6> <p><input type='hidden' name='email' value='" . $resultado['email'] . "'>" . $resultado['email'] . " </p></td><td>" . $resultado['name'] . "</td><td><form action='roles_edit.php' method='GET'><input name='id_rol' type='hidden' value=" . $resultado['id'] . ">
                        <button name='edit' class='no_boton2' title='Editar'>
                            <i class='fa fa-edit' style='font-size:22px;color:black'></i>
                            </button>
                </form></td></tr>";
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
    <script type="text/javascript">
    function confirmDelete(){
        var resp = confirm("¿Desea eliminarlo?");

        if ($resp == true){
            return true;
        }
        else{
            return false;
        }
    }
</script>
    </body>
  
</html>
        ';
        
    } 
    else {
        echo "<script language='javascript'>
            alert('¡¡ Error al añadir las horas!!');
            window.location.replace('./horas.php');
            </script>";
    }
}
