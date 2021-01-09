<?php 
include '../Prevista/pre_session.php'; 
include '../Prevista/pre_servicios.php';
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
		<button data-target="modalServicio" class="btn modal-trigger #2196f3 blue agregar"><i class="fas fa-plus-square"></i> Agregar Servicio</button><br><br>
		<table class="row-border centered responsive-table servicios" id="tabla">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Precio</th>
					<th>Editar</th>
					<th>Borrar</th>
				</tr>
			</thead>
			
			<tbody>
				<?php while ($dt=$rs->fetch_assoc()) {
					echo '<tr id="'.$dt['cve_servicio'].'" nombre="'.$dt['nombre'].'" precio="'.$dt['precio'].'">
					<td>'.$dt['nombre'].'</td>
					<td>$'.$dt['precio'].'</td>
					<td><button class="btn modal-trigger #1976d2 blue darken-2 editar" data-target="modalServicio"><i class="fas fa-edit"></i></button></td>
					<td><button class="btn waves-effect waves-light #d32f2f red darken-2 eliminar"><i class="fas fa-trash-alt"></i></button></td>
					</tr>';
				} ?>
			</tbody>
		</table>
		<div id="modalServicio" class="modal">
			<div class="modal-content">
				<h4 class="tituloModal">Datos del servicio</h4>
				<form method="post" id="formServicio">
					<input type="hidden" id="cve_servicio">
					<label>Nombre</label>
					<input type="text" id="nombre">
					<label>Precio</label>
					<input type="number" id="precio">
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
<script type="text/javascript" src="../Lib/js/Servicios.js"></script>
</html>