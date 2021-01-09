<?php 
namespace Model;
/**
*
*/
class Razas {

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

	public function guardarRaza() {
		$sql = "INSERT INTO razas (cve_especie, nombre, activo) VALUES ('$this->cve_especie', '$this->nombre', b'1')";
		$this->con->query($sql);
		return $this->con->lastId();
	}

	public function verRazas(){
		$sql="SELECT ra.cve_raza,ra.nombre FROM razas AS ra, especies AS es WHERE ra.cve_especie=es.cve_especie AND ra.cve_especie='$this->cve_especie' ORDER BY ra.nombre asc";
		return $this->con->query($sql);
	}
	
}
?>
