<?php 
include '../Prevista/pre_session.php'; 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Happy Pet</title>
	<?php include '../Prevista/pre_links.php'; ?>
</head>
<body>
	<?php include '../Prevista/pre_nav.php'; ?>
	<div style="margin: 2% 2% 2% 2%;" class="animated fadeIn">
		<button data-target="modalCliente" class="btn modal-trigger #2196f3 blue agregar"><i class="fas fa-plus-square"></i> Agregar Cliente</button><br><br>
		<div id="allTable"></div>

		<div id="modalCliente" class="modal">
			<div class="modal-content">
				<h4 class="tituloModal">Datos del cliente</h4>
				<form method="post" id="formCliente">
					<div class="row">
						<div class="col s6">
							<input type="hidden" id="cve_persona">
							<label>Nombre</label>
							<input type="text" id="nombre">
							<label>Apellidos</label>
							<input type="text" id="apellidos">
							<label>Telefono</label>
							<input type="number" maxlength="10" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" id="telefono">
						</div>
						<div class="col s6">
							<label >Correo</label>
							<input type="text" id="correo" >
							<input type="hidden" id="tieneCorreo">
							<label>Contraseña</label>
							<input type="password" id="contrasena">
							<label>Repetir contrasena</label>
							<input type="password" id="confirm_contrasena">
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="waves-effect waves-green btn-flat btnModal guardar">Guardar</button>
				<a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
			</div>
		</div>
	</div>
</body>
<?php include '../Prevista/pre_funciones.php'; ?>
<script type="text/javascript" src="../Lib/js/Clientes.js"></script>
</html>