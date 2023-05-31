<?php

session_start();
include("../include/bbddconexion.php");

$nombre = $_REQUEST['buscar_obra'];
$gasto = $_REQUEST['tipo_gasto'];
$importe = $_REQUEST['importe'];
$fecha = $_REQUEST['fecha'];
$comentario = $_REQUEST['comentario'];
$id = $_SESSION['id'];


if (!$conn) {
    die("Conexion fallida:" . mysqli_connect_error());
} 
else {
    if (isset($_REQUEST['add'])) {
    if ($nombre == "" | $gasto == "" | $importe == "" | $fecha == ""){
        echo "<script language='javascript'>
        alert('¡¡ Faltan datos por rellenar !!');
        window.location.replace('./add_gastos.php');
        </script>"; 
    }
    else {
        
        if ($gasto == "DIETA"){
            $query = "insert into gastos (id, estado, nombre, work_id, tipo_gasto, importe, fecha, comentario, user_id, alta_gasto) values (NULL, 'NO APROBADA', '$nombre' , (select id from works where name='$nombre'), '$gasto', (select $importe*dieta_importe from importe_gasto where user_id=$id), '$fecha', '$comentario', (select id from users where id=$id), NOW());";
            $consulta = mysqli_query($conn, $query) or die("Fallo en la consulta");
                if ($consulta) {
                    echo "<script language='javascript'>
                alert('¡¡ Gasto añadido con exito !!');
                window.location.replace('./gastos.php');
                </script>";
                } 
                else {
                    echo "<script language='javascript'>
                alert('¡¡ Error al añadir gasto !!');
                window.location.replace('./add_gastos.php');
                </script>";
                }
        }
        else if ($gasto == "KM"){
            $query2 = "insert into gastos (id, estado, nombre, work_id, tipo_gasto, importe, fecha, comentario, user_id, alta_gasto) values (NULL, 'NO APROBADA', '$nombre' , (select id from works where name='$nombre'), '$gasto', (select $importe*km_importe from importe_gasto where user_id=$id), '$fecha', '$comentario', (select id from users where id=$id), NOW());";
            $consulta2 = mysqli_query($conn, $query2) or die("Fallo en la consulta");
            if ($consulta2) {
                echo "<script language='javascript'>
                alert('¡¡ Gasto añadido con exito !!');
                window.location.replace('./gastos.php');
                </script>";
            } 
            else {
                echo "<script language='javascript'>
                alert('¡¡ Error al añadir gasto !!');
                window.location.replace('./add_gastos.php');
                </script>";
            }

        }
        // else if ($gasto == "LOCOMOCION"){
        //     $query3 = "insert into gastos (id, estado, nombre, work_id, tipo_gasto, importe, fecha, comentario, user_id, alta_gasto) value (NULL, 'NO APROBADA', '$nombre' , (select id from works where name='$nombre'), '$gasto', (select $importe*locomocion_importe from importe_gasto where user_id=$id), '$fecha', '$comentario', (select id from users where id=$id), NOW())";
        //     $consulta3 = mysqli_query($conn, $query3) or die ("Fallo en la consulta locomocion");
        //     if ($consulta3){
        //         echo "<script language='javascript'>
        //         alert('¡¡ Gasto añadido con exito !!');
        //         window.location.replace('./gastos.php');
        //         </script>";
        //     } 
        //     else {
        //         echo "<script language='javascript'>
        //         alert('¡¡ Error al añadir gasto !!');
        //         window.location.replace('./add_gastos.php');
        //         </script>";
        //     }
        // }

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
                        $nombreCompleto = $targetDir . $fileName;

                        // subida imagen al servidor
                        if (move_uploaded_file($_FILES['miinput']['tmp_name'], $targetFilePath)) {
                            $query2 = "insert into gastos (id, estado, nombre, work_id, tipo_gasto, importe, fecha, comentario, user_id, imagen_gasto, alta_gasto) values (NULL, 'NO APROBADA', '$nombre', (select id from works where name='$nombre'), '$gasto', $importe, '$fecha', '$comentario', (select id from users where id=$id), '$fileName', NOW());";
                            $consulta2 = mysqli_query($conn, $query2) or die("Fallo en la consulta");
                            if ($consulta2) {
                                echo "<script language='javascript'>
                                    alert('¡¡ Gasto añadido con exito !!');
                                    window.location.replace('./gastos.php');
                                    </script>";
                            } else {
                                echo "<script language='javascript'>
                                    alert('¡¡ Error al añadir gasto !!');
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
        else if(isset($_REQUEST['close'])){
            header('Location:./gastos.php');
    }
}
