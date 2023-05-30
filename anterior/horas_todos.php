<?php

session_start();
include("./include/bbddconexion.php");

if (!$conn) {
    die("Conexion fallida:" . mysqli_connect_error());
} 
else {
    $query = "select hours.status, users.name as 'name_user', works.name, hours.date, hours.hour, hours.comment, hours.id from hours, users, works where users.id=hours.user_id and hours.work_id=works.id order by hours.id desc;";
    $consulta = mysqli_query($conn, $query) or die("Fallo en la consulta");
    $num_filas = mysqli_num_rows($consulta);

    if ($consulta) {

        echo '
            <!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>BaumControl</title>
    <link rel="stylesheet" type="text/css" href="./css/user.css">
    <link rel="stylesheet" type="text/css" href="./css/nav_dropdown.css">
</head>

<body>
    <div class="fondo">
        <div class="nav">
            <div class="encabezado">
                <h3>Horas</h3>
            </div>
            <div class="buscador">
                <div id="buscador2" wire:id="mtTQPHZkOsXxxbL2DJiq" class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
                    <span class="text-sm ease leading-5.6 absolute z-50 -ml-px flex h-full items-center whitespace-nowrap rounded-lg rounded-tr-none 
                            rounded-br-none border border-r-0 border-transparent bg-transparent py-2 px-2.5 text-center font-normal text-slate-500 transition-all">
                        <i class="fas fa-search" aria-hidden="true"></i>
                    </span>
                    <input type="text" wire:keyup="searchItem" wire:model="search" name="buscar" class="pl-9 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border 
                            border-solid border-gray-300 dark:bg-slate-850 dark:text-white bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all 
                            placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" placeholder="Buscar...">
                </div> <!-- buscador boton  -->
            </div>
            <div class="nav_der">
                <p>
                    <!-- desplegable -->
                <div class="dropdown">
                    <button class="no_boton"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                            <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                        </svg></button>

                </div>

                <!-- notificacion -->
                <button class="no_boton">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                    </svg>
                </button>
                </p>
            </div>
        </div><br><br><br>

        <div class="medio">
            <nav class="medio_ajuste">
                <div class="items">
                    <span class="item_span"><a class="item_a" href="#"> Ir a resto horas</a></span>
                </div>
                <div class="items ">
                    <span class="item_span"><a class="item_a" href="#"> Ver Obras</a></span>
                </div>
                <div class="items">
                    <span class="item_span"><a class="item_a" href="#">Ir a Administracion</a></span>
                </div>
                <div class="items ">
                    <span class="item_span"><a class="item_a" href="#"> Horas totales: </a></span>
                </div>
            </nav>
        </div><br><br><br>

        <div class="cuerpo">
            <div class="tabla_horas">
                <div class="encab_div_izq">
                    <p class="encab">Horas</p>
                </div>
                <div class="encab_div_der">
                    
                        <input type="submit" class="no_boton2" name="excell" value="Excell">
                        </input>
                        <input type="submit" class="no_boton2" name="busqav" value="Busqueda Avanzada"></input>
                        <input type="submit" class="no_boton2" name="resetbusq" value="Resetear Busqueda"></input>

                </div>
                <table>
                    <tr>
                        <th>Estado</th>
                        <th>Usuario</th>
                        <th>Obra</th>
                        <th>Fecha</th>
                        <th>Horas</th>
                        <th>Obervaciones</th>
                    </tr>';
                    for ($i = 0; $i < $num_filas; $i++) {
                        $resultado = mysqli_fetch_array($consulta);
                        print "<tr><td>" . $resultado['status'] . " </td><td> " . $resultado['name_user'] . "</td><td>" . $resultado['name'] . "</td><td>" . $resultado['date'] . "</td><td>" . $resultado['hour'] . "</td><td><form action='horas_comment.php' method='GET'><button class='no_boton2'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-chat-dots-fill' viewBox='0 0 16 16'>
                        <path d='M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM5 8a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z'/>
                        </svg></button><input type='hidden' name='hours_id' value='" . $resultado['id'] ."' ></form>" . $resultado['comment'] . "</td></tr>";
                    }
                    echo '
                </table>
            </div>
        </div>
        ';
        
    } else {
        echo "<script language='javascript'>
            alert('¡¡ Error al añadir las horas!!');
            window.location.replace('./horas.php');
            </script>";
    }
}

?>