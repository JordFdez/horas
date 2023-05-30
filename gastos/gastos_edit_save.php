<?php

session_start();
include("../include/bbddconexion.php");

$nombre = $_REQUEST['buscar_obra'];
$gasto = $_REQUEST['tipo_gasto'];
$importe = $_REQUEST['importe'];
$comentario = $_REQUEST['comentario'];
$id_gasto = $_REQUEST['id_gasto'];

$id = $_SESSION['id'];

if (isset($_REQUEST['miinput'])){
    $fileName = $_REQUEST['miinput'];
}
else{
    $fileName = "";
}

if (!$conn) {
    die("Conexion fallida:" . mysqli_connect_error());
} 
else {
    if (isset($_REQUEST['act'])) {
        if ($nombre == "" | $gasto == "" | $importe == "" ){
            echo "<script language='javascript'>
                alert('¡¡ Faltan datos por rellenar !!');
                window.location.replace('./gastos.php');
                </script>"; 
        }
        else{
            if ($gasto == "DIETA"){
            $query2 = "update gastos set nombre='$nombre', tipo_gasto='$gasto', importe=(select $importe*dieta_importe from importe_gasto where user_id=$id ), comentario='$comentario' where id=$id_gasto;";
            $consulta = mysqli_query($conn, $query) or die("Fallo en la consulta");
                if ($consulta) {
                    echo "<script language='javascript'>
                alert('¡¡ Gasto editado con exito !!');
                window.location.replace('./gastos.php');
                </script>";
                } 
                else {
                    echo "<script language='javascript'>
                alert('¡¡ Error al editar gasto !!');
                window.location.replace('./add_gastos.php');
                </script>";
                }
        }
        else if ($gasto == "KM"){
            $query2 = "update gastos set nombre='$nombre', tipo_gasto='$gasto', importe=(select $importe*km_importe from importe_gasto where user_id=$id ), comentario='$comentario' where id=$id_gasto;";
            $consulta2 = mysqli_query($conn, $query2) or die("Fallo en la consulta");
            if ($consulta2) {
                echo "<script language='javascript'>
                alert('¡¡ Gasto editado con exito !!');
                window.location.replace('./gastos.php');
                </script>";
            } 
            else {
                echo "<script language='javascript'>
                alert('¡¡ Error al editar gasto !!');
                window.location.replace('./add_gastos.php');
                </script>";
            }

        }
        else if ($gasto == "VARIOS") {
                // verifica si esta seleccionado
                if ($_FILES['miinput']['name'] != "") {
                    $targetDir = "../img_gastos/"; //nombre directorio
                    $fileName = basename($_FILES['miinput']['name']); //nombre fichero
                    $targetFilePath = $targetDir . $fileName;
                    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

                    // solo formato especifico
                    $allowedTypes = array('jpg', 'jpeg', 'png', 'gif', 'svg', 'jfif', 'psd', 'tiff', 'bmp', 'heif');
                    if (in_array($fileType, $allowedTypes)) {
                        // subida imagen al servidor
                        if (move_uploaded_file($_FILES['miinput']['tmp_name'], $targetFilePath)) {
                            $query2 = "update gastos set nombre='$nombre', tipo_gasto='$gasto', importe=$importe, comentario='$comentario', imagen_gasto='$fileName' where id=$id_gasto;";
                            $consulta2 = mysqli_query($conn, $query2) or die("Fallo en la consulta");
                            if ($consulta2) {
                                echo "<script language='javascript'>
                                    alert('¡¡ Gasto editado con exito !!');
                                    window.location.replace('./gastos.php');
                                    </script>";
                            } else {
                                echo "<script language='javascript'>
                                    alert('¡¡ Error al editar gasto !!');
                                    window.location.replace('./add_gastos.php');
                                    </script>";
                            }
                        } else {
                            echo "<script language='javascript'>
                                alert('¡¡ Error al subir la imagen !!');
                                window.location.replace('./add_gastos.php');
                                </script>";
                        }
                    } else {
                        echo "<script language='javascript'>
                            alert('¡¡ Tipo de archivo no permitido por la extension, solo se permite JPG, JPEG, PNG, GIF, SVG, JFIF, PSD, TIFF, BMP, HEIF !!');
                            window.location.replace('./add_gastos.php');
                            </script>";
                    }
                } else {
                    echo "<script language='javascript'>
                        alert('¡¡ Debe seleccionar una imagen !!');
                        window.location.replace('./add_gastos.php');
                        </script>";
                }
            }
        }
    }
        else if (isset($_REQUEST['close'])) {
        header('Location:./gastos.php');
        }  
    }

?>

