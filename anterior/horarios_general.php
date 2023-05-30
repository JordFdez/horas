<?php

session_start();
include("./include/bbddconexion.php");

if (!$conn) {
    die("Conexion fallida:" . mysqli_connect_error());
} else {
    $query = "select id, name, L, M, X, J, V, total from schedules ;";
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
                    
                    <form action="horarios_general_add.php" method="GET">
                        <input type="submit" name="add" value="Añadir">
                    </form>

                </div>
                <table>
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Lunes</th>
                        <th>Martes</th>
                        <th>Miercoles</th>
                        <th>Jueves</th>
                        <th>Viernes</th>
                        <th>total</th>
                        <th></th>
                    </tr>';
        for ($i = 0; $i < $num_filas; $i++) {
            $resultado = mysqli_fetch_array($consulta);
            print "<tr><td>" . trim($resultado['id']) . " </td><td> " . trim($resultado['name']) . "</td><td>" . $resultado['L'] . "</td><td>" . $resultado['M'] . "</td><td>" . $resultado['X'] . "</td><td>" . $resultado['J'] . "</td><td>" . $resultado['V'] . "</td><td>" . $resultado['total'] . "</td><td><form action='horarios_general_conf.php' method='GET'><button class='no_boton2' name='delete'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash3' viewBox='0 0 16 16'>
  <path d='M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z'/>
</svg></button><button name='edit' class='no_boton2' ><svg id='edit' xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                    <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z' />
                    <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z' />
                </svg></button><input type='hidden' name='id_schedules' value='" . $resultado['id'] . "'></td></form></tr>";
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
