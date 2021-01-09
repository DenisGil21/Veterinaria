<?php 
include '../Prevista/pre_session.php'; 
include '../Prevista/pre_historial_mascota.php';
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
	<?php
	if ($_SESSION['tipo_usuario']==1) {
		echo '<a href="./Mascotas.php" class="btn #2196f3 blue"><i class="fas fa-arrow-circle-left"></i> Atras</a><br><br>';
	}elseif ($_SESSION['tipo_usuario']==3) {
		echo '<a href="./Inicio.php" class="btn #2196f3 blue"><i class="fas fa-arrow-circle-left"></i> Atras</a><br><br>';
	}
	?>
		<?php $dt=$rsM->fetch_assoc() ?>
		<div style="text-align: center;">
			<h3>Historial de <?php echo $dt['mascota'] ?></h3>
			<img class="responsive-img circle" src="../Img/<?php echo $dt['imagen'] ?>" style="width: 20%;">
		</div>
		<label>Seleccionar fecha</label>
		<input type="text" class="datepicker">
		<table class="centered responsive-table historial">
			<thead>
				<tr>
					<th>Fecha</th>
					<th>Servicio</th>
				</tr>
			</thead>

			<tbody>
				<?php while ($dt=$rsH->fetch_assoc()) {
					echo '<tr>
					<td>'.$dt['fecha'].'</td>
					<td>'.$dt['nombre'].'</td>
					</tr>';
				} ?>
			</tbody>
		</table>
	</div>
</body>
<?php include '../Prevista/pre_funciones.php'; ?>
<script type="text/javascript" src="../Lib/js/HistorialMascota.js"></script>
</html>