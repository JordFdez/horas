

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>BaumControl</title>
    <link rel="stylesheet" type="text/css" href="./css/user_add.css">
</head>

<body>
    <div class="cuerpo">
        <form action="horarios_general_save.php" method="GET">
            <h4> Horarios | Añadir </h4>
            <hr>
            Nombre: <br><input type="text" name="name"><br>
            Lunes: <br><input type="number" name="L"><br>
            Martes: <br><input type="number" name="M"><br>
            Miercoles: <br><input type="number" name="X"><br>
            Jueves: <br><input type="number" name="J"><br>
            Viernes: <br><input type="number" name="V"><br>

            <hr><br>

            <input type="submit" name="add" value="Añadir">
        </form>
    </div>

</body>

</html>
