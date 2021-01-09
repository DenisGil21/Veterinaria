<?php 
include '../Config/Autoload.php';
\Config\Autoload::run();

$con = new \Model\Conexion();
$personas = new \Model\Personas($con);
$usuarios = new \Model\Usuarios($con);

switch ($_POST['accion']) {

	case 'guardarCliente':
	$nombre = trim($_POST['nombre']);
	$apellidos = trim($_POST['apellidos']);
	$telefono = trim($_POST['telefono']);
	$correo = trim($_POST['correo']);
	$contrasena = trim($_POST['contrasena']);
	$password =password_hash($contrasena, PASSWORD_BCRYPT);

	$personas->set('nombre',$nombre);
	$personas->set('apellidos',$apellidos);
	$personas->set('telefono',$telefono);

	if ($correo!="") {
		$usuarios->set('correo',$correo);
		$rs=$usuarios->validarLogin();
		$num=$rs->num_rows;
		if ($num>0) {
			echo "correo";
			return false;
		}
	}

	// return false;

	//inicio de transaccion
	if($nombre != ""){
		$status = true;
		$con->autocommit(false);
		$cve_persona = $personas->guardarPersona();
		$status = $con->check($status);
		$usuarios->set('cve_usuario',$cve_persona);
		if ($correo!="") {
			$usuarios->set('contrasena',$password);		
			$cve_usuario=$usuarios->guardarUsuario();
			$status = $con->check($status);
		}
		$info = $con->send($status);
		//fin
	}else{
		$info = false;
	}

	if($info){
		$rsCli=$personas->verClientes();
		$tabla="";
		$datos="";
		while ($dt=$rsCli->fetch_assoc()) {
			$correo=($dt['correo']=="")? "Sin correo":$dt['correo'];
			$datos.= '<tr id="'.$dt['cve_persona'].'" nombre="'.$dt['nombre'].'" apellidos="'.$dt['apellidos'].'" telefono="'.$dt['telefono'].'" correo="'.$dt['correo'].'">
			<td>'.$dt['nombre'].'</td>
			<td>'.$dt['apellidos'].'</td>
			<td>'.$dt['telefono'].'</td>
			<td>'.$correo.'</td>
			<td><button class="btn modal-trigger #1976d2 blue darken-2 editar" data-target="modalCliente"><i class="fas fa-edit"></i></button></td>
			<td><button class="btn waves-effect waves-light #d32f2f red darken-2 eliminar"><i class="fas fa-trash-alt"></i></button></td>
			<td><button class="btn waves-effect waves-light #455a64 blue-grey darken-2 mascotas"><i class="fas fa-paw"></i></button></td>
			</tr>';
		}

		$tabla.='<table class="row-border centered responsive-table clientes" id="tabla">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Apellidos</th>
							<th>Teléfono</th>
							<th>Correo</th>
							<th>Editar</th>
							<th>Borrar</th>
							<th>Mascotas</th>
						</tr>
					</thead>

					<tbody>
						'.$datos.'
					</tbody>
				</table>';

		echo $tabla;
	}else{
		echo "error";
	}
	break;
	case 'editarCliente':
	$cve_persona=$_POST['cve_persona'];
	$nombre = trim($_POST['nombre']);
	$apellidos = trim($_POST['apellidos']);
	$telefono = trim($_POST['telefono']);
	$correo = trim($_POST['correo']);
	$contrasena = trim($_POST['contrasena']);
	$password =password_hash($contrasena, PASSWORD_BCRYPT);

	$personas->set('nombre',$nombre);
	$personas->set('apellidos',$apellidos);
	$personas->set('telefono',$telefono);

	$personas->editarPersona($cve_persona);
	$usuarios->set('cve_usuario',$cve_persona);
	$usuarios->set('contrasena',$password);
	$rs=$usuarios->tieneUsuario();
	$num=$rs->num_rows;
	if ($num==0) {
		$usuarios->set('correo',$correo);
		$rs2=$usuarios->validarLogin();
			$num2=$rs2->num_rows;
			if ($num2>0) {
				echo "correo";
				return false;
			}
		$usuarios->guardarUsuario();
	}else{
		$usuarios->editarUsuario($cve_persona);
	}
	$rsCli=$personas->verClientes();
		$tabla="";
		$datos="";
		while ($dt=$rsCli->fetch_assoc()) {
			$correo=($dt['correo']=="")? "Sin correo":$dt['correo'];
			$datos.= '<tr id="'.$dt['cve_persona'].'" nombre="'.$dt['nombre'].'" apellidos="'.$dt['apellidos'].'" telefono="'.$dt['telefono'].'" correo="'.$dt['correo'].'">
			<td>'.$dt['nombre'].'</td>
			<td>'.$dt['apellidos'].'</td>
			<td>'.$dt['telefono'].'</td>
			<td>'.$correo.'</td>
			<td><button class="btn modal-trigger #1976d2 blue darken-2 editar" data-target="modalCliente"><i class="fas fa-edit"></i></button></td>
			<td><button class="btn waves-effect waves-light #d32f2f red darken-2 eliminar"><i class="fas fa-trash-alt"></i></button></td>
			<td><button class="btn waves-effect waves-light #455a64 blue-grey darken-2 mascotas"><i class="fas fa-paw"></i></button></td>
			</tr>';
		}

		$tabla.='<table class="row-border centered responsive-table clientes" id="tabla">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Apellidos</th>
							<th>Teléfono</th>
							<th>Correo</th>
							<th>Editar</th>
							<th>Borrar</th>
							<th>Mascotas</th>
						</tr>
					</thead>

					<tbody>
						'.$datos.'
					</tbody>
				</table>';

		echo $tabla;
			
	break;
	case 'eliminarCliente':
	$id = $_POST['cve_persona'];
	$personas->eliminarCliente($id);
	$rsCli=$personas->verClientes();
		$tabla="";
		$datos="";
		while ($dt=$rsCli->fetch_assoc()) {
			$correo=($dt['correo']=="")? "Sin correo":$dt['correo'];
			$datos.= '<tr id="'.$dt['cve_persona'].'" nombre="'.$dt['nombre'].'" apellidos="'.$dt['apellidos'].'" telefono="'.$dt['telefono'].'" correo="'.$dt['correo'].'">
			<td>'.$dt['nombre'].'</td>
			<td>'.$dt['apellidos'].'</td>
			<td>'.$dt['telefono'].'</td>
			<td>'.$correo.'</td>
			<td><button class="btn modal-trigger #1976d2 blue darken-2 editar" data-target="modalCliente"><i class="fas fa-edit"></i></button></td>
			<td><button class="btn waves-effect waves-light #d32f2f red darken-2 eliminar"><i class="fas fa-trash-alt"></i></button></td>
			<td><button class="btn waves-effect waves-light #455a64 blue-grey darken-2 mascotas"><i class="fas fa-paw"></i></button></td>
			</tr>';
		}

		$tabla.='<table class="row-border centered responsive-table clientes" id="tabla">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Apellidos</th>
							<th>Teléfono</th>
							<th>Correo</th>
							<th>Editar</th>
							<th>Borrar</th>
							<th>Mascotas</th>
						</tr>
					</thead>

					<tbody>
						'.$datos.'
					</tbody>
				</table>';

		echo $tabla;
	break;

	case 'guardarCve_cliente':
	$id = $_POST['cve_persona'];
	session_start();
	$_SESSION['cve_cliente']=$id;
	echo 'success';
	break;
}


?>
