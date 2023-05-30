<!DOCTYPE html>
<html lang="es">

<head>
    <meta content="initial-scale=1, maximum-scale=1, user-scalable=0" name="viewport" />

    <meta name="viewport" content="width=device-width" />

    <title>BaumControl</title>
    <link rel="shortcut icon" href="../img/favicon.png">

    <link rel="stylesheet" href="../css/nav-bar.css">
    <link rel="stylesheet" href="../css/formularios.css">
    <script type="text/javascript" src="../js/gastos.js">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#tipo_gasto').change(function(e) {
                if ($(this).val() === "VARIOS") {
                    $('#miinput').prop("disabled", false);
                } else {
                    $('#miinput').prop("disabled", true);
                }
            })
        });
    </script>

</head>

<body>
    <div class="fondo_naranja">
        <div class="nav-bar">
            <div class="medio">
                <nav class="medio_ajuste">

                </nav>
            </div><br>
        </div>
        <div class="tabla_estilo">
            <!-- <span>Horas</span><br><br>
        </div>
    </div> -->