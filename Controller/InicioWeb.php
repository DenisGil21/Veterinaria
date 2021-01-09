<?php 
include '../Config/Autoload.php';
\Config\Autoload::run();

$con = new \Model\Conexion();
$personas = new \Model\Personas($con);
$usuarios = new \Model\Usuarios($con);

switch ($_POST['accion']) {

	case 'registroUsuario':
	$nombre = trim($_POST['nombre']);
	$apellidos = trim($_POST['apellidos']);
	$telefono = trim($_POST['telefono']);
	$correo = trim($_POST['correo']);
	$contrasena = trim($_POST['contrasena']);
	$password =password_hash($contrasena, PASSWORD_BCRYPT);

	$personas->set('nombre',$nombre);
	$personas->set('apellidos',$apellidos);
	$personas->set('telefono',$telefono);
	$usuarios->set('correo',$correo);
	$usuarios->set('contrasena',$password);

	$rs=$usuarios->validarLogin();
	$dt=$rs->fetch_assoc();
	$num2=$rs->num_rows;
	if ($num2>0) {
		echo "correo";
		return false;
	}

	// return false;

	//inicio de transaccion
	if($nombre != ""){
		$status = true;
		$con->autocommit(false);
		$cve_persona = $personas->guardarPersona();
		$status = $con->check($status);
		$usuarios->set('cve_usuario',$cve_persona);		
		$cve_usuario=$usuarios->guardarUsuario();
		$status = $con->check($status);
		$info = $con->send($status);
		session_start();
		$rs2=$usuarios->validarLogin();
		$dt2=$rs2->fetch_assoc();
		$_SESSION['cve_usuario']=$cve_persona;
		$_SESSION['cve_empresa']=$dt2['cve_empresa'];
		$_SESSION['tipo_usuario']=$dt2['tipo'];
		$_SESSION['correo']=$dt2['correo'];
		$_SESSION['img_perfil']=$dt2['imagen'];
		$_SESSION['empresa']=$dt2['empresa'];
		$_SESSION['cve_cliente']=$cve_persona;
		//fin
	}else{
		$info = false;
	}

	if($info){
		echo $cve_persona;
	}else{
		echo "error";
	}
	break;

		case 'inicioSesion':
	$correo = trim($_POST['correo']);
	$contrasena = trim($_POST['contrasena']);
	$usuarios->set('correo',$correo);

	$rs=$usuarios->validarLogin();
	$dt=$rs->fetch_assoc();
	$clave=$dt['contrasena'];
	if (password_verify($contrasena,$clave)) {
		session_start();
		$_SESSION['cve_usuario']=$dt['cve_usuario'];
		$_SESSION['cve_empresa']=$dt['cve_empresa'];
		$_SESSION['tipo_usuario']=$dt['tipo'];
		$_SESSION['correo']=$dt['correo'];
		$_SESSION['img_perfil']=$dt['imagen'];
		$_SESSION['empresa']=$dt['empresa'];
		$_SESSION['cve_cliente']=$dt['cve_usuario'];
		echo $_SESSION['tipo_usuario'];
	}else{
		echo "error";
	}
	break;
}


?>
