<?php 
include '../Config/Autoload.php';
\Config\Autoload::run();

$con = new \Model\Conexion();
$clientes = new \Model\Personas($con);

$rsCli=$clientes->verClientes();

 ?>