<?php 
include '../Config/Autoload.php';
\Config\Autoload::run();

$con = new \Model\Conexion();
$personas = new \Model\Personas($con);
$usuarios = new \Model\Usuarios($con);

switch ($_POST['accion']) {

	case 'actualizarPersonal':
	$cve_usuario=$_POST['cve_usuario'];
	$nombre = trim($_POST['nombre']);
	$apellidos = trim($_POST['apellidos']);
	$telefono = trim($_POST['telefono']);

	$personas->set('nombre',$nombre);
	$personas->set('apellidos',$apellidos);
	$personas->set('telefono',$telefono);
	$personas->editarPersona($cve_usuario);
	echo "success";
			
	break;
	case 'eliminarCliente':
	$id = $_POST['cve_persona'];
	$personas->eliminarCliente($id);
	echo 'success';
	break;

	case 'actualizarCuenta':
	$cve_usuario=$_POST['cve_usuario'];
	$contrasena = trim($_POST['contrasena']);

	$password =password_hash($contrasena, PASSWORD_BCRYPT);
	$usuarios->set('contrasena',$password);
	$usuarios->editarUsuario($cve_usuario);
	echo "success";
			
	break;

	case 'actualizarImagen':
	$cve_usuario=$_POST['cve_usuario'];
	$imagen= $_FILES['imagen']['name'];
	move_uploaded_file($_FILES['imagen']['tmp_name'], "../Img/".$imagen);

	$usuarios->set('imagen',$imagen);
	$usuarios->editarImgPerfil($cve_usuario);
	echo "success";
			
	break;

	case 'eliminarCliente':
	$id = $_POST['cve_persona'];
	$personas->eliminarCliente($id);
	echo 'success';
	break;
}


?>