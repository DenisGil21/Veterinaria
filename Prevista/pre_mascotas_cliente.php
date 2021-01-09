<?php 
include '../Config/Autoload.php';
\Config\Autoload::run();

$con = new \Model\Conexion();
$mascotas = new \Model\Mascotas($con);
$especies = new \Model\Especies($con);
$mascotas->set('cve_persona',$_SESSION['cve_usuario']);
$rs=$mascotas->verMascotas();
$rsE=$especies->verEspecies();
?>