<?php 
include '../Config/Autoload.php';
\Config\Autoload::run();
session_start();
$con = new \Model\Conexion();
$citas = new \Model\Citas($con);

switch ($_POST['accion']) {

	case 'guardarCita':
	$fecha = trim($_POST['fecha']);
	$hora = trim($_POST['hora']);
	$cve_empresa = trim($_POST['cve_empresa']);
	$cve_persona = trim($_POST['cve_persona']);
	// $nota = trim($_POST['nota']);

	$citas->set('cve_empresa',$cve_empresa);
	$citas->set('cve_persona',$cve_persona);
	$citas->set('fecha',$fecha);
	$citas->set('hora',$hora);
	$citas->set('nota','');

	//inicio de transaccion
	if($fecha != ""){
		$status = true;
		$con->autocommit(false);
		$cve_cita = $citas->guardarCita();
		$status = $con->check($status);
		$info = $con->send($status);
		//fin
	}else{
		$info = false;
	}

	if($info){
		echo $cve_cita;
	}else{
		echo "error";
	}
	break;
	case 'eliminarCita':
	$cve_cita = trim($_POST['cve_cita']);
	$citas->eliminarCita($cve_cita);
	echo "success";
	break;
}