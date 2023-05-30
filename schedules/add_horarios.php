<?php

include("../template/formularios.php");
print '
        <span> Horario | Añadir </span>
        <form action="add_horario_tabla.php" method="GET">

            <hr><br>
            Nombre: <input type="text" class="horario_nmame" name="nombre"><br>
            Lunes: <input type="text" class="horario" name="L"><br>
            Martes: <input type="text" class="horario" name="M"><br>
            Miercoles: <input type="text" class="horario" name="X"><br>
            Jueves: <input type="text" class="horario" name="J"><br>
            Viernes: <input type="text" class="horario" name="V"><br>

            <br>

            <hr><br>

            <input type="submit" name="add" class="boton" value="Añadir">
            <input type="submit" class="boton" name="close" value="Cerrar">
        </form>
    </div>

</body>

</html>';

?>