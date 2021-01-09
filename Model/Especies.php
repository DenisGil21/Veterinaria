<?php 
namespace Model;
/**
*
*/
class Especies {

	private $con;
	private $cve_raza;
	private $cve_especie;
	private $nombre;


	function __construct($con) {
		$this->con = $con;
	}

	public function set($atributo, $parametro) {
		$this->$atributo = $parametro;
	}

	public function get($atributo) {
		return $this->$atributo;
	}

	public function guardarEspecie() {
		$sql = "INSERT INTO especies (nombre, activo) VALUES ('$this->nombre', b'1')";
		$this->con->query($sql);
		return $this->con->lastId();
	}

	public function verEspecies(){
		$sql="SELECT * FROM especies";
		return $this->con->query($sql);
	}
	
}
?>