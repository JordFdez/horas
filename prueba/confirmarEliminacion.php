<form action="eliminar_dato.php" method="post" onsubmit="return confirmarEliminacion();">
    <input type="hidden" name="id" value="123" /> <!-- Reemplaza "123" con tu ID real -->
    <input type="submit" value="Eliminar Dato" />
</form>

<script>
function confirmarEliminacion() {
    return confirm("¿Estás seguro de que deseas eliminar este dato?");
}
</script>

<?php
// Conexión a la base de datos
$conn = mysqli_connect("localhost", "usuario", "contraseña", "basedatos");

// Obtener el ID del dato a eliminar (enviado a través del formulario)
$id = $_POST['id'];

// Consulta SQL para eliminar el dato
$sql = "DELETE FROM tabla WHERE id = $id";

// Ejecutar la consulta
$result = mysqli_query($conn, $sql);

// Verificar si la eliminación fue exitosa
if ($result) {
    echo "Dato eliminado correctamente";
} else {
    echo "Error al eliminar el dato: " . mysqli_error($conn);
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
