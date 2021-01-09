<?php 
include '../Prevista/pre_session.php'; 
include '../Prevista/pre_ventas.php';
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
		<a href="./Ventas.php" class="btn #2196f3 blue"><i class="fas fa-arrow-circle-left"></i> Atras</a><br><br>
		<label>Seleccionar fecha</label>
		<input type="text" class="datepicker">
		<table class="centered responsive-table ventas">
			<thead>
				<tr>
					<th>Fecha</th>
					<th>Total</th>
					<th>Ver detalle de la venta</th>
				</tr>
			</thead>

			<tbody>
				<?php while ($dt=$rsVent->fetch_assoc()) {
					echo '<tr id="'.$dt['cve_venta'].'">
					<td>'.$dt['fecha'].'</td>
					<td>$'.$dt['total'].'</td>
					<td><button class="btn modal-trigger #1976d2 blue darken-2 verDetalle" data-target="modalVenta"><i class="fas fa-plus-square"></i></button></td>
					</tr>';
				} ?>
			</tbody>
		</table>

		<div id="modalVenta" class="modal">
			<div class="modal-content">
				<h4>Detalle Venta</h4>
				<table class="centered responsive-table detalleVenta">
					<thead>
						<tr>
							<th>Servicio</th>
							<th>Precio</th>
						</tr>
					</thead>

					<tbody>
						
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<a href="#!" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
			</div>
		</div>
	</div>
</body>
<?php include '../Prevista/pre_funciones.php'; ?>
<script type="text/javascript" src="../Lib/js/HistorialVentas.js"></script>
</html>