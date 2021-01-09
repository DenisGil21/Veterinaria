<?php 
include '../Config/Autoload.php';
\Config\Autoload::run();

$con = new \Model\Conexion();
$servicios = new \Model\Servicios($con);

$rs=$servicios->verServicios();

 ?>