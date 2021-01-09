<?php 
include '../Prevista/pre_session.php'; 
include '../Prevista/pre_mascotas.php';
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
		<a href="./Clientes.php" class="btn #2196f3 blue"><i class="fas fa-arrow-circle-left"></i> Atras</a><br><br>
		<button data-target="modalMascota" class="btn modal-trigger #2196f3 blue agregar"><i class="fas fa-plus-square"></i> Agregar Mascota</button><br><br>
		<table class="centered responsive-table mascotas">
			<thead>
				<tr>
					<th>Imagen</th>
					<th>Nombre</th>
					<th>Raza</th>
					<th>Nacimiento</th>
					<th>Sexo</th>
					<th>Historial</th>
					<th>Editar</th>
					<th>Borrar</th>
				</tr>
			</thead>

			<tbody>
				<?php while ($dt=$rs->fetch_assoc()) {
					$sexo=($dt['sexo']==1)? "Macho":"Hembra";
					echo '<tr id="'.$dt['cve_mascota'].'" cve_especie="'.$dt['cve_especie'].'" cve_raza="'.$dt['cve_raza'].'" mascota="'.$dt['mascota'].'" nacimiento="'.$dt['nacimiento'].'" sexo="'.$dt['sexo'].'" imagen="'.$dt['imagen'].'">
					<td><img src="../Img/'.$dt['imagen'].'" alt="" style="width:120px;"></td>
					<td>'.$dt['mascota'].'</td>
					<td>'.$dt['raza'].'</td>
					<td>'.$dt['nacimiento'].'</td>
					<td>'.$sexo.'</td>
					<td><button class="btn  #1976d2 blue darken-2 historial"><i class="fas fa-history"></i></button></td>
					<td><button class="btn modal-trigger #1976d2 blue darken-2 editar" data-target="modalMascota"><i class="fas fa-edit"></i></button></td>
					<td><button class="btn waves-effect waves-light #d32f2f red darken-2 eliminar"><i class="fas fa-trash-alt"></i></button></td>
					</tr>';
				} ?>
			</tbody>
		</table>

		<div id="modalMascota" class="modal">
			<div class="modal-content">
				<h4 class="tituloModal">Datos de la mascota</h4>
				<form method="post" id="formMascota">
					<div class="row">
						<div class="col s6">
							<input type="hidden" id="cve_mascota">
							<input type="hidden" id="nombreImg">
							<div class="center-align">
								<img src="" id="mostrarImg" style="width: 35%;">
							</div>
							<label><b>Seleccionar imagen</b></label>
							<div class="file-field input-field col s12">
								<div class="btn #1976d2 blue darken-2">
									<span>Seleccionar</span>
									<input type="file" id="imagen">
								</div>
								<div class="file-path-wrapper">
									<input class="file-path validate"  type="text">
								</div>
							</div>
							<div class="input-field col s12">
								<select id="cve_especie" name="especie">
									<option value="" disabled selected>Seleccionar</option>
									<?php while ($dt=$rsE->fetch_assoc()) {
										echo '<option value="'.$dt['cve_especie'].'">'.$dt['nombre'].'</option>';
									} ?>
								</select>
								<label>Especie</label>
							</div>
							<div class="input-field col s12">
								<select id="cve_raza" name="razas">
								</select>
								<label>Raza</label>
							</div>
						</div>
						<div class="col s6">
							<div class="col s12">
								<label>Nombre</label>
								<input type="text" id="nombre">
							</div>
							<div class="col s12">
								<label>Fecha de nacimiento</label>
								<input type="date" id="nacimiento">
							</div>
							<div class="input-field col s12">
								<select id="sexo">
									<option value="" disabled selected>Seleccionar</option>
									<option value="0">Hembra</option>
									<option value="1">Macho</option>
								</select>
								<label>Sexo</label>
							</div>	
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
<script type="text/javascript" src="../Lib/js/Mascotas.js"></script>
</html>