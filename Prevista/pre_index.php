<?php 
include 'Model/Conexion.php';
include 'Model/Empresa.php';
$con = new \Model\Conexion();
$empresa = new \Model\Empresa($con);

$rs=$empresa->verEmpresa();
$dt=$rs->fetch_assoc();
 ?>