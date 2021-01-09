<?php 
include '../Config/Autoload.php';
\Config\Autoload::run();

$con = new \Model\Conexion();
$clientes = new \Model\Personas($con);
$servicios = new \Model\Servicios($con);
$ventas = new \Model\Ventas($con);

$rsCli=$clientes->verClientes();
$rsSer=$servicios->verServicios();
$rsVent=$ventas->verVentasHoy();
 ?>