<!-- Menu desplegable -->

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="../mis_horas/horas_propias.php"><img src="../img/mis_horas.svg" height="30px" width="35px"> Mis Horas</a>
  <a href="../users/usuario.php"><img src="../img/users1.svg" height="30px" width="35px"> Usuarios</a>
  <a href="../roles/roles.php"> <img src="../img/rol.svg" height="30px" width="35px"> Roles</a>
  <a href="../horas_general/horas_todos.php"><img src="../img/reloj.svg" height="30px" width="35px"> Horas</a>
  <a href="../works/obras.php"><img src="../img/const1.svg" height="30px" width="35px"> Obras</a>
  <a href="../schedules/horarios.php"><img src="../img/horarios.svg" height="30px" width="35px"> Horarios</a>
  <a href="../gastos/gastos.php"><img src="../img/euro.png" height="30px" width="35px"> Gastos </a>

  <div class="dropdown">
    <a><img src="../img/importes.svg" height="30px" width="35px"> Importe</a>
    <div class="dropdown-content">
      <a href="../importe/km.php">KM</a>
      <a href="../importe/dieta.php">DIETA</a>
      <a href="../importe/horas.php">HORAS</a>
    </div>
  </div>

  <a></a><a></a><a></a><a></a><a></a><a></a>
  <a></a>
  <a><i class="fa fa-user" style="font-size:24px;color:#818181"></i> <?php echo $_SESSION['name']; ?></a>
  <a href="../logout.php"><img src="../img/salir1.png" height="30px" width="30px"> Cerrar Sesión</a>
</div>

<div class="nav_der">
  <!-- Use any element to open the sidenav -->
  <span> <img src="../img/logo.webp" height="50px" width="120px"></span>
  <span onclick="openNav()">☰ Menú</span>


  <!-- Add all page content inside this div if you want the side nav to push page content to the right (not used if you only want the sidenav to sit on top of the page -->




</div>