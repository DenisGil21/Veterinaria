<?php
 include '../Prevista/pre_session.php';
 include '../Prevista/pre_empresa.php'; 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Happy Pet</title>
	<?php include '../Prevista/pre_links.php'; ?>
	<link rel="stylesheet" type="text/css" href="../Lib/css/empresa.css">
</head>
<body>
	<?php include '../Prevista/pre_nav.php'; ?>
	<div style="margin: 2% 2% 2% 2%;" class="animated fadeIn">
		<ul class="tabs tabs-fixed-width">
			<li class="tab"><a href="#empresa">Empresa</a></li>
			<li class="tab"><a href="#horarios">Horarios</a></li>
		</ul><br><br>
		<div id="empresa" class="container">
			<?php $dt=$rs->fetch_assoc();?>
			<form>
				<input type="hidden" id="cve_empresa" value="<?php echo $dt['cve_empresa'] ?>" name="">
				<div class="input-field col s12">
					<i class="material-icons prefix"><span class="fas fa-building"></span></i>
					<input type="text" id="nombre" disabled="disabled" value="<?php echo $dt['nombre'] ?>">
					<label for="nombre">Nombre</label>
				</div>
				<div class="input-field col s12">
					<i class="material-icons prefix"><span class="fas fa-map-marked-alt"></span></i>
					<input type="text" id="direccion" disabled="disabled" value="<?php echo $dt['direccion'] ?>">
					<label for="direccion">Dirección</label>
				</div>
				<div class="input-field col s12">
					<i class="material-icons prefix"><span class="fas fa-phone"></span></i>
					<input type="text" id="telefono" maxlength="10" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" disabled="disabled" value="<?php echo $dt['telefono'] ?>">
					<label for="telefono">Teléfono</label>
				</div>
				<a class="btn waves-effect #1976d2 blue darken-2 boton editEmpresa"><i class="fas fa-user-edit"></i> Editar</a>
				<a class="btn waves-effect #4caf50 green boton actEmpresa" disabled="disabled"><i class="fas fa-sync-alt"></i> Actualizar</a>
			</form>
		</div>
		<div id="horarios" class="container">
			<button data-target="modalHorario" class="btn modal-trigger #2196f3 blue agregar"><i class="fas fa-plus-square"></i> Agregar Horario</button><br><br>
			<table class="centered responsive-table horarios">
				<thead>
					<tr>
						<th>Turno</th>
						<th>Hora entrada</th>
						<th>Hora salida</th>
						<th>Editar</th>
						<th>Borrar</th>
					</tr>
				</thead>
				<tbody>
					<?php while ($dt=$rsH->fetch_assoc()) {
						echo '<tr id="'.$dt['cve_horario'].'" turno="'.$dt['turno'].'" hora_entrada="'.$dt['hora_entrada'].'" hora_salida="'.$dt['hora_salida'].'">
						<td>'.$dt['turno'].'</td>
						<td>'.$dt['hora_entrada'].'</td>
						<td>'.$dt['hora_salida'].'</td>
						<td><button class="btn modal-trigger #1976d2 blue darken-2 editar" data-target="modalHorario"><i class="fas fa-edit"></i></button></td>
						<td><button class="btn waves-effect waves-light #d32f2f red darken-2 eliminar"><i class="fas fa-trash-alt"></i></button></td>
						</tr>';	
					} ?>
				</tbody>
			</table>
			<div id="modalHorario" class="modal">
				<div class="modal-content">
					<h4 class="tituloModal">Horario</h4>
					<form method="post" id="formHorario">
						<input type="hidden" id="cve_horario">
						<label>Turno</label>
						<input type="text" id="turno">
						<label>Hora entrada</label>
						<input type="time" id="hora_entrada">
						<label>Hora salida</label>
						<input type="time" id="hora_salida">
					</form>
				</div>
				<div class="modal-footer">
					<a class="waves-effect waves-green btn-flat btnModal guardar">Guardar</a>
					<a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
				</div>
			</div>
		</div>
	</div>
</body>
<?php include '../Prevista/pre_funciones.php'; ?>
<script type="text/javascript" src="../Lib/js/Empresa.js"></script>
<script type="text/javascript" src="../Lib/js/Horarios.js"></script>
</html>