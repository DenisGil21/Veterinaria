<?php 
include '../Prevista/pre_session.php'; 
include '../Prevista/pre_perfil.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Happy Pet</title>
	<?php include '../Prevista/pre_links.php'; ?>
	<link rel="stylesheet" type="text/css" href="../Lib/css/perfil.css">
</head>
<body>
	<?php include '../Prevista/pre_nav.php'; ?>
	<div style="margin: 2% 2% 2% 2%;" class="center-align animated fadeIn">
		
		<ul class="tabs tabs-fixed-width">
			<li class="tab col s6"><a href="#datosPersonales">Datos Personales</a></li>
			<li class="tab col s6"><a href="#datosCuenta">Datos de cuenta</a></li>
		</ul>
		<br><br>
		<div id="datosPersonales" class="container">
			<?php $dt=$rs->fetch_assoc() ?>
			<form>
				<input type="hidden" id="cve_usuario" name="" value="<?php echo $dt['cve_usuario'] ?>">
				<div class="input-field col s12">
					<i class="material-icons prefix"><span class="fas fa-address-card"></span></i>
					<input type="text" id="nombre" disabled="disabled" value="<?php echo $dt['nombre'] ?>">
					<label for="nombre">Nombre</label>
				</div>						
				<div class="input-field col s12">
					<i class="material-icons prefix"><span class="fas fa-address-card"></span></i>
					<input type="text" id="apellidos" disabled="disabled" value="<?php echo $dt['apellidos'] ?>">
					<label for="apellidos">Apellidos</label>
				</div>
				<div class="input-field col s12">
					<i class="material-icons prefix"><span class="fas fa-phone"></span></i>
					<input type="number" id="telefono" maxlength="10" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" disabled="disabled" value="<?php echo $dt['telefono'] ?>">
					<label for="telefono">Teléfono</label>
				</div>
				<a class="btn waves-effect #1976d2 blue darken-2 boton editPersonal"><i class="fas fa-user-edit"></i> Editar</a>
				<a class="btn waves-effect #4caf50 green boton actPersonal" disabled="disabled"><i class="fas fa-sync-alt"></i> Actualizar</a>
			</form>
		</div>
		<div id="datosCuenta" class="container">
			<form>
				<div class="row">
					<div class="col s8">
						<label><b>Cambiar Imagen de Perfil</b></label>
						<div class="file-field input-field">
							<div class="btn #1976d2 blue darken-2">
								<span>Seleccionar</span>
								<input type="file" id="imagen">
							</div>
							<div class="file-path-wrapper">
								<input class="file-path validate"  type="text">
							</div>
						</div>
						<a class="btn waves-effect #4caf50 green boton actImagen"><i class="fas fa-sync-alt"></i> Actualizar</a>
					</div>
					<div class="col s4">
						<img src="../Img/<?php echo $dt['imagen'] ?>" style="width:100%">
					</div>
				</div>
				<div class="input-field col s12">
							<i class="material-icons prefix"><span class="fas fa-envelope"></span></i>
							<input type="text" id="correo" disabled="disabled" value="<?php echo $dt['correo'] ?>">
							<label for="correo">Correo</label>
						</div>	
						<div class="input-field col s12">
							<i class="material-icons prefix"><span class="fas fa-key"></span></i>
							<input type="password" id="contrasena" disabled="disabled">
							<label for="contrasena">Contraseña</label>
						</div>	
						<div class="input-field col s12">
							<i class="material-icons prefix"><span class="fas fa-key"></span></i>
							<input type="password" id="confirm_contrasena" disabled="disabled">
							<label for="confirm_contrasena">Confirmar contraseña</label>
						</div>			
				<a class="btn waves-effect #1976d2 blue darken-2 boton editCuenta"><i class="fas fa-user-edit"></i> Editar contraseña</a>
				<a class="btn waves-effect #4caf50 green boton actCuenta" disabled="disabled"><i class="fas fa-sync-alt"></i> Actualizar</a>
			</form>
		</div>
		<a href="../Prevista/cerrarSesion.php" class="btn waves-effect waves-light #d32f2f red darken-2 cerrarSesion">
			<i class="fas fa-sign-out-alt"></i>
			Cerrar Sesión
		</a>

	</div>
</body>
<?php include '../Prevista/pre_funciones.php'; ?>
<script type="text/javascript" src="../Lib/js/Perfil.js"></script>
</html>