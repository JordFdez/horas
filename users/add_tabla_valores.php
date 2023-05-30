<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>BaumControl</title>
    <link rel="stylesheet" type="text/css" href="../css/user_add.css">
</head>

<body>
    <div class="cuerpo">
        <form action="add_tabla.php" method="GET">
            <h4>Usuario | Añadir </h4>
            <hr>
            Nombre: <br><input type="text" name="nombre"><br>
            Apellido: <br><input type="text" name="apellido"><br>
            Email: <br><input type="email" name="email"><br>
            Contraseña: <br><input type="password" name="pass"><br><br>
            Estado <select name="estado">
                <option>Activada</option>
                <option>Desactivada</option>
            </select><br><br>

            Horario:<select name="horario">
                <option>Horario 1</option>
                <option>Horario 2</option>
                <option>Horario 3</option>
            </select><br><br>
            Rol:<select name="rol">
                <option>root</option>
                <option>admin</option>
                <option>user</option>
                <option>gestion</option>
            </select><br>

            <hr><br>

            <input type="submit" name="add" value="Añadir">
        </form>
    </div>

</body>

</html>