<!DOCTYPE html>
<?php
error_reporting(0);
session_start();

if ($_SESSION['tipo_usuario']==1) {
	header('Location: /Veterinaria/View/Admin.php');
}elseif ($_SESSION['tipo_usuario']==3) {
	header('Location: /Veterinaria/View/Inicio.php');
}
include 'Prevista/pre_index.php';
 ?>
<html>
<head>
	<title>Registro</title>
	<link rel="stylesheet" href="Lib/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="Lib/materialize/css/materialize.min.css">
	<link rel="stylesheet" type="text/css" href="Lib/css/registro.css">
	<link rel="stylesheet" type="text/css" href="Lib/css/animate.css">
	<script src="Lib/materialize/js/materialize.min.js"></script>
</head>
<body>
	<div class="container animated fadeInLeft">
		<h2><?php echo $dt['nombre'] ?></h2>
		<form method="post" id="registroUsuario">
			<div class="row">
				<div class="col s4">
					<img src="Img/logo.png" class="logo">
				</div>
				<div class="col s8">
					<h4 class="center-align">Registro</h4>
					<div class="row">
						<div class="col s6">
							<label>Nombre</label>
							<input type="text" name="nombre" id="nombre" ><br>
							<label>Apellidos</label>
							<input type="text" name="apellidos" id="apellidos" ><br>
							<label>Teléfono</label>
							<input type="number" maxlength="10" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="telefono" id="telefono" ><br>
						</div>
						<div class=" col s6">
							<label>Correo</label>
							<input type="text" name="correo" id="correo" ><br>
							<label>Contraseña</label>
							<input type="password"  name="contrasena" id="contrasena" ><br>
							<label>Confirmar contraseña</label>
							<input type="password" name="confirm_contrasena" id="confirm_contrasena" ><br>
						</div>
					</div>
					<button type="submit" class="waves-effect waves-light btn #2196f3 blue btnRegistro">Registrarse</button><br><br>
					<div class="center-align">
						¿Ya tienes una cuenta?
						<a href="login.php">Inicia sesión</a>	
					</div>
				</div>
			</div>
		</form>
	</div>
	<footer class="page-footer #42a5f5 blue lighten-1">
		<div class="container">
			<div class="row">
				<div class="col l6 s12">
					<h5 class="white-text">Veterinaria Happy Pet</h5>
					<p class="grey-text text-lighten-4">La mejor atención y cuidado para tus mascotas a traves de nuestra aplicación web.</p>
				</div>
				<div class="col l4 offset-l2 s12">
					<h5 class="white-text">Redes sociales</h5>
					<ul>
						<li><a class="grey-text text-lighten-3" href="#!">denisgilsil.21@gmail.com</a></li>
						<li><a class="grey-text text-lighten-3" href="#!">cristian@gmail.com</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="footer-copyright">
			<div class="container">
				© 2020 Copyright Denis Gil & Cristian Páramo
				<!-- <a class="grey-text text-lighten-4 right" href="#!">More Links</a> -->
			</div>
		</div>
	</footer>
</body>
<script type="text/javascript" src="Lib/jquery/jquery.js"></script>
<script type="text/javascript" src="Lib/js/jquery.validate.min.js"></script>
<script src="Lib/js/Registro.js"></script>
</html>