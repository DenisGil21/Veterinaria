<?php 
session_start();
if ($_SESSION['cve_usuario']=="") {
	header('Location: /Veterinaria/');
}
 ?>