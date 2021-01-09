<?php 
include '../Prevista/pre_session.php';
include '../Prevista/pre_admin.php'; 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Happy Pet</title>
	<?php include '../Prevista/pre_links.php'; ?>
</head>
<body>
	<?php include '../Prevista/pre_nav.php'; ?>
	<div style="margin: 10px 10px 10px 10px" class="animated fadeIn">
		<h3 class="center-align">Bienvenido</h3>
	<div class="center-align">
		<div class="row">
			<div class="col s4">
				<div class="card-panel #90caf9 blue lighten-3">
					<img src="../Img/equipo.png" class="carteles"><br>
					<span class="white-text contador" id="counter">
						Numero de clientes:
						<span class="counter-value" data-count="<?php echo $numCli ?>">0</span>
					</span>
				</div>
			</div>
			<div class="col s4">
				<div class="card-panel #90caf9 blue lighten-3">
					<img src="../Img/mascotas.png" class="carteles"><br>
					<span class="white-text contador" id="counter">
						Numero de mascotas:
						<span class="counter-value" data-count="<?php echo $numM ?>">0</span>
					</span>
				</div>
			</div>
			<div class="col s4">
				<div class="card-panel #90caf9 blue lighten-3">
					<img src="../Img/calendario.png" class="carteles"><br>
					<span class="white-text contador" id="counter">
						Numero de citas para hoy:
						<span class="counter-value" data-count="<?php echo $numCitas ?>">0</span>
					</span>
				</div>
			</div>
		</div>
	</div>
	</div>
</body>
<?php include '../Prevista/pre_funciones.php'; ?>
<script type="text/javascript" src="../Lib/js/Contador.js"></script>
</html>