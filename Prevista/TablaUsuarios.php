<?php 
include '../Config/Autoload.php';
\Config\Autoload::run();

$con = new \Model\Conexion();
$clientes = new \Model\Personas($con);

$rsCli=$clientes->verClientes();

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
 ?>