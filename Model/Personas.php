<?php 
namespace Model;
/**
*
*/
class Personas {

	private $con;
	private $cve_persona;
	private $nombre;
	private $apellidos;
	private $telefono;


	function __construct($con) {
		$this->con = $con;
	}

	public function set($atributo, $parametro) {
		$this->$atributo = $parametro;
	}

	public function get($atributo) {
		return $this->$atributo;
	}

	public function guardarPersona() {
		$sql = "INSERT INTO personas (nombre, apellidos,telefono, activo) VALUES ('$this->nombre', '$this->apellidos', '$this->telefono', b'1')";
		$this->con->query($sql);
		return $this->con->lastId();
	}

	public function verClientes(){
		$sql="SELECT * FROM personas AS p LEFT JOIN usuarios AS us ON cve_persona=cve_usuario WHERE NOT EXISTS(SELECT * FROM personas as pe, empleados as em WHERE pe.cve_persona=em.cve_empleado AND em.cve_empleado=p.cve_persona) and p.activo=b'1'";
		return $this->con->query($sql);
	}

	public function verCliente(){
		$sql="SELECT * FROM personas AS p LEFT JOIN usuarios AS us ON cve_persona=cve_usuario WHERE p.activo=b'1' AND p.cve_persona='$this->cve_persona'";
		return $this->con->query($sql);
	}

	public function editarPersona($id) {
		$sql = "UPDATE personas SET nombre='$this->nombre', apellidos='$this->apellidos', telefono='$this->telefono' WHERE cve_persona=$id";
		$this->con->query($sql);
	}

	public function eliminarCliente($id) {
		$sql = "UPDATE personas SET activo=b'0' WHERE cve_persona=$id";
		$this->con->query($sql);
		$sql2 = "UPDATE usuarios SET activo=b'0' WHERE cve_usuario=$id";
		$this->con->query($sql2);
	}

}
?>
