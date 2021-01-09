<?php 
include '../Config/Autoload.php';
\Config\Autoload::run();
session_start();
$con = new \Model\Conexion();
$empresa = new \Model\Empresa($con);

switch ($_POST['accion']) {

	case 'actualizarEmpresa':
	$cve_empresa=$_POST['cve_empresa'];
	$nombre = trim($_POST['nombre']);
	$direccion = trim($_POST['direccion']);
	$telefono = trim($_POST['telefono']);

	$empresa->set('nombre',$nombre);
	$empresa->set('direccion',$direccion);
	$empresa->set('telefono',$telefono);
	$empresa->editarEmpresa($cve_empresa);
	$_SESSION['empresa']=$nombre;
	echo "success";
			
	break;
}


?>