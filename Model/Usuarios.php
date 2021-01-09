<?php 
namespace Model;
/**
*
*/
class Usuarios {

	private $con;
	private $cve_usuario;
	private $correo;
	private $contrasena;
	private $imagen;


	function __construct($con) {
		$this->con = $con;
	}

	public function set($atributo, $parametro) {
		$this->$atributo = $parametro;
	}

	public function get($atributo) {
		return $this->$atributo;
	}

	public function guardarUsuario() {
		$sql = "INSERT INTO usuarios (cve_usuario,imagen,correo, contrasena,tipo,activo) VALUES ('$this->cve_usuario','usuario.png','$this->correo', '$this->contrasena',3,b'1')";
		$this->con->query($sql);
		return $this->con->lastId();
	}

	public function editarImgPerfil($id) {
		$sql = "UPDATE usuarios SET imagen='$this->imagen' WHERE cve_usuario=$id";
		$this->con->query($sql);
	}

	public function editarUsuario($id) {
		$sql = "UPDATE usuarios SET contrasena='$this->contrasena' WHERE cve_usuario=$id";
		$this->con->query($sql);
	}

	public function validarLogin(){
		$sql = "SELECT us.cve_usuario,us.correo,us.contrasena,us.imagen,us.tipo,us.activo,per.nombre,per.apellidos,per.telefono,per.cve_persona,em.cve_empresa,em.nombre AS empresa,emp.cve_empleado FROM usuarios AS us LEFT JOIN personas AS per ON us.cve_usuario=per.cve_persona LEFT JOIN empleados AS emp ON per.cve_persona=emp.cve_empleado LEFT JOIN empresa AS em ON emp.cve_empresa=em.cve_empresa WHERE us.correo='$this->correo' AND us.activo=b'1'";
		return $this->con->query($sql);
	}

	public function tieneUsuario(){
		$sql = "SELECT * FROM usuarios WHERE cve_usuario='$this->cve_usuario'";
		return $this->con->query($sql);
	}

	public function verPerfil(){
		$sql = "SELECT * FROM usuarios AS us, personas AS per WHERE per.cve_persona=us.cve_usuario AND us.cve_usuario='$this->cve_usuario'";
		return $this->con->query($sql);
	}

}
?>
