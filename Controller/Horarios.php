<?php 
include '../Config/Autoload.php';
\Config\Autoload::run();
session_start();
$con = new \Model\Conexion();
$horarios = new \Model\Horarios($con);

switch ($_POST['accion']) {

	case 'guardarHorario':
	$turno = trim($_POST['turno']);
	$hora_entrada = trim($_POST['hora_entrada']);
	$hora_salida = trim($_POST['hora_salida']);
	date_default_timezone_set('America/Mexico_City');
	$horaIni = strtotime($hora_entrada);
	$horaFin = strtotime($hora_salida);
	if ($horaIni>$horaFin) {
		echo "incorrecto";
		return false;
	}

	$horarios->set('cve_empresa',$_SESSION['cve_empresa']);
	$horarios->set('turno',$turno);
	$horarios->set('hora_entrada',$hora_entrada);
	$horarios->set('hora_salida',$hora_salida);

	//inicio de transaccion
	if($turno != ""){
		$status = true;
		$con->autocommit(false);
		$cve_horario = $horarios->guardarHorario();
		$status = $con->check($status);
		$info = $con->send($status);
		//fin
	}else{
		$info = false;
	}

	if($info){
		echo $cve_horario;
	}else{
		echo "error";
	}
	break;
	case 'editarHorario':
	$cve_horario=$_POST['cve_horario'];
	$turno = trim($_POST['turno']);
	$hora_entrada = trim($_POST['hora_entrada']);
	$hora_salida = trim($_POST['hora_salida']);
	
	date_default_timezone_set('America/Mexico_City');
	$horaIni = strtotime($hora_entrada);
	$horaFin = strtotime($hora_salida);
	if ($horaIni>$horaFin) {
		echo "incorrecto";
		return false;
	}

	$horarios->set('cve_horario',$cve_horario);
	$horarios->set('turno',$turno);
	$horarios->set('hora_entrada',$hora_entrada);
	$horarios->set('hora_salida',$hora_salida);

	$horarios->editarHorario($cve_horario);
	echo "success";

	break;
	case 'eliminarHorario':
	$id = $_POST['cve_horario'];
	$horarios->eliminarHorario($id);
	echo 'success';
	break;

	case 'obtenerHorario':	
	$cve_horario=$_POST['cve_horario'];
	$fecha=$_POST['fecha'];
	$horarios->set('cve_horario',$cve_horario);
	$rs=$horarios->verHorasTurno();
	$dt=$rs->fetch_assoc();
	date_default_timezone_set('America/Mexico_City');

	$hora_entrada = strtotime ( '-00 hour' , strtotime ($dt['hora_entrada'])) ; 
	$hora_entrada = strtotime ( '-30 minute' , $hora_entrada ) ; 
	$hora_entrada = strtotime ( '-00 second' , $hora_entrada ) ; 
	$hora_entrada = date ( 'H:i:s' , $hora_entrada); 

	$hora1 = strtotime($hora_entrada);
	$hora2 = strtotime($dt['hora_salida']);
	$hora=$hora_entrada;
	$arreglo=array();
	$cambio=0;
	while ( $hora1< $hora2) { 
		$h = strtotime ( '-00 hour' , strtotime ($hora) ) ; 
		$h = strtotime ( '+30 minute' , $h ) ; 
		$h = strtotime ( '-00 second' , $h ) ; 
		$h = date ( 'H:i:s' , $h); 
		$hora1=strtotime($h);
		$hora=$h;
		$rs2=$horarios->verHorasOcupadas($fecha);
		while ($dt2=$rs2->fetch_assoc()) {
			if ($dt2['hora']==$h) {
				$cambio=1;
			}
		}
		if ($cambio==0) {
			array_push($arreglo, array(
				"hora"=>$h,
			));
		}
		$cambio=0;
	}
	echo json_encode($arreglo);
	break;
}