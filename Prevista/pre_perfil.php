<?php 
include '../Config/Autoload.php';
\Config\Autoload::run();

$con = new \Model\Conexion();
$usuarios = new \Model\Usuarios($con);
$usuarios->set('cve_usuario',$_SESSION['cve_usuario']);
$rs=$usuarios->verPerfil();

?>