 <?php if ($_SESSION['tipo_usuario']==1){ ?>
 	<nav>
	<div class="nav-wrapper #42a5f5 blue lighten-1">
		<a href="Admin.php" class="brand-logo"><?php echo $_SESSION['empresa']; ?></a>
		<a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="fas fa-bars"></i></a>
		<ul class="right hide-on-med-and-down">
			<li class="navClientes"><a href="Clientes.php"><i class="fas fa-users"></i> Clientes</a></li>
			<li class="navServicios"><a href="Servicios.php"><i class="fas fa-paw"></i> Servicios</a></li>
			<li class="navCitas"><a href="Citas.php"><i class="far fa-calendar-alt"></i> Citas</a></li>
			<li class="navVentas"><a href="Ventas.php"><i class="fas fa-shopping-cart"></i> Ventas</a></li>
			<li class="navEmpresa"><a href="Empresa.php"><i class="fas fa-building"></i> Empresa</a></li>
			<li class="navPerfil"><a href="Perfil.php"><i class="fas fa-user-circle"></i> <?php echo $_SESSION['correo']; ?></a></li>
		</ul>
	</div>
</nav>

<ul class="sidenav" id="mobile-demo">
	<li><a href="Clientes.php"><i class="fas fa-users"></i> Clientes</a></li>
	<li><a href="Servicios.php"><i class="fas fa-paw"></i> Servicios</a></li>
	<li><a href="Citas.php"><i class="far fa-calendar-alt"></i> Citas</a></li>
	<li><a href="Ventas.php"><i class="fas fa-shopping-cart"></i> Ventas</a></li>
	<li><a href="Empresa.php"><i class="fas fa-building"></i> Empresa</a></li>
	<li><a href="Perfil.php"><i class="fas fa-user-circle"></i> <?php echo $_SESSION['correo']; ?></a></li>
</ul>
 <?php }elseif ($_SESSION['tipo_usuario']==3) { ?>
 	<nav>
	<div class="nav-wrapper #42a5f5 blue lighten-1">
		<a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="fas fa-bars"></i></a>
		<ul class="left hide-on-med-and-down">
			<li class="navInicio"><a href="Inicio.php"><i class="fas fa-home"></i> Inicio</a></li>
			<li class="navCitas"><a href="Citas.php"><i class="far fa-calendar-alt"></i> Citas</a></li>
		</ul>
		<ul class="right hide-on-med-and-down">
			<li class="navPerfil"><a href="Perfil.php"><i class="fas fa-user-circle"></i> <?php echo $_SESSION['correo']; ?></a></li>
		</ul>
	</div>
</nav>

<ul class="sidenav" id="mobile-demo">
	<li><a href="Inicio.php"><i class="fas fa-home"></i> Inicio</a></li>
	<li><a href="Citas.php"><i class="far fa-calendar-alt"></i> Citas</a></li>
	<li><a href="Perfil.php"><i class="fas fa-user-circle"></i> <?php echo $_SESSION['correo']; ?></a></li>
</ul>
 <?php } ?>
