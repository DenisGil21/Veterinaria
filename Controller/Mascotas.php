<?php 
include '../Config/Autoload.php';
\Config\Autoload::run();
session_start();
$con = new \Model\Conexion();
$mascotas = new \Model\Mascotas($con);
$razas = new \Model\Razas($con);

switch ($_POST['accion']) {

	case 'cargarRazas':
	$cve_especie=$_POST['cve_especie'];
	$razas->set('cve_especie',$cve_especie);
	$rs=$razas->verRazas();
	$datos=array();
	while ($dt=$rs->fetch_assoc()) {
		array_push($datos, array(
			"cve_raza"=>$dt['cve_raza'],
			"nombre"=>$dt['nombre'],
		));
	}
	echo json_encode($datos);
	break;

	case 'guardarMascota':
	$cve_raza = trim($_POST['cve_raza']);
	$nombre = trim($_POST['nombre']);
	$nacimiento = trim($_POST['nacimiento']);
	$sexo = trim($_POST['sexo']);
	$imagen= $_FILES['imagen']['name'];
	move_uploaded_file($_FILES['imagen']['tmp_name'], "../Img/".$imagen);

	$mascotas->set('cve_raza',$cve_raza);
	$mascotas->set('imagen',$imagen);
	$mascotas->set('nombre',$nombre);
	$mascotas->set('nacimiento',$nacimiento);
	$mascotas->set('sexo',$sexo);
	$mascotas->set('cve_persona',$_SESSION['cve_cliente']);

	//inicio de transaccion
	if($nombre != ""){
		$status = true;
		$con->autocommit(false);
		$cve_mascota = $mascotas->guardarMascota();
		$status = $con->check($status);
		$info = $con->send($status);
		//fin
	}else{
		$info = false;
	}

	if($info){
		echo $cve_mascota;
	}else{
		echo "error";
	}
	break;
	case 'editarMascota':
	$cve_mascota=trim($_POST['cve_mascota']);
	$cve_raza = trim($_POST['cve_raza']);
	$nombre = trim($_POST['nombre']);
	$nacimiento = trim($_POST['nacimiento']);
	$sexo = trim($_POST['sexo']);
	if ($_POST['vacio']=="lleno") {
		$imagen= $_FILES['imagen']['name'];
		move_uploaded_file($_FILES['imagen']['tmp_name'], "../Img/".$imagen);
		$mascotas->set('imagen',$imagen);
		$mascotas->editarImagen($cve_mascota);
	}

	$mascotas->set('cve_raza',$cve_raza);
	$mascotas->set('nombre',$nombre);
	$mascotas->set('nacimiento',$nacimiento);
	$mascotas->set('sexo',$sexo);
	
	$mascotas->editarMascota($cve_mascota);
	echo "success";
			
	break;
	case 'eliminarMascota':
	$id = $_POST['cve_mascota'];
	$mascotas->eliminarMascota($id);
	echo 'success';
	break;

	case 'guardarCve_mascota':
	$id = $_POST['cve_mascota'];
	session_start();
	$_SESSION['cve_mascota']=$id;
	echo 'success';
	break;

	case 'traerHistorialFecha':
	$fecha = $_POST['fecha'];
	$mascotas->set('fecha',$fecha);
	$mascotas->set('cve_mascota',$_SESSION['cve_mascota']);
	$rs=$mascotas->verHistorialFecha();
	$datos=array();
	while ($dt=$rs->fetch_assoc()) {
		array_push($datos, array(
			"fecha"=>$dt['fecha'],
			"nombre"=>$dt['nombre']
		));
	}
	echo json_encode($datos);
	break;
}