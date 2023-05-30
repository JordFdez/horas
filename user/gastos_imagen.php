<?php

session_start();
include("../include/bbddconexion.php");

$id_gastos = $_REQUEST['id_gastos'];

if (!$conn) {
    die("Conexion fallida:" . mysqli_connect_error());
} else {
    $query = "select imagen_gasto, user_id, email from gastos, users where users.id=gastos.user_id and gastos.id=$id_gastos and email=(select email from users where users.id=user_id)";
    $consulta = mysqli_query($conn, $query) or die("Fallo en la consulta");
    $resultado = mysqli_fetch_array($consulta);
}
include("../template/formularios.php");
?>

<span> Gastos | Imagen</span>
<form action="gastos_imagen_close.php" method="GET">

    <hr><br>
    <div class="imagen_gasto" id="divParaimprimir">
        <img id="imagenParaImprimir"  src="../img_gastos/<?php echo $resultado['imagen_gasto'] ?>" class="imagen_gasto">
    </div>
    <hr><br>
    <button class="boton" name ="print" onclick="imprimirImagen()">Imprimir</button><br>
    <input type="submit" name="close" class="boton" value="Cerrar">
</form>
</div>
</div>

<script>
    function imprimirImagen() {
        var imagen = document.getElementById("imagenParaImprimir");

        var ventanaImpresion = window.open('', '_blank');
        ventanaImpresion.document.write('<html><head><title><?php echo $resultado['email'] ?></title></head><body>');
        ventanaImpresion.document.write('<img src="' + imagen.src + '">');
        ventanaImpresion.document.write('</body></html>');

        ventanaImpresion.document.close();
        ventanaImpresion.print();
    }
</script>


</body>

</html>