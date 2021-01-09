<?php 
include '../Config/Autoload.php';
\Config\Autoload::run();

$con = new \Model\Conexion();
$empresa = new \Model\Empresa($con);
$horarios = new \Model\Horarios($con);
$rs=$empresa->verEmpresa();
$horarios->set('cve_empresa',$_SESSION['cve_empresa']);
$rsH=$horarios->verHorarios();

?>