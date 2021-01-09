<?php 
include '../Config/Autoload.php';
\Config\Autoload::run();
session_start();
$con = new \Model\Conexion();
$servicios = new \Model\Servicios($con);

switch ($_POST['accion']) {

	case 'guardarServicio':
	$nombre = trim($_POST['nombre']);
	$precio = trim($_POST['precio']);

	$servicios->set('nombre',$nombre);
	$servicios->set('precio',$precio);

	//inicio de transaccion
	if($nombre != ""){
		$status = true;
		$con->autocommit(false);
		$cve_servicio = $servicios->guardarServicio();
		$status = $con->check($status);
		$info = $con->send($status);
		//fin
	}else{
		$info = false;
	}

	if($info){
		echo $cve_servicio;
	}else{
		echo "error";
	}
	break;
	case 'editarServicio':
	$cve_servicio=trim($_POST['cve_servicio']);
	$nombre = trim($_POST['nombre']);
	$precio = trim($_POST['precio']);

	$servicios->set('cve_servicio',$cve_servicio);
	$servicios->set('nombre',$nombre);
	$servicios->set('precio',$precio);
	
	$servicios->editarServicio($cve_servicio);
	echo "success";
			
	break;
	case 'eliminarServicio':
	$id = $_POST['cve_servicio'];
	$servicios->eliminarServicio($id);
	echo 'success';
	break;
}