<?php
include '../Prevista/pre_session.php';
include '../Prevista/pre_ventas.php'; 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Happy Pet</title>
	<?php include '../Prevista/pre_links.php'; ?>
	<link rel="stylesheet" type="text/css" href="../Lib/css/ventas.css">
</head>
<body>
	<?php include '../Prevista/pre_nav.php'; ?>
	<div style="margin: 2% 2% 2% 2%;" class="animated fadeIn">
		<div class="row">
			<div class="col s4">
				<div class="input-field" style="margin-bottom: -3px;">
					<i class="material-icons prefix"><span class="fas fa-search"></span></i>
					<input type="text" autocomplete="of" id="myInput" onkeyup="buscarPersona('myTable','myInput')">
					<label for="myInput">Buscar cliente</label>
				</div>
				<table class="row-border centered clientes col s4 ocultar" id="myTable" >
					<tbody>
						<?php while ($dt=$rsCli->fetch_assoc()) {
							echo '<tr class="verdtCliente" id="'.$dt['cve_persona'].'" nombre="'.$dt['nombre'].'" apellidos="'.$dt['apellidos'].'" telefono="'.$dt['telefono'].'" correo="'.$dt['correo'].'">
							<td>'.$dt['nombre'].'</td>
							<td>'.$dt['apellidos'].'</td>
							</tr>';
						} ?>
					</tbody>
				</table>
			</div>
			<div class="col">
				<button data-target="modalServicios" class="btn modal-trigger #2196f3 blue agregar"><i class="fas fa-plus-square"></i> Agregar Servicio</button>
			</div>
			<div class="col">
				<a href="HistorialVentas.php" class="waves-effect waves-light btn #2196f3 blue"><i class="fas fa-clipboard-list"></i> Ver Historial de ventas</a>
			</div>
		</div>
		<div class="row">
			<!-- TABLA DE COBRO -->
			<div class="col s8">
				<table class="row-border centered responsive-table tablaCobrar">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Precio</th>
							<th>Eliminar</th>
						</tr>
					</thead>

					<tbody id="ventaServ">

					</tbody>
					<tfoot>
						<th style="text-align: center;"><b>Total:</b></th>
						<th style="text-align: center;">
							<div id="totalVenta"></div>
							<input type="hidden" id="enviarTotal">
						</th>
						<th></th>
					</tfoot>
				</table>
				<br>
				<div class="input-field col s8">
					<!-- <textarea id="observaciones" class="materialize-textarea"></textarea>
					<label for="observaciones">Observaciones:</label> -->
				</div>
				<div class="col s4">
					<button data-target="modalCliente" class="btn #388e3c #616161 grey darken-2 cobrar margen"><i class="fas fa-dollar-sign"></i> Cobrar</button>
					<button data-target="modalCliente" class="btn #d32f2f red darken-2 limpiar margen"><i class="fas fa-backspace"></i> Limpiar</button>
				</div>
			</div>
			<!-- FIN -->
			<!-- INFORMACION DEL CLIENTE -->
			<div class="col s4">
				<div class="card horizontal dtCliente" id="clienteOcultar">
					<div class="card-image">
						<img src="../Img/usuario.png" class="imgCliente">
					</div>
					<div class="card-stacked">
						<div class="card-content">
							<input type="hidden" id="cve_cliente">
							<b>Nombre: </b><p class="nombreCliente"></p>
							<b>Teléfono: </b><p class="telefonoCliente"></p>
						</div>
						<div class="card-action">
							<a href="" data-target="modalMascotas" class="modal-trigger">Seleccionar mascota</a>
						</div>
					</div>
				</div>
				<div class="card horizontal dtMascota" id="mascotaOcultar">
					<div class="card-image">
						<img src="" class="imgMascota">
					</div>
					<div class="card-stacked">
						<div class="card-content">
							<input type="hidden" id="cve_mascota">
							<b>Nombre: </b><p class="nombreMascota"></p>
							<b>Raza: </b><p class="raza"></p>
							<b>Sexo: </b><p class="sexo"></p>
						</div>
					</div>
				</div>
			</div>
			<!-- FIN -->
		</div>
		<!-- MODAL -->
		<div id="modalServicios" class="modal">
			<div class="modal-content">
				<h4>Servicios</h4>
				<form>
					<table class="row-border centered responsive-table servicios">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Precio</th>
								<th>Agregar</th>
							</tr>
						</thead>

						<tbody>
							<?php while ($dt=$rsSer->fetch_assoc()) {
								echo '<tr class="cve_servicio" id="'.$dt['cve_servicio'].'" nombre="'.$dt['nombre'].'" precio="'.$dt['precio'].'">
								<td>'.$dt['nombre'].'</td>
								<td>$'.$dt['precio'].'</td>
								<td><button class="btn #1976d2 blue darken-2 remover">Agregar</button></td>
								</tr>';
							} ?>
						</tbody>
					</table>
				</form>
			</div>
			<div class="modal-footer">
				<a href="#!" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
			</div>
		</div>

		<div id="modalMascotas" class="modal">
			<div class="modal-content">
				<h4>Mascotas</h4>
				<form>
					<table class="row-border centered responsive-table mascotas">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Raza</th>
								<th>Sexo</th>
							</tr>
						</thead>

						<tbody>
							
						</tbody>
					</table>
				</form>
			</div>
			<div class="modal-footer">
				<a href="#!" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
			</div>
		</div>
	</div>
</body>
<?php include '../Prevista/pre_funciones.php'; ?>
<script type="text/javascript" src="../Lib/js/Ventas.js"></script>
</html>