<?php

session_start();
include("../include/bbddconexion.php");
$id = $_REQUEST['id_gastos'];
$id_user = $_SESSION['id'];

if (!$conn) {
    die("Conexion fallida:" . mysqli_connect_error());
} 
else {
    $query = "select * from gastos where id=$id";
    $consulta = mysqli_query($conn, $query) or die("Fallo en la consulta");
    $num_filas = mysqli_num_rows($consulta);
    $resultado = mysqli_fetch_array($consulta);

    $query4 = "select * from works";
    $consulta4 = mysqli_query($conn, $query4) or die("Fallo en la consulta");
    $num_filas4 = mysqli_num_rows($consulta4);

    if (isset($_REQUEST['delete'])) {
        $query3 = "delete from gastos where id=$id";
        $consulta3 = mysqli_query($conn, $query3) or die("Fallo en la consulta");
        if ($consulta3){
            echo "<script language='javascript'>
                alert('¡¡ Fila de gasto eliminada !!');
                window.location.replace('./gastos.php');
                </script>";
        }
        else{
            echo "<script language='javascript'>
                alert('¡¡ Error al eliminar !!');
                window.location.replace('./gastos.php');
                </script>";
        }
        
    }

//     else if (isset($_REQUEST['edit'])){
//         include("../template/formularios.php");

//         print '
//         <span> Gastos | Editar </span>
//         <form action="gastos_edit_save.php" method="GET">

//             <hr><br>
            
//             Nombre de obra: <input type="search" name="buscar_obra" list="lista_obras" value=" ' . $resultado['nombre'] . '">
//             <datalist id="lista_obras">';
//         for ($i = 0; $i < $num_filas4; $i++) {
//             $resultado4 = mysqli_fetch_array($consulta4);
//             print ' <option name="lista_obras" value="' . $resultado4['name'] . '">';
//         }
//         print
//             '</datalist> <br><br>
            
//             Tipo de gasto: <select name="tipo_gasto" >
//                 <option>';
//         echo $resultado['tipo_gasto'];
//         print '</option>
//                 <option>DIETA</option>
//                 <option>KM</option>
//                 <option>VARIOS</option>
//             </select><br><br>
//             Importe: <input type="text" name="importe" value="' . $resultado['importe'] . '"> <br>
//             Fecha: <input type="date" name="fecha" value="'.$resultado['fecha'].'"><br>

//             <br><textarea name="comentario" rows="10" cols="40" placeholder="Añada comentario sobre los gastos varios, km, dieta...">';
//         echo $resultado['comentario'];
//         print '</textarea><br>
            
//             <input type="text" name="id_gasto" value="' . $resultado['id']  . '">

//             <br><hr><br>

//             <input type="submit" name="act" class="boton" value="Actualizar">
//             <input type="submit" class="boton" name="close" value="Cerrar">
//         </form>
//     </div>

// </body>

// </html>
//             '; 
//     }


}

?>