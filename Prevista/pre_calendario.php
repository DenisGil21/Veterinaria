<?php 
include '../Config/Autoload.php';
\Config\Autoload::run();


$con = new \Model\Conexion();
$citas = new \Model\Citas($con);
session_start();
date_default_timezone_set('America/Mexico_City');

if ($_SESSION['tipo_usuario']!=3) {
	$rs = $citas->verCitas();
	$datos = array();
	while($dt = $rs->fetch_assoc()){

		$horaInicial=$dt['hora'];
		$minutoAnadir=30;
		$segundos_horaInicial=strtotime($horaInicial);
		$segundos_minutoAnadir=$minutoAnadir*60;
		$nuevaHora=date("H:i",$segundos_horaInicial+$segundos_minutoAnadir);
		$color;
		if ($dt['activo']==0) {
			$color="#FB1635";
		}elseif ($dt['activo']==1) {
			$color="#118930";

		}
		array_push($datos, array(
			"id" => $dt['cve_cita'],
			"title" => $dt['nombre'].' '.$dt['apellidos'],
			"start" => $dt['fecha'].' '.$dt['hora'],
			"end" => $dt['fecha'].' '.$nuevaHora,
			"color"=>$color,
			// "nota" => $dt['nota'],
			"fecha" => $dt['fecha'],
			"nombre" => $dt['nombre'].' '.$dt['apellidos'],
			"hora" =>$dt['hora']
		));
	}

	echo json_encode($datos);	
}else{
	$citas->set('cve_persona',$_SESSION['cve_usuario']);
	$rs = $citas->verCitasCliente();
	$datos = array();
	while($dt = $rs->fetch_assoc()){

		$horaInicial=$dt['hora'];
		$minutoAnadir=30;
		$segundos_horaInicial=strtotime($horaInicial);
		$segundos_minutoAnadir=$minutoAnadir*60;
		$nuevaHora=date("H:i",$segundos_horaInicial+$segundos_minutoAnadir);
		$color;
		if ($dt['activo']==0) {
			$color="#FB1635";
		}elseif ($dt['activo']==1) {
			$color="#118930";

		}
		array_push($datos, array(
			"id" => $dt['cve_cita'],
			"title" => $dt['nombre'].' '.$dt['apellidos'],
			"start" => $dt['fecha'].' '.$dt['hora'],
			"end" => $dt['fecha'].' '.$nuevaHora,
			"color"=>$color,
			// "nota" => $dt['nota'],
			"fecha" => $dt['fecha'],
			"nombre" => $dt['nombre'].' '.$dt['apellidos'],
			"hora" =>$dt['hora']
		));
	}

	echo json_encode($datos);	
}

?>