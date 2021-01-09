<?php 
include '../Config/Autoload.php';
\Config\Autoload::run();
session_start();
$con = new \Model\Conexion();
$clientes = new \Model\Personas($con);
$mascotas = new \Model\Mascotas($con);
$ventas = new \Model\Ventas($con);
$servicios = new \Model\Servicios($con);

switch ($_POST['accion']) {

	case 'traerCliente':
	$cve_cliente = trim($_POST['cve_cliente']);

	$clientes->set('cve_persona',$cve_cliente);
	$rs=$clientes->verCliente();
	$datos=array();
	while ($dt=$rs->fetch_assoc()) {
		array_push($datos, array(
			"cve_persona"=>$dt['cve_persona'],
			"nombre"=>$dt['nombre'].' '.$dt['apellidos'],
			"telefono"=>$dt['telefono'],
			"correo"=>$dt['correo'],
			"imagen"=>$dt['imagen']
		));
	}
	echo json_encode($datos);
	break;
	case 'traerMascotas':
	$cve_cliente = trim($_POST['cve_cliente']);

	$mascotas->set('cve_persona',$cve_cliente);
	$rs=$mascotas->verMascotas();
	$datos=array();
	while ($dt=$rs->fetch_assoc()) {
		if ($dt['sexo']==1) {
			$sexo="Macho";
		}else{
			$sexo="Hembra";
		}
		array_push($datos, array(
			"cve_mascota"=>$dt['cve_mascota'],
			"nombre"=>$dt['mascota'],
			"raza"=>$dt['raza'],
			"sexo"=>$sexo,
			"imagen"=>$dt['imagen']
		));
	}
	echo json_encode($datos);
	break;
	case 'traerMascota':
	$cve_mascota = trim($_POST['cve_mascota']);

	$mascotas->set('cve_mascota',$cve_mascota);
	$rs=$mascotas->verMascota();
	$datos=array();
	while ($dt=$rs->fetch_assoc()) {
		if ($dt['sexo']==1) {
			$sexo="Macho";
		}else{
			$sexo="Hembra";
		}
		array_push($datos, array(
			"cve_mascota"=>$dt['cve_mascota'],
			"nombre"=>$dt['mascota'],
			"raza"=>$dt['raza'],
			"sexo"=>$sexo,
			"imagen"=>$dt['imagen']
		));
	}
	echo json_encode($datos);
	break;
	case 'traerServicios':
	$rs=$servicios->verServicios();
	$datos=array();
	while ($dt=$rs->fetch_assoc()) {
		array_push($datos, array(
			"cve_servicio"=>$dt['cve_servicio'],
			"nombre"=>$dt['nombre'],
			"precio"=>$dt['precio']
		));
	}
	echo json_encode($datos);
	break;
	case 'traerVentasFecha':
	$fecha = $_POST['fecha'];
	$ventas->set('fecha',$fecha);
	$rs=$ventas->verVentasFecha();
	$datos=array();
	while ($dt=$rs->fetch_assoc()) {
		array_push($datos, array(
			"cve_venta"=>$dt['cve_venta'],
			"fecha"=>$dt['fecha'],
			"total"=>$dt['total']
		));
	}
	echo json_encode($datos);
	break;
	case 'detalleVenta':
	$cve_venta = $_POST['cve_venta'];
	$ventas->set('cve_venta',$cve_venta);
	$rs=$ventas->verDetalleVenta();
	$datos=array();
	while ($dt=$rs->fetch_assoc()) {
		array_push($datos, array(
			"cve_venta"=>$dt['cve_venta'],
			"nombre"=>$dt['nombre'],
			"precio"=>$dt['precio']
		));
	}
	echo json_encode($datos);
	break;
	case 'cobrarVenta':
	$cve_cliente = trim($_POST['cve_cliente']);
	$cve_mascota = trim($_POST['cve_mascota']);
	// $observaciones = trim($_POST['observaciones']);
	$enviarTotal = trim($_POST['enviarTotal']);
	$serviciosCheck= json_decode($_POST['servicios']);
	$longitud=count($serviciosCheck);
	$ventas->set('total', $enviarTotal);
	$ventas->set('observaciones', '');
	//inicio de transaccion
	if($cve_cliente != ""){
		$status = true;
		$con->autocommit(false);
		$cve_venta = $ventas->guardarVenta();
		$status = $con->check($status);

		for ($i=0; $i < $longitud; $i++) {
			$ventas->guardarMascotasServicios($cve_venta,$cve_mascota,$serviciosCheck[$i]);
		}
		$status = $con->check($status);

		$info = $con->send($status);
		//fin
	}else{
		$info = false;
	}

	if($info){
		$rs=$servicios->verServicios();
		$datos=array();
		while ($dt=$rs->fetch_assoc()) {
			array_push($datos, array(
				"cve_servicio"=>$dt['cve_servicio'],
				"nombre"=>$dt['nombre'],
				"precio"=>$dt['precio']
			));
		}
		echo json_encode($datos);
	}else{
		echo "error";
	}

	break;
}