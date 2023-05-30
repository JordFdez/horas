<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="../user/horas_propias.php"><img src="../img/mis_horas.svg" height="30px" width="35px"> Mis Horas</a>
    <a href="../user/gastos.php"><img src="../img/euro.png" height="30px" width="35px"> Gastos</a>
    <a></a><a></a><a></a><a></a><a></a><a></a><br><br><br><br><br>
    <a></a><a></a><a></a><a></a><a></a><a></a><a></a><a>
        <a><i class="fa fa-user" style="font-size:24px;color:#818181"></i> <?php echo $_SESSION['name']; ?></a>
        <a href="../logout.php"><img src="../img/salir1.png" height="30px" width="30px"> Cerrar Sesión</a>
</div>

<div class="nav_der">
    <!-- Use any element to open the sidenav -->
    <span> <img src="../img/logo.webp" height="50px" width="120px"></span>
    <span onclick="openNav()">☰ Menú</span>

    <!-- Add all page content inside this div if you want the side nav to push page content to the right (not used if you only want the sidenav to sit on top of the page -->

    <span> </span>


</div>