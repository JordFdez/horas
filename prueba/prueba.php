<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="prueba.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>
    <button id="myBtn" title="" onclick="myFunction()">NO APROBADA</button>
    <script>
        function myFunction() {
            var x = document.getElementById("myBtn");
            if (x.innerHTML === "APROBADA") {
                x.innerHTML = "NO APROBADA";
                var ap = x.innerHTML;
                x.style.backgroundColor = "#EFEFEF";
            } else {
                x.innerHTML = "APROBADA";
                var ap = x.innerHTML;
                x.style.backgroundColor = "#18ff00";
            }
        }
    </script>
</body>

<script type="text/javascript" src="prueba.js">
</script>

</html>