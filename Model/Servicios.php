<?php 
namespace Model;
/**
*
*/
class Servicios {

	private $con;
	private $nombre;
	private $precio;

	function __construct($con) {
		$this->con = $con;
	}


	public function set($atributo, $parametro) {
		$this->$atributo = $parametro;
	}

	public function get($atributo) {
		return $this->$atributo;
	}

	public function guardarServicio() {
		$sql = "INSERT INTO servicios (nombre, precio, activo) VALUES ('$this->nombre', '$this->precio', b'1')";
		$this->con->query($sql);
		return $this->con->lastId();
	}

	public function verServicios(){
		$sql="SELECT * FROM servicios WHERE activo=b'1'";
		return $this->con->query($sql);
	}

	public function editarServicio($id) {
		$sql = "UPDATE servicios SET nombre='$this->nombre', precio='$this->precio' WHERE cve_servicio=$id";
		$this->con->query($sql);
	}

	public function eliminarServicio($id) {
		$sql = "UPDATE servicios SET activo=b'0' WHERE cve_servicio=$id";
		$this->con->query($sql);
	}

}
?>
