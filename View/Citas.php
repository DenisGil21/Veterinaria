<?php 
include '../Prevista/pre_session.php'; 
include '../Prevista/pre_citas.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Happy Pet</title>
	<?php include '../Prevista/pre_links.php'; ?>
	<link rel="stylesheet" type="text/css" href="../Lib/fullcalendar3/fullcalendar.min.css">
	<link rel="stylesheet" type="text/css" href="../Lib/select2/css/select2.min.css">
</head>
<body>
	<?php include '../Prevista/pre_nav.php'; ?>
	<div style="margin: 2% 2% 2% 2%;" class="animated fadeIn">
		<div id="calendar"></div> 
		<div id="modalCita" class="modal">
			<div class="modal-content">
				<h4>Cita</h4>
				<form id="formCita">
					<div class="row">
						<div class="col s6">
							<input type="hidden" id="cve_empresa" value="1">
							<input type="hidden" id="fecha">
							<?php if ($_SESSION['tipo_usuario']!=3){ ?>
								<label>Cliente</label><br><br>
								<select id="cve_persona" class="buscaCliente" style="width: 100%">
									<option value="" disabled selected>Seleccionar</option>
									<?php while ($dt=$rsCli->fetch_assoc()) {
										echo '<option value="'.$dt['cve_persona'].'">'.$dt['nombre'].' '.$dt['apellidos'].'</option>';
									} ?>
								</select>
								<br><br>
							<?php }else{ ?>
								<input type="hidden" id="cve_persona" value="<?php echo $_SESSION['cve_usuario'] ?>">
							<?php } ?>
							<label>Turno</label>
							<select id="cve_horario" name="turno">
								<option value="" disabled selected>Seleccionar</option>
								<?php 
								while ($dt=$rsH->fetch_assoc()) {
									echo '<option value="'.$dt['cve_horario'].'">'.$dt['turno'].'</option>';
								}
								?>
							</select>
						</div>
						<div class="col s6">
							<label>Hora</label>
							<select id="hora">

							</select><br>
							<!-- <label>Nota</label>
							<textarea class="materialize-textarea" id="nota"></textarea>		 -->
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<a class="waves-effect waves-green btn-flat btnModal guardar">Guardar</a>
				<a class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
			</div>
		</div>
		<div id="modalEditCita" class="modal">
			<div class="modal-content">
				<h4>Cita</h4>
				<p><b>Nombre:</b> <span id="c_nombre"></span></p>
				<p><b>Fecha:</b> <span id="c_fecha"></span></p>
				<p><b>Hora:</b> <span id="c_hora"></span></p>
				<!-- <p><b>Nota:</b> <span id="c_nota"></span></p> -->
				<button class="btn #d32f2f red darken-2 eliminar"><i class="fas fa-trash-alt"></i> Eliminar cita</button>
				<input type="hidden" value="" id="cve_cita">
				<input type="hidden" value="" id="e_fecha">
			</div>
			<div class="modal-footer">
				<a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
			</div>
		</div>
	</div>
</body>
<?php include '../Prevista/pre_funciones.php'; ?>
<script src="../Lib/fullcalendar3/lib/moment.min.js"></script>
<script type="text/javascript" src="../Lib/fullcalendar3/fullcalendar.min.js"></script>
<script src="../Lib/fullcalendar3/locale/es.js"></script>
<script type="text/javascript" src="../Lib/select2/js/select2.min.js"></script>
<script type="text/javascript" src="../Lib/js/Citas.js"></script>
</html>