<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>BaumControl</title>
    <link rel="shortcut icon" href="../img/favicon.png">

    <link rel="stylesheet" type="text/css" href="../css/user_add.css">
</head>

<body>
    <div class="cuerpo">
        <form action="add_tabla.php" method="GET">
            <h4>Horas | Añadir </h4>
            <hr>
            Nombre de la obra: <br><input type="text" name="nombre_obra"><br>
            codigo de la obra: <br><input type="text" name="cod_obra"><br>
            horas: <br><input type="text" name="horas"><br>
            Hora Extra:<input type="checkbox" name="hora_extra">
            Fecha: <input type="date" name="fecha">
            <br>

            <hr><br>

            <input type="submit" name="add" value="Añadir">
            <input type="submit" class="boton" name="close" value="Cerrar">
        </form>
    </div>

</body>

</html>