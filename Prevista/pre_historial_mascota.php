<?php 
include '../Config/Autoload.php';
\Config\Autoload::run();

$con = new \Model\Conexion();
$mascotas = new \Model\Mascotas($con);
$mascotas->set('cve_mascota',$_SESSION['cve_mascota']);
$rsH=$mascotas->verHistorialMascota();
$rsM=$mascotas->verMascota();
?>