<?php

$nombre = $_REQUEST['nombre'];

echo "<script language='javascript'>
            alert('¡¡ $nombre !!');
            window.location.replace('./prueba_modal.php');
            </script>";

?>