<?php
session_start();
include("./include/bbddconexion.php");

$email = $_REQUEST["email"];
$password = $_REQUEST["password"];

if(isset($_REQUEST['iniciar'])){

    if (!$conn) {
        die("Conexion fallida:" . mysqli_connect_error());
    }
    else{
        $query = "select * from users where email='$email'"; // and password2=$password
        $consulta = mysqli_query($conn, $query) or die("Fallo en la consulta");
        $num_filas = mysqli_num_rows($consulta);
        $resultado = mysqli_fetch_array($consulta);

        if ($num_filas == 1) {
            $_SESSION['id'] = $resultado['id'];
            $_SESSION['name'] = $resultado['name'];
            $_SESSION['last_name'] = $resultado['last_name'];
            $_SESSION['email'] = $resultado['email'];
            $_SESSION['pass'] = $resultado['password2'];
            $_SESSION['rol_id'] = $resultado['rol_id'];
            $_SESSION['type'] = $resultado['type'];
        
            if ($email == $_SESSION['email'] && $_SESSION['type'] == 'ACTIVADA' ){
                //cuando ya esten todas actualizadas.
                //if ($email == $_SESSION['email'] && $password == $_SESSION['pass'] && $_SESSION['type'] == 'ACTIVADA'){
                $id = $_SESSION['id'];
                $query1 = "update users set password2=MD5('$password') where id=$id;";
                $consulta2 = mysqli_query($conn, $query1) or die ("Fallo en la consulta");
                if ($consulta2){
                    if ($resultado['rol_id'] == "1" || $resultado['rol_id'] == "2"|| $resultado['rol_id'] == "4"){
                        header('Location:./horas_general/horas_todos.php');
                    }
                    else{
                        header('Location:./user/horas_propias.php');
                    }

                }
                else{
                    echo "<script language='javascript'>
                    alert('Contraseña incorrecta');
                    window.location.replace('./index.php');
                    </script>";
                }
            }
            else{
                echo "<script language='javascript'>
                    alert('Cuenta no activa');
                    window.location.replace('./index.php');
                    </script>";
            }
            
        } 
        else {
            echo "<script language='javascript'>
                    alert('Datos erroneos o Cuenta no activada');
                    window.location.replace('./index.php');
                    </script>";
        }

    }
}

?>