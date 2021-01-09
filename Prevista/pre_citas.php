<?php 
include '../Config/Autoload.php';
\Config\Autoload::run();

$con = new \Model\Conexion();
$clientes = new \Model\Personas($con);
$horarios = new \Model\Horarios($con);

$rsCli=$clientes->verClientes();
$rsH=$horarios->verHorarios();

 ?>