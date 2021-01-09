<?php 
include '../Config/Autoload.php';
\Config\Autoload::run();

$con = new \Model\Conexion();
$clientes = new \Model\Personas($con);
$mascotas = new \Model\Mascotas($con);
$ventas = new \Model\Ventas($con);
$citas = new \Model\Citas($con);

$rsCli=$clientes->verClientes();
$numCli=$rsCli->num_rows;
$rsM=$mascotas->verMascotasGeneral();
$numM=$rsM->num_rows;
$rsVent=$ventas->verVentasHoy();
$numV=$rsVent->num_rows;
$rsCi=$citas->verCitasHoy();
$numCitas=$rsCi->num_rows;
 ?>